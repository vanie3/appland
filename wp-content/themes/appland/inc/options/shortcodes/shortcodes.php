<?php
/**
 * Themes shortcode functions go here
 *
 * @package AppLand
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */


function oxy_shortcode_row( $atts, $content = null ) {
    return '<div class="row-fluid">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'row', 'oxy_shortcode_row' );

function oxy_shortcode_layout( $atts, $content = null, $code ) {
    return '<div class="' . $code . '">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'span1', 'oxy_shortcode_layout' );
add_shortcode( 'span2', 'oxy_shortcode_layout' );
add_shortcode( 'span3', 'oxy_shortcode_layout' );
add_shortcode( 'span4', 'oxy_shortcode_layout' );
add_shortcode( 'span5', 'oxy_shortcode_layout' );
add_shortcode( 'span6', 'oxy_shortcode_layout' );
add_shortcode( 'span7', 'oxy_shortcode_layout' );
add_shortcode( 'span8', 'oxy_shortcode_layout' );
add_shortcode( 'span9', 'oxy_shortcode_layout' );
add_shortcode( 'span10', 'oxy_shortcode_layout' );
add_shortcode( 'span11', 'oxy_shortcode_layout' );
add_shortcode( 'span12', 'oxy_shortcode_layout' );


function oxy_shortcode_recent($atts , $content = '' ) {
    // setup options
    extract( shortcode_atts( array(
        'count'        => 4,
        'categories'   => null,
        'authors'      => null,
        'post_formats' => null,
        'titles'        => 'show'
    ), $atts ) );

    $categories = ( null === $categories ) ? null : explode( ',', $categories );
    $authors = ( null === $authors ) ? null : explode( ',', $authors );
    $post_formats = ( null === $post_formats ) ? null : explode( ',', $post_formats );

    $posts = oxy_get_recent_posts( $count, $categories, $authors, $post_formats );

    $output = '';
    if( !empty( $posts ) ) {
        $output .= '[raw]<ul class="oxyrecentposts">';
        global $post;
        foreach( $posts as $post ) {
            setup_postdata( $post );
            $output .= '<li>';
            $output .= '<a href="' . get_permalink() . '" class="recent-feature" >';
            if( has_post_thumbnail( $post->ID ) ) {
                $output .= get_the_post_thumbnail( $post->ID, array(64,64), array('title'=>$post->post_title,'alt'=>$post->post_title));
            }
            else {
               // $output .= oxy_theme_icon( oxy_get_post_icon( $post->ID ), 'span' );
            }
            $output .= '</a>';
            if( 'show' == $titles ) {
                $output .= '<h5>' . get_the_title( $post->ID ) . '</h5>';
                $output .= '<p>' . get_the_date() . '</p>';
            }
            $output .= '</li>';
        }
        $output .= '</ul>[/raw]';
    }
    // reset post data
    wp_reset_postdata();

    return $output;
}


function oxy_get_recent_posts( $count, $categories, $authors, $post_formats ) {
    $query = array();
    // set post count
    $query['numberposts'] = $count;
    // set category if selected
    if( !empty( $categories ) ) {
        $query['cat'] = implode( ',', $categories );
    }
    // set author if selected
    if( !empty( $authors ) ) {
        $query['author'] = implode( ',', $authors );
    }
    // set post format if selected
    if( !empty( $post_formats ) ) {
        foreach( $post_formats as $key => $value ) {
            $post_formats[$key] = 'post-format-' . $value;
        }
        $query['tax_query'] = array();
        $query['tax_query'][] = array(
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => $post_formats
        );
    }
    // fetch posts
    return get_posts( $query );
}


add_shortcode( 'recent', 'oxy_shortcode_recent' );

/* Slideshow Shortcode */

function oxy_shortcode_carousel( $atts, $content = null ){
    extract( shortcode_atts( array(
        'slideshow'  => '',
        'device'     => 'app-iphone-portrait',
    ), $atts ) );

    $slides = get_posts( array(
        'numberposts' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'oxy_slideshow_categories',
                'field' => 'slug',
                'terms' => $slideshow
            )
        ),
        'post_type' => 'oxy_slideshow_image',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));
    $img_size = $device == 'app-iphone-portrait' ? 'size-iphone-portrait' :'size-ipad';
    $active = ' active';
    $id = 'carousel-' . rand(1,100);
    $output  = '<div class="'.$device.'">';
    $output .= '<div class="row-fluid">';
    $output .= '<div class="carousel slide intro" id="'.$id.'">';
    $output .= '<div class="carousel-inner">';
    global $post;
    $tmp_post = $post;
    foreach( $slides as $post ) {
        setup_postdata( $post );
        $output.= '<div class="item'.$active.'">';
        $output.= get_the_post_thumbnail( $post->ID, $img_size );
        $output.= '</div>';
        $active = '';
    }
    $output.='</div>';
    $output.='<div class="carousel-frame"></div>';
    $output.='<a class="carousel-control left" data-slide="prev" href="#'.$id.'"><i class="icon-chevron-left"></i></a>';
    $output.='<a class="carousel-control right" data-slide="next" href="#'.$id.'"><i class="icon-chevron-right"></i></a>';
    $output.='</div></div></div>';

    $post = $tmp_post;
    if( $post !== null ) {
        setup_postdata( $post );
    }

    return $output;
}
add_shortcode( 'carousel', 'oxy_shortcode_carousel' );


