<?php
/**
 * Oxygenna.com
 *
 * $Template:: AppLand
 * $Copyright:: (c) 2013 Oxygenna.com
 * $Licence:: http://wiki.envato.com/support/legal-terms/licensing-terms/
 */
// load wordpress
require_once( '../../../../../../../wp-load.php' );
// get system fonts and google fonts if there
include dirname(__FILE__).'/system.php';
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
?>