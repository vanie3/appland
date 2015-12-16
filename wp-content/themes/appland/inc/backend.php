<?php
require_once ADMIN_DIR . 'quick-uploader.php';

function oxy_create_logo_css() {
    // check if we using a logo
    $css = '';
    $header_height = oxy_get_option( 'header_height' );
    switch( oxy_get_option('logo_type') ) {
        case 'image':
            $img_id = oxy_get_option( 'logo_image' );
            $img = wp_get_attachment_image_src( $img_id, 'full' );
            $logo_width = $img[1];
            $logo_height = $img[2];
            $retina = '';
            // check for retina logo
            if( 'on' == oxy_get_option( 'logo_retina' ) ) {
                // set brand logo to be half width & height
                $retina .= 'width:' . ($logo_width / 2) . 'px;height:' . ($logo_height / 2 )  . 'px;';
                // use half logo height to calculate header size
                $logo_height = $logo_height / 2;
            }
            $css = oxy_create_header_css( $header_height, $logo_height . 'px', $logo_width . 'px', $retina );
        break;
        case 'text':
            $css = oxy_create_header_css( $header_height, 36, 'auto' );
        break;
    }
    update_option( THEME_SHORT . '-header-css', $css );
}
add_action( 'oxy-options-updated-appland-general', 'oxy_create_logo_css' );

function oxy_create_header_css( $header_height, $brand_height, $brand_width, $retina = '' ) {
    $min_height     = $header_height.'px';
    $margin_top     =  - ( $brand_height / 2).'px';
    $brand_padding  = ( ($header_height - $brand_height ) / 2).'px';
    $navbar_padding = ( ( $header_height -24 ) /2 ).'px';
    $navbar_margin  = ( $header_height / 2 - 14).'px';
    $container_pad  = ( $header_height + 20).'px';

    return <<< CSS
@media (min-width: 980px) {
.section .container {
padding-top: $container_pad;
}
}
#masthead .navbar-inner {
min-height: $min_height;
}
.navbar .nav > li > a {
padding-top: $navbar_padding;
padding-bottom: $navbar_padding;
line-height: 24px;
}
#masthead a.brand {
height: $min_height;
width: $brand_width;
padding: 0;
line-height: $min_height;
$retina
}
#masthead a.brand img {
    margin-top: $margin_top;
}
navbar .btn, .navbar .btn-navbar {
margin-top: $navbar_margin;
}
@media (max-width: 767px) {
.navbar .nav > li > a {
padding: 15px 15px 15px;
}
}
CSS;
}

function oxy_update_permalinks() {
    //Ensure the $wp_rewrite global is loaded
    global $wp_rewrite;
    //Call flush_rules() as a method of the $wp_rewrite object
    $wp_rewrite->flush_rules();
}
add_action( 'oxy-options-updated-smartbox-permalinks', 'oxy_update_permalinks' );


// add custom type columns
function oxy_slideshow_edit_columns($columns) {
    $columns = array(
        'cb'          => '<input type="checkbox" />',
        'title'       => __('Image Title', THEME_ADMIN_TD),
        'slide-thumb' => __('Image', THEME_ADMIN_TD),
        'menu_order'  => __('Order', THEME_ADMIN_TD),
        'slideshows'  => __('Slideshows', THEME_ADMIN_TD),
    );
    return $columns;
}
add_filter('manage_edit-oxy_slideshow_image_columns', 'oxy_slideshow_edit_columns' );

function oxy_custom_slideshow_column($column) {
    global $post;
    switch( $column ) {
        case 'menu_order':
            echo $post->menu_order;
        break;
        case 'slide-thumb':
            $editlink = get_edit_post_link( $post->ID );
            echo '<a href="' . $editlink . '">' . get_the_post_thumbnail( $post->ID, 'thumbnail' ) . '</a>';
        break;

        case 'slideshows':
            echo get_the_term_list( $post->ID, 'oxy_slideshow_categories', '', ', ' );
        break;

        default:
            // do nothing
        break;
    }
}
add_action('manage_oxy_slideshow_image_posts_custom_column', 'oxy_custom_slideshow_column' );

// add sortable
function oxy_slideshow_sortable_columns( $columns ) {
    $columns['menu_order'] = 'menu_order';
    return $columns;
}
add_filter( 'manage_edit-oxy_slideshow_image_sortable_columns', 'oxy_slideshow_sortable_columns' );

// gallery items columns

function oxy_gallery_edit_columns($columns) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => __('Image Title', THEME_ADMIN_TD),
        'port-thumb' => __('Image', THEME_ADMIN_TD),
        'menu_order' => __('Order', THEME_ADMIN_TD),
        'galleries' => __('Galleries', THEME_ADMIN_TD),
    );
    return $columns;
}
add_action('manage_edit-oxy_gallery_item_columns', 'oxy_gallery_edit_columns' );

function oxy_custom_gallery_column($column) {
    global $post;
    switch( $column ) {
        case 'menu_order':
            echo $post->menu_order;
        break;

        case 'port-thumb':
            $editlink = get_edit_post_link( $post->ID );
            echo '<a href="' . $editlink . '">' . get_the_post_thumbnail( $post->ID, 'thumbnail' ) . '</a>';
        break;

        case 'galleries':
            echo get_the_term_list( $post->ID, 'oxy_gallery_categories', '', ', ' );
        break;

        default:
            // do nothing
        break;
    }
}
add_action( 'manage_oxy_gallery_item_posts_custom_column' , 'oxy_custom_gallery_column', 10, 2 );

// add sortable
function oxy_gallery_sortable_columns( $columns ) {
    $columns['menu_order'] = 'menu_order';
    return $columns;
}
add_filter( 'manage_edit-oxy_gallery_item_sortable_columns', 'oxy_gallery_sortable_columns' );

