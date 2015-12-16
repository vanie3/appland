<?php
/**
 * Header used for sections, pages and posts
 *
 * @package AppLand
 * @subpackage Frontend
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */

$hero_panel = false;
if( isset( $custom[THEME_SHORT.'_section_panel'] ) ){
    $hero_panel = $custom[THEME_SHORT.'_section_panel'][0];
}
?>

<?php echo $hero_panel ? '<div class="hero-unit pull-center text-center">' : '<header class="page-header">'; ?>
    <h1>
        <?php
        if( isset( $custom[THEME_SHORT.'_section_title'] ) ) {
            echo $custom[THEME_SHORT.'_section_title'][0];
        }
        else {
            the_title();
        }

        if( isset( $custom[THEME_SHORT.'_section_subtitle'] ) ) {
            echo $hero_panel ? '<p>':'<small>'; ?><?php echo $custom[THEME_SHORT.'_section_subtitle'][0]; ?><?php echo $hero_panel ? '</p>':'</small>';
        }
        ?>
    </h1>
<?php echo $hero_panel ? '</div>':'</header>'; ?>
