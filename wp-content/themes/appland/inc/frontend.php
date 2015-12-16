<?php
/**
 * This is where all the themes frontend actions at
 *
 * @package AppLand
 * @subpackage Frontend
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */

// Register main menu
register_nav_menus( array(
    'primary' => __( 'Primary Navigation', THEME_ADMIN_TD ),
));

if ( ! isset( $content_width ) )  {
    $content_width = 1170;
}

add_theme_support( 'automatic-feed-links' );

/**
 * Gets a theme option
 *
 * @return theme option value or false if not set
 * @since 1.0
 **/
function oxy_get_option( $name ) {
    global $oxy_theme_options;
    if( isset( $oxy_theme_options[$name] ) ) {
        return $oxy_theme_options[$name];
    }
    else {
        return false;
    }
}

/**
 * Converts a string into a valid id
 *
 * @return string valid id for html
 * @param string my_string string to convert
 **/
function oxy_string_to_id( $my_string ) {
    return str_replace( ' ', '-', strtolower( $my_string ) );
}

/**
 * Cleaner walker for wp_nav_menu()
 *
 * Walker_Nav_Menu (WordPress default) example output:
 *   <li id="menu-item-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8"><a href="/">Home</a></li>
 *   <li id="menu-item-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9"><a href="/sample-page/">Sample Page</a></l
 *
 * Roots_Nav_Walker example output:
 *   <li class="menu-home"><a href="/">Home</a></li>
 *   <li class="menu-sample-page"><a href="/sample-page/">Sample Page</a></li>
 */
class OxyNavWalker extends Walker_Nav_Menu {
    function check_current( $classes ) {
        return preg_match('/(current[-_])|active|dropdown/', $classes);
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "\n<ul class=\"dropdown-menu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);

        if( $item->is_dropdown && ($depth === 0) ) {
            $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#"', $item_html);
        }
        elseif( stristr($item_html, 'li class="divider') ) {
            $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
        }
        elseif( stristr($item_html, 'li class="nav-header') ) {
            $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
        }

        $output .= $item_html;
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        switch( $element->object ) {
            case 'oxy_section':
                $element->url = oxy_get_home_url().'/#' . oxy_string_to_id( $element->title );
                $has_logo = get_post_meta( $element->object_id, THEME_SHORT.'_section_logo', true );
                if( $has_logo ) {
                    $output .= '<li>' . oxy_create_logo( $element ) . '</li>';
                    return;
                }
            default:
                $element->is_dropdown = !empty( $children_elements[$element->ID] );

                if( $element->is_dropdown ) {
                    if( $depth === 0 ) {
                        $element->classes[] = 'dropdown';
                    }
                    elseif( $depth === 1 ) {
                        $element->classes[] = 'dropdown-submenu';
                    }
                }

                parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
            break;
        }
    }
}

/**
 * Loads theme scripts
 *
 * @return void
 *
 **/
