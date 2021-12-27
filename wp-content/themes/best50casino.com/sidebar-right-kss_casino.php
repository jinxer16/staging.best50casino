<div class="widget2">
    <span class="widget2-heading">General Info</span>
    <div class="widget2-body p-10p">
        <div class="info-row">
            <h6>Website</h6>
            <p><a rel="nofollow"
                  href="<?php echo get_post_meta($post->ID, 'casino_custom_meta_affiliate_link_review', true); ?>"><?php echo str_replace("https://", "", get_post_meta($post->ID, 'casino_custom_meta_com_url', true)); ?></a>
            </p>
        </div>
        <div class="info-row">
            <h6>Founded</h6>
            <p><?php echo get_post_meta($post->ID, 'casino_custom_meta_com_estab', true); ?></p>
        </div>
        <div class="info-row">
            <h6>Licensed in</h6>
            <?php

         foreach (get_post_meta($post->ID, 'casino_custom_meta_license_country') as $option) {
                if ($option) {
                    $i = 0;
                    $len = count($option);
                    foreach ($option as $licenseid){
                        if ($licenseid == '13975'){
                            $title = 'Sweden';
                        }else{
                            $title = get_the_title($licenseid);
                        }
                    if (count($option) > 1){

                        if(++$i === $len) {
                            echo  $title;
                        }else{
                            echo  $title .", ";
                        }

                    }else{
                        echo  $title ;
                    }

                    }
            }
            }
         ?>
        </div>
        <?php if (get_post_meta($post->ID, 'casino_custom_meta_twitter_option') || get_post_meta($post->ID, 'casino_custom_meta_facebook_option') || get_post_meta($post->ID, 'casino_custom_meta_instagram_option')) { ?>
            <div class="info-row">
                <h6>Social Media</h6>
                <?php
                $sret = '';
                $social = get_post_meta($post->ID, 'casino_custom_meta_twitteroption_det');
                $social1 = get_post_meta($post->ID, 'casino_custom_meta_facebookoption_det');
                $social2 = get_post_meta($post->ID, 'casino_custom_meta_instagramoption_det');
                if ($social[0]) {
                    $sret .= '<i style="font-size: 20px;margin-right:15px;" class="fa fa-twitter" aria-hidden="true" data-toggle="tooltip" title="' . $social[0] . '"></i>';
                }
                if ($social1[0]) {
                    $sret .= '<i style="font-size: 20px;margin-right:15px;" class="fa fa-facebook" aria-hidden="true" data-toggle="tooltip" title="' . $social1[0] . '"></i>';
                }
                if ($social2[0]) {
                    $sret .= '<i style="font-size: 20px;margin-right:15px;" class="fa fa-instagram" aria-hidden="true" data-toggle="tooltip" title="' . $social2[0] . '"></i>';
                }
                ?>
                <p><?php echo $sret; ?></p>

            </div>
            <?php
        } ?>
        <div class="info-row">
            <h6>Customer Service Hours</h6>
            <p><?php echo get_post_meta($post->ID, 'casino_custom_meta_comun_hours', true); ?></p>
        </div>
        <div class="info-row">
            <h6>Email</h6>
            <p>
                <a href="mailto:<?php echo get_post_meta($post->ID, 'casino_custom_meta_emailoption_det', true); ?>"><?php echo get_post_meta($post->ID, 'casino_custom_meta_emailoption_det', true); ?></a>
            <p>
        </div>
        <div class="info-row">
            <h6>Live Chat</h6>
            <p><?php if (get_post_meta($post->ID, 'casino_custom_meta_live_chat_option', true)) {
                    echo 'Yes';
                } else {
                    echo 'No';
                }; ?></p>
        </div>
        <?php if (get_post_meta($post->ID, 'casino_custom_meta_phoneoption_det', true)) { ?>
            <div class="info-row">
                <h6>Phone Number</h6>
                <p><?php echo get_post_meta($post->ID, 'casino_custom_meta_phoneoption_det', true); ?></p>
            </div>
        <?php } ?>
        <?php $platforms = get_post_meta($post->ID, 'casino_custom_meta_platforms', true); ?>
        <?php if ($platforms) { ?>
            <div class="info-row info-platforms">
                <h6>Platforms</h6>
                <?php $platformsArray = array('apple' => 'iPhone App', 'android' => 'Android App', 'windows' => 'Windows Phone App', 'download' => 'Casino Download',); ?>
                <?php foreach ($platforms as $platform) {
                    echo '<b class="mr-15p text-20 mb-0"><i class="fa fa-' . $platform . ' " aria-hidden="true"  data-toggle="tooltip" title="' . $platformsArray[$platform] . '"></i></b>';
                } ?>
            </div>
        <?php } ?>

        <?php $auditing = get_post_meta($post->ID, 'casino_custom_meta_auditing', true); ?>
        <?php if ($auditing) { ?>
            <div class="info-row info-platforms">
                <h6>Auditing</h6>
                <?php foreach ($auditing as $audit) {
                    echo '<span class="shortcode-icon ' . $audit . '"></span>';
                } ?>
            </div>
        <?php } ?>
    </div>
