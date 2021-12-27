<?php
$casino_pros = explode(',', get_post_meta($post->ID, 'casino_custom_meta_pros', true));
$casino_cons = explode(',', get_post_meta($post->ID, 'casino_custom_meta_why_not_play', true));
?>
<div class="widget2 hidden-xs">
    <span class="widget2-heading">Rating</span>
    <div class="widget2-body rating-table">
        <div class="rating-table pl-10p pr-10p">
            <table width="100%" border="0">
                <tbody>
                <tr>
                    <td scope="row">Fairness</td>
                    <?php $value = get_post_meta($post->ID, 'casino_custom_meta_license_rating', true);?>
                    <?php $value = $value ? $value : 0?>
                    <td><?=$value?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php $lis_rat = $value * 10;?>
                        <div class="progress rounded">
                            <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="<?php echo $lis_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td scope="row">Payout Speed</td>
                    <?php $value = get_post_meta($post->ID, 'casino_custom_meta_withdrawal_rating', true);?>
                    <?php $value = $value ? $value : 0?>
                    <td><?=$value?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php $wit_rat = $value * 10; ?>
                        <div class="progress rounded">
                            <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="<?php echo $wit_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td scope="row">Bonuses</td>
                    <?php $value = get_post_meta($post->ID, 'casino_custom_meta_offers_rating', true);?>
                    <?php $value = $value ? $value : 0?>
                    <td><?=$value?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php $off_rat = $value * 10; ?>
                        <div class="progress rounded">
                            <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="<?php echo $off_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td scope="row">Software</td>
                    <?php $value = get_post_meta($post->ID, 'casino_custom_meta_site_rating', true);?>
                    <?php $value = $value ? $value : 0?>
                    <td><?=$value?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php $site_rat = $value * 10; ?>
                        <div class="progress rounded">
                            <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="<?php echo $site_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td scope="row">B50 Quality</td>
                    <?php $value = get_post_meta($post->ID, 'casino_custom_meta_games_rating', true);?>
                    <?php $value = $value ? $value : 0?>
                    <td><?=$value?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="progress rounded">
                            <?php $gam_rat = $value * 10; ?>
                            <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="<?php echo $gam_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <span><a class="catholic_link" href="<?php echo get_site_url(); ?>/online-casino-reviews/" target="_blank">Our rating model</a></span>
    </div>
</div>

<a href="<?php echo get_post_meta($post->ID, 'casino_custom_meta_affiliate_link_review', true); ?>" class="bonus-btn d-lg-none d-md-none d-sm-none d-block"><i class="fa fa-star"></i> Register</a>
<?php
//if(current_user_can('administrator')){
//    ?>
<!--    <div class="widget2 hidden-xs">-->
<!--        <span class="widget2-heading">Your Rating</span>-->
<!--        <div class="widget2-body rating-table">-->
<!--            <div class="rating-table pl-10p pr-10p">-->
<!--                <table width="100%" border="0">-->
<!--                    <tbody>-->
<!--                    <tr>-->
<!--                        <td scope="row">-->
<!--                        --><?php //UserVotes::vote($post->ID);?>
<!--                        </td>-->
<!--                    </tr>-->
<!--                    </tbody>-->
<!--                </table>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!---->
<!--    --><?php
//} ?>
    <div class="widget2">
    <span class="widget2-heading"><i class="fa fa-plus-circle text-green"></i> Pros</span>
    <div class="widget2-body p-10p">
        <ul class="dashed pl-10p">
            <?php foreach ($casino_pros as $pros) { ?>
                <li><?php echo $pros; ?></li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="widget2">
    <span class="widget2-heading"><i class="fa fa-minus-circle text-red"></i> Cons</span>
    <div class="widget2-body p-10p">
        <ul class="dashed">
            <?php foreach ($casino_cons as $pros) { ?>
                <li><?php echo $pros; ?></li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="widget2">
    <span class="widget2-heading">Additional Information</span>
    <div class="widget2-body p-10p">
        <div class="info-row">
            <h6>Website Languages</h6>
            <ul class="inline-list countries-list p-0 mb-2p list-typenone d-inline-block">
                <li><?php echo get_flags($post->ID, 'site'); ?></li>
            </ul>
        </div>
        <div class="info-row">
            <h6>Support Languages</h6>
            <ul class="inline-list countries-list  p-0 mb-2p list-typenone d-inline-block ">
                <li><?php echo get_countries($post->ID, 'cs'); ?></li>
            </ul>
        </div>
        <div class="info-row">
            <h6>Currencies</h6>
            <ul class="inline-list cards-list p-0 mb-2p list-typenone d-inline-block">
                <li><?php echo get_currencies($post->ID); ?></li>
            </ul>
        </div>
        <div class="info-row">
            <h6>Restricted countries</h6>
            <ul class="inline-list countries-list p-0 mb-2p list-typenone d-inline-block">
                <li><?php echo get_countries($post->ID, 'rest'); ?></li>
            </ul>
        </div>
    </div>
</div>
<a href="<?php echo get_post_meta($post->ID, 'casino_custom_meta_affiliate_link_review', true); ?>" class="bonus-btn d-lg-none d-md-none d-sm-none"><i class="fa fa-star"></i> Visit</a>
<?php
$args = array(
    'post_type' => array('kss_offers', 'kss_news'),
    'posts_per_page' => 3,
    'post_status' => 'published',
    'no_found_rows' => true,
    'update_post_term_cache' => false,
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'casino_custom_meta_casino_offer',
            //'value' => $cas,
            'compare' => 'LIKE',
        ),
        array(
            'key' => 'casino_custom_meta_promote_offer',
            'value' => 'on',
            'compare' => 'LIKE',
        ),
    ),
);
$my_slot_loop = new WP_Query($args);
$my_slot_loop_count = $my_slot_loop->post_count;
$rest_posts = 3 - $my_slot_loop_count;

