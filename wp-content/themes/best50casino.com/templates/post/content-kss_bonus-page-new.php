<?php get_header(); ?>
<?php
$bookieid = get_post_meta($post->ID, 'bonus_custom_meta_bookie_offer', true);
$countryISO = $GLOBALS['countryISO'];
$localIso =  $GLOBALS['visitorsISO']; //
$bonusISO = get_bonus_iso($post->ID);
$bonusName = get_post_meta($post->ID, 'bonus_custom_meta_bonus_offer', true);
$geoBonusArgs = is_country_enabled($bonusName,$bookieid,'bc_bonus');
$bookiename = get_the_title($bookieid);
//Αν η χωρα ειναι ενεργοποιημενη    $countryISO = $GLOBALS['countryISO'];
 $offerList = explode( "|", get_post_meta($post->ID, 'bonus_custom_meta_wb_text', true));
 $image_id = get_post_meta($bookieid, 'casino_custom_meta_comp_screen_1', true);
 $image = wp_get_attachment_image_src($bookieid, 'thumb-230', true);
 $logo = get_post_meta($bookieid, 'casino_custom_meta_trans_logo', true);
$imge_id = getImageId(get_post_meta($bookieid, 'casino_custom_meta_sidebar_icon', true));

$ctaLink = $geoBonusArgs['aff_bo'];
$ctaFunction = $geoBonusArgs['ctaFunction'] ;

$countriesEnabledArray = \WordPressSettings::getCountryEnabledSettings();
$thisISO = WordPressSettings::isCountryActive($countryISO);
$premiumCasinosstring = WordPressSettings::getPremiumCasino($countryISO,'premium');

$casino_pros = explode(',', get_post_meta($bookieid, 'casino_custom_meta_pros', true));
$casino_cons = explode(',', get_post_meta($bookieid, 'casino_custom_meta_why_not_play', true));

$premiumCasinosArray =  explode(",",$premiumCasinosstring);
$isCasinoPremium = in_array($bookieid, $premiumCasinosArray);
//$premiumCasinosArray =  array_values( $premiumCasinosArray);
$numberCasinos = count($premiumCasinosArray);
if ($numberCasinos>4){
    $premiumCasinosArray = array_slice($premiumCasinosArray, 0, 4);
    $colNumber = 3;
}else{
    $colNumber = 12/$numberCasinos;
}
?>
<?php //echo get_post_meta($bonusName, 'bs_custom_meta_parent_casino', true); ?>
    <div class="offers-row w-100 d-flex flex-wrap">
        <?php get_template_part('templates/geo-parts/offer-billboard-new'); ?>
