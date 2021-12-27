<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>
<?php get_header(); ?>
<body <?php body_class(); ?> >
<?php include(locate_template('common-templates/main-menu.php', false, false)); ?>
<?php include(locate_template('common-templates/sub-menu.php', false, false)); ?>
    <div class="container body-bg">
        <div class="row page-bg page-shadow pt-10p">
            <div class="d-flex flex-wrap">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 d-none d-lg-block d-xl-block sidenav">
                    <?php

                    dynamic_sidebar('secondary-sidebar');
                        $two_col = 7;
                        $two_coll = 9;
                        $class="threecols";
                    ?>
                </div>
                <div class="col-lg-<?php echo $two_col; ?> col-md-9 col-12 col-xs-12 text-justify main <?php echo $class; ?>">
                    <header class="page-header">
                        <?php if ( have_posts() ) : ?>
                            <h1 class="content-title">Search results for:
                            <?php echo get_search_query(); ?></h1>
                        <?php else : ?>
                            <h1 class="content-title">No results found for:
                            <?php echo get_search_query(); ?></h1>
                        <?php endif; ?>
                    </header>
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main search" role="main">
                        <?php
                            if ( have_posts() ) :
                                while ( have_posts() ) : the_post(); ?>
                                    <div class="col-sm-4">
                                        <div class="offer-box">
                                            <a href="<?php the_permalink(); ?>" class="offer-info" title="<?php echo get_post_meta($post->ID, 'slot_custom_meta_slot_software' , true);?>"><i class="fa fa-info"></i></a>
                                            <a href="<?php the_permalink(); ?>">
                                                <div class="offer-image cover" style="background-image: url('<?php the_post_thumbnail_url()?>');">
                                                    <img class="bg-image" src="<?php the_post_thumbnail_url()?>" alt="" style="display: none;">
                                                </div>
                                                <div class="offer-content">
                                                    <p><?php the_title(); ?></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                            <?php endwhile; ?>
                            <?php
                                the_posts_pagination( array(
                                    'screen_reader_text' => ' ',
                                    'prev_text' => '<span class="screen-reader-text">' . __( '<<', 'best50casino.com' ) . '</span>',
                                    'next_text' => '<span class="screen-reader-text">' . __( '>>', 'best50casino.com' ) . '</span>' ,
                                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'best50casino.com' ) . ' </span>',
                                ) );
                            else : ?>

                                <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'best50casino.com' ); ?></p>
                                <?php
                                    get_search_form();
                            endif;
                        ?>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 d-none d-lg-block d-xl-block col-xs-12 sidenav">
                    <?php  dynamic_sidebar('main-sidebar');?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();