// slideshow using flexslider
function oxy_shortcode_device( $atts , $content = 'iphone5w' ){
    extract( shortcode_atts( array(
        'slideshow'     => '',
        'autostart'     => 'true',
        'animation'     => 'slide',
        'directionnav'  => 'show',
        'speed'         => 7000,
    ), $atts ) );

    global $post;
    $tmp_post = $post;

    // fetch slides
    $slides = get_posts( array(
        'numberposts' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'oxy_slideshow_categories',
                'field' => 'slug',
                'terms' => $slideshow
            )
        ),
        'post_type' => 'oxy_slideshow_image',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));

    $is_portrait = false;
    $id = 'flexslider-' . rand(1,100);
    // remove last char from the content so iPhone5b becomes iPhone5
    if($content == 'macbook' ){
        $image_size = 'ipad';
    }
    else{
        $image_size = substr( $content, 0, -1 );
        $is_portrait = ( substr($image_size, -8) == 'portrait' )? true:false;
    }

    $output  = '<div class="app-' . $content . '">';
    $output .= ( $is_portrait == true)?'<div class="row-fluid"><div class="portrait-slides">':'';
    $output .= '<div class="flex-wrapper">';
    $output .= '<div class="flex-container">';
    $output .= '<div id="' . $id . '" class="flexslider" ';
    $output .= 'data-flex-animation="' . $animation . '" data-flex-autostart="'.$autostart.'" data-flex-directions="'.$directionnav.'" data-flex-speed="'.$speed.'"';
    $output .= '>';
    $output .= '<ul class="slides">';

    foreach( $slides as $post ) {
        setup_postdata( $post );
        $link = get_post_meta( $post->ID, THEME_SHORT . '_external_link' , true );
        $output .= '<li>';
        $output .= $link? '<a href="'.$link.'" target="_blank"></a>':'';
        $output .= get_the_post_thumbnail( $post->ID, $image_size );
        //$output .= $link?'</a>':'';
        $output .= '</li>';
    }

    $output .=  '</ul></div></div>';
    $output .= '<div class="slider-frame">';
    $output .= ( $is_portrait == true)? '</div></div>':'';
    $output .= '</div></div></div>';

    // reset the post back to tmp one
    $post = $tmp_post;
    if( $post !== null ) {
        setup_postdata( $post );
    }

    return $output;
}

add_shortcode( 'device' , 'oxy_shortcode_device' );



/* ---------- TESTIMONIALS SHORTCODE ---------- */

function oxy_shortcode_features( $atts , $content = '' ) {
    // setup options
    extract( shortcode_atts( array(
        'title'       => '',
        'count'       => 3,
        'columns'     => 3,
    ), $atts ) );

    $query_options = array(
        'post_type'      => 'oxy_feature',
        'numberposts'    => $count
    );

    // fetch posts
    $span = $columns == 3? 'span4':'span3';
    $items = get_posts( $query_options );
    $items_per_row = ($span == 'span4')? 3:4;
    $items_count = count( $items );
    $output = '';
    if( $items_count > 0):
        $item_num = 1;
        $output .='<div class="row-fluid text-center pull-center">';
        $output .='<ul class="thumbnails services">';
        foreach ($items as $item) :
            global $post;
            $post = $item;
            setup_postdata($post);
            $custom_fields = get_post_custom($post->ID);
            $icon = (isset($custom_fields[THEME_SHORT.'_icon']))? $custom_fields[THEME_SHORT.'_icon'][0]:'';
            if($item_num > $items_per_row){
                $output.= '</ul><ul class="thumbnails services">';
                $item_num = 1;
            }
            $output.='<li class="'. $span .'">';
            $output.='<h3><div class="drop-icon text-center pull-center"><i class="'.$icon.'"></i></div>'.get_the_title().'</h3>';
            $output.='<p>'.get_the_content().'</p>';

            $item_num++;
        endforeach;
        $output .='</ul></div>';

        wp_reset_postdata();
    endif;

    return $output;

}

