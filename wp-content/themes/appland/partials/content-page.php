<?php
/**
 * Standard Page
 *
 * @package AppLand
 * @subpackage Admin
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */

get_header();
global $post;
$custom = get_post_custom($post->ID);
?>

<section class="section" id="<?php echo oxy_string_to_id( get_the_title() ); ?>">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
        <?php include( locate_template( 'partials/header-titles.php' ) ); ?>
        <?php
            if ( has_post_thumbnail() ) {
                $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                $img_link = is_single() ? $img[0] : get_permalink();
                echo '<figure class="feature-image">';
                echo '<img alt="featured image" src="'.$img[0].'">';
                echo '</figure>';
            } ?>
        <?php the_content(); ?>
        <?php endwhile; ?>
    </div>
</section>

<?php get_footer();