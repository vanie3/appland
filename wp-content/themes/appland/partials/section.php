<?php
/**
 * Template for a theme section
 *
 * @package AppLand
 * @subpackage Frontend
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */

// fetch the section
$post = get_post( $menu_item->object_id );
setup_postdata($post);
// get the meta data of the post
$custom = get_post_custom();
// fetch section background
$section_background = '';
$section_background_repeat = '';
$section_background_scroll = 'scroll';
if( isset( $custom[THEME_SHORT.'_section_background'] ) ) {
    $section_background = wp_get_attachment_image_src( $custom[THEME_SHORT.'_section_background'][0], 'full' );
    if( isset( $section_background[0] ) ) {
        $section_background = $section_background[0];
    }
    if( isset( $custom[THEME_SHORT.'_section_background_repeat'] ) ) {
        $section_background_repeat = $custom[THEME_SHORT.'_section_background_repeat'][0];
    }
    if( isset( $custom[THEME_SHORT.'_section_background_scroll'] ) ) {
        $section_background_scroll = $custom[THEME_SHORT.'_section_background_scroll'][0];
    }
}
// fetch the section backgrounds
$backgrounds = array();
if( isset( $custom[THEME_SHORT.'_backgrounds'] ) ) {
    foreach( $custom[THEME_SHORT.'_backgrounds'] as $index => $background ) {
        $backgrounds[] = wp_get_attachment_image_src( $background, 'full' );
        $backgrounds[$index]['ratio']  = $custom[THEME_SHORT.'_background' . $index . '_ratio'][0];
        $backgrounds[$index]['repeat'] = $custom[THEME_SHORT.'_background' . $index . '_repeat'][0];
    }
}

?>
<section class="section" id="<?php echo oxy_string_to_id( get_the_title() ); ?>" style="background-image: url(<?php echo $section_background; ?>); background-repeat:<?php echo $section_background_repeat; ?>; background-attachment:<?php echo $section_background_scroll; ?>;">
    <div class="container">
        <?php include( locate_template( 'partials/header-titles.php' ) ); ?>
        <?php the_content(); ?>
    </div>
    <?php
    foreach( $backgrounds as $index => $background ) { ?>
        <div class="parallax-bg bg-zindex-<?php echo $index; ?>" data-stellar-background-ratio="<?php echo $background['ratio']; ?>" style="background-image: url(<?php echo $background[0]; ?>); background-repeat:<?php echo $background['repeat']; ?>;"></div>
    <?php
    }
    ?>
</section>

<?php wp_reset_postdata();