</div>
<div class="widget2">
    <span class="widget2-heading">Payment Methods</span>
    <div class="widget2-body p-10p">
        <div class="info-row">
            <h6>Deposit Methods</h6>
            <ul class="inline-list cards-list">

                <?php
                $payments = get_post_meta($post->ID, 'casino_custom_meta_dep_options', true);
                if ($payments) {
                    foreach ($payments as $option) {
                        $title = get_the_title($option);
                        $image_id = getImageId(get_post_meta($option, 'casino_custom_meta_sidebar_icon', true));
                        $image = wp_get_attachment_image_src($image_id, 'sidebar-40', true);
                        if (get_post_status($option) == 'publish') {
                            ?>
                            <li><a href="<?php echo get_the_permalink($option); ?>"><img loading="lazy"
                                                                                         src="<?php echo $image[0]; ?>"
                                                                                         width="40" height="40"
                                                                                         alt="<?= $title; ?>"
                                                                                         data-toggle="tooltip"
                                                                                         title="<?php echo ucwords($title); ?> "/></a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li><img loading="lazy" src="<?php echo $image[0]; ?>"
                                     width="40" height="40" alt="<?php echo get_the_title($title); ?>"
                                     data-toggle="tooltip" title="<?php echo ucwords($title); ?> "/></li>
                            <?php
                        }
                    }
                } ?>
            </ul>
        </div>
        <div class="info-row">
            <h6>Withdrawal Methods</h6>
            <ul class="inline-list cards-list">
                <?php
                $payments = get_post_meta($post->ID, 'casino_custom_meta_withd_options', true);
                if ($payments) {
                    foreach ($payments as $option) {
                        $title = get_the_title($option);
                        $image_id = getImageId(get_post_meta($option, 'casino_custom_meta_sidebar_icon', true));
                        $image = wp_get_attachment_image_src($image_id, 'sidebar-40', true);
                        if (get_post_status($option) == 'publish') {
                            ?>
                            <li><a href="<?php echo get_the_permalink($option); ?>"><img loading="lazy"
                                                                                         src="<?php echo $image[0]; ?>"
                                                                                         width="40" height="40"
                                                                                         alt="<?php echo get_the_title($option); ?>"
                                                                                         data-toggle="tooltip"
                                                                                         title="<?php echo ucwords($title); ?> "/></a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li><img loading="lazy" src="<?php echo $image[0]; ?>"
                                     width="40" height="40" alt="<?php echo get_the_title($option); ?>"
                                     data-toggle="tooltip" title="<?php echo ucwords($title); ?> "/></li>
                            <?php
                        }
                    }
                } ?>
            </ul>
        </div>
        <div class="info-row">
            <h6>Min Deposit</h6>
            <p><?php echo get_post_meta($post->ID, 'casino_custom_meta_min_dep', true); ?><p>
        </div>
        <div class="info-row">
            <h6>Min Withdrawal</h6>
            <p><?php echo get_post_meta($post->ID, 'casino_custom_meta_min_withd', true); ?><p>
        </div>
    </div>
