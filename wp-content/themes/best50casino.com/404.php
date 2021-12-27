<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
    <div class="row page-bg page-shadow">
        <div class="d-flex flex-wrap pt-10p">
            <div class="col-lg-9-extra col-md-push-0 col-md-12  colmain col-sm-12 col-xs-12 text-left main ">
                <section class="error-404 not-found">
                    <?php if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<p id="breadcrumbs" class="mb-6 pl-0">', '</p>');
                    } ?>
                    <header class="page-header">
                        <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'best50casino.com' ); ?></h1>
                    </header>
                    <img src="<?php echo get_template_directory_uri().'/assets/images/404.png';?>" alt="404" class="img-responsive" style="width:170px;margin: 0 auto;display: block;">
                    <div class="page-content">
                        <h2 class="post-title"><?php _e( 'You can try using the search bar to find what you\'re looking for or go back to the ', 'tie' ); ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><strong><?php _e( 'Home Page', 'tie' ); ?></strong></a></h2>
                        <?php get_search_form(); ?>
                    </div>
                </section>
            </div>
            <div class="col-lg-3-extra col-xl-3-extra col-md-12 col-sm-12 col-xs-12 d-none  d-md-none d-lg-block d-xl-block sidenav">
                <?php get_sidebar('right');?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();