add_shortcode( 'features', 'oxy_shortcode_features' );


/**
 * The Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * images on a post.
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 * @since 1.2
 */
function oxy_gallery_shortcode($attr) {
    $post = get_post();

    if ( ! empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) )
            $attr['orderby'] = 'post__in';
        $attr['include'] = $attr['ids'];
    }

    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_gallery', '', $attr);
    if ( $output != '' )
        return $output;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'rows'     => 2,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $columns = intval($columns);
    $span_width = $columns > 0 ? floor(12/$columns) : 12;
    $gallery_id = 'gallery-' . rand(1,100);

    $output  = '<div class="carousel slide thumbs" id="'.$gallery_id.'">';
    $output .= '<div class="carousel-inner">';
    $output .= '<div class="active item">';
    $output .= '<ul class="thumbnails thumbnail-list">';
    $item = 1;
    foreach ( $attachments as $id => $attachment ) {
        $thumb = wp_get_attachment_image_src( $id, 'large' );
        $full  = wp_get_attachment_image_src( $id, 'full' );
        if( $item > ($columns*$rows)){
            $output .='</ul></div><div class="item"><ul class="thumbnails thumbnail-list">';
            $item = 1;
        }
        $output .= '<li class="span' . $span_width . '">';
        $output .= '<figure class="thumbnail-figure">';
        $output .= '<a class="popup-link popup-image" href="' . $full[0]  . '">';
        $output .= '<img src="' . $thumb[0] . '"><i></i>';
        $output .= '</a>';
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= '<figcaption>';
            $output .=  wptexturize($attachment->post_excerpt);
            $output .= '</figcaption>';
        }
        $output .= '</figure></li>';

        $item++;
    }

    $output .= '</ul>';
    $output .= '</div></div>';
    $output .= '<a class="carousel-control left" data-slide="prev" href="#'.$gallery_id.'"><i class="icon-chevron-left"></i></a>';
    $output .= '<a class="carousel-control right" data-slide="next" href="#'.$gallery_id.'"><i class="icon-chevron-right"></i></a>';
    $output .= '</div>';
    return $output;
}
add_shortcode( 'gallery', 'oxy_gallery_shortcode' );



/* ---------- TESTIMONIALS SHORTCODE ---------- */

function oxy_shortcode_testimonials( $atts , $content = '' ) {
    // setup options
    extract( shortcode_atts( array(
        'count'       => 3,
        'columns'     => 3,
    ), $atts ) );

    $query_options = array(
        'post_type'   => 'oxy_testimonial',
        'numberposts' => $count,
        'order'      => 'ASC',
        'orderby'     => 'menu_order',
    );

    // fetch posts
    $span = $columns == 3? 'span4':'span3';
    $items = get_posts( $query_options );
    $items_count = count( $items );
    $output = '';
    if( $items_count > 0):
        $item_num = 1;
        // Calculate how many items we will render before we need another row
        $items_per_row = ($span == 'span4')? 3:4;
        $item_num = 1;
        $output .='<div class="row-fluid">';
        foreach ($items as $item) :
                    global $post;
                    $post = $item;
                    setup_postdata($post);
                    $custom_fields = get_post_custom($post->ID);
                    $cite  = (isset($custom_fields[THEME_SHORT.'_citation']))? ' href="'.$custom_fields[THEME_SHORT.'_citation'][0].'" ' :'';
                    $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full' );

            if($item_num > $items_per_row){
                $output.= '</div><div class="row-fluid">';
                $item_num = 1;
            }

            $output.='<div class="'. $span .'"><div class="well well-quote">'. get_the_content().'';
            $output.='<div class="well-author"><a '.$cite.' rel="tooltip" title="'.get_the_title().'"><img src="'.$img[0].'"></a></div>';
            $output.='</div></div>';
            $item_num++;

        endforeach;
        $output.='</div>';


            wp_reset_postdata();
    endif;

    return $output;
}


