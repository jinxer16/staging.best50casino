<?php $sectionHeadingState = get_post_meta($post->ID,'casino_custom_meta_heading_state_slot',true);
if ($sectionHeadingState == ''){
    $sectionHeadingState = 'span';
}
$sectionHeading = get_post_meta($post->ID,'casino_custom_meta_heading_slot',true);
if (!empty($sectionHeading)){
    ?>
    <a id="<?=$anchorsids[3]?>" class="position-relative text-decoration-none" style="top: -70px;"></a>
    <<?=$sectionHeadingState?> class="widget2-new-heading text-18 pt-6p pb-6p pl-10p pr-10p font-weight-bold mb-5p w-100 d-block mt-0p text-whitte text-left"><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
}
?>
<div class="flex-wrap d-flex shadow-box p-5p">
            <div class="w-100 text-justify">
                   <?php
                   $theContent = get_post_meta($post->ID, "casino_custom_meta_li_mo", true);
                   $theContent = ampizeImages($theContent);
                   echo apply_filters('the_content', $theContent); ?>
            </div>
    <div class="w-100 d-flex flex-wrap">
        <?php
        $casino_soft = get_post_meta($post->ID, 'casino_custom_meta_softwares', true);
        if (is_array($casino_soft)) {
            $casino_softCache = implode("-", $casino_soft);
        }
        $args = array(
            'post_type' => 'kss_slots',
            'posts_per_page' => 4,
            'post_status' => array('publish'),
            'numberposts' => 4,
            'no_found_rows' => true,
            'fields' => 'ids',
            'update_post_term_cache' => false,
            'orderby' => 'rand',
            'meta_query' => array(
                array(
                    'key' => 'slot_custom_meta_slot_software',
                    'value' => $casino_soft,
                    'compare' => 'IN',
                )
            )
        );
        $cache_key = 'slot_shark' . md5($casino_softCache);
        if (false === ($slots = wp_cache_get($cache_key))) {
            $slots = get_posts($args);
            wp_cache_set($cache_key, $slots, 'slot_shark', DAY_IN_SECONDS);
        }
        $slots = get_posts($args);
        foreach ($slots as $slot) {
            $score = get_post_meta($slot, 'slot_custom_meta_slot_value', true) / 20; ?>
            <div style="width: 50%;"
                 class="p-3p element-item <?php echo implode(" ", get_post_meta($slot, 'slot_custom_meta_label', true)) ?> ">
                <div class="card">
                    <a class="text-decoration-none" href="<?php echo get_the_permalink($slot); ?>">
                        <figure class="m-0 position-relative">
                            <amp-img class=""
                                     width="154"
                                     height="120"
                                     layout="responsive"
                                     src="<?php echo get_the_post_thumbnail_url($slot) ?>"
                                     alt="game-image"></amp-img>
                            <?php if (get_post_meta($slot, 'slot_custom_meta_label', true)) {
                                $metaLabel = array_flip(get_post_meta($slot, 'slot_custom_meta_label', true));
                                if (isset($metaLabel['LEGEND'])) { ?>
                                    <div class="ribbon hot position-absolute overflow-hidden d-block text-right">
                                        <span class="font-weight-bold text-whitte text-uppercase text-center d-block text-11">Legend</span></div>
                                <?php } elseif (isset($metaLabel['BEST'])) {
                                    ?>
                                    <div class="ribbon premium position-absolute overflow-hidden d-block text-right">
                                        <span>Best</span></div>
                                <?php } elseif (isset($metaLabel['NEW'])) {
                                    ?>
                                    <div class="ribbon new position-absolute overflow-hidden d-block text-right"><span>New</span>
                                    </div>
                                <?php }
                            } ?>
                            <?php $page = get_post_meta($slot, 'slot_custom_meta_slot_software', true); ?>
                            <span class="software position-absolute bottom-5 right-5 d-block">
                                <amp-img class="" src="<?php echo get_post_meta($page, "casino_custom_meta_sidebar_icon", true); ?>" width="30" height="30" alt="<?php echo get_the_title($page); ?>"/></amp-img>
                            </span>
                        </figure>
                        <div class="bg-gray w-100 d-flex flex-column align-items-center justify-content-center">
                            <span class="name text-13 text-primary font-weight-bold"><?php echo get_the_title($slot); ?> </span>
<!--                            <span class="text-secondary text-11">--><?php //echo get_rating('','this',$score); ?><!--</span>-->
                        </div>
                    </a>
                </div>
            </div>
            <?php
        }

        ?>
    </div>
</div>