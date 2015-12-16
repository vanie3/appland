<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = THEME_SHORT. '_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'section_metabox',

    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => 'Section Backgrounds',

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'oxy_section' ),

    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.
    'priority' => 'default',

    // List of meta fields
    'fields' => array(
        array(
            'name' => __('Section Background', THEME_ADMIN_TD),
            'id'   => "{$prefix}section_background",
            'type' => 'plupload_image',
            'max_file_uploads' => 1
        ),
        array(
            'name' => __('Section Background Repeat', THEME_ADMIN_TD),
            'id'   => "{$prefix}section_background_repeat",
            'type' => 'select',
            'options' => array(
                'no-repeat'     => __('No Repeat', THEME_ADMIN_TD),
                'repeat-x'      => __('Repeat X', THEME_ADMIN_TD),
                'repeat-y'      => __('Repeat Y', THEME_ADMIN_TD),
                'repeat'        => __('Repeat Both',THEME_ADMIN_TD)
            )
        ),
        array(
            'name' => __('Section Background Scroll', THEME_ADMIN_TD),
            'id'   => "{$prefix}section_background_scroll",
            'type' => 'select',
            'options' => array(
                'scroll'     => __('Scroll', THEME_ADMIN_TD),
                'fixed'      => __('Fixed', THEME_ADMIN_TD),
            )
        ),
        array(
            'name' => __('Parallax Backgrounds (add up to 3)', THEME_ADMIN_TD),
            'id'   => "{$prefix}backgrounds",
            'type' => 'plupload_image',
            'max_file_uploads' => 3
        ),
        array(
            'name' => 'Background 1 Ratio',
            'id'   => "{$prefix}background0_ratio",
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 5,
                'step'  => 0.1,
            ),
        ),
        array(
            'name' => __('Background 1 Repeat', THEME_ADMIN_TD),
            'id'   => "{$prefix}background0_repeat",
            'type' => 'select',
            'options' => array(
                'no-repeat'     => __('No Repeat', THEME_ADMIN_TD),
                'repeat-x'      => __('Repeat X', THEME_ADMIN_TD),
                'repeat-y'      => __('Repeat Y', THEME_ADMIN_TD),
                'repeat'        => __('Repeat Both',THEME_ADMIN_TD)
            )
        ),
        array(
           'name' => 'Background 2 Ratio',
            'id'   => "{$prefix}background1_ratio",
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 5,
                'step'  => 0.1,
            ),
        ),
        array(
            'name' => __('Background 2 Repeat', THEME_ADMIN_TD),
            'id'   => "{$prefix}background1_repeat",
            'type' => 'select',
            'options' => array(
                'no-repeat'     => __('No Repeat', THEME_ADMIN_TD),
                'repeat-x'      => __('Repeat X', THEME_ADMIN_TD),
                'repeat-y'      => __('Repeat Y', THEME_ADMIN_TD),
                'repeat'        => __('Repeat Both',THEME_ADMIN_TD)
            )
        ),
        array(
          'name' => 'Background 3 Ratio',
            'id'   => "{$prefix}background2_ratio",
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 5,
                'step'  => 0.1,
            ),
        ),
        array(
            'name' => __('Background 3 Repeat', THEME_ADMIN_TD),
            'id'   => "{$prefix}background2_repeat",
            'type' => 'select',
            'options' => array(
                'no-repeat'     => __('No Repeat', THEME_ADMIN_TD),
                'repeat-x'      => __('Repeat X', THEME_ADMIN_TD),
                'repeat-y'      => __('Repeat Y', THEME_ADMIN_TD),
                'repeat'        => __('Repeat Both',THEME_ADMIN_TD)
            )
        ),
    ),
);

