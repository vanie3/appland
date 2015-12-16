<?php

define( 'FONT_STYLE_OPTIONS', 'body_font,headings_font' );
define( 'GOOGLE_API_KEY', 'AIzaSyDVQGrQVBkgCBi9JgPiPpBeKN69jIRk8ZA' );

if( is_admin() ) {
    add_action( 'admin_print_scripts', 'register_google_fonts_info' );

    // register  font info ajax call
    add_action( 'wp_ajax_fetch_font_info', 'oxy_fetch_font_info' );
    add_action( 'wp_ajax_nopriv_fetch_font_info', 'oxy_fetch_font_info' );

     // register fonts list ajax call
    add_action( 'wp_ajax_fetch_fonts_list', 'oxy_fetch_fonts_list' );
    add_action( 'wp_ajax_nopriv_fetch_fonts_lists', 'oxy_fetch_fonts_list' );

    // create font field options again after update
    add_action( 'wp_ajax_create_font_options', 'oxy_create_font_options' );
    add_action( 'wp_ajax_nopriv_create_font_options', 'oxy_create_font_options' );

}

function register_google_fonts_info(){

    wp_localize_script( 'oxy-font-plugin', 'localData', array(
        // URL to wp-admin/admin-ajax.php to process the request
        'ajaxurl'   => admin_url( 'admin-ajax.php' ),
        // generate a nonce with a unique ID "myajax-post-comment-nonce"
        // so that you can check it later when an AJAX request is sent
        'nonce'     => wp_create_nonce( 'oxygenna-fetch-font-info-nonce' ),
        )
    );

    global $oxy_theme_options;
    if( isset($oxy_theme_options['unregistered']['google_fonts']) ) {
        $fonts = $oxy_theme_options['unregistered']['google_fonts'];
    }
    else{
        $fonts = array();
    }

    $font_family = isset($oxy_theme_options['font_id'])? $oxy_theme_options['font_id'] : null;
    $family_variation = isset($oxy_theme_options['font_variation'])? $oxy_theme_options['font_variation'] : null ;
    wp_localize_script( 'google_fonts_script', 'localData', array(
        // URL to wp-admin/admin-ajax.php to process the request
        'ajaxurl'   => admin_url( 'admin-ajax.php' ),
        // generate a nonce with a unique ID "myajax-post-comment-nonce"
        // so that you can check it later when an AJAX request is sent
        'nonce'     => wp_create_nonce( 'oxygenna-fetch-fonts-list-nonce' ),
        'fonts'     => $fonts,
        'family'    => $font_family,
        'variation' => $family_variation
        )
    );
}

function oxy_update_typography() {
    global $oxy_theme_options;
    $body = oxy_get_option('body_font');
    $heading = oxy_get_option('headings_font');
    if( $body!= false && isset($body['font']) || $heading!= false && isset($heading['font']) ) {
        if($body['font']!= ""){
            $bodyfont = create_font( 'body_font' );
            $headingsfont = create_font( 'headings_font' );
            $url = create_import_url();

$css = <<<CSS
{$url}
html > body, input, button, textarea {
    {$bodyfont}
}
h1, h2, h3, h4, h5, h6, .navbar .brand {
    {$headingsfont}
    text-transform: uppercase;
    font-weight: 700;
}
CSS;

            update_option( THEME_SHORT . '-font-css', $css );
        }
    }
}


add_action( 'oxy-options-updated-appland-fonts', 'oxy_update_typography' );


function create_import_url(){
    $providers = array(
        'google' => array(),
        'typekit'=> array() //unused at the moment
    );
    $font_options = explode( ',', FONT_STYLE_OPTIONS );
    foreach( $font_options as $option ) {
        $font = oxy_get_option( $option );
        // check who provides the font. not set if it's system
        if(isset($font['provider'])){
            switch( $font['provider'] ) {
                case 'google':
                    $key = str_replace( ' ', '_', $font['font'] );
                    // check if font has been added by another option - if not create it
                    if( !isset( $providers['google'][$key] ) ) {
                        $providers['google'][$key] = array();
                        $providers['google'][$key]['variants'] = array();
                        $providers['google'][$key]['subsets'] = array();
                        $providers['google'][$key]['code'] = str_replace( ' ', '+', $font['font'] );

                    }

                    $font_variants = array();
                    if(isset($font['variant']) && !empty($font['variant'])){
                        $font_variants = explode( ',', $font['variant'] );
                    }
                    if(!empty($font_variants)){
                        foreach( $font_variants as $variant ) {
                            $providers['google'][$key]['variants']['_'.$variant] = $variant;
                        }
                    }

                    $font_subsets = array();
                    if(isset($font['subsets']) && !empty($font['subsets'])){
                        $font_subsets = explode( ',', $font['subsets'] );
                    }
                    if(!empty($font_subsets)){
                        foreach( $font_subsets as $subset ) {
                            $providers['google'][$key]['subsets'][$subset] = $subset;
                        }
                    }
                break;
                case 'typekit':
                break;
            }
        }
    }
    // build final providers
    $providers_final = array();
    // check for google fonts
    $google = oxy_create_google_provider( $providers['google'] );
    if( null !== $google ) {
        $providers_final[] = $google;
    }
    // check for typekit// do we have any fonts to be loaded by providers?
    $typekit = oxy_create_typekit_provider( $providers['typekit'] );
    if( null !== $typekit ) {
        $providers_final[] = $typekit;
    }

    if( !empty( $providers_final ) ) {
        return implode( ',', $providers_final );
    }
    else{
        return "";
    }

}

