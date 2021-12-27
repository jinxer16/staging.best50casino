<?php get_header(); ?>
<body <?php body_class(); ?> >
<?php include(locate_template('common-templates/main-menu.php', false, false)); ?>
    <div class="container body-bg">
        <div class="row page-bg page-shadow">
            <?php
            if (is_front_page()) {
                get_template_part("templates/head_gadgets");
            } else {
                if (function_exists('yoast_breadcrumb') && $post->ID != 2) {
                    yoast_breadcrumb('<p id="breadcrumbs" class="mb-10p pt-10p col-12 pl-10p pl-sm-10p visible-xs">', '</p>');
                }
                get_template_part("templates/mobile_head_gadgets");
            }
            ?>
            <div class="d-flex flex-wrap">
                <?php if (!get_post_meta($post->ID, 'posts_no_sidebar' ,true)){ ?>
                    <div class="col-lg-2-extra col-md-12 col-sm-12 col-xs-12 d-none d-md-none d-lg-block d-xl-block sidenav sidelefttablet">
                        <?php
                        dynamic_sidebar('secondary-sidebar');
                        $two_col = '7-extra';
                        $two_coll = '9-extra';
                        $class="threecols";
                        ?>
                    </div>
                <?php }else{ $two_col = '9-extra'; $two_coll = 12; $class="twocols";}?>
                <div class="col-lg-<?php echo $two_col; ?> col-md-12 col-sm-12 col-xs-12 text-justify main colmain <?php echo $class; ?>">
                    <?php
                    while ( have_posts() ) : the_post();
                        echo compareCasino($id);
                        get_template_part( 'templates/post/content');
                        //get_template_part( 'templates/specials/pinned-related');
                    endwhile;
                    ?>
                </div>
                <div class="col-lg-3-extra col-xl-3-extra col-md-12 d-md-none d-lg-block d-xl-block col-sm-12 col-xs-12 sidenav">
                    <?php  dynamic_sidebar('main-sidebar');?>
                </div>

            </div>
        </div>
<!--        --><?php //get_template_part("templates/common/promotions_notifications");?>
    </div>
<?php get_footer(); ?>