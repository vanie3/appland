<?php
/**
 * Textarea option
 *
 * @package AppLand
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */

/**
 * Simple Select option
 */
class OxyFont extends OxyOption {

    /**
     * Creates option
     *
     * @return void
     * @since 1.0
     **/
    function __construct( $field, $value, $attr ) {
        parent::__construct( $field, $value, $attr );

        $this->set_attr( 'data-theme', THEME_URI );
        $this->set_attr( 'class', 'oxy-font-field font-option with-preview' );

        if( isset( $value['font'] ) ) {
            $this->_value = $value['font'];
            // set variant if we have one
            if( isset( $value['variant'] ) ) {
                if( is_array($value['variant'] ) ){
                    $this->set_attr( 'data-variant', implode( ',', $value['variant'] ) );
                }
                else {
                    $this->set_attr( 'data-variant', $value['variant'] );
                }
            }
            if( isset( $value['subsets'] ) ) {
                if( is_array( $value['subsets'] ) ) {
                    $this->set_attr( 'data-subsets', implode( ',', $value['subsets'] ) );
                }
                else {
                    $this->set_attr( 'data-subsets', $value['subsets'] );
                }
            }
        }
    }

    /**
     * Overrides super class render function
     *
     * @return string HTML for option
     * @since 1.0
     **/
    public function render($echo=true) {
        //if it is not an array , search the backend for the select options
       // if( !is_array( $this->_field['options'] ) ) {
        $this->load_select_options();
       // }

        $option = '<select' . $this->create_attributes() . ' id="'.$this->_field['id'].'">';

        if( isset( $this->_field['blank'] ) ) {
            $option .= '<option value="">' . $this->_field['blank'] . '</option>';
        }

        $option .= $this->create_select_options( $this->_field['options'], $this->_value );

        $option .= '</select>';

        echo $option;
    }



    function load_select_options() {
        $data = $this->load_select_data();
        $this->build_options_from_data( $data );
    }


    function load_select_data() {
        // get data
        $data = array();

        $options = get_option( THEME_SHORT. '-options' );
        // option exists , so just grab it
        if( isset( $options['unregistered'][$this->_field['option']] ) ) {
            $data = $options['unregistered'][$this->_field['option']];
        }else {
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
            // TODO : include typekit fonts.
        }


        return $data;
    }

    function build_options_from_data( $data ) {
        $this->_field['options'] = array();
        if( !empty( $data ) ) {
            foreach( $data as $key => $entry ) {
                $this->_field['options'][$key] = $entry;
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
                $options_html .= $this->create_select_options( $name, $selected_value );
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

    public function enqueue() {
        parent::enqueue();

        // load font stylesheet
        wp_enqueue_style( 'oxy-option-fonts', ADMIN_CSS_URI . 'options/oxy-option-fonts.css' );
        // load scripts only once
        if( !wp_script_is('font-field')){
            wp_enqueue_script( 'font-field', ADMIN_OPTIONS_URI . 'fields/font/font.js', array( 'jquery', 'oxy-font-plugin','select2-plugin' ) );
        }
    }

}