function oxy_load_scripts() {
    // load js
    wp_enqueue_script( 'bootstrap', JS_URI . 'bootstrap.js', array( 'jquery' ), '2.2.2' );
    wp_enqueue_script( 'stellar', JS_URI . 'jquery.stellar.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'flexslider', JS_URI. 'jquery.flexslider-min.js', array('jquery'), '2.1', true );
    wp_enqueue_script( 'scrollTo', JS_URI . 'jquery.scrollTo.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'magnificPopup', JS_URI . 'jquery.magnific-popup.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'placeholder', JS_URI . 'jquery.placeholder.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'script', JS_URI . 'script.js', array( 'bootstrap', 'flexslider', 'scrollTo', 'stellar', 'magnificPopup' ) );


     // send stored date to the theme script
    // also send ajax url and nonce for sign up
    wp_localize_script( 'script', 'localData', array(
        // URL to wp-admin/admin-ajax.php to process the request
        'ajaxurl'       => admin_url( 'admin-ajax.php' ),
        // generate a nonce with a unique ID "myajax-post-comment-nonce"
        // so that you can check it later when an AJAX request is sent
        'nonce'         => wp_create_nonce( 'oxygenna-sign-me-up-nonce' ),
        )
    );
    // load styles
    wp_enqueue_style( 'bootstrap', CSS_URI . 'bootstrap.css', array(), false, 'all' );
    wp_enqueue_style( 'responsive', CSS_URI . 'responsive.css', array( 'bootstrap' ), false, 'all' );
    wp_enqueue_style( 'font-awesome-all', CSS_URI . 'font-awesome-all.css', array( 'bootstrap' ), false, 'all' );
    wp_enqueue_style( 'magnificPopupStyle', CSS_URI . 'magnific-popup.css', array(), false, 'all' );
    wp_enqueue_style( 'style', CSS_URI . 'style.css', array( 'bootstrap' ), false, 'all' );

    if( get_option( THEME_SHORT . '-font-css' ) === false ) {
        wp_enqueue_style( 'fonts', CSS_URI . 'fonts.css', array( 'style' ), false, 'all' );
    }
}
add_action( 'wp_enqueue_scripts', 'oxy_load_scripts' );

/**
 * Gets the main menu items
 *
 * @return array of menu items null if not set
 * @since 1.0
 **/
function oxy_get_menu_items() {
    $menu_name = 'primary';
    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
        return wp_get_nav_menu_items( $locations[ $menu_name ] );
    }
}

/**
 * Creates a logo that is shown on mobile sized screens
 *
 * @return void
 * @since 1.0
 **/
function oxy_create_mobile_logo() {
    $menu_items = oxy_get_menu_items();
    if( null !== $menu_items ) {
        foreach( $menu_items as $menu ) {
            if( 'oxy_section' == $menu->object ) {
                 $has_logo = get_post_meta( $menu->object_id, THEME_SHORT.'_section_logo', true );
                 if( $has_logo ) {
                    $menu->url = oxy_get_home_url().'/#' . oxy_string_to_id( $menu->title );
                    echo oxy_create_logo( $menu );
                }
            }
        }
    }
}

/**
 * Creates a logo using a menu item
 *
 * @param object $menu Menu object to use to create the logo
 * @return HTML for logo
 * @since 1.0
 **/
function oxy_create_logo( $menu ) {
    $output = '<a class="brand brand-appland" href="' . $menu->url . '">';

    switch( oxy_get_option( 'logo_type' ) ) {
        case 'text':
            $output .= oxy_get_option( 'logo_text' );
        break;
        case 'image':
            $img_id = oxy_get_option( 'logo_image' );
            $logo_object = wp_get_attachment_image_src( $img_id, 'full' );
            $logo = '';
            if( isset( $logo_object[0] ) ) {
                $logo = $logo_object[0];
            }
            $output .= '<img src="' . $logo . '" alt="' . $menu->title . '"/>';
        break;
        case 'text_image':
            $img_id = oxy_get_option( 'logo_image' );
            $logo_object = wp_get_attachment_image_src( $img_id, 'full' );
            $logo = '';
            if( isset( $logo_object[0] ) ) {
                $logo = $logo_object[0];
            }
            $output .= oxy_get_option( 'logo_text' );
            $output .= '<span style="background: url(' . $logo . ') no-repeat center;"></span>';
        break;
    }

    $output .= '</a>';
    return $output;
}


/**
 * Apple device icons
 *
 * @return echos html for apple icons
 **/
function oxy_add_apple_icons( $option_name, $sizes = '' ) {
    $icon = oxy_get_option( $option_name );
    if( false !== $icon ) {
        $rel = oxy_get_option( $option_name . '_pre', 'apple-touch-icon' );
        echo '<link rel="' . $rel . '" href="' . $icon . '" ' . $sizes  . ' />';
    }
}

/**
 * Adds classes to body class
 *
 * @return void
 * @since 1.0
 **/
function oxy_theme_body_classes($classes) {
    // add colour theme class
    $classes[] = oxy_get_option( 'site_style' );
    // return the $classes array
    return $classes;
}
add_filter( 'body_class', 'oxy_theme_body_classes' );


function create_image_sizes() {
// create theme specific image size for the iphone slider
    if( function_exists( 'add_image_size' ) ) {
        add_image_size( 'iphone5', 650, 370, true );
        add_image_size( 'ipad', 590, 437, true );
        add_image_size( 'iphone-portrait', 275, 430, true );
        add_image_size( 'iphone5-portrait', 260, 455, true );
    }

}
add_action( 'init', 'create_image_sizes');

function display_image_sizes( $sizes ) {
    // $sizes['size-ipad'] = __( 'Carousel Ipad Size', THEME_ADMIN_TD);
    // $sizes['size-iphone-portrait'] = __( 'Carousel Iphone Portrait Size', THEME_ADMIN_TD);
    return $sizes;
}
// hook for displaying the size in the media screen
add_filter( 'image_size_names_choose', 'display_image_sizes');

// add support for featured images
add_theme_support( 'post-thumbnails' );
// add post format support
add_theme_support( 'post-formats', array( 'gallery', 'video' ) );


// enable support for custom backgrounds
$args = array(
    'default-color' => '',
    'default-image' => '%s/images/bundled/grid.png',
);

global $wp_version;
if ( version_compare( $wp_version, '3.4', '>=' ) ) {
    add_theme_support( 'custom-background' , $args );
}
else {
    add_custom_background( $args );
}

// pagination in blog list template
function oxy_pagination( $pages = '', $range = 2 ){
    $showitems = ($range * 2)+1;
    //$showitems =2;
    global $paged;
    if(empty($paged)) {
        $paged = 1;
    }

    if($pages == ''){
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages){
            $pages = 1;
        }
    }

    if(1 != $pages){
        echo "<div class='pagination pagination-centered'><ul>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages)
            echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
        if($paged > 1 && $showitems < $pages)
            echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

        for ($i=1; $i <= $pages; $i++){
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                echo ($paged == $i)? "<li class='active'><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
            }
        }

        if ($paged < $pages && $showitems < $pages)
            echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
        if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages)
            echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
        echo "</ul></div>\n";
    }
}

