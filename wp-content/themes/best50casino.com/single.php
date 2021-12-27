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
    <div class="row page-bg page-shadow pt-10p">

        <?php if($post->post_type !='kss_slots' && $post->post_type !='kss_news' && $post->post_type !='kss_games'){
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs" class="mb-10p col-12 pl-0 pl-sm-10p visible-xs d-block d-xl-none d-lg-none">', '</p>');
            }
            get_template_part("templates/mobile_head_gadgets");
        }?>
        <div class="d-flex flex-wrap">
            <?php if (!get_post_meta($post->ID, 'posts_no_sidebar' ,true)) { ?>
                <?php if( 'kss_casino' !== $post->post_type && !is_singular('kss_slots')  && !is_singular('kss_news')) { ?>
                    <div class="col-lg-2-extra  col-md-12 col-sm-2 d-none d-md-none d-lg-block d-xl-block col-xs-12 sidenav sidelefttablet">
                        <?php get_sidebar('left'); ?>
                    </div>
                <?php
                }
            }
            ?>
            <?php
                if (!get_post_meta($post->ID, 'posts_no_sidebar' ,true) ) {
                    if('kss_casino' !== $post->post_type && !is_singular('kss_slots') && !is_singular('kss_news')) {
                        $two_col = '7-extra';
                        $two_coll = '9-extra';
                        $push_1 = 2;
                        $class="threecols";
                    }else{
                        $two_col = '9-extra';
                        $two_coll = '9-extra';
                        $class="twocols";
                    }
                } else {
                    $two_col = '9-extra';
                    $two_coll = '9-extra';
                    $class="twocols";
                }
            ?>
            <?php
            if( 'kss_casino' !== $post->post_type ) { ?>
            <div class="col-lg-<?php echo $two_col; ?> col-md-push-0 col-md-12  colmain col-sm-12 col-xs-12 text-left main  <?php echo $class; ?>">
                <?php if($post->post_type !== 'kss_softwares' || $post->post_type !== 'kss_transactions' ||$post->post_type !== 'kss_offers' ||$post->post_type !== 'kss_news') { } ?>
                <?php } else { ?>
                <div class="col-sm-12 text-left main">
                    <?php //the_breadcrumb(); ?>
                    <?php } ?>
                    <?php
                        if (function_exists('yoast_breadcrumb')) {
                            yoast_breadcrumb('<p id="breadcrumbs" class="mb-10p col-12 pl-0 d-md-block d-xl-block d-xl-block d-none">', '</p>');
                        }

                    ?>
                    <?php
                        while ( have_posts() ) : the_post();
                            if ( 'kss_slots' === $post->post_type ) {
//        							get_template_part( 'templates/common/casino-list-responsive');
                                get_template_part( 'templates/post/content-kss_slots', get_post_format() );
                            } elseif( 'kss_guides' === $post->post_type ) {
//                                get_template_part( 'templates/common/casino-list-responsive');
                                get_template_part( 'templates/post/content-kss_guides', get_post_format() );
                            } elseif( 'kss_offers' === $post->post_type ) {
                                get_template_part( 'templates/post/content-kss_offers', get_post_format() );
                            } elseif( 'kss_games' === $post->post_type ) {
                                get_template_part( 'templates/post/content-kss_games', get_post_format() );
                            } elseif( 'kss_softwares' === $post->post_type ) {
                                get_template_part( 'templates/post/content-kss_software', get_post_format() );
                            } elseif( 'kss_transactions' === $post->post_type ) {
                                get_template_part( 'templates/post/content-kss_transactions', get_post_format() );
                            } elseif( 'kss_news' === $post->post_type ) {
                                get_template_part( 'templates/post/content-kss_news', get_post_format() );
                            } elseif (is_single()) {
                    ?>
                                <h1 class="content-title"><span><?php the_title(); ?></span></h1>
                                <?php
                                    the_content();
                                    $posttags = get_the_tags();
                                    if ($posttags) {
                                ?>
                                    <ul class="tags-list">
                                        <?php
                                            foreach($posttags as $tag) {
                                                echo '<li><a href="'.get_tag_link($tag->term_id).'">'.$tag->name .'</a></li>';
                                            }
                                        ?>
                                    </ul>
                                <?php }
                                    echo get_post_meta($post->ID, 'in_page_game_script', true);
                            } else {
                                get_template_part( 'templates/post/content', get_post_format() );
                            }
                            if (get_post_meta($post->ID,'no_comments',true) !== 1){
                            echo CommentForm($post->ID);
                            }
                        endwhile;
                    ?>

                    <?php
                    get_template_part('templates/common/content-faqs');
                    //   get_template_part("templates/common/promotions_notifications");
                    ?>
                </div>
                <?php if( 'kss_casino' != $post->post_type ) { ?>
                    <div class="col-lg-3-extra col-xl-3-extra col-md-12 col-sm-12 col-xs-12 d-none  d-md-none d-lg-block d-xl-block sidenav">
                        <?php get_sidebar('right');?>
                    </div>
                <?php } ?>
            </div>
    </div>

</div>
</div>
<?php get_footer(); ?>