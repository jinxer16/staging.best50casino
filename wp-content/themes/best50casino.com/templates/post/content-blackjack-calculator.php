<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

$padding = get_the_ID()==2?'p-sm-10p':'';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($padding); ?>>
        <header class="entry-header">
            <?php
                the_title( '<h1 class="content-title"><span>', '</span></h1>' );
            ?>
        </header>
        <div class="entry-content">
            <?php
            require_once get_template_directory() . '/templates/bj-calculator/blackjack-calculator-functions.php';
            include(locate_template('templates/bj-calculator/blackjack-calculator-template.php', false, false));
            /* translators: %s: Name of current post */
            the_content( sprintf(
                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
                get_the_title()
            ) );

            wp_link_pages( array(
                'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ) );
            ?>
        </div><!-- .entry-content -->

    <?php if ( '' !== get_the_post_thumbnail() && ! is_single() && !get_post_meta($post->ID, 'hide_featured', true)) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
            </a>
        </div>
    <?php endif; ?>
</article>