function oxy_get_home_url(){
    if( function_exists( 'icl_get_home_url' ) ) {
        $home_link = icl_get_home_url();
    }
    else {
        $home_link = site_url();
    }
    return $home_link;

}



/*************** COMMENTS ***************************/


/** COMMENTS WALKER */
class OxyCommentWalker extends Walker_Comment {

    // init classwide variables
    var $tree_type = 'comment';
    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );


    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

        if ( !$element )
           return;

        $id_field = $this->db_fields['id'];
        $id = $element->$id_field;

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

        // If we're at the max depth, and the current element still has children, loop over those and display them at this level
        // This is to prevent them being orphaned to the end of the list.
        if ( $max_depth <= $depth + 1 && isset( $children_elements[$id]) ) {
            foreach ( $children_elements[ $id ] as $child )
                $this->display_element( $child, $children_elements, $max_depth, $depth, $args, $output );

            unset( $children_elements[ $id ] );
        }

    }

    /** CONSTRUCTOR
     * You'll have to use this if you plan to get to the top of the comments list, as
     * start_lvl() only goes as high as 1 deep nested comments */
    function __construct() { ?>

        <div id="comment-list">

    <?php }

    /** START_LVL
     * Starts the list before the CHILD elements are added. Unlike most of the walkers,
     * the start_lvl function means the start of a nested comment. It applies to the first
     * new level under the comments that are not replies. Also, it appear that, by default,
     * WordPress just echos the walk instead of passing it to &$output properly. Go figure.  */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>

                <!--<ul class="children">-->
    <?php }

    /** END_LVL
     * Ends the children list of after the elements are added. */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>

        <!--</ul>--><!-- /.children -->

    <?php }

    /** START_EL */
    function start_el( &$output, $comment, $depth=0, $args=array(), $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;
        $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); ?>
        <?php
        switch ( $comment->comment_type ) :
             case 'pingback':
             case 'trackback':
             // Display trackbacks differently than normal comments.
        ?>
        <div>
            <p><?php _e( 'Pingback:', THEME_FRONT_TD ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', THEME_FRONT_TD ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
            break;
            default:
            // Proceed with normal comments.
            global $post;
        ?>

        <div <?php comment_class( 'media media-comment' ); ?> >
            <div class="media-box box-mini pull-left">
                <?php echo get_avatar( $comment, 300 ); ?>
            </div>
            <div class="media-body">
                <div class="media-inner">
                    <div <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
                        <h5 class="media-heading">
                            <?php comment_author_link(); ?>
                            -
                            <?php comment_date(); ?>
                            <span class="comment-reply pull-right">
                                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', THEME_FRONT_TD ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                            </span>
                        </h5>
                        <?php comment_text(); ?>
                    </div>
                </div>
    <?php endswitch; ?>

    <?php }

    function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
            </div><!-- /media body -->
        </div><!-- /comment-->

    <?php }

    /** DESTRUCTOR
     * I just using this since we needed to use the constructor to reach the top
     * of the comments list, just seems to balance out :) */
    function __destruct() { ?>

    </div><!-- /#comment-list -->

    <?php }
}



/**
 * Customize comments form
 *
 *@return void
 *@since 1.0
 **/
