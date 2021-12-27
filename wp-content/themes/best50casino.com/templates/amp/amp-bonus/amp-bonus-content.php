<?php include(locate_template('templates/amp/amp-menu.php', false, false)); ?>
<div class="container p-0 m-0">

    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-bonus/amp-bonus-intro.php', false, false)); ?>
        </div>
    </div>
    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-bonus/amp-bonus-ratings.php', false, false)); ?>
        </div>
    </div>

    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-bonus/amp-bonus-steps.php', false, false)); ?>
        </div>
    </div>

    <?php include(locate_template('templates/amp/amp-bonus/amp-sticky-top.php', false, false)); ?>

    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-bonus/amp-bonus-anchors.php', false, false)); ?>
        </div>
    </div>
    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_intro',true);
            if ($sectionHeadingState == ''){
                $sectionHeadingState = 'span';
            }
            $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_intro',true);
            if (!empty($sectionHeading)){
                ?>
            <a id="intro" class="position-relative text-decoration-none" style="top: -70px;"></a>
            <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mb-5p w-100 d-block mt-0 pt-5p pb-5p pr-7p pl-7p  font-weight-bold text-whitte text-left"><?=$sectionHeading?></<?=$sectionHeadingState?>>
          <?php
            }
            ?>
        <div class="flex-wrap d-flex shadow-box p-5p" id="">
            <div class="w-100 text-justify">
                <?php
                $theContent = get_post_meta($post->ID, "bonus_custom_meta_intro", true);
                $theContent = ampizeImages($theContent);
                echo apply_filters('the_content', $theContent); ?>
            </div>
        </div>
    </div>
</div>
<div class="row m-0p">
    <div class="col-12 p-5p">
        <?php include(locate_template('templates/amp/amp-bonus/amp-bonus-pros-cons.php', false, false)); ?>
    </div>
</div>

<div class="row m-0p">
    <div class="col-12 p-5p">
        <?php include(locate_template('templates/amp/amp-bonus/amp-promo-code.php', false, false)); ?>
    </div>
</div>
<div class="row m-0p">
    <div class="col-12 p-5p">
        <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_hidden',true);
        if ($sectionHeadingState == ''){
            $sectionHeadingState = 'span';
        }
        $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_hidden',true);
        if (!empty($sectionHeading)){
        ?>
        <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mb-5p w-100 d-block mt-0 pt-5p pb-5p pr-7p pl-7p  font-weight-bold text-whitte text-left"><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
    }
    ?>
    <div class="flex-wrap d-flex shadow-box">
            <div class="w-100 text-justify">
                    <?php
                    $theContent = get_post_meta($post->ID, "bonus_custom_meta_hidden_terms", true);
                    $theContent = ampizeImages($theContent);
                    $result = apply_filters('the_content',$theContent);
                    $healthy = array("<ul>");
                    $yummy   = array("<ul class='p-0 m-0'>");
                    echo  str_replace($healthy, $yummy, $result);
                    ?>
            </div>
    </div>
</div>
</div>

<div class="row m-0p">
    <div class="col-12 p-5p">
        <span class="widget2-new-heading mb-5p w-100 d-block mt-0 pt-5p pb-5p pr-7p pl-7p  font-weight-bold text-whitte text-left">Compare <?=get_the_title($bookieid);?> against other casinos</span>
        <?php include(locate_template('templates/amp/amp-common/amp-casino-comparison.php', false, false)); ?>
    </div>
</div>

