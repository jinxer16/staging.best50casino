<?php if (!get_post_meta($post->ID, 'hide_featured', true)) { ?>
    <figure class="image-banner">
        <img class="bg-image" src="<?php get_the_post_thumbnail_url($post->ID); ?>" loading="lazy" width="720" height="350" alt=""/>
        <figcaption>
            <h1 class="text-white mb-5p mt-5p text-24"><?php the_title(); ?></h1>
            <?php //the_excerpt(); ?>
            <p class="pull-right text-13 text-grey mb-0"><?php the_date(); ?></p>
        </figcaption>
    </figure>
<?php } else {
    ?>
    <h1 class="star"><?php the_title(); ?></h1>
    <?php
} ?>
<div class="entry">
    <?php the_content();
    $posttags = get_the_tags();
    if ($posttags) {
        ?>
        <ul class="tags-list">
            <?php foreach ($posttags as $tag) {
                echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
            }
            ?>
        </ul>
    <?php }
    echo get_post_meta($post->ID, 'in_page_game_script', true); ?>

    <hr>
    <?php

        $title_h6 = "More Articles";

    //							if( $related->have_posts() ) : ?>
    <h3 class="bg-dark text-white p-5p" style="border:none;"><?php echo $title_h6; ?> </h3>
    <?php echo related_posts($post->post_type,  $post->ID ); ?>
    <!--						--><?php //endif;
    wp_reset_postdata(); ?>
</div>