function oxy_comment_form( $args = array(), $post_id = null ) {
    global $user_identity, $id;

    if ( null === $post_id )
        $post_id = $id;
    else
        $id = $post_id;

    $commenter = wp_get_current_commenter();

    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $fields =  array(
        'author' => '<div class="control-group"><div class="controls"><input id="author" name="author" placeholder="' . __('your name', THEME_FRONT_TD) . '" type="text" class="input-xlarge" value="' . esc_attr( $commenter['comment_author'] ) .  '"/></div></div>',
        'email'  => '<div class="control-group"><div class="controls"><input id="email" name="email" placeholder="' . __('your email address', THEME_FRONT_TD) . '" type="text" class="input-xlarge" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" /></div></div>',
        'url'    => '',
    );

    $required_text = sprintf( ' ' . __('Required fields are marked %s', THEME_FRONT_TD), '<span class="required"><a>*</a></span>' );
    $defaults = array(
        'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_field'        => '<div class="control-group message"><div class="controls"><textarea id="comment" name="comment" placeholder="' . __('add your comment here ', THEME_FRONT_TD) . '" class="input-xxlarge" rows="3"></textarea></div></div>',
        'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', THEME_FRONT_TD ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
        'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', THEME_FRONT_TD ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
        'comment_notes_before' => '',
        'comment_notes_after'  => '',

        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'title_reply'          => __( 'Add your comment', THEME_FRONT_TD ),
        'title_reply_to'       => __( 'Leave a Reply', THEME_FRONT_TD ),
        'cancel_reply_link'    => __( 'Cancel reply', THEME_FRONT_TD ),
        'label_submit'         => __( 'Add comment', THEME_FRONT_TD ),
    );

    $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

    ?>
        <?php if ( comments_open() ) : ?>
            <?php do_action( 'comment_form_before' ); ?>
            <div class="comments-form"  id="respond">
                <h3 id="reply-title" class="comment-form small-screen-center"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small id="cancel-comment-reply"><?php cancel_comment_reply_link('Cancel') ?></small></h3>
                <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
                    <?php echo $args['must_log_in']; ?>
                    <?php do_action( 'comment_form_must_log_in_after' ); ?>
                <?php else : ?>
                    <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
                        <fieldset>
                        <?php do_action( 'comment_form_top' ); ?>
                        <?php if ( is_user_logged_in() ) : ?>
                            <?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
                            <?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
                        <?php else : ?>
                            <?php echo $args['comment_notes_before']; ?>
                            <?php
                            do_action( 'comment_form_before_fields' );
                            foreach( (array) $args['fields'] as $name => $field ) {
                                echo apply_filters( 'comment_form_field_'.$name, $field ) . "\n";
                            }
                            do_action( 'comment_form_after_fields' );
                            ?>
                        <?php endif; ?>
                        <?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
                        <?php echo $args['comment_notes_after']; ?>
                        <div class="control-group">
                            <div class="controls small-screen-center">
                                <button name="submit" type="submit" class="btn btn-primary" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>"><?php echo esc_attr( $args['label_submit'] ); ?></button>
                                <?php comment_id_fields(); ?>
                            </div>
                        </div>


                        <?php do_action( 'comment_form', $post_id ); ?>
                        </fieldset>
                    </form>
                <?php endif; ?>
            </div><!-- #respond -->
            <?php do_action( 'comment_form_after' ); ?>
        <?php else : ?>
            <?php do_action( 'comment_form_comments_closed' ); ?>
        <?php endif; ?>
    <?php
}

/**
 * Enables threaded comments
 *
 *@return void
 *@since 1.0
 **/

function oxy_enable_threaded_comments(){
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
            wp_enqueue_script('comment-reply');
    }
}

add_action('get_header', 'oxy_enable_threaded_comments');

// output extra css in head
function oxy_output_extra_css() { ?>
    <style type="text/css" media="screen">
        <?php echo get_option( THEME_SHORT . '-font-css', '' ); ?>
        <?php echo get_option( THEME_SHORT . '-header-css', '' ); ?>
        <?php echo oxy_get_option( 'extra_css' ); ?>
    </style>
<?php
}

add_action('wp_head', 'oxy_output_extra_css');