function oxy_create_google_provider( $fonts ) {
    if( !empty( $fonts ) ) {
        $font_codes = array();
        $subsets = array();
        foreach( $fonts as $font ) {
            $variants = empty( $font['variants'] ) ? '' : ':' . implode( ',', $font['variants'] );
            if( isset( $font['subsets'] ) ) {
                foreach( $font['subsets'] as $add_subset ) {
                    $subsets[] = $add_subset;
                }
            }
            $font_codes[] = $font['code'] . $variants;
        }
        $families = implode( '|' , $font_codes );
        $subsets_url = empty( $subsets ) ? '' : '&subset=' . implode( ',', $subsets );
        return '@import url(http://fonts.googleapis.com/css?family=' . $families . $subsets_url . ');';
    }
    else {
        return null;
    }
}


function oxy_create_typekit_provider( $fonts ) {
    // to be implemented
    return null;
}


function create_font( $id ) {
    $font = oxy_get_option( $id );
    return oxy_get_font_css( $font );
}

function oxy_get_font_css( $font ) {
    $font_family = '';
    switch( $font['provider'] ) {
        case 'system':
            include MODULES_DIR . 'typography/providers/system.php';
            if( array_key_exists( $font['font'], $system_fonts ) ) {
                // create fontstack
                $font_family = implode( ',', $system_fonts[$font['font']]['family'] );
            }
        break;
        case 'google':
            $font_family = "'" . str_replace( '+', ' ', $font['font'] ) . "'";
        break;
        case 'typekit':
            $tkfonts = include MODULES_DIR . 'typography/providers/typekit.php';
            if( null !== $tkfonts ) {
                 foreach( $tkfonts as $tkfont ) {
                     if( $tkfont->id == $font ) {
                         $font_family = $tkfont->css_stack;
                         break;
                     }
                 }
            }
        break;
    }
    $output = "font-family: {$font_family};";

    // if( isset( $font['variant'] ) ) {
    //     $weight_style = oxy_get_font_weight_style( $font['variant'], $font['provider'] );
    //     $output .= "font-style: {$weight_style['style']};";
    // }

    $output = str_replace( "'", '"', $output );

    return $output;
}

function oxy_get_font_weight_style( $variant, $provider ) {
    $variations = array(
        'font-style' => array(
            'n' => 'normal',
            'i' => 'italic',
            'o' => 'oblique'
        ),
        'font-weight' => array(
            '1' => '100',
            '2' => '200',
            '3' => '300',
            '4' => '400',
            '5' => '500',
            '6' => '600',
            '7' => '700',
            '8' => '800',
            '9' => '900',
            '4' => 'normal',
            '7' => 'bold'
        )
    );

    $weight_style = array( 'style' => 'normal', 'weight' => 'normal' );
    if( null !== $variant ) {
        switch( $provider ) {
            case 'google':
                // if variant has italic inside string set style otherwise use normal
                $weight_style['style'] = ( strpos( $variant, 'italic' ) === FALSE ) ? 'normal' : 'italic';
                // remove italic from weight
                $weight_style['weight'] = str_replace( 'italic', '', $variant );
                if( $weight_style['weight'] == '' || $weight_style['weight'] == 'regular' ) {
                    $weight_style['weight'] = 'normal';
                }
            break;
            case 'typekit':
            case 'system':
                if( 2 == strlen( $variant ) ) {
                    $pieces = str_split( $variant, 1 );
                    if( array_key_exists( $pieces[1], $variations['font-weight'] ) ) {
                        $weight_style['weight'] = $variations['font-weight'][$pieces[1]];
                    }
                    if( array_key_exists( $pieces[0], $variations['font-style'] ) ) {
                        $weight_style['style'] = $variations['font-style'][$pieces[0]];
                    }
                }
            break;
        }
    }
    return $weight_style;
}


