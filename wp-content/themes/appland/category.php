<?php


get_header(); ?>

<section class="section">
    <div class="container">
        <?php
        if( have_posts() ):
            while ($wp_query->have_posts()) : the_post(); ?>
            <article class="article">
                <header class="page-header">
                    <h1>
                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', THEME_FRONT_TD ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                            <?php the_title(); ?>
                        </a>
                        <?php get_template_part('partials/post-extras');?>
                    </h1>
                </header>
                <?php
                if ( has_post_thumbnail() ) {
                    $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                    $img_link = is_single() ? $img[0] : get_permalink();
                    echo '<figure class="feature-image">';
                    echo '<a href="' . $img_link . '">';
                    echo '<img alt="featured image" src="'.$img[0].'">';
                    echo '</a>';
                    echo '</figure>';
                } ?>
                <?php the_content( __( 'Read more..', THEME_FRONT_TD )); ?>
        </article>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php oxy_pagination($wp_query->max_num_pages);//oxy_results_nav( 'nav-below' ); ?>
    </div>
</section>

 <?php wp_footer(); ?>