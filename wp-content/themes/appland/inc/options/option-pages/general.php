<?php
/**
 * Test Options Page
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
    'page_title' => THEME_NAME . ' - ' . __('General', THEME_ADMIN_TD),
    'menu_title' => __('General', THEME_ADMIN_TD),
    'slug'       => THEME_SHORT . '-general',
    'main_menu'  => true,
    'icon'       => 'tools',
    'menu_icon'  => ADMIN_ASSETS_URI . 'images/theme.png',
    'sections'   => array(
        'general-section' => array(
            'title'   => __('Site Style', THEME_ADMIN_TD),
            'header'  => __('Set the style of your site', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'    => __('Style', THEME_ADMIN_TD),
                    'desc'    => __('Choose a colour to use for your site', THEME_ADMIN_TD),
                    'id'      => 'site_style',
                    'type'    => 'radio',
                    'options' => array(
                        'theme-green'  => __('Green', THEME_ADMIN_TD),
                        'theme-orange' => __('Orange', THEME_ADMIN_TD),
                        'theme-blue'   => __('Blue', THEME_ADMIN_TD),
                    ),
                    'default' => 'theme-green',
                ),
            )
        ),
        'logo-section' => array(
            'title'   => __('Logo', THEME_ADMIN_TD),
            'header'  => __('Upload and configure your site logo here', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'    => __('Logo Type', THEME_ADMIN_TD),
                    'desc'    => __('Select which kind of logo you would like', THEME_ADMIN_TD),
                    'id'      => 'logo_type',
                    'type'    => 'radio',
                    'options' => array(
                        'text'  => __('Use Text', THEME_ADMIN_TD),
                        'image' => __('Use Image', THEME_ADMIN_TD),
                        'text_image' => __('Both Text & Image', THEME_ADMIN_TD),
                    ),
                    'default' => 'text',
                ),
                array(
                    'name'    => __('Logo Text', THEME_ADMIN_TD),
                    'desc'    => __('Add your logo text here', THEME_ADMIN_TD),
                    'id'      => 'logo_text',
                    'type'    => 'text',
                    'default' => 'AppLand',
                ),
                array(
                    'name'    => __('Logo', THEME_ADMIN_TD),
                    'desc'    => __('Upload a logo for your site', THEME_ADMIN_TD),
                    'id'      => 'logo_image',
                    'store'   => 'id',
                    'type'    => 'upload',
                ),
                array(
                    'name'    => __('Retina Logo', THEME_ADMIN_TD),
                    'desc'    => __('Use retina logo (NOTE - you will need to upload a logo that is twice the size intended to display)', THEME_ADMIN_TD),
                    'id'      => 'logo_retina',
                    'type'    => 'radio',
                    'options' => array(
                        'on'  => __('Retina Logo', THEME_ADMIN_TD),
                        'off' => __('Normal Logo', THEME_ADMIN_TD),
                    ),
                    'default' => 'off',
                ),
                array(
                    'name'    => __('Menu Align', THEME_ADMIN_TD),
                    'desc'    => __('Align the main navigation menu', THEME_ADMIN_TD),
                    'id'      => 'menu_align',
                    'type'    => 'radio',
                    'options' => array(
                        'left'   => __('Left', THEME_ADMIN_TD),
                        'center' => __('Center', THEME_ADMIN_TD),
                        'right'  => __('Right', THEME_ADMIN_TD),
                    ),
                    'default' => 'center',
                ),
                array(
                    'name'      => __('Header Height', THEME_ADMIN_TD),
                    'desc'      => __('Set the height of the header in case you use a custom logo image', THEME_ADMIN_TD),
                    'id'        => 'header_height',
                    'type'      => 'slider',
                    'default'   => 85,
                    'attr'      => array(
                        'max'       => 300,
                        'min'       => 60,
                        'step'      => 1
                    )
                ),
            )
        ),
        'blog-section' => array(
            'title'   => __('Blog', THEME_ADMIN_TD),
            'header'  => __('Setup your blog here', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'    => __('Show Comments On', THEME_ADMIN_TD),
                    'desc'    => __('Where to allow comments. All (show all), Pages (only on pages), Posts (only on posts), Off (all comments are off)', THEME_ADMIN_TD),
                    'id'      => 'site_comments',
                    'type'    => 'radio',
                    'options' => array(
                        'all'   => __('All', THEME_ADMIN_TD),
                        'pages' => __('Pages', THEME_ADMIN_TD),
                        'posts' => __('Posts', THEME_ADMIN_TD),
                        'Off'   => __('Off', THEME_ADMIN_TD)
                    ),
                    'default' => 'posts',
                ),
                array(
                    'name' => __('Blog read more link', THEME_ADMIN_TD),
                    'desc' => __('The text that will be used for your read more links', THEME_ADMIN_TD),
                    'id' => 'blog_readmore',
                    'type' => 'text',
                    'default' => __('Read More', THEME_ADMIN_TD)
                ),
            )
        ),
    )
);