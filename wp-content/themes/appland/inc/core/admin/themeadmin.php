<?php
/**
 * Main theme admin class file
 *
 * @package AppLand
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */

include ADMIN_OPTIONS_DIR . 'options.php';
include ADMIN_OPTIONS_DIR . 'option.php';
include INCLUDES_DIR . 'backend.php';
/**
 * Main theme admin bootstrap class
 *
 * @since 1.0
 */
class OxyThemeAdmin
{
    /**
     * Stores array of theme setuop options
     *
     * @since 1.0
     * @access public
     * @var array
     */
    public $theme;

    /**
     * Main theme options
     *
     * @var Object
     **/
    public $options;

    /**
     * Constructior, called if the theme is_admin by †he main Theme class
     *
     * @since 1.0
     * @param array $options array of all theme options to use in construction this theme
     */
    function __construct( $theme ) {
        $this->theme = $theme;
        // load admin defines
        $this->defines();
        // initialise admin
        add_action('admin_init', array( &$this , 'admin_init' ) );
        // enqueue option page scripts
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

        //enqueue the scripts needed for the custom media gallery fields
        add_action( 'wp_enqueue_media', array( $this, 'admin_enqueue_media' ) );
        add_action( 'print_media_templates', array( $this, 'print_media_templates' ) );
        // create theme options
        $this->options = new OxyOptions( $theme->theme['option-pages'] );
         // load admin modules
        $this->theme->load_modules( 'admin_modules', 'admin.php' );

        $this->register_metaboxes();

    }

    /**
     * called on admin_init
     *
     * @since 1.0
     */
    function admin_init() {
        // register admin js & css
        $this->register_resources();
        // initialise media upload class ( for media options )
        require_once ADMIN_DIR . 'media-upload.php';
        $media_upload = new OxyMediaUpload();

        require_once ADMIN_SC_DIR . 'shortcode-admin.php';
        $shortcode_admin = new ShortcodeAdmin( $this->theme );

    }

    function defines() {
        define( 'ADMIN_SC_DIR', ADMIN_DIR . 'shortcodes/' );
        define( 'ADMIN_IMAGES_URI', THEME_URI . '/inc/core/images/' );
    }

    function register_resources() {
        // register a ui theme css
        wp_register_style( 'jquery-ui-theme', ADMIN_CSS_URI . 'jquery-ui/smoothness/theme.min.css' );
        wp_enqueue_style( 'select2-style', ADMIN_CSS_URI . 'select2/select2.css' );

        wp_register_style( 'oxy-option-page', ADMIN_CSS_URI . 'options/oxy-option-page.css' );
    }

    function check_theme_compatible() {
        $version = get_bloginfo( 'version' );
        $this->errors = array();

        if( version_compare( $version, $this->options['min_wp_ver'], '<' ) ) {
            $this->errors[] = sprintf( __('Version %s is incompatible with this theme minimum version %s', THEME_ADMIN_TD), $version, $this->options['min_wp_ver'] );
        }

        if( !empty( $this->errors ) ) {
            add_action( 'init', array( &$this, 'admin_warning' ) );
        }

    }

    function admin_enqueue_scripts( $hook ) {
        global $pagenow;
        if( 'admin.php' == $pagenow || 'post-new.php' == $pagenow || 'post.php' == $pagenow ) {
            $screen = get_current_screen();
            // enqueue script only for pages.
            if( $screen->id == 'page' ) {
                wp_enqueue_script( 'oxy-ajax-metaboxes', INCLUDES_URI . 'options/metaboxes/ajax-metaboxes.js' , array('jquery' , 'rwmb-map') );
            }
        }
        wp_register_script( 'webfont', JS_URI . 'webfont.js', array('jquery') );
        wp_register_script( 'oxy-font-plugin', INCLUDES_URI . 'core/admin/assets/js/jquery.font-plugin.js' , array('jquery' , 'webfont') );
        wp_register_script( 'select2-plugin', INCLUDES_URI . 'core/admin/assets/js/select2.min.js' , array('jquery', 'oxy-font-plugin') );
    }

    // enqueue the scripts needed for the custom media gallery fields.
    function admin_enqueue_media(){
        if ( ! isset( get_current_screen()->id ) || get_current_screen()->base != 'post' )
            return;
        wp_enqueue_script( 'oxy-gallery-fields', INCLUDES_URI . 'core/admin/assets/js/custom-gallery-fields.js' , array('media-views') );
    }

    function print_media_templates(){
        if ( ! isset( get_current_screen()->id ) || get_current_screen()->base != 'post' )
            return;
         ?>
        <script type="text/html" id="tmpl-custom-gallery-setting">
            <label class="setting">
                <span>Number of Rows</span>
                <select class="type" name="rows" data-setting="rows">
                    <?php

                    $rows = array(
                        1 => __( 'One', THEME_ADMIN_TD ),
                        2 => __( 'Two', THEME_ADMIN_TD ),
                        3 => __( 'Three', THEME_ADMIN_TD ),
                        4 => __( 'Four', THEME_ADMIN_TD ),
                    );

                    foreach ( $rows as $value => $name ) { ?>
                        <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, 2 ); ?>>
                            <?php echo esc_html( $name ); ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
        </script>
        <script type="text/html" id="tmpl-custom-attachment-settings">
            <label class="setting" data-setting="videolink">
                <span>Video Link</span>
                <input type="text" name="videolink" value="{{ data.videolink }}" />
            </label>
        </script>

        <?php
    }

    function admin_warning() {
        $msg = '<div class="error">';
        foreach( $this->errors as $error ) {
            $msg .= '<p>' . $error . '</p>';
        }
        $msg .=  '</div>';
        echo $msg;
    }

    function register_metaboxes(){
        define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/inc/modules/meta-box' ) );
        define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/inc/modules/meta-box' ) );

        // Include the meta box script
        require_once RWMB_DIR . 'meta-box.php';
        include OPTIONS_DIR . '/metaboxes/theme-metaboxes.php';
    }
}