add_shortcode( 'testimonials', 'oxy_shortcode_testimonials' );


function oxy_shortcode_app_store( $atts , $content = '' ){
    extract( shortcode_atts( array(
        'link'    => '#',
        'height'  => 60,
        'open_in' => '_blank',
        'float'   => 'none'
    ), $atts ) );

    $output = '<a class="app-store-button pull-' . $float . '"' . ' href="' . $link . '" target="' . $open_in . '">';
    $output .= '<img src="' . IMAGES_URI . 'badges/app-store-';
    $output .= $height . '.png" />';
    $output .= '</a>';
    return $output;
}

add_shortcode( 'app_store' ,'oxy_shortcode_app_store' );


function oxy_shortcode_google_play( $atts , $content = '' ){
    extract( shortcode_atts( array(
        'package'   => '',
        'publisher' => '',
        'style'     => 'get-it-on',
        'height'    => 60,
        'lang'      => 'en',
        'open_in'   => '_blank',
        'float'     => 'none'
    ), $atts ) );

    $output = '<a class="app-store-button pull-' . $float . '"';
    $output .= ' target="' . $open_in . '" href="https://play.google.com/store/';
    $output .= empty( $package ) ? 'search?q=pub:' . $publisher : 'apps/details?id=' . $package;
    $output .= '">';
    $output .= '<img alt="Android app on Google Play" ';
    $output .= 'src="https://developer.android.com/images/brand/';
    $output .= $lang;
    $output .= 'get-it-on' === $style ? '_generic_rgb_wo_' : '_app_rgb_wo_';
    $output .= $height . '.png" /></a>';
    return $output;
}
add_shortcode( 'google_play' ,'oxy_shortcode_google_play' );



function oxy_shortcode_mailchimp( $atts, $content = '' ){
    $output  ='<form id="sign-me-up'.rand(1,100).'" class="form-search text-center sign-me-up" novalidate><div class="input-append input-signup">';
    $output .='<input class="email-signup" class="email-signup span3 input-block-level" placeholder="'. __('Your email', THEME_FRONT_TD) .'" type="email" />';
    $output .='<button class="btn signup-button submitEmail" type="button"></button>';
    $output .='</div></form><div class="messages" style="position:relative;"></div>';

    return $output;
}

add_shortcode('mailchimp', 'oxy_shortcode_mailchimp');


function oxy_shortcode_social( $atts, $content = '' ){
    $output  = '<ul class="social">';
    for( $i = 1; $i < 6; $i++){
        if(isset($atts['icon_'.$i] ) && isset($atts['url_'.$i]) ){
            $output .= '<li><a data-iconcolor="'.oxy_get_icon_color($atts['icon_'.$i]).'" href="'.$atts['url_'.$i].'"><i class="'.$atts['icon_'.$i].'"></i></a></li>';
        }
    }
    $output .= '</ul>';

    return $output;
}

add_shortcode('social', 'oxy_shortcode_social' );


function oxy_shortcode_facebook ( $atts, $content = ''){

    wp_enqueue_script( 'facebook', JS_URI . 'facebook.js', array(), '1.0', true );

    extract( shortcode_atts( array(
        'fb_layout'     => 'button_count',
        'fb_show_faces' => 'false',
        'fb_width'      =>  50,
        'fb_action'     => 'like',
        'fb_font'       => 'verdana',
        'fb_colour'     => 'light'
    ), $atts ) );

    $output  = '<div class="blog-social-buttons small-screen-center"><div class="blog-social-button">';
    $output .= '<div class="fb-like" data-href="'. get_permalink() .'" data-send="false" data-layout="'. $fb_layout .'" data-show-faces="'. $fb_show_faces .'" data-font="'. $fb_font .'" data-colorscheme="'.$fb_colour .'" data-action="'. $fb_action.'"></div>';
    $output .= '</div></div>';
    return $output;
}

add_shortcode('facebook', 'oxy_shortcode_facebook');


