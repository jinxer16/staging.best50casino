<?php

$casino_why_play = explode(',', get_post_meta($post->ID, 'casino_custom_meta_why_play', true));
$imge_id = getImageId(get_post_meta($post->ID, 'casino_custom_meta_sidebar_icon', true)); ?>

<?php $imge_id = get_image_id_by_link(get_post_meta($post->ID, 'casino_custom_meta_sidebar_icon', true)); ?>
<?php if (strpos(get_the_title($post->ID), 'Casino') !== false || strpos(get_the_title($post->ID), 'casino') !== false) {
    $titleTxt = ' Review';
} else {
    $titleTxt = ' Casino Review';
} ?>
<?php
//$casinoBonusPage = get_post_meta($post->ID, 'casino_custom_meta_bonus_page', true);
//$bonusName = get_post_meta($casinoBonusPage, 'casino_custom__bonus_offer', true);

$bonusISO = get_bonus_iso($post->ID);
$countryISO = $GLOBALS['countryISO'];

$localIso =  $GLOBALS['visitorsISO'];

$image_id = get_post_meta($post->ID, 'casino_custom_meta_comp_screen_1', true);
$logo_id = get_post_meta($post->ID, 'casino_custom_meta_trans_logo', true);
$logo_idmo = getImageId(get_post_meta($post->ID, 'casino_custom_meta_trans_logo', true));
$imge_id = getImageId(get_post_meta($post->ID, 'casino_custom_meta_sidebar_icon', true));
$geoBonusArgs = is_country_enabled($post->ID, 'kss_casino');

$casino_pros = explode(',', get_post_meta($post->ID, 'casino_custom_meta_pros', true));
$casino_cons = explode(',', get_post_meta($post->ID, 'casino_custom_meta_why_not_play', true));

 $ctaLink = $geoBonusArgs['aff_re2'];
 $ctaFunction = $geoBonusArgs['ctaFunction'];
 $offerList = explode( ",", get_post_meta($post->ID, 'casino_custom_meta_why_play', true));

 $countriesEnabledArray = \WordPressSettings::getCountryEnabledSettings();
 $thisISO = WordPressSettings::isCountryActive($countryISO);
 $premiumCasinosstring = WordPressSettings::getPremiumCasino($countryISO,'premium');

 $premiumCasinosArray =  explode(",",$premiumCasinosstring);
 $isCasinoPremium = in_array($post->ID, $premiumCasinosArray);
 //$premiumCasinosArray =  array_values( $premiumCasinosArray);
    $numberCasinos = count($premiumCasinosArray);
if ($numberCasinos>4){
    $premiumCasinosArray = array_slice($premiumCasinosArray, 0, 4);
    $colNumber = 3;
    }else{
    $colNumber = 12/$numberCasinos;
    }


$args = array(
    'post_type' => 'player_review',
    'posts_per_page' => 999,
    'post_status' => array('publish'),
    'numberposts' => 999,
    'no_found_rows' => true,
    'fields' =>'ids',
    'update_post_term_cache' => false,
    'orderby' => 'rand',
    'meta_query' => array(
        array(
            'key' => 'review_casino',
            'value' => $post->ID,
        )
    )
);
$getreview = get_posts($args);
$totalVotes = count($getreview);
$sumVotes=0;
foreach ($getreview as $review){
    $votes = get_post_meta($review,'review_rating',true);
    $sumVotes +=  (float)$votes;
}
wp_reset_postdata();
?>

<div class="main-box d-flex flex-wrap w-100">

    <?php get_template_part('templates/geo-parts/offer-billboard-new'); ?>

<div class="main-box d-flex flex-wrap w-100">

    <div class="w-70 w-sm-100 p-5p">
        <h2 id="aksiologisi" class="review-box-title widget2-heading bg-dark text-left text-white bg-primary p-5p text-15 mb-0"><?= get_post_meta($post->ID,"casino_custom_meta_h1",true); ?></h2>
        <!-- get_the_content(null, null, $post->ID) //-->
        <div class="review-box-body p-5p border w-100 shadow" style="min-height:90%;" id="intro"><?php echo apply_filters('the_content', get_the_content($post->ID)); ?>

        </div>
    </div>

    <div class="w-30 w-sm-100 p-5p sidebar-casino">
    <div class="widget2 mt-0 mb-0">
        <div class="d-flex flex-wrap bg-dark ">
            <span class="w-75 text-left text-white p-10p font-weight-bold">Pros</span>
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
            <span class="w-75 text-left text-white p-10p font-weight-bold">Cons</span>
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
            <a class="btn bg-yellow text-17 w-70 d-block mx-auto p-7p btn_large text-dark text-decoration-none roundbutton font-weight-bold bumper" style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                <span><?php if($GLOBALS['countryISO'] == 'gb'){
                    echo "Visit";
                }else{
                    echo "Visit";
                }?></span></a>
        </div>
    </div>

    <div class="w-70 w-sm-100 p-5p">

        <?php $screenshotHeading=get_post_meta($post->ID,'casino_custom_meta_h2_screenshot',true);?>
        <?php if($screenshotHeading){ ?>
            <h2 class="widget2-new-heading text-left"><?php echo $screenshotHeading;?></h2>
        <?php } ?>
        <div id="ScreenshotsCarousel" class="carousel mb-10p slide" data-ride="carousel">

