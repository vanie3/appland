<?php
/**
 * Shows tags, categories and comment count for posts
 *
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */
?>
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
    <?php comments_popup_link( _x( 'No comments', 'comments number', THEME_FRONT_TD ), _x( '1 comment', 'comments number', THEME_FRONT_TD ), _x( '% comments', 'comments number', THEME_FRONT_TD ) ); ?>
    <?php endif; ?>
</small>