</div>
<div class="widget2">
    <span class="widget2-heading">Games & Providers</span>
    <div class="widget2-body p-10p">
        <div class="info-row">
            <h6>RNG Games</h6>
            <?php foreach (get_post_meta($post->ID, 'casino_custom_meta_games') as $option) {
                ?>
                <p><?php echo implode(', ', $option) ?></p>
            <?php } ?>
        </div>
        <div class="info-row">
            <h6>Games Payout</h6>
            <p><?php echo get_post_meta($post->ID, 'casino_custom_meta_payout', true); ?><p>
        </div>
        <div class="info-row softwares">
            <h6>Casino Providers</h6>
            <table width="100%" border="0">
                <tbody>
                <?php
                $preferedOrder = array("Novomatic", "Netent", "EGT", "Playtech", "Microgaming", "Evolution Gaming", "ΝΥΧ Gaming", "Play\'n Go", "IGΤ", "Betsoft", "iSoftbet", "Aristocrat");
                $availableMeans = get_post_meta($post->ID, 'casino_custom_meta_softwares', true);
                if (is_array($availableMeans)) {
                    $res = array_intersect($preferedOrder, $availableMeans);
                    $correctOrder = array_unique(array_merge($res, $availableMeans));

                    $j = 0;
                    //print_r($correctOrder);

                    foreach ($correctOrder as $option) {
                        $j += 1;
                        $title = get_the_title($option);
                        if ($j > 5) { ?>
                            <tr class="collapse">
                        <?php } else { ?>
                            <tr>
                        <?php }
                        if (get_post_status($option) == 'publish') {
                            ?>
                            <td>
                                <a href="<?php echo get_the_permalink($option); ?>"><?= $title; ?></a>
                            </td>
                            <?php
                        } else {
                            ?>
                            <td><?= $title; ?></td>
                            <?php
                        }
                        ?>
                        <?php $image_id = getImageId(get_post_meta($option, 'casino_custom_meta_sidebar_icon', true)); ?>
                        <?php $image = wp_get_attachment_image_src($image_id, 'sidebar-40', true); ?>
                        <td><img loading="lazy" src="<?php echo $image[0]; ?>"
                                 width="40" height="40" alt="<?= $title; ?>" data-toggle="tooltip"
                                 title="<?php echo ucwords($title); ?> "/></td>
                        </tr>
                    <?php }
                } else {
                    ?>
                    <tr>
                        <td>-</td>
                    </tr>
                    <?php
                } ?>
                </tbody>
            </table>
            <?php if ($j > 5) { ?>
                <button class="catholic_link collapsed w-100" id="provider_collapsebtn" data-target="tr.collapse"
                        data-toggle="collapse">
                    + <?php echo $j - 5; ?> Providers
                </button>
            <?php } ?>
        </div>
        <div class="info-row">
            <h6>Live Casino Games</h6>
            <?php foreach (get_post_meta($post->ID, 'casino_custom_meta_live_games') as $option) {
                ?>
                <p><?php echo implode(', ', $option) ?></p>
            <?php } ?>
        </div>
        <?php if (!get_post_meta($post->ID, 'casino_custom_meta_live_casino', true)) { ?>
            <div class="info-row">
                <h6>Live Casino</h6>
                <p><?php if (get_post_meta($post->ID, 'casino_custom_meta_live_casino', true)) {
                        echo 'Yes';
                    } else {
                        echo 'No';
                    }; ?></p>
            </div>
        <?php } ?>
        <div class="info-row softwares">
            <h6>Live Casino Providers</h6>
            <table width="100%" border="0">
                <tbody>
                <?php if (!get_post_meta($post->ID, 'casino_custom_meta_live_softwares', true)) { ?>
                    <tr>
                        <td>-</td>
                    </tr>
                <?php } else { ?>
                    <?php foreach (get_post_meta($post->ID, 'casino_custom_meta_live_softwares', true) as $option) {
                        $title = get_the_title($option);
                        ?>
                        <tr> <?php
                            if (get_post_status($option) == 'publish') {
                                ?>
                                <td>
                                    <a href="<?php echo get_the_permalink($option); ?>"><?= $title; ?></a>
                                </td>
                                <?php
                            } else {
                                ?>
                                <td><?= $title; ?></td>
                                <?php
                            }
                            ?>
                            <?php $image_id = getImageId(get_post_meta($option, 'casino_custom_meta_sidebar_icon', true)); ?>
                            <?php $image = wp_get_attachment_image_src($image_id, 'sidebar-40', true); ?>
                            <td>
                                <img loading="lazy" src="<?php echo $image[0]; ?>"
                                     width="40" height="40" alt="<?= $title; ?>" data-toggle="tooltip"
                                     title="<?php echo ucwords($title); ?> "/>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="widget2">
    <?php echo get_template_part('/templates/common/casino_select_menu'); ?>
</div>