<!--            <ol class="carousel-indicators">-->
<!--                <li data-target="#ScreenshotsCarousel" data-slide-to="0" class="active"></li>-->
<!--            </ol>-->
              <?php if (wp_is_mobile()){
                    $heightscreen = '250px';
                    $screenshot = get_post_meta($post->ID,"casino_custom_meta_comp_mobi_screen_1",true);
              }else{
                  $heightscreen = '400px';
                  $screenshot = get_post_meta($post->ID,"casino_custom_meta_comp_screen_1",true);
              }
              ?>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-block w-100" style="height:<?php echo $heightscreen?>; background-position: bottom; background-size:cover; background-image: url('<?php echo $screenshot;?>')"></div>
                </div>
            </div>
            <div class="w-20 w-sm-50 d-flex pt-20p pl-3p pb-15p flex-column position-absolute top-0">
                <img src="<?php echo get_post_meta($post->ID,"casino_custom_meta_trans_logo",true);?>" loading="lazy" class="img-fluid d-block mx-auto"  style="max-width: 140px; max-height: 140px;">
                <span class="font-weight-bold text-center text-white">Review <?php echo date("Y"); ?></span>
                <div class="company-rating bonus-stars d-flex justify-content-center mb-10p mt-10p mb-xl-0 mb-lg-0" style="font-size:17px;">
                    <?php

                    if ($totalVotes == 0 ){
                        $rating =0;
                    }else {
                        $rating = (($sumVotes/$totalVotes)/2);
                    }
                    $ratingWhole = floor($rating);
                    $ratingDecimal = $rating - $ratingWhole;
                    $j = 5;
                    $helper = 1;
                    $html = '<style>
                    .pretty-star { background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg); }
                    .icon-star { width: 100%;height: 100%; position: absolute; background-size: cover; background-repeat: no-repeat; background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg);}
                    .star-voting.star-game .star-wrap-review-bg { height: 16px;width: 16px;}
                    .star-wrap-review-bg { position: relative; width: 17px;height: 17px;float: left;border-right: 2px solid transparent;background-size: cover;background-repeat: no-repeat;background-image: url('.get_template_directory_uri().'/assets/images/star_empty.svg);}
                    .star-temp .icon-star {background-image: none;}      
                    </style>';
                    for($i=0;$i<$ratingWhole;$i++){
                        $j -=1 ;
                        $html .= '<div class="star-wrap-review-bg star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:100%"></div></div>';
                        $helper ++;
                    }
                    if($ratingDecimal != 0){
                        $j -=1 ;
                        $test = $ratingDecimal*100;
                        $html .= '<div class="star-wrap-review-bg star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:'.$test.'%"></div></div>';
                        $helper ++;
                    }
                    for($i=0;$i<$j;$i++){
                        $html .= '<div class="star-wrap-review-bg star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:0%"></div></div>';
                        $helper ++;
                    }
                    echo $html;
                    ?>

                </div>
                <?php if ($totalVotes == 0){
                    ?>
                    <span class="text-11 pl-5p mb-10p text-center pt-2p text-white">No Reviews</span>
                    <?php
                }else{
                    ?>
                    <span class="text-11 pl-5p mb-10p text-center pt-2p text-white"> <?= round($rating,1)*2?>/10 From <?=$totalVotes?> Reviews</span>
                    <?php
                }?>
                <a class="btn bg-yellow text-17 w-50 d-block mx-auto mt-20p p-7p btn_large text-dark text-decoration-none roundbutton font-weight-bold bumper"
                   style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?>
                   href="<?php echo $ctaLink?>" rel="nofollow" target="_blank"><span>Visit</span></a>
            </div>
        </div>

        <?php
        $sectionHeadingState = get_post_meta($post->ID,'casino_custom_meta_heading_state_intro',true) ;
        if ($sectionHeadingState == ''){
            $sectionHeadingState = 'span';
        }
        $sectionHeading = get_post_meta($post->ID,'casino_custom_meta_heading_intro',true);
        if (!empty($sectionHeading)){
        ?>
        <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mt-0p mt-sm-10p text-left mb-0" ><?=$sectionHeading?></<?=$sectionHeadingState?>>
        <?php
        }
            ?>
        <div class="flex-wrap d-flex shadow-box p-5p" id="welcome_bonus">
                <span class="w-100 text-justify">
                <?php echo apply_filters('the_content', get_post_meta($post->ID,"casino_custom_meta_intro",true)); ?>
                </span>
        </div>
        <?php $sectionHeadingState = get_post_meta($post->ID,'casino_custom_meta_heading_state_code',true);
            if ($sectionHeadingState == ''){
                $sectionHeadingState = 'span';
            }
            $sectionHeading = get_post_meta($post->ID,'casino_custom_meta_heading_code',true);
            if (!empty($sectionHeading)){
            ?>
            <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mt-20p text-left mb-0" ><?=$sectionHeading?></<?=$sectionHeadingState?>>
        <?php
        }
        ?>
        <div class="flex-wrap d-flex shadow-box p-5p" style="min-height: 460px;" id="bonus_code">
             <span class="w-100 text-justify">
              <?php echo apply_filters('the_content', get_post_meta($post->ID,"casino_custom_meta_promo_code",true)); ?>
            </span>
        <div class="d-flex flex-wrap w-40 w-sm-100 rounded">
            <div class="w-33 bg-yellow text-dark text-center font-weight-bold p-10p d-block m-auto" style="border-top-left-radius:12px;border-right: 1px solid black;"><i class="fas fa-bolt d-inline-block text-17"></i> One Click</div>
            <div class="w-33 bg-gray-light text-center p-10p font-weight-bold d-block m-auto" style="border-right: 1px solid black;"><i class="fas fa-mobile d-inline-block text-17"></i> By Phone</div>
            <div class="w-33 bg-gray-light text-center font-weight-bold p-10p d-block m-auto" style="border-top-right-radius:12px;"><i class="fas fa-envelope d-inline-block text-17"></i> By Mail</div>
            <div class="w-100 d-flex flex-column p-10p bg-dark">
                <div class="bg-white w-80 d-block mx-auto p-7p" style="border-radius: 5px;">
                    <?php
                    $flagISO = $localIso !== 'nl' ? $localIso : 'eu';
                    $ret = get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;'));
                    ?>
                    <span class="font-weight-bold"><?php echo $ret.' '.$GLOBALS['countryName']?><i class="fas fa-angle-down text-17 mt-5p float-right"></i></span>
                </div>
                <div class="bg-white w-80 mt-10p d-block mx-auto p-7p" style="border-radius: 5px;">
                    <?php $ret = get_post_meta($post->ID, $bonusISO."casino_custom_meta_bc_code", true);?>
                    <span class="font-weight-bold bg-primary text-white p-5p"><?php echo $ret;?><i class="fas fa-angle-down text-17 mt-5p float-right"></i></span>
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
        <div class="d-flex flex-column w-60 w-sm-100 steps-bonus">
            <div class="d-flex flex-wrap"><div class="w-10 p-10p"><span class="stepper text-white font-weight-bold d-inline-block mr-5p text-center">1</span></div><div class="w-90 w-sm-80 text-sm-13 bg-gray-light d-block m-auto p-7p border font-weight-bold">Create your personal account by clicking on the registration button</div> </div>
            <div class="d-flex flex-wrap"><div class="w-10 p-10p"><span class="stepper text-white font-weight-bold d-inline-block mr-5p text-center">2</span></div><div class="w-90 w-sm-80 text-sm-13 bg-gray-light d-block m-auto p-7p border font-weight-bold">Provide the casino with your personal details</div> </div>
            <div class="d-flex flex-wrap"><div class="w-10 p-10p"><span class="stepper text-white font-weight-bold d-inline-block mr-5p text-center">3</span></div><div class="w-90 w-sm-80 text-sm-13 bg-gray-light d-block m-auto p-7p border font-weight-bold">Enter any of the casino's available promo codes,or Best50casino's exclusive code in the corresponding field</div> </div>
            <div class="d-flex flex-wrap"><div class="w-10 p-10p"><span class="stepper text-white font-weight-bold d-inline-block mr-5p text-center">4</span></div><div class="w-90 w-sm-80 text-sm-13 bg-gray-light d-block m-auto p-7p border font-weight-bold">Complete the registration process and claim your bonus</div> </div>
            <a class="btn bg-yellow text-17 w-40 w-sm-80 d-block p-10p mx-auto mt-10p btn_large roundbutton text-decoration-none text-dark font-weight-bold bumper"
               data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>"
               rel="nofollow" target="_blank"><span>GET THIS BONUS <i class="fas fa-angle-right"></i></span>
            </a>
        </div>
    </div>
        <!-- Hidden Terms -->

            <?php $sectionHeadingState = get_post_meta($post->ID,'casino_custom_meta_heading_state_hidden',true);
            if ($sectionHeadingState == ''){
                $sectionHeadingState = 'span';
            }
            $sectionHeading = get_post_meta($post->ID,'casino_custom_meta_heading_hidden',true);
            if (!empty($sectionHeading)){
            ?>
            <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mt-20p text-left mb-0" ><?=$sectionHeading?></<?=$sectionHeadingState?>>
        <?php
        }
        ?>
        <div class="flex-wrap d-flex shadow-box">
                <span class="w-100 text-justify">
                  <?php echo apply_filters('the_content', get_post_meta($post->ID,"casino_custom_meta_hidden_terms",true)); ?>
                </span>
        </div>


            <!-- Promotion -->
            <?php $sectionHeadingState = get_post_meta($post->ID,'casino_custom_meta_heading_state_promo',true);
                if ($sectionHeadingState == ''){
                    $sectionHeadingState = 'span';
                }
            $sectionHeading = get_post_meta($post->ID,'casino_custom_meta_heading_promo',true);
                if (!empty($sectionHeading)){
                    ?>
                    <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mt-20p text-left mb-0" ><?=$sectionHeading?></<?=$sectionHeadingState?>>
                    <?php
                }

                $data = get_post_meta($post->ID, $bonusISO."_promotions", true);
                $datagloabl =get_post_meta($post->ID,"glb_promotions", true);
                $emptyvar ='';
                $datasent= '';
                if (empty($data) && $datagloabl !== ''){
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
                           href="<?=$promo['button_link']?$promo['button_link']:get_post_meta($post->ID,'casino_custom_meta_affiliate_link_bonus',true);?>"
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
                ?>
<?php $sectionHeadingState = get_post_meta($post->ID,'casino_custom_meta_heading_state_lic',true);
        if ($sectionHeadingState == ''){
            $sectionHeadingState = 'span';
        }
        $sectionHeading = get_post_meta($post->ID,'casino_custom_meta_heading_lic',true);
        if (!empty($sectionHeading)){
        ?>
        <<?php echo $sectionHeadingState; ?> class="widget2-new-heading text-left" id="<?=$anchorsids[1]?>"><?=$sectionHeading?></<?=$sectionHeadingState?>>
        <?php
        }
        ?>
        <div class="flex-wrap d-flex shadow-box p-5p">
            <div class="w-100 text-justify d-flex">
                <span class="float-left text-left">
                     <img class="img-fluid float-right" style="max-height: 160px;" src="/wp-content/themes/best50casino.com/assets/images/secure-2.png" loading="lazy">
                     <?php echo apply_filters('the_content', get_post_meta($post->ID,"casino_custom_meta_banking",true)); ?>
                </span>
            </div>
        </div>

        <div class="section-withdrawls mt-10p mb-10p" id="<?=$anchorsids[2]?>">
            <?php $sectionHeadingState = get_post_meta($post->ID,'casino_custom_meta_heading_state_pay',true);
            if ($sectionHeadingState == ''){
                $sectionHeadingState = 'span';
            }
            $sectionHeading = get_post_meta($post->ID,'casino_custom_meta_heading_pay',true);
            if (!empty($sectionHeading)){
            ?>
            <<?php echo $sectionHeadingState; ?> class="widget2-new-heading text-left" id="<?=$anchorsids[2]?>"><?=$sectionHeading?></<?=$sectionHeadingState?>>
            <?php
            }
            ?>

    <ul class="nav nav-tabs pl-0 mb-0" id="myTab" role="tablist">
        <li class="nav-item w-25 w-sm-50 text-center pl-0 list-none">
            <a class="nav-link active font-weight-bold text-decoration-none p-sm-5p text-sm-1 p-15p" id="depo-tab" data-toggle="tab" href="#depotab" role="tab" aria-controls="depotab" aria-selected="true">Deposit Methods</a>
        </li>
        <li class="nav-item w-25 w-sm-50 text-center pl-5p list-none">
            <a class="nav-link font-weight-bold text-decoration-none p-sm-5p text-sm-13 p-15p" id="with-tab" data-toggle="tab" href="#withtab" role="tab" aria-controls="withtab" aria-selected="false">Withdrawal Options</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="depotab" role="tabpanel" aria-labelledby="depotab">
            <div class="d-flex flex-wrap w-100">
                <div class=" w-20 w-sm-25 p-7p headtables p-sm-5p text-sm-13 text-center font-weight-bold text-14" style="color: #354046;background: #c7ccce;">Deposit Methods</div>
                <div class=" w-20 w-sm-25  p-7p headtables p-sm-5p text-sm-13 text-center font-weight-bold text-14" style="color: #354046;background: #c7ccce;">Deposit Minimum</div>
                <div class=" w-20 w-sm-25  p-7p headtables p-sm-5p text-sm-13 text-center font-weight-bold text-14" style="color: #354046;background: #c7ccce;">Deposit Maximum</div>
                <div class=" w-20 w-sm-25  p-7p headtables p-sm-5p text-sm-13 text-center font-weight-bold text-14" style="color: #354046;background: #c7ccce;">Deposit Time</div>
                <?php
                if (!wp_is_mobile()){
                    ?>
                    <div class=" w-20 p-7p text-center font-weight-bold text-14" style="color: #354046;background: #c7ccce;"></div>
                <?php
                }
                ?>

            </div>
            <div class="d-flex flex-wrap w-100">
                <?php
                $paymentOrder['ids'] = WordPressSettings::getPremiumPayments($countryISO);
                $order = explode(",", (string)$paymentOrder['ids']);
                $availableMeans = get_post_meta($post->ID, 'casino_custom_meta_dep_options', true);
                $availableMeansstrict = get_post_meta($post->ID, 'casino_custom_meta_dep_options_strict', true);

                if($countryISO == 'de' && !empty($availableMeansstrict)){
                    $tags = array_diff($availableMeans, $availableMeansstrict);
                    $res = array_intersect($order, $tags);
                    $correctOrder = array_unique(array_merge($res, $tags));
                }else{
                    $res = array_intersect($order, $availableMeans);
                    $correctOrder = array_unique(array_merge($res, $availableMeans));
                }

                $depArrayFirst = array_slice($correctOrder, 0, 6);
                $depArrayRest = array_slice($correctOrder, 6);

                foreach ($depArrayFirst as $rest){
                    $image_id = get_post_meta($rest, 'casino_custom_meta_sidebar_icon', true);
                    $lices = get_post_meta($rest, 'casino_custom_meta_strict_lice_dep'.get_the_title($rest).'', true);
                    ?>
                    <div class="d-flex flex-wrap w-100 p-7p deporows">
                        <div class="w-20 w-sm-25  text-left align-self-center">
                            <div class="d-flex flex-wrap">
                                <div class="w-40">
                                    <img class="img-fluid float-right" style="width: 44px"  loading="lazy" src="<?= $image_id;?>">
                                </div>
                                <div class="w-60 m-auto text-left pl-5p">
                                    <?= get_the_title($rest) .$lices;?>
                                </div>
                            </div>
                        </div>
                        <div class="w-20 w-sm-25  align-self-center text-center align-middle">
                            <?= get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_min_dep',true);?>
                        </div>
                        <div class="w-20 w-sm-25  align-self-center text-center align-middle">
                            <?= get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_max_dep',true);?>
                        </div>
                        <div class="w-20 w-sm-25  align-self-center text-center align-middle">
                            <?= get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_dep_time',true)? get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_dep_time',true):'instant' ;?>
                        </div>
                        <?php
                        if (!wp_is_mobile()){
                        ?>
                        <div class="text-center align-middle w-20 align-self-center">
                            <a class="btn bumper btn btn bg-yellow text-15 w-sm-100 d-block p-5p text-decoration-none btn_large rounded text-dark bumper font-weight-bold"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                               <span>Deposit <i class="fas fa-arrow-right"></i></span></a>
                        </div>
                        <?php
                        }
                        ?>

                    </div>
                    <?php
                }
                ?>
                <div class="hidden-payments-wrapper w-100" style="display: none;">
                    <?php
                    if(is_array($depArrayRest)){
                        foreach ($depArrayRest as $rest){
                            $image_id = get_post_meta($rest, 'casino_custom_meta_sidebar_icon', true);
                            ?>
                            <div class="d-flex flex-wrap hidden-payments deporows w-100 p-7p">
                                <div class="w-20 w-sm-25  text-left align-self-center">
                                    <div class="d-flex flex-wrap">
                                        <div class="w-40">
                                            <img class="img-fluid float-right" style="width: 44px"  loading="lazy" src="<?= $image_id;?>">
                                        </div>
                                        <div class="w-60 text-sm-13  align-self-center text-left pl-5p">
                                            <?= get_the_title($rest);?>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-20 w-sm-25  text-sm-13  align-self-center text-center align-middle">
                                    <?= get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_min_dep',true);?>
                                </div>
                                <div class="w-20 w-sm-25  text-sm-13  align-self-center text-center align-middle">
                                    <?= get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_max_dep',true);?>
                                </div>
                                <div class="w-20 w-sm-25  text-sm-13  align-self-center text-center align-middle">
                                    <?= get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_dep_time',true)? get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_dep_time',true):'instant' ;?>
                                </div>
                            <?php
                            if (!wp_is_mobile()){
                                ?>
                                <div class="text-center align-middle text-center w-20 align-self-center">
                                    <a class="btn bumper btn btn bg-yellow text-15 w-sm-100 d-block p-5p text-decoration-none btn_large rounded text-dark bumper font-weight-bold"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                                        <span>Deposit <i class="fas fa-arrow-right"></i></span></a>
                                </div>
                                <?php
                            }
                                ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="bg-gray-light p-10p">
                <?php if (is_array($depArrayRest)){

                    ?>
                    <a class="btn bumper btn btn bg-primary text-17 w-sm-100 d-block table-depo-btn text-decoration-none text-white w-50 mx-auto p-15p p-sm-5p text-sm-13 btn_large bumper font-weight-bold" style="border-radius: 0!important;" href="#hidden-payments" data-toggle="collapse" rel="nofollow" >
                        <i class="fas fa-sync-alt"></i>  View More Deposit Methods</i></a>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="tab-pane fade" id="withtab" role="tabpanel" aria-labelledby="withtab">
            <div class="d-flex flex-wrap w-100">
                <div class=" w-20 p-7p w-sm-25  headtables p-sm-5p text-sm-13 text-center font-weight-bold text-14" style="color: #354046;background: #c7ccce;">Withdrawal Methods</div>
                <div class=" w-20 p-7p w-sm-25  headtables p-sm-5p text-sm-13  text-center font-weight-bold text-14" style="color: #354046;background: #c7ccce;">Withdrawal Minimum</div>
                <div class=" w-20 p-7p  w-sm-25  headtables p-sm-5p text-sm-13 text-center font-weight-bold text-14" style="color: #354046;background: #c7ccce;">Withdrawal Maximum</div>
                <div class=" w-20 p-7p  w-sm-25  headtables p-sm-5p text-sm-13 3 text-center font-weight-bold text-14" style="color: #354046;background: #c7ccce;">Withdrawal Time</div>
                <?php
                if (!wp_is_mobile()){
                ?>
                <div class=" w-20 p-7p text-center font-weight-bold text-14" style="color: #354046;background: #c7ccce;"></div>
                <?php
                }
                ?>
            </div>
            <div class="d-flex flex-wrap w-100">
                <?php
                $paymentOrder['ids'] = WordPressSettings::getPremiumPayments($countryISO);
                $order = explode(",", $paymentOrder['ids']);
                $availableMeans = get_post_meta($post->ID, 'casino_custom_meta_withd_options', true);
                $availableMeansstrictwith = get_post_meta($post->ID, 'casino_custom_meta_with_options_strict', true);

                if($countryISO == 'de' && !empty($availableMeansstrictwith)){
                    $tags = array_diff($availableMeans, $availableMeansstrictwith);
                    $res = array_intersect($order, $tags);
                    $correctOrder = array_unique(array_merge($res, $tags));
                }else{
                    $res = array_intersect($order, $availableMeans);
                    $correctOrder = array_unique(array_merge($res, $availableMeans));
                }
                $depArrayFirst = array_slice($correctOrder, 0, 6);
                $depArrayRest = array_slice($correctOrder, 6);
                foreach ($depArrayFirst as $rest){
                    $image_id = get_post_meta($rest, 'casino_custom_meta_sidebar_icon', true);
                    ?>
                    <div class="d-flex flex-wrap w-100 p-7p withdrawrow">
                        <div class="w-20 w-sm-25  text-left align-self-center">
                            <div class="d-flex flex-wrap">
                                <div class="w-40">
                                    <img class="img-fluid float-right" style="width: 44px" loading="lazy" src="<?= $image_id;?>">
                                </div>
                                <div class="w-60 text-sm-13  m-auto text-left pl-5p">
                                    <?= get_the_title($rest);?>
                                </div>
                            </div>
                        </div>
                        <div class="w-20 w-sm-25  text-sm-13  align-self-center text-center align-middle">
                            <?= get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_min_wit',true);?>
                        </div>
                        <div class="w-20 w-sm-25  text-sm-13  align-self-center text-center align-middle">
                            <?= get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_max_wit',true);?>
                        </div>
                        <div class="w-20 w-sm-25  text-sm-13  align-self-center text-center align-middle">
                            <?= get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_wit_time',true)? get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_wit_time',true):'instant' ;?>
                        </div>
                        <?php
                        if (!wp_is_mobile()){
                        ?>
                        <div class="text-center align-middle w-20 align-self-center">
                            <a class="btn bumper btn btn bg-yellow text-15 w-sm-100 d-block p-5p text-decoration-none btn_large rounded text-dark bumper font-weight-bold"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                               <span> Withdrawal <i class="fas fa-arrow-right"></i></span></a>
                        </div>
                        <?php
                        }
                        ?>

                    </div>
                    <?php
                }
                ?>
                <div class="hidden-withdrawals-wrapper w-100" style="display: none">
                    <?php
                    if(is_array($depArrayRest)){
                        foreach ($depArrayRest as $rest){
                            $image_id = get_post_meta($rest, 'casino_custom_meta_sidebar_icon', true);
                            ?>
                            <div class="d-flex flex-wrap w-100 p-7p withdrawrow ">
                                <div class="w-20 w-sm-25  text-left align-self-center">
                                    <div class="d-flex flex-wrap">
                                        <div class="w-40">
                                            <img class="img-fluid float-right" style="width: 44px" loading="lazy" src="<?= $image_id;?>">
                                        </div>
                                        <div class="w-60 m-auto text-sm-13 text-left pl-5p">
                                            <?= get_the_title($rest);?>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-20 w-sm-25  text-sm-13  align-self-center text-center align-middle">
                                    <?= get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_min_wit',true);?>
                                </div>
                                <div class="w-20 w-sm-25  text-sm-13  align-self-center text-center align-middle">
                                    <?= get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_max_wit',true);?>
                                </div>
                                <div class="w-20 w-sm-25  text-sm-13  align-self-center text-center align-middle">
                                    <?= get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_wit_time',true)? get_post_meta($post->ID,'casino_custom_meta_'.$rest.'_wit_time',true):'instant' ;?>
                                </div>
                            <?php
                            if (!wp_is_mobile()){
                                ?>
                                <div class="text-center align-middle w-20 align-self-center">
                                    <a class="btn bumper btn btn bg-yellow text-15 w-sm-100 d-block text-decoration-none p-5p btn_large rounded text-dark bumper font-weight-bold"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                                        <span>Withdrawal <i class="fas fa-arrow-right"></i></span></a>
                                </div>
                                <?php
                            }
                                ?>

                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="bg-gray-light p-10p">
                <?php if (is_array($depArrayRest)){
                    ?>
                    <a class="btn bumper btn btn bg-primary text-decoration-none text-white text-17 text-sm-13 p-sm-5p w-sm-100 d-block table-with-btn w-50 mx-auto viewpaym p-20p btn_large  bumper font-weight-bold" style="border-radius: 0!important;"  href="#hidden-payments-with" data-toggle="collapse" rel="nofollow" >
                        <i class="fas fa-sync-alt"></i> View More Withdrawals Methods</i></a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
            <div class="flex-wrap d-flex shadow-box mt-5p p-5p">
                <div class="w-100 text-justify">
                     <?php echo apply_filters('the_content', get_post_meta($post->ID,"casino_custom_meta_payments_text",true)); ?>
                </div>
            </div>
        </div>


    <?php if(get_post_meta($post->ID,'casino_custom_meta_hide_slots',true) != 'on'){
        ?>
    <?php $sectionHeadingState = get_post_meta($post->ID,'casino_custom_meta_heading_state_slot',true);
    if ($sectionHeadingState == ''){
        $sectionHeadingState = 'span';
    }
    $sectionHeading = get_post_meta($post->ID,'casino_custom_meta_heading_slot',true);
    if (!empty($sectionHeading)){
    ?>
    <<?php echo $sectionHeadingState; ?> class="widget2-new-heading text-left" id="<?=$anchorsids[3]?>"><?=$sectionHeading?></<?=$sectionHeadingState?>>
<?php
}
?>
        <div class="flex-wrap d-flex shadow-box p-5p">
            <span class="w-100 text-justify">
                <?php echo apply_filters('the_content', get_post_meta($post->ID,"casino_custom_meta_li_mo",true)); ?>
            </span>
            <div class="w-100 d-flex inner_row more_games review_slots flex-wrap">
                  <?php
                            $casino_soft = get_post_meta($post->ID, 'casino_custom_meta_softwares', true);
                            if(is_array($casino_soft)) {
                                $casino_softCache = implode("-", $casino_soft);
                            }
                            $args = array(
                                'post_type' => 'kss_slots',
                                'posts_per_page' => 4,
                                'post_status' => array('publish'),
                                'numberposts' => 4,
                                'no_found_rows' => true,
                                'fields' =>'ids',
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
                            $cache_key = 'slot_shark'.md5($casino_softCache);
                           if (false === ( $slots = wp_cache_get( $cache_key ) )){
                               $slots = get_posts($args);
                                wp_cache_set( $cache_key, $slots, 'slot_shark', DAY_IN_SECONDS );
                            }
                $slots= get_posts($args);
                foreach ($slots as $slot){
                    $score = get_post_meta($slot, 'slot_custom_meta_slot_value', true) / 20;
                    if (wp_is_mobile()){
                        $widthslot = '48%';
                    }else{
                        $widthslot = '24.2%';
                    }
                    ?>
                    <div  style="width: <?php echo $widthslot;?>" class="m-3p element-item <?php echo implode(" ", get_post_meta($slot, 'slot_custom_meta_label', true)) ?> <?php echo get_post_meta($slot, 'slot_custom_meta_slot_software', true) ?> "
                         data-category="transition">
                        <section class="containerz">
                            <div class="card">
                                <div class="front">
                                    <a class="text-decoration-none" href="<?php echo get_the_permalink($slot); ?>">
                                        <figure class="m-0">
                                            <img loading="lazy" src="<?php echo get_the_post_thumbnail_url($slot) ?>" alt="game-image">
                                            <?php if (get_post_meta($slot, 'slot_custom_meta_label', true)) {
                                                $metaLabel = array_flip(get_post_meta($slot, 'slot_custom_meta_label', true));
                                                if (isset($metaLabel['LEGEND'] )) { ?>
                                                    <div class="ribbon hot">
                                                        <span>Legend</span></div>
                                                <?php } elseif (isset($metaLabel['BEST'])) {
                                                    ?>
                                                    <div class="ribbon premium">
                                                        <span>Best</span></div>
                                                <?php } elseif (isset($metaLabel['NEW'])) {
                                                    ?>
                                                    <div class="ribbon new"><span>New</span>
                                                    </div>
                                                <?php }
                                            } ?>
                                            <?php $page = get_post_meta($slot, 'slot_custom_meta_slot_software', true);?>
                                            <span class="software"><img
                                                        src="<?php echo get_post_meta($page, "casino_custom_meta_sidebar_icon", true);?>"
                                                        width="30" height="30"
                                                        loading="lazy"
                                                        alt="<?php echo get_the_title($page); ?>"
                                                        data-toggle="tooltip"
                                                        title="<?php echo ucwords(get_the_title($page)); ?> "/></span>
                                        </figure>
                                        <span class="name p-2p"><?php echo get_the_title($slot); ?> </span>
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                    <?php
                }

                ?>
            </div>
        </div>

<?php
    }
?>

        <?php $sectionHeadingState = get_post_meta($post->ID,'casino_custom_meta_heading_state_live',true);
        if ($sectionHeadingState == ''){
            $sectionHeadingState = 'span';
        }
        $sectionHeading = get_post_meta($post->ID,'casino_custom_meta_heading_live',true);
        if (!empty($sectionHeading)){
            ?>
            <<?php echo $sectionHeadingState; ?> class="widget2-new-heading text-left" id="<?=$anchorsids[4]?>"><?=$sectionHeading?></<?=$sectionHeadingState?>>
            <?php
        }
        ?>
        <div class="flex-wrap d-flex shadow-box p-5p">
            <div class="w-100  d-flex">
                <span class="float-left text-left">
                     <img class="img-fluid float-right" style="max-height: 160px;"  loading="lazy" src="/wp-content/themes/best50casino.com/assets/images/gifroul-min.png">
                     <?php echo apply_filters('the_content', get_post_meta($post->ID,"casino_custom_meta_ot_in",true)); ?>
                </span>
            </div>
        </div>

        <div class="w-100 mt-20p mb-10p">
               <?php echo apply_filters('the_content', get_post_meta($post->ID,"casino_custom_meta_note",true)); ?>
        </div>

        <div>
        <?php echo compareCasino($post->ID)?>
        </div>

        <?php include(locate_template('templates/common/players-reviews.php', false, false));?>

        <?php  get_template_part('templates/common/content-faqs'); ?>

    </div>

    <div class="w-30 w-sm-100 p-5p sidebar-casino">
        <div class="widget2 mt-0">
            <span class="widget2-heading bg-dark text-left">General Info</span>
            <div class="d-flex flex-wrap  w-100 ">
                <div class="w-100 pt-10p pb-5p bg-gray-light box-sidebar">
                    <div class="w-90 m-auto">
                        <span class="mb-2p text-primary d-block font-weight-bold"  style="border-bottom: 1px solid #525252;">Licensed in</span>
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
                </div>
            </div>

            <div class="d-flex flex-wrap mb-2p w-100 ">
                <div class="w-100 pt-10p pb-10p bg-gray-light box-sidebar">
                    <div class="w-90 m-auto">
                        <span class="mb-2p text-primary d-block font-weight-bold" style="border-bottom: 1px solid #777777f5;">Founded</span>
                        <p class="mb-10p"><?php echo get_post_meta($post->ID, 'casino_custom_meta_com_estab', true); ?></p>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap w-100 ">
                <div class="w-100 pt-10p pb-5p bg-gray box-sidebar">
                    <div class="w-90 m-auto">
                        <span class="mb-2p text-primary d-block font-weight-bold" style="border-bottom: 1px solid #777777f5;">Website</span>
                        <p class="mb-10p text-dark"><a class="text-dark text-decoration-none" rel="nofollow"
                                                href="<?php echo get_post_meta($post->ID, 'casino_custom_meta_affiliate_link_review', true); ?>"><?php echo str_replace("https://", "", get_post_meta($post->ID, 'casino_custom_meta_com_url', true)); ?></a>
                        </p>
                    </div>
                </div>
            </div>

            <?php if (get_post_meta($post->ID, 'casino_custom_meta_twitter_option') || get_post_meta($post->ID, 'casino_custom_meta_facebook_option') || get_post_meta($post->ID, 'casino_custom_meta_instagram_option')) { ?>
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
                <div class="w-100 pt-10p pb-10p bg-gray box-sidebar">
                    <div class="w-90 m-auto">
                        <span class="mb-2p text-primary d-block font-weight-bold" style="border-bottom: 1px solid #777777f5;">Customer Service Hours</span>
                        <p class="text-dark mb-10p"><?php echo get_post_meta($post->ID, 'casino_custom_meta_comun_hours', true); ?></p>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-wrap w-100 ">
                <div class="w-100 pt-10p pb-5p bg-gray-light box-sidebar">
                    <div class="w-90 m-auto ">
                        <span class="mb-2p text-primary d-block font-weight-bold" style="border-bottom: 1px solid #777777f5;">Email</span>
                        <p class="text-dark mb-10p">
                            <a class="text-dark text-decoration-none" href="mailto:<?php echo get_post_meta($post->ID, 'casino_custom_meta_emailoption_det', true); ?>"><?php echo get_post_meta($post->ID, 'casino_custom_meta_emailoption_det', true); ?></a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap mb-2p w-100 ">
                <div class="w-100 bg-gray-light pt-10p pb-10p box-sidebar">
                    <div class="w-90 m-auto">
                        <span class="mb-2p text-primary d-block font-weight-bold" style="border-bottom: 1px solid #777777f5;">Live Chat</span>
                        <p class="text-dark mb-10p"><?php if (get_post_meta($post->ID, 'casino_custom_meta_live_chat_option', true)) {
                                echo 'Yes';
                            } else {
                                echo 'No';
                            }; ?></p>
                    </div>
                </div>
            </div>
            <?php if (get_post_meta($post->ID, 'casino_custom_meta_phoneoption_det', true)) { ?>
                <div class="d-flex flex-wrap w-100 ">
                    <div class="w-100 pt-10p pb-5p bg-gray box-sidebar">
                        <div class="w-90 m-auto">
                            <span class="mb-2p text-primary d-block font-weight-bold" style="border-bottom: 1px solid #777777f5;">Phone Number</span>
                            <p class="text-dark mb-10p"><?php echo get_post_meta($post->ID, 'casino_custom_meta_phoneoption_det', true); ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php $platforms = get_post_meta($post->ID, 'casino_custom_meta_platforms', true); ?>
            <?php if ($platforms) { ?>
                <div class="d-flex flex-wrap mb-2p w-100 ">
                    <div class="w-100 bg-gray pt-10p pb-10p box-sidebar">
                        <div class="w-90 m-auto ">
                            <span class="mb-2p text-primary d-block font-weight-bold" style="border-bottom: 1px solid #777777f5;">Platforms</span>
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
            <span class="widget2-heading bg-dark text-left">Additional Information</span>
            <div class="widget2-body p-10p">
                <div class="info-row">
                    <span class="text-15 d-block font-weight-bold">Website Languages</span>
                    <ul class="inline-list countries-list p-0 mb-2p list-typenone d-inline-block">
                        <li><?php echo get_flags($post->ID, 'site'); ?></li>
                    </ul>
                </div>
                <div class="info-row">
                    <span class="text-15 d-block font-weight-bold">Support Languages</span>
                    <ul class="inline-list countries-list  p-0 mb-2p list-typenone d-inline-block ">
                        <li><?php echo get_countries($post->ID, 'cs'); ?></li>
                    </ul>
                </div>
                <div class="info-row">
                    <span class="text-15 d-block font-weight-bold">Currencies</span>
                    <ul class="inline-list cards-list p-0 mb-2p list-typenone d-inline-block">
                        <li><?php echo get_currencies($post->ID); ?></li>
                    </ul>
                </div>
                <div class="info-row">
                    <span class="text-15 d-block font-weight-bold">Restricted countries</span>
                    <ul class="inline-list countries-list p-0 mb-2p list-typenone d-inline-block">
                        <li><?php echo get_countries($post->ID, 'rest'); ?></li>
                    </ul>
                </div>
            </div>
        </div>

<!--       Mobilde-->

        <div class="widget2 position-sticky" style="top: 12%;" id="bestCasinos">
            <?php
            $flagISO = $localIso != 'nl' ? $localIso : 'eu';
            $rete = get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;'));?>
            <span class="widget2-heading bg-dark text-left"> Best Casinos <?= $rete;?></span>
            <?php
            $getss = WordPressSettings::getPremiumCasino($countryISO, $type = 'premium');
            $cas = explode(",", $getss);
            $i=0;
            foreach ($cas as $casinoID){
                $bonusISObest = get_bonus_iso($casinoID);
                $ctaLinkbest = get_post_meta($casinoID, 'casino_custom_meta_affiliate_link', true);
                $exclusiveMobileString = '<div class="ribbon best-casino 5"><span class="ribbonclass-exclusive"><i class="fa fa-star" aria-hidden="true" style="color:#fff;font-size:11px;"></i></span></div>';
                $isBonusExclusiveMobile = get_post_meta($casinoID, $bonusISObest . "casino_custom_meta_exclusive", true) ? $exclusiveMobileString : '';
                ?>
                <div class="p-10p d-flex flex-wrap " style="border: 1px solid #bfbfbfe0; background: #f1f1f1;">
                    <div class="w-30 position-relative overflow-hidden">
                        <a class="" href="<?= get_the_permalink($casinoID);?>">
                            <img loading="lazy" src="<?=get_the_post_thumbnail_url($casinoID);?>" class="img-fluid rounded" alt="<?php echo get_the_title($casinoID);?>" style="height: 60px">
                        <?=$isBonusExclusiveMobile;?>
                        </a>
                    </div>
                    <div class="w-50 position-relative d-flex flex-column text-center text-14 align-self-center">
                        <span class="font-weight-bold"><?php echo get_post_meta($casinoID, $bonusISObest."casino_custom_meta_cta_for_top", true);?></span>
                        <span class=""><?php echo get_post_meta($casinoID, $bonusISObest."casino_custom_meta_cta_for_top_2", true);?></span>

                    </div>
                    <div class="w-20 align-self-center">
                        <a class="btn bg-yellow text-15 w-sm-100 d-block p-5p btn_large text-decoration-none rounded text-decoration-none text-dark bumper font-weight-bold"  data-casinoid="<?php echo $casinoID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLinkbest?>" rel="nofollow" target="_blank">
                            <span>VISIT</span></a>
                    </div>
                </div>
                <?php
                if(++$i > 5) break;
            }
            wp_reset_postdata();
            ?>

            <div class="mt-10p">
            <?php echo get_template_part('/templates/common/casino_select_menu'); ?>
            </div>
        </div>


        </div>
        </div>
    </div>

    <?php if($geoBonusArgs['restr'] != true){ ?>
        <div class="mobile-footer-banner-bookie d-none d-lg-block d-xl-block position-sticky overflow-hidden mb-2p w-100" style="top: 0;bottom: 3px; z-index: 100;">
            <div class="mega-cta-stable p-4p m-0 text-white d-flex flex-wrap">
                <div class="col-4 col-sm-2 col-md-4 cta-img no-pad"><a <?php echo $ctaFunction; ?> href="<?php echo $ctaLink; ?>" rel="nofollow" target="_blank"><img width="110" class="img-fluid" src="<?php echo $logo_id; ?>" alt="<?php echo get_the_title($post->ID) ; ?>" ></a></div>
                <div class="col-8 col-sm-8 col-md-4 cta-txt">
                    <div class="promo-details-amount text-center text-17">
                        <?php if (get_post_meta($post->ID, $localIso."casino_custom_meta_no_bonus", true)!=1) { ?>
                        <?php if ($geoBonusArgs['isExclusive']){echo '<div class="exclusive-inline d-block "><i class="fa fa-star" aria-hidden="true"></i>
                            <span>Exclusive Bonus</span></div>';}?>
                        <div class="d-flex justify-content-center">
                            <span class="text-21">
                                <?php echo get_flags( '', '', $GLOBALS['countryISO']).'  '.get_post_meta($post->ID, $bonusISO."casino_custom_meta_cta_for_top", true); ?>
                            </span>
                            <span class="promo-details-amount-sub d-inline-block mt-5p ml-5p text-15">
                                <i>
                            <?php echo $geoBonusArgs['bonusText']['FlagText']; ?>
                                </i>
                            </span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-12 col-sm-2 col-md-4 pr-0 cta-btn ">
                    <a class="btn btn_yellow text-17 w-sm-100 text-decoration-none float-right d-flex justify-content-center pl-10p ml-20p w-55 p-10p btn_large font-weight-bold bumper"
                       data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                        <span>
                            <?php if($GLOBALS['countryISO'] === 'gb'){
                                echo "Play";
                            }else{
                                echo "Play Now";
                            }?>
                        </span>
                    </a></div>
            </div>
        </div>
    <?php } ?>


<script type="application/ld+json"> {"@context": "http://schema.org","@type": "Review","itemReviewed": {"@type": "CreativeWorkSeries","name": "<?=get_the_title()?>"},"reviewRating":{"@type":"AggregateRating","ratingValue":<?=round(get_post_meta($post->ID, 'casino_custom_meta_sum_rating', true),1)?>,"ratingCount":1,"bestRating":10,"worstRating":1},"author": {"@type": "Organization","name": "Best50casino.com" }}</script>

</div>

<?php if($geoBonusArgs['restr'] == true){ ?>
<?php include_once(locate_template('templates/geo-parts/premium_casinos_pop_up.php'));
}?>
