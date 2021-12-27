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

$padding = get_the_ID()==2?'p-sm-5p':'';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($padding); ?>>
<?php
    if ( is_front_page() ) {

	} else {
?>
	<header class="entry-header d-flex flex-wrap w-100 align-items-start">
		<?php
			if ( 'post' === get_post_type() ) :
				echo '<div class="entry-meta">';
					if ( is_single() ) :
						//twentyseventeen_posted_on();
					else :
						echo twentyseventeen_time_link();
						//twentyseventeen_edit_link();
					endif;
				echo '</div><!-- .entry-meta -->';
			endif;
			if ( is_single() ) {
				the_title( '<h1 class="entry-title 85">', '</h1>' );
			} else {
				the_title( '<h1 class="content-title w-85"><span>', '</span></h1>' );

			}
		?>
        <?php
        if ( '' !== get_the_post_thumbnail() && ! is_single() && !get_post_meta($post->ID, 'hide_featured', true)) : ?>
        <div class="post-thumbnail w-15">
            <img class="img-fluid"  src="<?=get_the_post_thumbnail_url($post->ID)?>" loading="lazy">
        </div>
        <?php endif;?>
	</header>
	<?php } ?>
    <?php
        if ( is_front_page() ){
    ?>
        <header class="entry-header">
            <?php the_title( '<h1 class="content-title"><span>', '</span></h1>' ); ?>

        </header>
    <?php
        the_content();
        //echo apply_filters('the_content', $content);

	    } else {
    ?>
		<div class="entry-content">
                <?php
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
	<?php } ?>
</article>
