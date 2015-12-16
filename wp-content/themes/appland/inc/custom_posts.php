<?php
/**
 * Oxygenna.com
 *
 * :: AppLand
 * :: (c) 2013 Oxygenna.com
 * :: http://wiki.envato.com/support/legal-terms/licensing-terms/
 */


/**
 * Slideshow Custom Post
 */

/***************** SLIDESHOWS *******************/
$labels = array(
    'name'               => _x( 'Slideshow Images', THEME_ADMIN_TD ),
    'singular_name'      => _x( 'Slideshow Image', THEME_ADMIN_TD ),
    'add_new'            => _x( 'Add New', THEME_ADMIN_TD ),
    'add_new_item'       => __( 'Add New Image', THEME_ADMIN_TD ),
    'edit_item'          => __( 'Edit Image', THEME_ADMIN_TD ),
    'new_item'           => __( 'New Image', THEME_ADMIN_TD ),
    'view_item'          => __( 'View Image', THEME_ADMIN_TD ),
    'search_items'       => __( 'Search Images', THEME_ADMIN_TD ),
    'not_found'          => __( 'No images found', THEME_ADMIN_TD ),
    'not_found_in_trash' => __( 'No images found in Trash', THEME_ADMIN_TD ),
    'menu_name'          => __( 'Slider Images', THEME_ADMIN_TD )
);

$args = array(
    'labels'    => $labels,
    'public'    => false,
    'show_ui'   => true,
    'query_var' => false,
    'rewrite'   => false,
    'menu_icon' => ADMIN_ASSETS_URI . 'images/slideshow.png',
    'supports'  => array( 'title', 'thumbnail', 'page-attributes' )
);

// create custom post
register_post_type( 'oxy_slideshow_image', $args );

// Register slideshow taxonomy
$labels = array(
    'name'          => __( 'Slideshows', THEME_ADMIN_TD ),
    'singular_name' => __( 'Slideshow', THEME_ADMIN_TD ),
    'search_items'  => __( 'Search Slideshows', THEME_ADMIN_TD ),
    'all_items'     => __( 'All Slideshows', THEME_ADMIN_TD ),
    'edit_item'     => __( 'Edit Slideshow', THEME_ADMIN_TD),
    'update_item'   => __( 'Update Slideshow', THEME_ADMIN_TD),
    'add_new_item'  => __( 'Add New Slideshow', THEME_ADMIN_TD),
    'new_item_name' => __( 'New Slideshow Name', THEME_ADMIN_TD)
);

register_taxonomy(
    'oxy_slideshow_categories',
    'oxy_slideshow_image',
    array(
        'hierarchical' => true,
        'labels'       => $labels,
        'show_ui'      => true,
        'query_var'    => false,
        'rewrite'      => false
    )
);

// move featured image box on slideshow
function oxy_move_slideshow_meta_box() {
    remove_meta_box( 'postimagediv', 'oxy_slideshow_image', 'side' );
    add_meta_box('postimagediv', __('Slideshow Image', THEME_ADMIN_TD), 'post_thumbnail_meta_box', 'oxy_slideshow_image', 'advanced', 'low');
}
add_action('do_meta_boxes', 'oxy_move_slideshow_meta_box');


/**
 * Logo Custom Post
 */

$labels = array(
    'name'               => _x( 'Sections', THEME_ADMIN_TD ),
    'singular_name'      => _x( 'Section', THEME_ADMIN_TD ),
    'add_new'            => _x( 'Add New', THEME_ADMIN_TD ),
    'add_new_item'       => __( 'Add New Section', THEME_ADMIN_TD ),
    'edit_item'          => __( 'Edit Section', THEME_ADMIN_TD ),
    'new_item'           => __( 'New Section', THEME_ADMIN_TD ),
    'view_item'          => __( 'View Section', THEME_ADMIN_TD ),
    'search_items'       => __( 'Search Sections', THEME_ADMIN_TD ),
    'not_found'          => __( 'No sections found', THEME_ADMIN_TD ),
    'not_found_in_trash' => __( 'No sections found in Trash', THEME_ADMIN_TD ),
    'menu_name'          => __( 'Sections', THEME_ADMIN_TD )
);

$args = array(
    'labels'    => $labels,
    'public'    => true,
    'show_ui'   => true,
    'query_var' => false,
    'rewrite'   => false,
    'supports'  => array( 'title', 'editor', 'thumbnail' )
);

// create custom post
register_post_type( 'oxy_section', $args );