function oxy_fetch_font_info(){

    include dirname(__FILE__).'/providers/system.php';
    global $oxy_theme_options;
    if( isset($oxy_theme_options['unregistered']['google_fonts']) ) {
        $google_fonts = $oxy_theme_options['unregistered']['google_fonts'];
    }

    if( isset( $_GET['family'] ) ) {
        $name = $_GET['family'];
        $return_font = null;

        switch( $_GET['provider'] ) {
            case 'System Fontstacks':
                $return_font = $system_fonts[$name];
                $return_font['provider'] = 'system';
            break;
            case 'Google Web Fonts':
                foreach( $google_fonts as $font ) {
                    if( $name == $font['family'] ) {
                        $return_font = $font;
                        $return_font['provider'] = 'google';
                        break;
                    }
                }
            break;
            case 'Typekit Fonts':
                $tkfonts = include dirname(__FILE__) . '/typekit.php';
                if( null !== $tkfonts ) {
                    foreach( $tkfonts as $font ) {
                        if( $font->id == $name ) {
                            $return_font = array();
                            $return_font['family'] = $font->css_stack;
                            $return_font['kit-id'] = $kit->kit->id;
                            $return_font['variants'] = $font->variations;
                            $return_font['subsets'] = array();
                            $return_font['provider'] = 'typekit';
                        }
                    }
                }
            break;
        }

        // lookup fonts in list and return
        if( null !== $return_font ) {
            echo json_encode( $return_font );
        }
    }
    die();

}


function oxy_fetch_fonts_list() {
    if( isset( $_POST['nonce'] ) ) {
        if( wp_verify_nonce( $_POST['nonce'], 'oxygenna-fetch-fonts-list-nonce') ) {
            header( 'Content-Type: application/json' );
            $resp = new stdClass();

            $google_api_url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=' . GOOGLE_API_KEY ;
            $response = wp_remote_retrieve_body( wp_remote_get($google_api_url, array('sslverify' => false )));
            if( is_wp_error( $response ) ) {
                $resp->status = 'error';
            } else {
                $resp->status = 'ok';
                $resp->webfonts = array();
                $resp->webfonts = json_decode($response, true);
            }

            // we got a new list , so we update the theme options
            global $oxy_theme_options;
            if( isset($oxy_theme_options['unregistered']['google_fonts']) ) {
                $oxy_theme_options['unregistered']['google_fonts'] = (array) $resp->webfonts['items'];
            } else {
                $oxy_theme_options['unregistered'] = array('google_fonts' => $resp->webfonts['items'] );
            }
            update_option( THEME_SHORT . '-options', $oxy_theme_options );

            }

            echo json_encode($resp);
            die();

    }
}


function oxy_create_font_options(){
    if( isset( $_POST['nonce'] ) && isset( $_POST['id'] ) ) {
        if( wp_verify_nonce( $_POST['nonce'], 'oxygenna-fetch-fonts-list-nonce') ) {
            header( 'Content-Type: application/json' );
            $resp = new stdClass();
            $value = oxy_get_option($_POST['id']);
            $data = array();
            // get default system fonts first
            include MODULES_DIR . 'typography/providers/system.php';
            $data['system_fonts'] = array(
                'optgroup' => __('System Fontstacks', THEME_ADMIN_TD),
            );
            foreach( $system_fonts as $key => $font ) {
                $data['system_fonts'][$key] = implode( ', ', $font['family'] );
            }

            // include google fonts if they exist
            global $oxy_theme_options;
            $google_fonts = false;
            if( isset($oxy_theme_options['unregistered']['google_fonts']) ) {
                $google_fonts = $oxy_theme_options['unregistered']['google_fonts'];
            }
            if( $google_fonts !== false ) {
                // add optgroup label
                $data['google_fonts'] = array(
                    'optgroup' => __('Google Web Fonts', THEME_ADMIN_TD),
                );
                foreach( $google_fonts as $font ) {
                    $data['google_fonts'][$font['family']] = $font['family'];
                }
            }
            $options = array();
            if( !empty( $data ) ) {
                foreach( $data as $key => $entry ) {
                    $options[$key] = $entry;
                }
            }

            $selected = isset($value['font'])? $value['font']:null;
            $resp->options = '<option value="">Choose a family</option>' .create_select_options($options,$selected);
            $resp->status = 'ok';
            $resp->value = $value;
            echo json_encode($resp);
            die();
        }
    }

}

function create_select_options( $options, $selected_value ) {
    $options_html = '';
    foreach( $options as $key => $name ) {
        // check for optgroup
        if( is_array( $name ) ) {
            $label = $name['optgroup'];
            unset( $name['optgroup'] );
            $options_html .= '<optgroup label="' . $label . '">';
            // call recursive self to create optgroup options
            $options_html .= create_select_options( $name, $selected_value );
        }
        else {
            $options_html .= '<option value="' . $key . '"';
            if( is_array( $selected_value ) ) {
                foreach( $selected_value as $multi_val ) {
                    if( $multi_val == $key ) {
                        $selected = $key;
                        $options_html .= ' selected="selected"';
                    }
                }
            }
            if( $selected_value == $key ) {
                $selected = $key;
                $options_html .= ' selected="selected"';
            }
            $options_html .= '>' . $name . '</option>';
        }
        // close if optgroup
        if( is_array( $name ) ) {
            $options_html .= '</optgroup>';
        }
    }
    return $options_html;
}
