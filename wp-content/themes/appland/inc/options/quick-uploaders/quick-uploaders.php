<?php
/**
 * Stores options for themes quick uploaders
 *
 * @package AppLand
 * @subpackage Admin
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */

return array(
    // slideshoe quick upload
    'oxy_slideshow_image' => array(
        'menu_title' => __('Quick Slideshow', THEME_ADMIN_TD),
        'page_title' => __('Quick Slideshow Creator', THEME_ADMIN_TD),
        'item_singular'  => __('Slideshow Image', THEME_ADMIN_TD),
        'item_plural'  => __('Slideshow Images', THEME_ADMIN_TD),
        'taxonomies' => array(
            'oxy_slideshow_categories'
        )
    ),
);