$labels = array(
    'name'               => __('Features', THEME_ADMIN_TD),
    'singular_name'      => __('Feature',  THEME_ADMIN_TD),
    'add_new'            => __('Add New',  THEME_ADMIN_TD),
    'add_new_item'       => __('Add New Feature',  THEME_ADMIN_TD),
    'edit_item'          => __('Edit Feature',  THEME_ADMIN_TD),
    'new_item'           => __('New Feature',  THEME_ADMIN_TD),
    'all_items'          => __('All Features',  THEME_ADMIN_TD),
    'view_item'          => __('View Feature',  THEME_ADMIN_TD),
    'search_items'       => __('Search Features',  THEME_ADMIN_TD),
    'not_found'          => __('No Features found',  THEME_ADMIN_TD),
    'not_found_in_trash' => __('No Features found in Trash', THEME_ADMIN_TD),
    'menu_name'          => __('Features',  THEME_ADMIN_TD)
);

$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title', 'editor' )
);
register_post_type('oxy_feature', $args);


/* ------------------ TESTIMONIALS -----------------------*/

$labels = array(
    'name'               => __('Testimonial', THEME_ADMIN_TD),
    'singular_name'      => __('Testimonial',  THEME_ADMIN_TD),
    'add_new'            => __('Add New',  THEME_ADMIN_TD),
    'add_new_item'       => __('Add New Testimonial',  THEME_ADMIN_TD),
    'edit_item'          => __('Edit Testimonial',  THEME_ADMIN_TD),
    'new_item'           => __('New Testimonial',  THEME_ADMIN_TD),
    'all_items'          => __('All Testimonial',  THEME_ADMIN_TD),
    'view_item'          => __('View Testimonial',  THEME_ADMIN_TD),
    'search_items'       => __('Search Testimonial',  THEME_ADMIN_TD),
    'not_found'          => __('No Testimonial found',  THEME_ADMIN_TD),
    'not_found_in_trash' => __('No Testimonial found in Trash', THEME_ADMIN_TD),
    'menu_name'          => __('Testimonials',  THEME_ADMIN_TD)
);

$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => ADMIN_ASSETS_URI . 'images/testimonials.png',
    'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
);
register_post_type('oxy_testimonial', $args);


$labels = array(
    'name'               => _x('Gallery Items', THEME_ADMIN_TD),
    'singular_name'      => _x('Gallery Item', THEME_ADMIN_TD),
    'add_new'            => _x('Add New', THEME_ADMIN_TD),
    'add_new_item'       => __('Add New Gallery Item', THEME_ADMIN_TD),
    'edit_item'          => __('Edit Gallery Item', THEME_ADMIN_TD),
    'new_item'           => __('New Gallery Item', THEME_ADMIN_TD),
    'view_item'          => __('View Gallery Item', THEME_ADMIN_TD),
    'search_items'       => __('Search Gallery Items', THEME_ADMIN_TD),
    'not_found'          =>  __('No Gallery Items found', THEME_ADMIN_TD),
    'not_found_in_trash' => __('No Gallery Items found in Trash', THEME_ADMIN_TD),
    'parent_item_colon'  => '',
    'menu_name'          => __('Gallery Items', THEME_ADMIN_TD)
);

// fetch portfolio slug
$permalink_slug = trim( oxy_get_option( 'portfolio_slug' ) );
if( empty($permalink_slug) ) {
    $permalink_slug = 'gallery';
}

$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'query_var'          => true,
    'capability_type'    => 'post',
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => ADMIN_ASSETS_URI . 'images/portfolio.png',
    'supports'           => array('title', 'editor', 'thumbnail', 'page-attributes', 'post-formats' ),
    'rewrite' => array( 'slug' => $permalink_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ),
);

// create custom post
register_post_type( 'oxy_gallery_item', $args );

// Register portfolio taxonomy
$labels = array(
    'name'          => __( 'Galleries', THEME_ADMIN_TD ),
    'singular_name' => __( 'Gallery', THEME_ADMIN_TD ),
    'search_items'  =>  __( 'Search Galleries', THEME_ADMIN_TD ),
    'all_items'     => __( 'All Galleries', THEME_ADMIN_TD ),
    'edit_item'     => __( 'Edit Gallery', THEME_ADMIN_TD),
    'update_item'   => __( 'Update Gallery', THEME_ADMIN_TD),
    'add_new_item'  => __( 'Add New Gallery', THEME_ADMIN_TD),
    'new_item_name' => __( 'New Gallery Name', THEME_ADMIN_TD)
);

register_taxonomy(
    'oxy_gallery_categories',
    'oxy_gallery_item',
    array(
        'hierarchical' => true,
        'labels'       => $labels,
        'show_ui'      => true,
        'query_var'    => true,
    )
);