<!--// end of billboard-->
        <div class="w-70 w-sm-100 p-5p main-bonus">
            <?php
            $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_intro',true) ;
            if ($sectionHeadingState == ''){
                $sectionHeadingState = 'span';
            }
            $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_intro',true);
            if (!empty($sectionHeading)){
            ?>
            <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mt-0p text-left mb-0" ><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
    }
    ?>
            <div class="flex-wrap d-flex shadow-box p-5p" id="intro">
            <span class="w-100 text-justify">
            <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_intro",true)); ?>
            </span>
            </div>
        </div>
        <div class="w-30 w-sm-100 p-5p">
            <div class="widget2 mt-0 mb-0">
                <div class="d-flex flex-wrap bg-dark ">
                    <span class="w-75 text-left font-weight-bold text-white p-10p">Pros</span>
                    <span class="w-25 d-flex" style="background-color:#1f8e23;clip-path: polygon(39% 0, 100% 0, 100% 100%, 0% 100%);">
              <i class="fas fa-plus m-auto text-dark pl-15p text-center"></i>
            </span>
                </div>
                <div class="widget2-body p-10p">
                    <ul class="billboard-list list-typenone text-dark w-80 mx-auto p-0 position-relative mt-5p mb-5p">
                        <?php foreach ($casino_pros as $pros) { ?>
                            <li style="border-bottom: 1px solid #7d7b7b8c;" class="font-weight-bold"><?php echo $pros; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="widget2 mt-0 mb-0">
                <div class="d-flex flex-wrap bg-dark ">
                    <span class="w-75 font-weight-bold text-left text-white p-10p">Cons</span>
                    <span class="w-25 d-flex" style="background-color:#b50255;clip-path: polygon(39% 0, 100% 0, 100% 100%, 0% 100%);">
              <i class="fas fa-minus m-auto text-white pl-15p text-center"></i>
            </span>
                </div>
                <div class="widget2-body p-10p">
                    <ul class="cons-list list-typenone text-dark w-80 mx-auto p-0 position-relative mt-5p mb-5p">
                        <?php foreach ($casino_cons as $pros) { ?>
                            <li style="border-bottom: 1px solid #7d7b7b8c;" class="font-weight-bold"><?php echo $pros; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="p-10p w-100 bg-dark">
                <a class="btn bg-yellow text-17 w-70 d-block mx-auto p-7p btn_large text-dark roundbutton text-decoration-none font-weight-bold bumper" style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                    <span><?php if($GLOBALS['countryISO'] == 'gb'){
                        echo "Visit";
                    }else{
                        echo "Visit";
                    }?></span></a>
            </div>
        </div>

        <div class="w-70 w-sm-100 p-5p">
            <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_code',true);
            if ($sectionHeadingState == ''){
                $sectionHeadingState = 'span';
            }
            $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_code',true);
            if (!empty($sectionHeading)){
            ?>
            <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mt-20p text-left mb-0" ><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
}
?>
            <div class="flex-wrap d-flex shadow-box p-5p" style="min-height: 460px;" id="bonus-code">
             <span class="w-100 text-justify">
              <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_promo_code",true)); ?>
            </span>
                <div class="d-flex flex-wrap w-40 rounded">
                    <div class="w-33 bg-yellow text-dark text-center font-weight-bold p-10p d-block m-auto" style="border-top-left-radius:12px;border-right: 1px solid black;"><i class="fas fa-bolt d-inline-block text-17"></i> One Click</div>
                    <div class="w-33 bg-gray-light text-center p-10p font-weight-bold d-block m-auto" style="border-right: 1px solid black;"><i class="fas fa-mobile d-inline-block text-17"></i> By Phone</div>
                    <div class="w-33 bg-gray-light text-center font-weight-bold p-10p d-block m-auto" style="border-top-right-radius:12px;"><i class="fas fa-envelope d-inline-block text-17"></i> By Mail</div>
                    <div class="w-100 d-flex flex-column p-10p bg-dark">
                        <div class="bg-white w-80 d-block mx-auto p-7p" style="border-radius: 5px;">
                            <?php
                            $flagISO = $localIso != 'nl' ? $localIso : 'eu';
                            $ret = get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;'));
                            ?>
                            <span class="font-weight-bold"><?=$ret.' '.$GLOBALS['countryName']?><i class="fas fa-angle-down text-17 mt-5p float-right"></i></span>
                        </div>
                        <div class="bg-white w-80 mt-10p d-block mx-auto p-7p" style="border-radius: 5px;">
                            <?php $ret = get_post_meta($bonusName, $bonusISO."bs_custom_meta_bc_code", true);?>
                            <span class="font-weight-bold bg-primary text-white p-5p"><?=$ret;?><i class="fas fa-angle-down text-17 mt-5p float-right"></i></span>
                        </div>
                        <div class="bg-white w-80 mt-10p d-block mx-auto p-7p" style="border-radius: 5px;">
                            <?php
                           $curr = $GLOBALS['countryCurrency'];
                            ?>
                            <span class="font-weight-bold"> <?=$curr['symbol']?><?=$curr['code']?>(<?=$curr['name']?>) <i class="fas fa-angle-down text-17 mt-5p float-right"></i></span>
                        </div>

                        <a class="btn bg-yellow text-17 w-80 d-block p-10p mx-auto text-dark text-decoration-none mt-10p btn_large rounded font-weight-bold bumper"
                           rel="nofollow" target="_blank"><span>REGISTER</span>
                        </a>
                    </div>
                </div>
                <div class="d-flex flex-column w-60 steps-bonus">
                    <div class="d-flex flex-wrap"><div class="w-10 p-10p"><span class="stepper text-white font-weight-bold d-inline-block mr-5p text-center">1</span></div><div class="w-90 bg-gray-light d-block m-auto p-7p border font-weight-bold">Create your personal account by clicking on the registration button</div> </div>
                    <div class="d-flex flex-wrap"><div class="w-10 p-10p"><span class="stepper text-white font-weight-bold d-inline-block mr-5p text-center">2</span></div><div class="w-90 bg-gray-light d-block m-auto p-7p border font-weight-bold">Provide the casino with your personal details</div> </div>
                    <div class="d-flex flex-wrap"><div class="w-10 p-10p"><span class="stepper text-white font-weight-bold d-inline-block mr-5p text-center">3</span></div><div class="w-90 bg-gray-light d-block m-auto p-7p border font-weight-bold">Enter any of the casino's available promo codes,or Best50casino's exclusive code in the corresponding field</div> </div>
                    <div class="d-flex flex-wrap"><div class="w-10 p-10p"><span class="stepper text-white font-weight-bold d-inline-block mr-5p text-center">4</span></div><div class="w-90 bg-gray-light d-block m-auto p-7p border font-weight-bold">Complete the registration process and claim your bonus</div> </div>
                    <a class="btn bg-yellow text-17 w-40 d-block p-10p mx-auto mt-10p btn_large roundbutton text-decoration-none text-dark font-weight-bold bumper"
                       data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>"
                       rel="nofollow" target="_blank"><span>GET THIS BONUS <i class="fas fa-angle-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="w-30 w-sm-100 p-5p">

            <div class="widget2 mb-0p">
                <span class="widget2-heading bg-dark text-left">General Info</span>
                <div class="d-flex flex-wrap  w-100 ">
                    <div class="w-100 pt-5p pb-5p bg-gray-light box-sidebar">
                        <div class="w-90 m-auto">
                            <span class="mb-2p text-primary d-block  font-weight-bold"  style="border-bottom: 1px solid #525252;">Licensed in</span>
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
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap mb-2p w-100 ">
                    <div class="w-100 pt-5p pb-5p bg-gray-light box-sidebar">
                        <div class="w-90 m-auto">
                            <span class="mb-2p d-block  text-primary font-weight-bold" style="border-bottom: 1px solid #777777f5;">Founded</span>
                            <p class="mb-10p"><?php echo get_post_meta($bookieid, 'casino_custom_meta_com_estab', true); ?></p>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap w-100 ">
                    <div class="w-100 bg-gray pt-5p pb-5p box-sidebar">
                        <div class="w-90 m-auto">
                            <span class="mb-2p text-primary d-block font-weight-bold" style="border-bottom: 1px solid #777777f5;">Website</span>
                            <p class="text-dark mb-0p"><a class="text-dark text-decoration-none" rel="nofollow"
                                  href="<?php echo get_post_meta($bookieid, 'casino_custom_meta_affiliate_link_review', true); ?>"><?php echo str_replace("https://", "", get_post_meta($bookieid, 'casino_custom_meta_com_url', true)); ?></a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php if (get_post_meta($bookieid, 'casino_custom_meta_twitter_option') || get_post_meta($post->ID, 'casino_custom_meta_facebook_option') || get_post_meta($post->ID, 'casino_custom_meta_instagram_option')) { ?>
                    <div class="d-flex flex-wrap mb-2p w-100 ">
                        <div class="w-100 pt-10p pb-10p bg-gray box-sidebar">
                            <div class="w-90 m-auto">
                                <span class="mb-2p text-primary d-block font-weight-bold" style="border-bottom: 1px solid #777777f5;">Social Media</span>
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
                    <div class="w-100 bg-gray pt-5p pb-5p box-sidebar">
                        <div class="w-90 m-auto">
                            <span class="mb-2p text-primary d-block  font-weight-bold" style="border-bottom: 1px solid #777777f5;">Customer Service Hours</span>
                            <p class="text-dark mb-0p"><?php echo get_post_meta($bookieid, 'casino_custom_meta_comun_hours', true); ?></p>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap w-100 ">
                    <div class="w-100 bg-gray-light pt-5p pb-5p box-sidebar">
                        <div class="w-90 m-auto ">
                            <span class="mb-2p text-primary d-block font-weight-bold" style="border-bottom: 1px solid #777777f5;">Email</span>
                            <p class="text-dark mb-0p">
                                <a class="text-dark text-decoration-none" href="mailto:<?php echo get_post_meta($bookieid, 'casino_custom_meta_emailoption_det', true); ?>"><?php echo get_post_meta($bookieid, 'casino_custom_meta_emailoption_det', true); ?></a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap mb-2p w-100 ">
                    <div class="w-100 bg-gray-light pt-5p pb-5p box-sidebar">
                        <div class="w-90 m-auto">
                            <span class="mb-2p text-primary d-block  font-weight-bold" style="border-bottom: 1px solid #777777f5;">Live Chat</span>
                            <p class="text-dark mb-0p"><?php if (get_post_meta($bookieid, 'casino_custom_meta_live_chat_option', true)) {
                                    echo 'Yes';
                                } else {
                                    echo 'No';
                                }; ?></p>
                        </div>
                    </div>
                </div>
                <?php if (get_post_meta($bookieid, 'casino_custom_meta_phoneoption_det', true)) { ?>
                    <div class="d-flex flex-wrap w-100 ">
                        <div class="w-100 bg-gray pt-5p pb-5p box-sidebar">
                            <div class="w-90 m-auto">
                                <span class="mb-2p text-primary d-block  font-weight-bold" style="border-bottom: 1px solid #777777f5;">Phone Number</span>
                                <p class="text-dark mb-0p"><?php echo get_post_meta($bookieid, 'casino_custom_meta_phoneoption_det', true); ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php $platforms = get_post_meta($bookieid, 'casino_custom_meta_platforms', true); ?>
                <?php if ($platforms) { ?>
                    <div class="d-flex flex-wrap mb-2p w-100 ">
                        <div class="w-100 bg-gray pt-5p pb-5p box-sidebar">
                            <div class="w-90 m-auto ">
                                <span class="mb-2p text-primary d-block  font-weight-bold" style="border-bottom: 1px solid #777777f5;">Platforms</span>
                                <?php $platformsArray = array('apple' => 'iPhone App', 'android' => 'Android App', 'windows' => 'Windows Phone App', 'download' => 'Casino Download',); ?>
                                <?php foreach ($platforms as $platform) {
                                    echo '<b class="mr-15p text-20 mb-0"><i class="fa fa-' . $platform . ' " aria-hidden="true"  data-toggle="tooltip" title="' . $platformsArray[$platform] . '"></i></b>';
                                } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>


        </div>
        <div class="w-70 w-sm-100 p-5p main-bonus">
            <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_hidden',true);
            if ($sectionHeadingState == ''){
                $sectionHeadingState = 'span';
            }
            $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_hidden',true);
            if (!empty($sectionHeading)){
            ?>
            <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mt-20p text-left mb-0" ><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
}
?>
            <div class="flex-wrap d-flex shadow-box">
            <span class="w-100 text-justify">
              <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_hidden_terms",true)); ?>
            </span>
            </div>

            <?= compareCasino($bookieid);?>

            <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_dep',true);
if ($sectionHeadingState == ''){
    $sectionHeadingState = 'span';
}
            $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_dep',true);
if (!empty($sectionHeading)){
    ?>
    <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mt-20p text-left mb-0" ><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
}
?>
            <div class="flex-wrap d-flex shadow-box p-5p">
            <span class="w-100 text-justify">
              <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_no_depo",true)); ?>
            </span>
            </div>

            <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_spins',true);
            if ($sectionHeadingState == ''){
                $sectionHeadingState = 'span';
            }
            $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_spins',true);
if (!empty($sectionHeading)){
    ?>
    <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mt-20p text-left mb-0" ><?=$sectionHeading?></<?=$sectionHeadingState?>>

            <div class="flex-wrap d-flex shadow-box p-5p" id="">
                <div class="w-100 d-flex">
                <span class="float-left text-left">
                     <img class="img-fluid float-right d-block pl-7p pr-7p" loading="lazy" style="max-height: 100px;" src="/wp-content/themes/best50casino.com/assets/images/spins-7.png">
                     <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_free_spins_text",true)); ?>
                </span>
                </div>
            </div>
    <?php
}
?>
                <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_wag',true);
                if ($sectionHeadingState == ''){
                    $sectionHeadingState = 'span';
                    }
                $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_wag',true);
                if (!empty($sectionHeading)){
                    ?>
                    <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mt-20p text-left mb-0"><?=$sectionHeading?></<?=$sectionHeadingState?>>
                    <?php
                }
                ?>

            <div class="flex-wrap d-flex shadow-box">
            <span class="w-100 text-justify">
                     <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_how_to_co",true)); ?>
            </span>
            </div>

            <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_promo',true);
                if ($sectionHeadingState == ''){
                    $sectionHeadingState = 'span';
                }
            $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_promo',true);
                if (!empty($sectionHeading)){
                    ?>
                    <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mt-20p text-left mb-0" ><?=$sectionHeading?></<?=$sectionHeadingState?>>
                    <?php
                }

                $data = get_post_meta($post->ID, $bonusISO."_promotions", true);
                $datagloabl =get_post_meta($post->ID,"glb_promotions", true);
                $emptyvar ='';
                $datasent= '';
                if (empty($data) && $datagloabl != ''){
                    $datasent =get_post_meta($post->ID,"glb_promotions", true);
                }elseif (empty($data) && (empty($datagloabl))){
                    $emptyvar= 'empty';
                }elseif($data != ''){
                    $datasent = get_post_meta($post->ID, $bonusISO."_promotions", true);
                }
                if ($emptyvar != 'empty'){
                ?>
                <div class="table-responsive w-100" id="offers">
                <table class="table-sm w-100"  style="border: 1px solid #84838394;">
                    <thead>
                    <tr>
                    <th scope="col" class="inline-hor-logo widget2-new-heading text-dark font-weight-bold text-left numeric d-table-cell w-auto" style="padding-top:10px!important; padding-bottom:10px!important;  color: #354046; background: #c7ccce;">TYPE OF OFFER</th>
                    <th scope="col" class="inline-hor-logo widget2-new-heading text-dark font-weight-bold text-left numeric d-table-cell w-auto" style="padding-top:10px!important; padding-bottom:10px!important; color: #354046; background: #c7ccce;">INFO</th>
                    <th scope="col" class="inline-hor-logo widget2-new-heading text-dark font-weight-bold text-left numeric d-table-cell w-auto" style="padding-top:10px!important; padding-bottom:10px!important; color: #354046;  background: #c7ccce;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($datasent as $promo){
                    ?>
                    <tr class="font-weight-bold" style="box-shadow: 0 1px 2px #828586bf; color: #797979">
                    <td class="text-left"><?=$promo['type_of'];?></td>
                    <td class="text-left"><?=$promo['info'];?></td>
                    <td class="text-left w-25">
                        <a class="btn bg-yellow text-decoration-none text-dark text-17 w-100 d-block p-7p btn_large rounded mx-auto font-weight-bold bumper"
                           data-casinoid="<?php echo $post->ID; ?>"
                           data-country="<?php echo $countryISO; ?>"
                           href="<?=$promo['button_link']?$promo['button_link']:get_post_meta($bookieid,'casino_custom_meta_affiliate_link_bonus',true);?>"
                           rel="nofollow"
                           target="_blank"><span>
                            GET BONUS
                            </span></a></td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php }

                $datacash = get_post_meta($post->ID, $bonusISO."_vip", true);
                $datagloablca =get_post_meta($post->ID,"glb_vip", true);
                $emptyvarcash ='';
                $datasentcash= '';
                if (empty($datacash) && $datagloablca != ''){
                    $datasentcash =get_post_meta($post->ID,"glb_vip", true);
                }elseif (empty($datacash) && (empty($datagloablca))){
                    $emptyvarcash= 'empty';
                }elseif($datacash != ''){
                    $datasentcash = get_post_meta($post->ID, $bonusISO."_vip", true);
                }

                $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_cash',true);
                if ($sectionHeadingState == ''){
                    $sectionHeadingState = 'span';
                }
                $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_cash',true);
                if (!empty($sectionHeading)){?>
            <div class="shadow-box d-flex flex-wrap mt-20p w-100" style="border: 1px solid #8e8e8e94;">
             <<?php echo $sectionHeadingState; ?> class="p-5p text-left mt-3p font-weight-bold mb-5p" ><i class="fas fa-user"></i> <?=$sectionHeading?></<?=$sectionHeadingState?>>
            <span class="w-100 p-5p text-justify">
            <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_vip_cashback",true)); ?>
            </span>
                <?php  if ($emptyvarcash != 'empty'){?>
            <div class="table-responsive viptable w-100">
                <table class="table-sm w-100"  style="border-left: 1px solid #84838394;border-bottom: 1px solid #84838394;border-right: 1px solid #84838394;">
                    <thead>
                    <tr class="font-weight-bold">
                        <th scope="col" class="inline-hor-logo widget2-new-heading text-dark font-weight-bold text-center numeric d-table-cell w-auto" style="  background-color: #f7f7f7!important;padding-top:10px!important; padding-bottom:10px!important; padding-left: 10px !important;  color: #354046; background: #c7ccce;">Status</th>
                        <th scope="col" class="inline-hor-logo widget2-new-heading text-dark font-weight-bold text-center numeric d-table-cell w-auto" style="

                          background-color: #f7f7f7!important;padding-top:10px!important; padding-bottom:10px!important; color: #354046; background: #c7ccce;">Cashback</th>
                        <th scope="col" class="inline-hor-logo widget2-new-heading text-dark font-weight-bold text-center numeric d-table-cell w-auto" style="  background-color: #f7f7f7!important;padding-top:10px!important; padding-bottom:10px!important; color: #354046;  background: #c7ccce;">Maximum Bonus</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($datasentcash as $vip){
                    ?>
                        <tr class="font-weight-bold" style="box-shadow: 0 1px 2px #828586bf; color: #797979">
                        <td align="center" class="text-center w-33" style="padding: 12px;"><?=$vip['level']?></td>
                        <td class="text-center w-33"><?=$vip['experience']?></td>
                        <td class="text-center w-33"><?=$vip['cashback']?></td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
                <?php }?>
            </div>
                    <?php
                }
                ?>
        <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_loy',true);
            if ($sectionHeadingState == ''){
                $sectionHeadingState = 'span';
            }
        $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_loy',true);
if (!empty($sectionHeading)){
    ?>
    <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mt-20p text-left mb-0" ><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
}
?>
            <div class="flex-wrap d-flex shadow-box">
            <span class="w-100 p-5p text-justify">
            <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_loyalt_bonus",true)); ?>
            </span>
            </div>

        <?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_bonus',true);
                if ($sectionHeadingState == ''){
                    $sectionHeadingState = 'span';
                }
        $sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_bonus',true);
if (!empty($sectionHeading)){
    ?>
    <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mt-20p text-left mb-0" ><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
}
?>
            <div class="flex-wrap d-flex shadow-box dail-bonus">
            <span class="w-100 p-5p text-justify">
            <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_live_bonus",true)); ?>
            </span>
            </div>
            <?php  get_template_part('templates/common/content-faqs'); ?>
        </div>

        <div class="w-30 w-sm-100 p-5p">
            <div class="widget2 w-100">
                <span class="widget2-heading bg-dark text-left">Additional Information</span>
                <div class="widget2-body p-10p">
                    <div class="info-row">
                        <span class="text-15 d-block  font-weight-bold">Website Languages</span>
                        <ul class="inline-list countries-list p-0 mb-2p list-typenone d-inline-block">
                            <li><?php echo get_flags($bookieid, 'site'); ?></li>
                        </ul>
                    </div>
                    <div class="info-row">
                        <span class="text-15 d-block  font-weight-bold">Support Languages</span>
                        <ul class="inline-list countries-list  p-0 mb-2p list-typenone d-inline-block ">
                            <li><?php echo get_countries($bookieid, 'cs'); ?></li>
                        </ul>
                    </div>
                    <div class="info-row">
                        <span class="text-15 d-block  font-weight-bold">Currencies</span>
                        <ul class="inline-list cards-list p-0 mb-2p list-typenone d-inline-block">
                            <li><?php echo get_currencies($bookieid); ?></li>
                        </ul>
                    </div>
                    <div class="info-row">
                        <span class="text-15 d-block  font-weight-bold">Restricted countries</span>
                        <ul class="inline-list countries-list p-0 mb-2p list-typenone d-inline-block">
                            <li><?php echo get_countries($bookieid, 'rest'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="widget2">
                <span class="widget2-heading bg-dark text-left"><?= get_the_title($bookieid);?> Mobile Casino/ Mobile Apps</span>
                <?php
                $meta = get_post_meta($bookieid, 'casino_custom_meta_mbapp_ticks', true);
                $ticksmobile = explode(",", $meta);

                if (get_post_meta($bookieid, 'casino_custom_meta_mbapp_bg', true)){
                    $bgimage = get_post_meta($bookieid, 'casino_custom_meta_mbapp_bg', true);
                }else{
                    $bgimage = "/wp-content/themes/best50casino.com/assets/images/default_mb.png";
                } ?>
                <div class="d-flex flex-wrap" style="height:280px; background-size:cover; background-image: url('<?=$bgimage;?>'); background-repeat: no-repeat;">
                    <div class="align-self-center w-60 position-relative pl-20p">
                        <img src="<?=get_post_meta($bookieid, 'casino_custom_meta_trans_logo', true)?>" loading="lazy" class="img-fluid pb-5p" alt="<?= get_the_title($bookieid) ?>" style="min-width: 140px;max-width: 140px;">
                        <ul class="billboard-list bill-mobil list-typenone p-5p">
                            <?php foreach ($ticksmobile as $value) {
                                ?>
                                <li class="font-weight-bold mb-10p text-14 text-white"><?=$value?></li>
                                <?php
                            }?>
                        </ul>
                    </div>
                </div>
                <div class="p-10p bg-dark">
                    <a class="btn bg-blue text-15 w-70 d-block mx-auto p-7p btn_large text-white rounded text-decoration-none font-weight-bold bumper" style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"  data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                        <span><?php if($GLOBALS['countryISO'] == 'gb'){
                            echo "Visit ".get_the_title($bookieid)." Mobile".'<i class="fas fa-angle-right mt-4p pl-2p"></i>' ;
                        }else{
                            echo "Visit ".get_the_title($bookieid)." Mobile".'<i class="fas fa-angle-right mt-4p pl-2p"></i>' ;
                        }?></span></a>
                </div>
            </div>


            <div class="widget2 side-depo">
                <span class="widget2-heading bg-dark text-left"><?= get_the_title($bookieid);?> Casino Payments </span>
                <div class="bg-gray text-left text-20 p-10p"><span>Deposit Methods</span></div>
                <?php
                $i=0;
                $paymentOrder['ids'] = WordPressSettings::getPremiumPayments($countryISO);
                $order = explode(",", $paymentOrder['ids']);
                $availableMeans = get_post_meta($bookieid, 'casino_custom_meta_dep_options', true);
                $res = array_intersect($order, $availableMeans);
                $correctOrder = array_unique(array_merge($res, $availableMeans));
                $depArrayFirst = array_slice($correctOrder, 0, 6);
                $depArrayRest = array_slice($correctOrder, 6);
                foreach ($depArrayFirst as $rest){
                    $image_id = get_post_meta($rest, 'casino_custom_meta_sidebar_icon', true);
                    $classcolor='';
                    if ( $i & 1 ) {
                        $classcolor = 'bg-gray';
                    } else {
                        $classcolor = 'bg-gray-light';
                    }
                    ?>
                    <div class="side-depo p-10p d-flex flex-wrap <?=$classcolor?>">
                        <div class="d-flex flex-wrap w-60">
                            <div class="w-30">
                                <img class="img-fluid" style="width: 45px"  loading="lazy" src="<?= $image_id;?>">
                            </div>
                            <div class="w-70 m-auto">
                                <?= get_the_title($rest);?>
                            </div>
                        </div>
                        <div class="w-40 p-5p">
                            <a class="btn bg-yellow text-15 w-sm-100 text-dark d-block text-decoration-none p-5p btn_large rounded  bumper font-weight-bold"
                               data-casinoid="<?php echo $post->ID; ?>"
                               data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                                <span>Deposit <i class="fas fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                ?>
            </div>


            <div class="widget2">
                <?php
                $flagISO = $localIso != 'nl' ? $localIso : 'eu';
                $rete = get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;'));?>
                <span class="widget2-heading bg-dark text-left" id="bestCasinos"> Best Casinos <?= $rete;?></span>
                <?php
                $getss = WordPressSettings::getPremiumCasino($countryISO,$type = 'premium');
                $cas = explode(",", $getss);
                $i=0;
                foreach ($cas as $casinoID){
                    $bonuspage = get_post_meta($casinoID, 'casino_custom_meta_bonus_page', true);
                    $bonusName = get_post_meta($bonuspage, 'bonus_custom_meta_bonus_offer', true);
                    $bonusISO = get_bonus_iso($bonuspage);
                    $ctaLink = get_post_meta($casinoID, 'casino_custom_meta_affiliate_link_review', true);
                    $exclusiveMobileString = '<div class="ribbon best-casino 5"><span class="ribbonclass-exclusive"><i class="fa fa-star" aria-hidden="true" style="color:#fff;font-size:11px;"></i></span></div>';
                    $isBonusExclusiveMobile = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_exclusive", true) ? $exclusiveMobileString : '';
                    ?>
                    <div class="p-10p d-flex flex-wrap " style="border: 1px solid #bfbfbfe0; background: #f1f1f1;">
                        <div class="w-30 position-relative overflow-hidden">
                            <a class="" href="<?= get_the_permalink($casinoID);?>">
                                <img src="<?=get_the_post_thumbnail_url($casinoID);?>" class="img-fluid rounded" loading="lazy" alt="<?= get_the_title($casinoID) ?>" style="height: 60px">
                            <?=$isBonusExclusiveMobile;?>
                            </a>
                        </div>
                        <div class="w-50 position-relative d-flex flex-column text-center text-14 align-self-center">
                            <span class="font-weight-bold"><?=get_post_meta($bonusName, $bonusISO."bs_custom_meta_cta_for_top", true)?></span>
                            <span class="font-weight-bold"><?=get_post_meta($bonusName, $bonusISO."bs_custom_meta_cta_for_top_2", true)?></span>

                        </div>
                        <div class="w-20 align-self-center">
                            <a class="btn bg-yellow text-15 text-dark text-decoration-none w-sm-100 d-block p-5p btn_large rounded  bumper font-weight-bold"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                                <span>VISIT</span></a>
                        </div>
                    </div>
                    <?php
                    if(++$i > 5) break;
                }
                ?>
            </div>

            <div class="widget2">
                <?php include(locate_template('templates/common/players-reviews.php', false, false));?>
            </div>

        </div>

        <!-- .content -->
        <div class="clear"></div>
        <?php if($geoBonusArgs['restr'] != true){ ?>

            <div class="mobile-footer-banner-bookie position-sticky w-100 mb-2p overflow-hidden d-xl-none d-lg-none d-block" style="top: 0;bottom: 64px; z-index: 100;">
                <div class="mega-cta-stable  m-0 text-white d-flex flex-wrap">
                    <div class="col-3 col-sm-2 col-md-3 cta-img no-pad" style="color:#d7dcdf;font-size:12px;"><a <?php echo $ctaFunction; ?> href="<?php echo $ctaLink; ?>" rel="nofollow" target="_blank"> <?php echo wp_get_attachment_image($imge_id, "sidebar-60", "", array( "class" => "img-fluid mobile-image-cta", "alt" => get_the_title($post->ID))); ?></a>
                    </div>
                    <div class="col-9 text-center col-sm-8 col-md-6 cta-txt">
                        <div class="promo-details-amount">
                            <?php if ($geoBonusArgs['isExclusive']){echo '<div class="exclusive-inline d-md-block d-xl-block d-lg-block d-none"><i class="fa fa-star" aria-hidden="true"></i>
<span>Exclusive Bonus</span></div>';}?>
                            <?php echo get_flags( '', '', $GLOBALS['countryISO']).'  '.get_post_meta($bonusName, $bonusISO."bs_custom_meta_cta_for_top", true); ?>
                        </div>
                        <div class="promo-details-amount-sub"><i>
                                <?php echo $geoBonusArgs['bonusText']['FlagText']; ?>
                            </i></div>
                        <div class="promo-details-type">
                            <?php echo $geoBonusArgs['bonusText']['left-billboard']; ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-2 col-md-3 pl-0 pr-0 cta-btn"><a class="btn btn_yellow btn_large w-sm-100 d-block font-weight-bold bumper mb-5p" data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO?>" <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                            <span><?php if($GLOBALS['countryISO'] == 'gb' || $post->ID == '7021'){
                                echo "Play";
                            }else{
                                echo "Play Now";
                            }?></span></a></div>
                </div>
            </div>
        <?php } ?>
    </div>
    <script type="application/ld+json"> {"@context": "http://schema.org","@type": "Review","itemReviewed": {"@type": "CreativeWorkSeries","name": "<?=get_the_title()?>"},"reviewRating":{"@type":"AggregateRating","ratingValue":<?=round(get_post_meta($post->ID, 'bonus_custom_meta_rat_ovrl', true),1)?>,"ratingCount":1,"bestRating":10,"worstRating":1},"author": {"@type": "Organization","name": "Best50casino.com" }}</script>
<?php if($geoBonusArgs['restr'] == true){ ?>
    <?php include_once(locate_template('templates/geo-parts/premium_casinos_pop_up.php')); ?>
<?php } ?><?php