function oxy_shortcode_twitter( $atts, $content = ''){

    wp_enqueue_script( 'twitter', JS_URI . 'twitter.js', array(), '1.0', true );

    extract( shortcode_atts( array(
        'twitter_text'      => '',
        'twitter_hashtags'  => '',
        'twitter_count_box' => 'horizontal',
        'twitter_size'      =>  'medium',
    ), $atts ) );

    $output  = '<div class="blog-social-buttons small-screen-center"><div class="blog-social-button">';
    $output .= '<a href="https://twitter.com/share" class="twitter-share-button" data-hashtag="'. $twitter_hashtags .'" data-url="'. get_permalink() .'" data-count="' . $twitter_count_box .'" data-size="'. $twitter_size .'" data-text="'. $twitter_text. '">Tweet</a>';
    $output .= '</div></div>';
    return $output;
}

add_shortcode('twitter', 'oxy_shortcode_twitter');


function oxy_shortcode_google_plus( $atts, $content = ''){

    wp_enqueue_script( 'google', JS_URI . 'google.js', array(), '1.0', true );

    extract( shortcode_atts( array(
        'google_size'       => 'medium',
        'google_annotation' => 'bubble',
        'google_expand_to'  => 'bottom',
    ), $atts ) );

    $output  = '<div class="blog-social-buttons small-screen-center"><div class="blog-social-button">';
    $output .= '<div class="g-plusone" href="' . get_permalink() .'" data-size="' .$google_size . '" data-annotation="' . $google_annotation . '" data-expandTo="' . $google_expand_to . '"></div>';
    $output .= '</div></div>';
    return $output;
}

add_shortcode('google_plus', 'oxy_shortcode_google_plus');



/* --------------------- PORTFOLIO SHORTCODES --------------------- */

function oxy_shortcode_appland_gallery($atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'count'      => 3,
        'columns'    => 3,
        'rows'       => 2,
        'gallery'  => ''
    ), $atts ) );

    $query_options = array(
        'post_type'   => 'oxy_gallery_item',
        'numberposts' => $count,
        'orderby'     => 'menu_order',
        'order'       => 'ASC'
    );
    $filters = get_terms( 'oxy_gallery_categories', array( 'hide_empty' => 1 ) );

    if( !empty( $gallery ) ) {
        $galleries = explode( ',', $gallery );
        $query_options['tax_query'][] = array(
            'taxonomy' => 'oxy_gallery_categories',
            'field' => 'slug',
            'terms' => $galleries
        );
    }
    $span = $columns == 3? 'span4':'span3';
    // fetch posts
    $attachments = get_posts( $query_options );
    $attachments_count = count( $attachments );
    $output = '';
    //  ----------------------

    $span_width = $columns > 0 ? floor(12/$columns) : 12;
    $gallery_id = 'gallery-' . rand(1,100);

    $output  = '<div class="carousel slide thumbs" id="'.$gallery_id.'">';
    $output .= '<div class="carousel-inner">';
    $output .= '<div class="active item">';
    $output .= '<ul class="thumbnails thumbnail-list">';
    $item = 1;
    foreach ( $attachments as $attachment ) {
        global $post;
        $post = $attachment;
        setup_postdata($post);
        $format = get_post_format( $post->ID );
        if( false === $format ) {
            $format = 'standard';
        }
        $use_magnific = get_post_meta( $post->ID, THEME_SHORT . '_open_magnific' , true );
        $link = get_post_meta( $post->ID, THEME_SHORT . '_external_link' , true );
        if($link){
            // overide magnific settings
            $use_magnific = false;
            $popup_class = '';
            $full = $link;
        }
        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
        $extra_gallery_images = array();
        $gallery_links = "";

        if( $use_magnific ) {
            switch ( $format ) {
                case 'gallery':
                    $gallery_ids = oxy_get_content_gallery( $post );
                    if( $gallery_ids !== null ) {
                        if( count( $gallery_ids ) > 0 ) {
                            // use the first image as thumbnail for the gallery
                           // $gallery_thumb = wp_get_attachment_image_src( $gallery_ids[0], 'full');
                           // $thumbnail = $gallery_thumb;

                            // remove first gallery image from array
                           // array_shift( $gallery_ids );
                            foreach( $gallery_ids as $gallery_image_id ) {
                                $gallery_image = wp_get_attachment_image_src( $gallery_image_id, 'full');
                                $extra_gallery_images[] = $gallery_image[0];
                            }
                        }
                        $popup_class = 'popup-gallery';
                        $gallery_links = implode(",", $extra_gallery_images);
                    }
                break;
                case 'video':
                    $video_shortcode = oxy_get_content_shortcode( $post, 'embed' );
                    if( $video_shortcode !== null ) {
                        if( isset( $video_shortcode[5] ) ) {
                            $video_shortcode = $video_shortcode[5];
                            if( isset( $video_shortcode[0] ) ) {
                                $popup_class = 'popup-video';
                                $full = $video_shortcode[0];
                            }
                        }
                    }
                break;
                default:
                case 'standard':
                    $full  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
                    $full = $full[0];
                    $popup_class = 'popup-image';
                break;
            }
        }

        if( $item > ($columns*$rows)){
            $output .='</ul></div><div class="item"><ul class="thumbnails thumbnail-list">';
            $item = 1;
        }
        $output .= '<li class="span' . $span_width . '">';
        $output .= '<figure class="thumbnail-figure">';
        $output .= '<figcaption>';
        $output .=  get_the_excerpt();
        $output .= '</figcaption>';
        if( $use_magnific || $link) {
            $output .= '<a class="popup-link '.$popup_class.'" href="' . $full  . '">';
        }
        $output .= '<img src="' . $thumbnail[0] . '"';
        if( $use_magnific || $link) {
            $output .= ( "" !== $gallery_links )? 'data-links="'.$gallery_links.'"' : "";
            $output .= '><i></i>';
            $output .= '</a>';
        }
        $output .= '</figure></li>';

        $item++;
    }

    $output .= '</ul>';
    $output .= '</div></div>';
    $output .= '<a class="carousel-control left" data-slide="prev" href="#'.$gallery_id.'"><i class="icon-chevron-left"></i></a>';
    $output .= '<a class="carousel-control right" data-slide="next" href="#'.$gallery_id.'"><i class="icon-chevron-right"></i></a>';
    $output .= '</div>';

    wp_reset_postdata();
    return $output;

}