function oxy_get_icon_color( $icon ) {
    switch( $icon ) {
        case 'icon-facebook':
        case 'icon-facebook-sign':
            return '#3b5998';
        break;
        case 'icon-twitter':
        case 'icon-twitter-sign':
            return '#00a0d1';
        break;
        case 'icon-linkedin':
        case 'icon-linkedin-sign':
            return '#5FB0D5';
        break;
        case 'icon-github':
        case 'icon-github-sign':
        case 'icon-github-alt':
        case 'icon-git-fork':
            return '#4183c4';
        break;
        case 'icon-pinterest':
        case 'icon-pinterest-sign':
            return '#910101';
        break;
        case 'icon-google-plus':
        case 'icon-google-plus-sign':
            return '#E45135';
        break;

        case 'icon-skype':
            return '#00aff0';
        break;

        case 'icon-youtube-sign':
        case 'icon-youtube':
            return '#c4302b';
        break;

        case 'icon-dropbox':
            return '#3d9ae8';
        break;
        case 'icon-drupal':
            return '#0c76ab';
        break;

        break;
        case 'icon-instagram':
            return '#634d40';
        break;

        case 'icon-share-this-sign':
        case 'icon-share-this':
            return '#3b5998';
        break;

        case 'icon-foursquare':
        case 'icon-foursquare-sign':
            return '#25a0ca';
        break;

        case 'icon-hacker-news':
            return '#ff6600';
        break;
        case 'icon-spotify':
            return '#81b71a';
        break;
        case 'icon-soundcloud':
            return '#ff7700';
        break;
        case 'icon-paypal':
            return '#3b7bbf';
        break;

        case 'icon-reddit':
            return '#cee3f8';
        break;

        case 'icon-blogger':
        case 'icon-blogger-sign':
            return '#fc4f08';
        break;

        case 'icon-dribbble-sign':
        case 'icon-dribbble':
            return '#ea4c89';
        break;
        case 'icon-evernote-sign':
        case 'icon-evernote':
            return '#5ba525';
        break;

        case 'icon-flickr-sign':
            return '#ff0084';
        break;
        case 'icon-flickr':
            return '#0063dc';
        break;

        case 'icon-forrst-sign':
        case 'icon-forrst':
            return '#5b9a68';
        break;

        case 'icon-delicious':
            return '#205cc0';
        break;
        case 'icon-lastfm':
        case 'icon-lastfm-sign':
            return '#c3000d';
        break;

        case 'icon-picasa-sign':
        case 'icon-picasa':
            return '#FF292B';
        break;

        case 'icon-stack-overflow':
            return '#ef8236';
        break;
        case 'icon-tumblr-sign':
        case 'icon-tumblr':
            return '#34526f';
        break;
        case 'icon-vimeo':
        case 'icon-vimeo-sign':
            return '#86c9ef';
        break;

        case 'icon-wordpress-sign':
            return '#464646';
        break;
        case 'icon-wordpress':
            return '#21759b';
        break;
        case 'icon-yelp-sign':
        case 'icon-yelp':
            return '#c41200';
        break;
    }
}


function oxy_get_content_shortcode( $post, $shortcode_name ) {
    $pattern = get_shortcode_regex();
    // look for an embeded shortcode in the post content
    if( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( $shortcode_name, $matches[2] ) ) {
        return $matches;
    }
}

function oxy_get_content_gallery( $post ) {
    $pattern = get_shortcode_regex();
    $gallery_ids = null;
    if( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'gallery', $matches[2] ) ) {
        // gallery shortcode is being used

        // do we have some attribues?
        if( array_key_exists( 3, $matches ) ) {
            if( array_key_exists( 0, $matches[3] ) ) {
                $gallery_attrs = shortcode_parse_atts( $matches[3][0] );
                if( array_key_exists( 'ids', $gallery_attrs) ) {
                    $gallery_ids = explode( ',', $gallery_attrs['ids'] );
                    return $gallery_ids;
                }
            }
        }
    }
}


/* --------------- add a wrapper for the embeded videos -------------*/
add_filter('embed_oembed_html', 'oxy_add_video_embed_note', 10, 3);

function oxy_add_video_embed_note( $html, $url, $attr ) {
    return '<div class="videoWrapper">'. $html .'</div>';
}


// use option read more link
add_filter( 'the_content_more_link', 'oxy_read_more_link', 10, 2 );

function oxy_read_more_link( $more_link, $more_link_text ) {
    // remove #more
    $more_link = preg_replace( '|#more-[0-9]+|', '', $more_link );
    return str_replace( $more_link_text, oxy_get_option('blog_readmore'), $more_link );
}

/**
 * post navigation
 */
function oxy_results_nav( $nav_id ) {
    global $wp_query;
    if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav id="<?php echo $nav_id; ?>">
            <ul class="pager">
                <li class="previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', THEME_FRONT_TD ) ); ?></li>
                <li class="next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', THEME_FRONT_TD ) ); ?></li>
            </ul>
        </nav><!-- #nav-above -->
    <?php endif;
}

function oxy_fix_shortcodes($content) {
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'oxy_fix_shortcodes');
