<?php get_header(); ?>
<body <?php body_class(); ?> >
<?php include(locate_template('common-templates/main-menu.php', false, false)); ?>

    <div class="container">
        <div class="row page-bg page-shadow">
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs" class="pl-10p pt-10p pb-10p pl-0 m-0">', '</p>');
            }

            if (get_post_meta($post->ID,'casino_custom_meta_template',true) == "nocontent") {
                get_template_part('common-templates/casino-no-content-menu');
            }
            ?>

            <div class="d-flex flex-wrap review-wrapper w-100 main">
                <?php
                while (have_posts()) : the_post();
                    if (get_post_meta($post->ID,'casino_custom_meta_template',true) == "new"){
                        get_template_part('templates/post/content-kss-new_casino');
                    }elseif (get_post_meta($post->ID,'casino_custom_meta_template',true) == "nocontent") {
                        get_template_part('templates/post/content-kss-no-content-review');
                    }else{
                        get_template_part('templates/post/content-kss_casino');
                    }

                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>