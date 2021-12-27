<?php
    $meta = get_post_meta($post->ID, 'casino_custom_meta_anchors', true);
    $anchors = explode(",", $meta);

    $metaids = get_post_meta($post->ID, 'casino_custom_meta_anchors', true);
    $anchorsids = explode(",", $metaids);
    ?>
    <div class="container d-flex flex-wrap text-dark p-0 mb-15p text-16" style="
    position: sticky;
    bottom: 0;
    top: 6%;
    left: 0;
    right: 0;
    z-index: 800;">
        <div class=" pl-5p pr-5p pt-5p mt-5p w-100 d-none d-lg-block position-sticky top-0 z-1">
            <ul class="review-anchors list-unstyled bg-primary d-flex rounded-10 justify-content-between position-relative">
                <?php foreach ($anchors as $key=>$value) {
                    ?>
                    <li class="p-10p border-right w-100 text-center font-weight-bold"><a href="#<?=$anchorsids[$key]?>" class="text-13 text-white"><?= $value ?></a></li>
                <?php }
                $casinoBonusPage = get_post_meta($post->ID, 'casino_custom_meta_bonus_page', true);
                ?>
                    <li class="p-10p border-right w-100 text-center font-weight-bold"><a href="<?=get_the_permalink($casinoBonusPage); ?>" class="text-13 text-white">Bonus</a>
                </li>
            </ul>
        </div>
    </div>
    <?php
 ?>