$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'section_menu_metabox',

    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => 'Section Menu Options',

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'oxy_section' ),

    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.
    'priority' => 'default',

    // List of meta fields
    'fields' => array(
        array(
            'name' => __('Menu Logo', THEME_ADMIN_TD),
            'desc' => __('Use a logo for this sections menu', THEME_ADMIN_TD),
            'id'   => "{$prefix}section_logo",
            'type' => 'checkbox',
        ),
        array(
            'name' => __('Sticky Section', THEME_ADMIN_TD),
            'desc' => __('Ignore menu position and always show section on top', THEME_ADMIN_TD),
            'id'   => "{$prefix}sticky_section",
            'type' => 'checkbox'
        ),
    )
);

$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'features_metabox',

    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => 'Feature Icon',

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'oxy_feature' ),

    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
        // THICKBOX IMAGE UPLOAD (WP 3.3+)
        array(
            'name' => __('Icon', THEME_ADMIN_TD),
            'id'   => "{$prefix}icon",
            'type' => 'icon',
        ),
    ),
);

$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'section_subtitle',

    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => 'Header Titles',

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'oxy_section', 'page' ),

    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
        // TAXONOMY
        array(
            // Field name - Will be used as label
            'name'  => 'Title',
            // Field ID, i.e. the meta key
            'id'    => "{$prefix}section_title",
            // Field description (optional)
            'desc'  => 'The title of the section',
            'type'  => 'text',
            // Default value (optional)
            'std'   => '',
        ),
        array(
            // Field name - Will be used as label
            'name'  => 'Subtitle',
            // Field ID, i.e. the meta key
            'id'    => "{$prefix}section_subtitle",
            // Field description (optional)
            'desc'  => 'The subtitle of the section',
            'type'  => 'text',
            // Default value (optional)
            'std'   => '',
        ),
        array(
            'name' => __('Hero Panel', THEME_ADMIN_TD),
            'desc' => __('Use a Hero Panel for this sections title and subtitle', THEME_ADMIN_TD),
            'id'   => "{$prefix}section_panel",
            'type' => 'checkbox',
        ),

    ),
);

// open in fancybox option for gallery post types.
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    // 'id' => 'portfolio_meta',

    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => 'Custom header image',

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'oxy_gallery_item' ),

    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
        array(
            'name' => __('Open in Magnific popup', THEME_ADMIN_TD),
            'id'   => "{$prefix}open_magnific",
            'type' => 'checkbox',
            'std' => true,
            'desc' => __('Opens item using Magnific Popup', THEME_ADMIN_TD),
        ),
    ),
);

$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'citation',

    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => 'External Link',

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'oxy_testimonial'  ),

    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
       // TAXONOMY
       array(
            // Field name - Will be used as label
            'name'  => 'Link',
            // Field ID, i.e. the meta key
            'id'    => "{$prefix}citation",
            // Field description (optional)
            'desc'  => 'Reference to the source of the quote',
            'type'  => 'text',
            // Default value (optional)
            'std'   => '',
        ),

    ),
);


$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'external',

    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => 'External Link',

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'oxy_slideshow_image', 'oxy_gallery_item' ),

    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
       // TAXONOMY
       array(
            // Field name - Will be used as label
            'name'  => 'Link',
            // Field ID, i.e. the meta key
            'id'    => "{$prefix}external_link",
            // Field description (optional)
            'desc'  => 'Link to an external page.Will override any magnific popup settings',
            'type'  => 'text',
            // Default value (optional)
            'std'   => '',
        ),

    ),
);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function oxy_register_meta_boxes()
{
    global $pagenow;
    // only load this when we need it - causing bugs in list pages
    if( $pagenow == 'post.php' || $pagenow == 'post-new.php' || defined('DOING_AJAX') ) {

        // Make sure there's no errors when the plugin is deactivated or during upgrade
        if ( !class_exists( 'RW_Meta_Box' ) ) {
            return;
        }
        global $meta_boxes;
        foreach ( $meta_boxes as $meta_box ) {
            new RW_Meta_Box( $meta_box );
        }
    }
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'oxy_register_meta_boxes' );