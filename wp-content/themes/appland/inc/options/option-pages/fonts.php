<?php
/**
 * Sign up options
 *
 * @package AppLand
 * @subpackage options-pages
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */

return array(
    'page_title' => THEME_NAME . ' - ' . __('Typography Settings', THEME_ADMIN_TD),
    'menu_title' => __('Fonts', THEME_ADMIN_TD),
    'slug'       => THEME_SHORT . '-fonts',
    'main_menu'  => false,
    'icon'       => 'tools',
    'sections'   => array(
        'font-section' => array(
            'title'   => __('Fonts settings section', THEME_ADMIN_TD),
            'header'  => __('Setup Fonts settings here.', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name' => __('Typography Preview:', THEME_ADMIN_TD),
                    'id' => 'typography',
                    'type' => 'preview',
                    'size' => 3,
                    'heading'=> __('This is a sample heading', THEME_ADMIN_TD),
                    'default' => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', THEME_ADMIN_TD),
                ),
                array(
                    'name' => __('Update your Google Fonts list', THEME_ADMIN_TD),
                    'id' => 'ajax_list',
                    'type' => 'button',
                    'default' => __('google_update', THEME_ADMIN_TD),
                    'attr' => array(
                        'class' => 'button-primary',
                        'type'  => 'button'
                    ),
                    'javascripts' => array(
                        array(
                            'handle' => 'google_fonts_script',
                            'src'    => INCLUDES_URI . 'options/option-pages/javascripts/update_fonts.js',
                            'deps'   => array( 'jquery','oxy-font-plugin','select2-plugin' ),
                        ),
                    ),
                ),
                array(
                    'name'      =>  __('Select a Body Font', THEME_ADMIN_TD),
                    'desc'      =>  __('Select a Font family', THEME_ADMIN_TD),
                    'id'        => 'body_font',
                    'type'      => 'font',
                    'validation'=> 'font',
                    'default'   => array(),
                    'option'    => 'fonts',
                    'blank'     => __('Choose a family', THEME_ADMIN_TD),
                    'attr' => array(
                        'data-preview-selector'   => 'typography',
                        'data-preview-target'     => 'p',
                        'class'                   => 'chosen',
                        'data-load-font-on-start' => 'true'
                    )
                ),
                array(
                    'name'      =>  __('Select a Headings Font', THEME_ADMIN_TD),
                    'desc'      =>  __('Select a Font family', THEME_ADMIN_TD),
                    'id'        => 'headings_font',
                    'type'      => 'font',
                    'validation'=> 'font',
                    'default'   => array(),
                    'option'    => 'fonts',
                    'blank'     => __('Choose a family', THEME_ADMIN_TD),
                    'attr' => array(
                        'data-preview-selector'   => 'typography',
                        'data-preview-target'     => 'h3',
                        'class'                   => 'chosen',
                        'data-load-font-on-start' => 'true'
                    )
                ),
            )
        )
    )
);