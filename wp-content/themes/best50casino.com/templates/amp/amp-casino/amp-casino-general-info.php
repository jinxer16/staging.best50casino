<div class="widget2 mt-10p mb-10p">
    <span class="widget2-heading text-whitte p-7p font-weight-bold text-18 mb-2p w-100 d-block mt-0 bg-dark text-left">General Info</span>
    <div class="d-flex flex-wrap  w-100 ">
        <div class="w-100 bg-gray-light box-sidebar">
            <div class="w-90 m-auto">
                <span class="mb-2p mt-5p text-primary d-block text-13 font-weight-bold" style="border-bottom: 1px solid #777777f5;">Licensed in</span>
                <p>
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
                </p>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap mb-2p w-100 ">
        <div class="w-100  bg-gray-light box-sidebar">
            <div class="w-90 m-auto">
                <span class="mb-2p mt-5p d-block text-primary text-13 font-weight-bold" style="border-bottom: 1px solid #777777f5;">Founded</span>
                <p><?php echo get_post_meta($post->ID, 'casino_custom_meta_com_estab', true); ?></p>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap w-100 ">
        <div class="w-100 bg-gray box-sidebar">
            <div class="w-90 m-auto">
                <span class="mb-2p mt-5p d-block text-primary text-13 font-weight-bold" style="border-bottom: 1px solid #777777f5;">Website</span>
                <p class="text-dark"><a class="text-dark text-decoration-none" rel="nofollow"
                                        href="<?php echo get_post_meta($post->ID, 'casino_custom_meta_affiliate_link_review', true); ?>"><?php echo str_replace("https://", "", get_post_meta($post->ID, 'casino_custom_meta_com_url', true)); ?></a>
                </p>
            </div>
        </div>
    </div>
    <?php if (get_post_meta($post->ID, 'casino_custom_meta_twitter_option') || get_post_meta($post->ID, 'casino_custom_meta_facebook_option') || get_post_meta($post->ID, 'casino_custom_meta_instagram_option')) { ?>
        <div class="d-flex flex-wrap mb-2p w-100 ">
            <div class="w-100 pt-10p pb-10p bg-gray box-sidebar">
                <div class="w-90 m-auto">
                    <span class="mb-2p mt-5p d-block text-primary text-13 font-weight-bold" style="border-bottom: 1px solid #777777f5;">Social Media</span>
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
                    <p class="text-dark"><?php echo $sret; ?></p>
                </div>
            </div>
        </div>
        <?php
    } ?>
    <div class="d-flex flex-wrap mb-2p w-100 ">
        <div class="w-100 bg-gray box-sidebar">
            <div class="w-90 m-auto">
                <span class="mb-2p mt-5p d-block text-primary text-13 font-weight-bold" style="border-bottom: 1px solid #777777f5;">Customer Service Hours</span>
                <p class="text-dark"><?php echo get_post_meta($post->ID, 'casino_custom_meta_comun_hours', true); ?></p>
            </div>
        </div>
    </div>
    <div class="d-flex flex-wrap w-100 ">
        <div class="w-100 bg-gray-light box-sidebar">
            <div class="w-90 m-auto ">
                <span class="mb-2p mt-5p d-block text-primary text-13 font-weight-bold" style="border-bottom: 1px solid #777777f5;">Email</span>
                <p class="text-dark">
                    <a class="text-dark text-decoration-none" href="mailto:<?php echo get_post_meta($post->ID, 'casino_custom_meta_emailoption_det', true); ?>"><?php echo get_post_meta($post->ID, 'casino_custom_meta_emailoption_det', true); ?></a>
                <p>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap mb-2p w-100 ">
        <div class="w-100 bg-gray-light box-sidebar">
            <div class="w-90 m-auto">
                <span class="mb-2p mt-5p d-block  text-primary text-13 font-weight-bold" style="border-bottom: 1px solid #777777f5;">Live Chat</span>
                <p class="text-dark"><?php if (get_post_meta($post->ID, 'casino_custom_meta_live_chat_option', true)) {
                        echo 'Yes';
                    } else {
                        echo 'No';
                    }; ?></p>
            </div>
        </div>
    </div>
    <?php if (get_post_meta($post->ID, 'casino_custom_meta_phoneoption_det', true)) { ?>
        <div class="d-flex flex-wrap w-100 ">
            <div class="w-100 bg-gray  box-sidebar">
                <div class="w-90 m-auto">
                    <span class="mb-2p d-block text-primary text-13 font-weight-bold" style="border-bottom: 1px solid #777777f5;">Phone Number</span>
                    <p class="text-dark"><?php echo get_post_meta($post->ID, 'casino_custom_meta_phoneoption_det', true); ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php $platforms = get_post_meta($post->ID, 'casino_custom_meta_platforms', true); ?>
    <?php if ($platforms) { ?>
        <div class="d-flex flex-wrap mb-2p w-100 ">
            <div class="w-100 bg-gray  box-sidebar">
                <div class="w-90 m-auto ">
                    <span class="mb-2p d-block mt-5p text-primary font-weight-bold" style="border-bottom: 1px solid #777777f5;">Platforms</span>
                    <?php $platformsArray = array('apple' => 'iPhone App', 'android' => 'Android App', 'windows' => 'Windows Phone App', 'download' => 'Casino Download',); ?>
                    <?php foreach ($platforms as $platform) {
                        echo '<b class="mr-15p text-20 mb-0"><i class="fa fa-' . $platform . ' " aria-hidden="true"  data-toggle="tooltip" title="' . $platformsArray[$platform] . '"></i></b>';
                    } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="widget2 w-100 mt-10p mb-10p">
    <span class="widget2-heading text-whitte p-7p font-weight-bold text-15 mb-2p w-100 d-block mt-0 bg-dark text-left">Additional Information</span>
    <div class="widget2-body p-10p">
        <div class="info-row">
            <span class="text-17 mb-2p mt-2p font-weight-bold d-block">Website Languages</span>
            <ul class="inline-list countries-list p-0 mb-2p list-typenone d-inline-block">
                <li><?php echo get_flags_amp($post->ID, 'site'); ?></li>
            </ul>
        </div>
        <div class="info-row">
            <span class="text-17 mb-2p mt-2p font-weight-bold d-block">Support Languages</span>
            <ul class="inline-list countries-list  p-0 mb-2p list-typenone d-inline-block ">
                <li><?php echo get_countries($post->ID, 'cs'); ?></li>
            </ul>
        </div>
        <div class="info-row">
            <span class="text-17 mb-2p mt-2p font-weight-bold d-block">Currencies</span>
            <ul class="inline-list cards-list p-0 mb-2p list-typenone d-inline-block">
                <li><?php echo get_currencies($post->ID); ?></li>
            </ul>
        </div>
        <div class="info-row">
            <span class="text-17 mb-2p mt-2p font-weight-bold d-block">Restricted countries</span>
            <ul class="inline-list countries-list p-0 mb-2p list-typenone d-inline-block">
                <li><?php echo get_countries($post->ID, 'rest'); ?></li>
            </ul>
        </div>
    </div>
</div>
