<aside class="sidebar right_sidebar">
    <?php
        if ( 'kss_slots' ==$post->post_type || 5459 == $post->ID ){
            echo do_shortcode('[table layout="sidebar_3" sort_by="premium" title="Best Casinos" cta="visit" link_title_url="https://www.@best50casino.com/online-casino-reviews/" ]');
        }
        // sidebar right widgetized
        if (function_exists('dynamic_sidebar') && dynamic_sidebar('main-sidebar')) : else : ?>

        <?php endif; ?>
</aside>