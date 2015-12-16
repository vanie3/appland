<?php
/**
 * Previews the shortcode
 *
 * @package AppLand
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */

if ( !defined('ABSPATH') ) {
    die('You are not allowed to call this page directly.');
}

?>
<!DOCTYPE html>
<!--[if IE 8 ]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html <?php language_attributes(); ?> class="ie9"> <![endif]-->
<!--[if gt IE 9]> <html <?php language_attributes(); ?>> <![endif]-->
<!--[if !IE]> <!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
        <title><?php wp_title( '|', true, 'right' );  bloginfo('name'); ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <script src="<?php echo JS_URI ?>jquery.1.8.3.min.js" type="text/javascript" ></script>
        <script src="<?php echo JS_URI ?>jquery.flexslider-min.js" type="text/javascript" ></script>
        <script src="<?php echo JS_URI ?>facebook.js" type="text/javascript" ></script>
        <script src="<?php echo JS_URI ?>twitter.js" type="text/javascript" ></script>
        <script src="<?php echo JS_URI ?>google.js" type="text/javascript" ></script>

        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <article>
                    <?php
                        if( isset( $_GET['sc'] ) ) {
                            echo apply_filters( 'the_content', do_shortcode( stripslashes( $_GET['sc'] ) ) );
                        }
                    ?>
                </article>
            </div>
        </div>
        <div id="fb-root"></div>
    </body>
</html>