if ($my_slot_loop->have_posts()) { ?>
    <div class="widget2-body">
        <div class="widget2 rev-offers">
            <?php $cas = get_the_title($post->ID); ?>
            <span class="widget2-heading">Latest Promotions</span>
            <?php //if( $my_slot_loop->have_posts() ){
            foreach ($my_slot_loop->posts as $slots) {
                if ($slots->ID != $post->ID) {
                    $used_posts[] = $slots->ID;
                    $score = get_post_meta($slots->ID, 'slot_custom_meta_slot_value', true) / 20; ?>
                    <div class="bonus-box p-10p">
                        <table width="100%" border="0">
                            <tbody>
                            <tr>
                                <!--td><span class="bonus-date">ΠΕΜ <span>17/12</span></span></td-->
                                <td>
                                    <span class="bonus-prize"><?php echo get_the_title($slots->ID); ?></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <p><?php echo get_post_excerpt_by_id($slots->ID, 'less'); ?></p>
                        <a href="<?php echo get_the_permalink($slots->ID); ?>" class="learn-more-btn">Read
                            More</a>
                    </div>
                <?php }
            }
            //	}
            if ($rest_posts > 0) {
                $args = array(
                    'post_type' => array('kss_offers', 'kss_news'),
                    'posts_per_page' => $rest_posts,
                    'post_status' => 'published',
                    'numberposts' => $rest_posts,
                    'no_found_rows' => true,
                    'update_post_term_cache' => false,
                    'order' => 'DESC',
                    'orderby' => 'ID',
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'casino_custom_meta_casino_offer',
                            'value' => $cas,
                            'compare' => 'LIKE',
                        ),
                    ),
                    'post__not_in' => $used_posts,
                );
                $my_extra_slot_loop = new WP_Query($args);
            }
            if ($my_extra_slot_loop->have_posts()) {
                foreach ($my_extra_slot_loop->posts as $slots) {
                    if ($slots->ID != $post->ID) {
                        $score = get_post_meta($slots->ID, 'slot_custom_meta_slot_value', true) / 20; ?>
                        <div class="bonus-box p-10p">
                            <?php if ('kss_offers' == $slots->post_type) { ?>
                                <div class="ribbon cat"><span><i class="fa fa-star" aria-hidden="true"></i>Promotion</span>
                                </div>
                            <?php } ?>
                            <table width="100%" border="0">
                                <tbody>
                                <tr>
                                    <!--td><span class="bonus-date">ΠΕΜ <span>17/12</span></span></td-->
                                    <td>
                                        <span class="bonus-prize"><?php echo get_the_title($slots->ID); ?></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <p><?php echo get_post_excerpt_by_id($slots->ID, 'less'); ?></p>
                            <a href="<?php echo get_the_permalink($slots->ID); ?>" class="learn-more-btn">Read
                                More</a>
                        </div>
                    <?php }
                }
            } ?>
            <a class="catholic_link"
               href="<?php echo get_post_meta($post->ID, 'casino_custom_meta_url_offers_news_link', true); ?>"><?php echo get_post_meta($post->ID, 'casino_custom_meta_text_offers_news_link', true); ?></a>
        </div>
    </div>
<?php } ?>