<div class="row m-0p">
    <div class="col-12 p-5p">
        <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_dep',true);
        if ($sectionHeadingState == ''){
            $sectionHeadingState = 'span';
        }
        $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_dep',true);
        if (!empty($sectionHeading)){
        ?>
        <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mb-5p w-100 d-block mt-0 pt-5p pb-5p pr-7p pl-7p font-weight-bold text-whitte text-left"><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
    }
    ?>
    <div class="flex-wrap d-flex shadow-box p-5p">
            <div class="w-100 text-justify">
                    <?php
                    $theContent = get_post_meta($post->ID, "bonus_custom_meta_no_depo", true);
                    $theContent = ampizeImages($theContent);
                    echo apply_filters('the_content', $theContent); ?>
            </div>
    </div>

    <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_spins',true);
    if ($sectionHeadingState == ''){
        $sectionHeadingState = 'span';
    }
    $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_spins',true);
    if (!empty($sectionHeading)){
    ?>
    <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mb-5p w-100 d-block mt-0 pt-5p pb-5p pr-7p pl-7p font-weight-bold text-whitte text-left" id=""><?=$sectionHeading?></<?=$sectionHeadingState?>>

<div class="flex-wrap d-flex shadow-box p-5p">
    <div class="w-100 d-flex">
                <span class="float-left text-left">
                     <amp-img
                             class="img-fluid float-right m-7p"
                             alt="spins"
                             src="/wp-content/themes/best50casino.com/assets/images/spins-7.png"
                             width="100"
                             height="100">
                </amp-img>
                     <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_free_spins_text",true)); ?>
                </span>
    </div>
</div>
<?php
}
?>
</div>
</div>
<div class="row m-0p">
    <div class="col-12 p-5p">
        <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_wag',true);
        if ($sectionHeadingState == ''){
            $sectionHeadingState = 'span';
        }
        $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_wag',true);
        if (!empty($sectionHeading)){
        ?>
        <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mb-5p w-100 d-block mt-0 pt-5p pb-5p pr-7p pl-7p  font-weight-bold text-whitte text-left"><?=$sectionHeading?></<?=$sectionHeadingState?>>
        <?php
        }
    ?>
    <div class="flex-wrap d-flex shadow-box">
            <span class="w-100 text-justify">
                      <?php
                      $theContent = get_post_meta($post->ID, "bonus_custom_meta_how_to_co", true);
                      $theContent = ampizeImages($theContent);
                      $result = apply_filters('the_content', $theContent);
                      $healthy = array("<ul>");
                      $yummy   = array("<ul class='p-0 m-0'>");
                      echo   str_replace($healthy, $yummy, $result);
                      ?>
            </span>
    </div>

    <?php include(locate_template('templates/amp/amp-bonus/amp-bonus-promotions-table.php', false, false)); ?>

</div>
</div>

<div class="row m-0p">
    <div class="col-12 p-5p">
        <?php include(locate_template('templates/amp/amp-bonus/amp-bonus-cashback-table.php', false, false)); ?>
    </div>
</div>


<div class="row m-0p">
    <div class="col-12 p-5p">
        <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_loy',true) ;
        if ($sectionHeadingState == ''){
            $sectionHeadingState = 'span';
        }
        $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_loy',true);
        if (!empty($sectionHeading)){
        ?>
        <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mb-5p w-100 d-block mt-0 pt-5p pb-5p pr-7p pl-7p  font-weight-bold text-whitte text-left"><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
    }
    ?>
    <div class="flex-wrap d-flex shadow-box">
            <div class="w-100 p-5p text-justify">
                  <?php
                  $theContent = get_post_meta($post->ID, "bonus_custom_meta_loyalt_bonus", true);
                  $theContent = ampizeImages($theContent);
                  echo apply_filters('the_content', $theContent); ?>
            </div>
    </div>
</div>
</div>

<div class="row m-0p">
    <div class="col-12 p-5p">
        <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_bonus',true);
        if ($sectionHeadingState == ''){
            $sectionHeadingState = 'span';
        }
        $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_bonus',true);
        if (!empty($sectionHeading)){
        ?>
        <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mb-5p w-100 d-block mt-0 pt-5p pb-5p pr-7p pl-7p  font-weight-bold text-whitte text-left"><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
    }
    ?>
    <div class="flex-wrap d-flex shadow-box dail-bonus">
            <span class="w-100 p-5p text-justify">
                   <?php

                   $theContent = get_post_meta($post->ID, "bonus_custom_meta_live_bonus", true);
                   $theContent = ampizeImages($theContent);
                   $result = apply_filters('the_content',$theContent);
                   $healthy = array("<li>","<ul>" );
                   $yummy   = array("<li class='w-100 p-10p font-weight-bold' style='box-shadow: 0 1px 4px #828586;'>", "<ul class='p-0 m-0 w-100 list-typenone'>");
                   echo str_replace($healthy, $yummy, $result);
                   ?>
            </span>
    </div>
</div>
</div>