add_shortcode( 'appland_gallery', 'oxy_shortcode_appland_gallery' );


/**
 * Icon List Shortcode
 *
 * @return Icon List
 **/
function oxy_shortcode_iconlist( $atts, $content = null ) {
    $output = '<ul class="iconlist">';
    $output .= do_shortcode( $content );
    $output .= '</ul>';
    return $output;
}

add_shortcode( 'iconlist', 'oxy_shortcode_iconlist' );


/**
 * Icon Item Shortcode - for use inside an iconlist shortcode
 *
 * @return Icon Item HTML
 **/
function oxy_shortcode_iconitem( $atts, $content = null) {
    extract( shortcode_atts( array(
        'icon'        => '',
    ), $atts ) );

    $output = '<li>';
    $output .= '<i class="' . $icon . '"></i>';
    $output .= $content;
    $output .= '<p>';
    $output .= '</p>';
    $output .= '</li>';
    return $output;
}
add_shortcode( 'iconitem', 'oxy_shortcode_iconitem' );

/* ---------- LEAD SHORTCODE ---------- */
function oxy_shortcode_lead( $atts, $content ) {
    extract( shortcode_atts( array(
        'centered'  => 'yes'
    ), $atts ) );
    $extraclass = ( $centered == 'yes')? ' text-center':'';
    return '<p class="lead'.$extraclass.'">' . do_shortcode($content) . '</p>';
}
add_shortcode( 'lead', 'oxy_shortcode_lead' );

/* ------------ BLOCKQUOTE SHORTCODE ------------*/

function oxy_shortcode_blockquote( $atts, $content ) {
    extract( shortcode_atts( array(
        'who'   => '',
        'cite'  => '',
    ), $atts ) );
    $output = '<blockquote>"' . do_shortcode($content) . '"';
    if( !empty( $who ) ) {
        $output .= '<small>' . $who;
        if( !empty( $cite ) ) {
            $output .= ' <cite title="source title">' . $cite . '</cite>';
        }
        $output .= '</small>';
    }
    $output .= '</blockquote>';

    return $output;
}
add_shortcode( 'blockquote', 'oxy_shortcode_blockquote' );

/**
 * Icon shortcode - for showing an icon
 *
 * @return Icon html
 **/
function oxy_shortcode_icon( $atts, $content = null) {
    extract( shortcode_atts( array(
        'size'       => 0,
    ), $atts ) );

    $output = '<i class="' . $content . '"';
    if( $size !== 0 ) {
        $output .= ' style="font-size:' . $size . 'px"';
    }
    $output .= '></i>';
    return $output;
}
add_shortcode( 'icon', 'oxy_shortcode_icon' );
