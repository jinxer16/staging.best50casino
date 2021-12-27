<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
<div class="container body-bg">
    <div class="row page-bg page-shadow">
        <div class="d-flex flex-wrap pt-10p">
            <?php if (!get_post_meta($post->ID, 'posts_no_sidebar' ,true)) { ?>
                <div class="col-lg-2-extra col-md-2 col-sm-12 col-xs-12 pl-0 d-none d-md-none d-lg-block d-xl-block sidenav sidelefttablet sidenav">
                    <?php
                        get_sidebar('left');
                        $two_col = '7-extra';
                        $two_coll = '9-extra';
                        $class="threecols";
                    ?>
                </div>
            <?php } else { $two_col = '9-extra'; $two_coll = 12; $class="twocols"; } ?>
            <div class="col-lg-<?php echo $two_col; ?> col-md-12 col-sm-12 col-xs-12 text-justify colmain main <?php echo $class; ?>">
                <?php
                    if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<p id="breadcrumbs" class="mb-2">', '</p>');
                    }
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php while ( have_posts() ) : the_post(); ?>
                    <header class="entry-header">
                        <?php the_title( '<h1 class="content-title"><span>', '</span></h1>' ); ?>
                    </header>
                    <div class="entry-content">
                        <p><?php echo get_field('text_above_the_slots', $post->ID);?></p>
                        <?php echo do_shortcode('[slots_filters]');?>
                        <div class="isotope d-flex flex-wrap w-100 container-slots">
                        </div>
                        <?php the_content(); ?>
                    </div>
                <?php endwhile;	?>
                </article>
            </div>
            <div class="col-lg-3-extra d-md-none d-lg-block d-xl-block col-sm-12 col-xs-12 sidenav">
                <?php get_sidebar('right');?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>