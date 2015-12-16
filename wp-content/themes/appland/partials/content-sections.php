<?php
/**
 * Displays the main body of the theme
 *
 * @package AppLand
 * @subpackage Frontend
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */

get_header();
?>
    <div id="content" role="main">
        <?php
        $menu_items = oxy_get_menu_items();
        $sections = array();
        $non_sticky = array();
        // check for any sticky sections that need to go first
        if($menu_items){
            foreach( $menu_items as $menu_item ) {
                if( 'oxy_section' == $menu_item->object ) {
                    $sticky = get_post_meta( $menu_item->object_id, THEME_SHORT . '_sticky_section', true );
                    if( $sticky ) {
                        $sections[] = $menu_item;
                    }
                    else {
                        $non_sticky[] = $menu_item;
                    }
                }
            }
        }
        $sections = array_merge( $sections, $non_sticky );
        // show sections
        foreach( $sections as $menu_item ) {
            // create the section
            include( locate_template( 'partials/section.php' ) );
        }
        ?>
        <?php wp_footer(); ?>
        <script type="text/javascript">
            //<![CDATA[
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', '<?php echo oxy_get_option( 'google_anal' ) ?>']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
            //]]>
        </script>
    </div>