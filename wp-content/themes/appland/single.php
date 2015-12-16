<?php
/**
 * Displays a single post
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
global $post;
$custom_fields = get_post_custom($post->ID);
$allow_comments = oxy_get_option( 'site_comments' );
?>

<section class="section">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID();?>" <?php post_class(); ?>>
            <header class="page-header">
                <h1>
                    <?php the_title(); ?>
                    <small class="post-extras">

                        <i class="icon-user"></i>
                        <?php the_author(); ?>
                        <i class="icon-calendar"></i>
                        <?php the_time(get_option('date_format')); ?>
                        <?php if( has_tag() && oxy_get_option( 'blog_tags' ) == 'on' ) : ?>
                        <i class="icon-tags"></i>
                        <?php the_tags( $before = null, $sep = ', ', $after = '' ); ?>
                        <?php endif; ?>
                        <?php if( has_category() ) : ?>
                        <i class="icon-bookmark"></i>
                        <?php the_category( ', ' ); ?>
                        <?php endif; ?>
                        <?php if ( comments_open() && ! post_password_required()  ) : ?>
                        <i class="icon-comments"></i>
                        <?php comments_popup_link( _x( 'No comments', 'comments number', THEME_FRONT_TD ),
                        _x( '1 comment', 'comments number', THEME_FRONT_TD ), _x( '% comments', 'comments number', THEME_FRONT_TD ) ); ?>
                        <?php endif; ?>

                     </small>
                </h1>

            </header>
            <?php
                if ( has_post_thumbnail() ) {
                    $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                    $img_link = is_single() ? $img[0] : get_permalink();
                    echo '<figure class="feature-image">';
                    echo '<img alt="featured image" src="'.$img[0].'">';
                    echo '</figure>';
                } ?>
            <?php the_content(); ?>
            <nav id="nav-below" class="post-navigation">
                <ul class="pager">
                    <li class="previous"><?php previous_post_link( '%link', '<i class="icon-angle-left"></i>' . ' %title' ); ?></li>
                    <li class="next"><?php next_post_link( '%link', '%title ' . '<i class="icon-angle-right"></i>' ); ?></li>
                </ul>
            </nav><!-- nav-below -->
            <?php if( $allow_comments == 'posts' || $allow_comments == 'all' ) comments_template( '', true ); ?>
        </article>
        <?php endwhile; ?>
    </div>
</section>

<?php get_footer();