<div class="widget2 mt-10p mb-10p">
    <span class="widget2-heading text-whitte p-7p font-weight-bold text-18 mb-2p w-100 d-block mt-0 bg-dark text-left">General Info</span>
    <div class="d-flex flex-wrap  w-100 ">
        <div class="w-100 bg-gray-light box-sidebar">
            <div class="w-90 m-auto">
                <span class="mb-2p mt-5p text-primary text-13 font-weight-bold d-block" style="border-bottom: 1px solid #777777f5;">Licensed in</span>
                <p>
                <?php

                foreach (get_post_meta($bookieid, 'casino_custom_meta_license_country') as $option) {
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
                <span class="mb-2p mt-5p text-primary d-block text-13 font-weight-bold" style="border-bottom: 1px solid #777777f5;">Founded</span>
                <p><?php echo get_post_meta($bookieid, 'casino_custom_meta_com_estab', true); ?></p>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap w-100 ">
        <div class="w-100 bg-gray box-sidebar">
            <div class="w-90 m-auto">
                <span class="mb-2p mt-5p text-primary d-block text-13 font-weight-bold" style="border-bottom: 1px solid #777777f5;">Website</span>
                <p class="text-dark"><a class="text-dark text-decoration-none" rel="nofollow"
                                        href="<?php echo get_post_meta($bookieid, 'casino_custom_meta_affiliate_link_review', true); ?>"><?php echo str_replace("https://", "", get_post_meta($bookieid, 'casino_custom_meta_com_url', true)); ?></a>
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
                <span class="mb-2p mt-5p text-primary d-block text-13 font-weight-bold" style="border-bottom: 1px solid #777777f5;">Customer Service Hours</span>
                <p class="text-dark"><?php echo get_post_meta($bookieid, 'casino_custom_meta_comun_hours', true); ?></p>
            </div>
        </div>
    </div>
    <div class="d-flex flex-wrap w-100 ">
        <div class="w-100 bg-gray-light box-sidebar">
            <div class="w-90 m-auto ">
                <span class="mb-2p mt-5p text-primary d-block text-13 font-weight-bold" style="border-bottom: 1px solid #777777f5;">Email</span>
                <p class="text-dark">
                    <a class="text-dark text-decoration-none" href="mailto:<?php echo get_post_meta($bookieid, 'casino_custom_meta_emailoption_det', true); ?>"><?php echo get_post_meta($bookieid, 'casino_custom_meta_emailoption_det', true); ?></a>
                <p>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap mb-2p w-100 ">
        <div class="w-100 bg-gray-light box-sidebar">
            <div class="w-90 m-auto">
                <span class="mb-2p mt-5p text-primary text-13 font-weight-bold" style="border-bottom: 1px solid #777777f5;">Live Chat</span>
                <p class="text-dark"><?php if (get_post_meta($bookieid, 'casino_custom_meta_live_chat_option', true)) {
                        echo 'Yes';
                    } else {
                        echo 'No';
                    }; ?></p>
            </div>
        </div>
    </div>
    <?php if (get_post_meta($bookieid, 'casino_custom_meta_phoneoption_det', true)) { ?>
        <div class="d-flex flex-wrap w-100 ">
            <div class="w-100 bg-gray  box-sidebar">
                <div class="w-90 m-auto">
                    <span class="mb-2p text-primary d-block text-13 font-weight-bold" style="border-bottom: 1px solid #777777f5;">Phone Number</span>
                    <p class="text-dark"><?php echo get_post_meta($bookieid, 'casino_custom_meta_phoneoption_det', true); ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php $platforms = get_post_meta($bookieid, 'casino_custom_meta_platforms', true); ?>
    <?php if ($platforms) { ?>
        <div class="d-flex flex-wrap mb-2p w-100 ">
            <div class="w-100 bg-gray  box-sidebar">
                <div class="w-90 m-auto ">
                    <span class="mb-2p mt-5p d-block text-primary font-weight-bold" style="border-bottom: 1px solid #777777f5;">Platforms</span>
                    <?php $platformsArray = array('apple' => 'iPhone App', 'android' => 'Android App', 'windows' => 'Windows Phone App', 'download' => 'Casino Download',); ?>
                    <?php foreach ($platforms as $platform) {
                        echo '<b class="mr-15p text-20 mb-0"><i class="fa fa-' . $platform . ' " aria-hidden="true"  data-toggle="tooltip" title="' . $platformsArray[$platform] . '"></i></b>';
                    } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="widget2 w-100">
    <span class="widget2-heading text-whitte p-7p font-weight-bold text-15 mb-2p w-100 d-block mt-0 bg-dark text-left">Additional Information</span>
    <div class="widget2-body p-10p">
        <div class="info-row">
            <span class="text-17 mb-2p mt-2p d-block font-weight-bold">Website Languages</span>
            <ul class="inline-list countries-list p-0 mb-2p list-typenone d-inline-block">
                <li><?php echo get_flags_amp($bookieid, 'site'); ?></li>
            </ul>
        </div>
        <div class="info-row">
            <span class="text-17 mb-2p mt-2p d-block font-weight-bold">Support Languages</span>
            <ul class="inline-list countries-list  p-0 mb-2p list-typenone d-inline-block ">
                <li><?php echo get_countries($bookieid, 'cs'); ?></li>
            </ul>
        </div>
        <div class="info-row">
            <span class="text-17 mb-2p mt-2p d-block font-weight-bold">Currencies</span>
            <ul class="inline-list cards-list p-0 mb-2p list-typenone d-inline-block">
                <li><?php echo get_currencies($bookieid); ?></li>
            </ul>
        </div>
        <div class="info-row">
            <span class="text-17 mb-2p mt-2p d-block font-weight-bold">Restricted countries</span>
            <ul class="inline-list countries-list p-0 mb-2p list-typenone d-inline-block">
                <li><?php echo get_countries($bookieid, 'rest'); ?></li>
            </ul>
        </div>
    </div>

    <div class="widget2">
        <span class="widget2-heading text-whitte p-5p font-weight-bold text-18 mb-2p w-100 d-block mt-0 bg-dark text-left"><?= get_the_title($bookieid);?> Mobile Casino / Mobile Apps</span>
        <?php
        $meta = get_post_meta($bookieid, 'casino_custom_meta_mbapp_ticks', true);
        $ticksmobile = explode(",", $meta);

        if (get_post_meta($bookieid, 'casino_custom_meta_mbapp_bg', true)){
            $bgimage = get_post_meta($bookieid, 'casino_custom_meta_mbapp_bg', true);
        }else{
            $bgimage = "/wp-content/themes/best50casino.com/assets/images/default_mb.png";
        } ?>
        <div class="d-flex flex-wrap" style="height:280px; background-size:cover; background-image: url('<?=$bgimage;?>'); background-repeat: no-repeat;">
            <div class="align-self-center w-70 pl-20p position-relative">
                <amp-img height="60" width="140"  src="<?=get_post_meta($bookieid, 'casino_custom_meta_trans_logo', true);?>" class="img-fluid pb-5p" alt="<?= get_the_title($bookieid) ?>"></amp-img>
                <ul class="billboard-list bill-mobil list-typenone p-5p">
                    <?php foreach ($ticksmobile as $value) {
                        ?>
                        <li class="font-weight-bold mb-10p text-13 text-whitte"><?=$value?></li>
                        <?php
                    }?>
                </ul>
            </div>
        </div>
        <amp-list  height="65" layout="fixed-height"  src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $bookieid; ?>" binding="no">
            <template type="amp-mustache">
                <div class="p-10p bg-dark">
                    <a class="btn bumper btn btn bg-blue text-13 w-70 d-block mx-auto p-7p btn_large text-decoration-none text-whitte rounded text-center font-weight-bold bumper" style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"  data-casinoid="<?php echo $bookieid; ?>" data-country="{{0.ISO}}"  href="{{0.aff_bo}}" rel="nofollow" target="_blank">
                        <span>  <?php  echo "Visit ".get_the_title($bookieid)." Mobile".'<i class="fa fa-angle-right mt-4p pl-2p"></i>' ;?></span>
                    </a>
                </div>
            </template>
        </amp-list>
    </div>

    <?php include(locate_template('templates/amp/amp-bonus/amp-deposit-payments.php', false, false));?>

    <div class="widget2">
        <?php include(locate_template('templates/amp/amp-common/amp-player-reviews.php', false, false));?>
    </div>

    <div class="widget2">
        <?php include(locate_template('templates/amp/amp-common/content-faqs-amp.php', false, false));?>
    </div>

    <?php include(locate_template('templates/amp/amp-common/amp-best-casinos.php', false, false));?>
</div>


