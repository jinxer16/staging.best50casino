<?php get_header(); ?>
<div <?php body_class(); ?> >
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
        <div class="d-flex flex-wrap w-100">
        <?php if (!get_post_meta($post->ID, 'posts_no_sidebar' ,true)){ ?>
            <div class="col-lg-2-extra col-md-12 col-sm-12 col-12 col-xs-12 d-block order-lg-1 order-3 sidenav sidelefttablet">
                <?php
                 dynamic_sidebar('secondary-sidebar');
                    $two_col = '7-extra';
                    $two_coll = '9-extra';
                    $class="threecols";
                ?>
            </div>
        <?php }else{ $two_col = '9-extra'; $two_coll = 12; $class="twocols";}?>
            <div class="col-lg-<?php echo $two_col; ?> col-md-12 col-sm-12 col-xs-12 text-justify order-1 order-lg-2 col-12 main colmain <?php echo $class; ?>">
                <?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'templates/post/content');
                        get_template_part( 'templates/common/related-articles');
                        get_template_part('templates/common/content-faqs');
                        if ($post->ID !== 2 && get_post_meta($post->ID,'no_comments',true) !== 1){
                        echo CommentForm($post->ID);
                        }
                    endwhile;
            ?>
            </div>
        <div class="col-lg-3-extra col-xl-3-extra col-md-12 col-12 order-2 order-lg-3 col-sm-12 col-xs-12 sidenav">
            <?php  dynamic_sidebar('main-sidebar');?>
        </div>

        </div>
    </div>
<!--    --><?php //get_template_part("templates/common/promotions_notifications");?>
</div>
</div>

<?php get_footer(); ?>