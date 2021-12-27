<?php
$folder= '/dev.best50casino.com';
$folder= '';
require_once($_SERVER['DOCUMENT_ROOT'] . $folder . '/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . $folder . '/wp-settings.php');
require_once($_SERVER['DOCUMENT_ROOT'] . $folder . '/wp-load.php');
$visitorsISO = $_GET['country'];
$postID = $_GET['id'];
$countryISO = WordPressSettings::isCountryActive($visitorsISO) ? $visitorsISO: 'glb';
if($_GET['type']=='casinolist'){
//    $countryISO = WordPressSettings::isCountryActive($visitorsISO) ? $visitorsISO: 'glb';
    $premiumCasino = WordPressSettings::getPremiumCasino($countryISO, 'premium');
    $premiumCasino = explode(",", $premiumCasino);
    $premiumCasino = array_slice($premiumCasino, 0, 4);
    foreach ($premiumCasino as $premID) {
        if($premID!=$postID){
            $ret['top'][]=[
                "name" => get_the_title($premID),
                "id" => $premID
            ];
        }
    }
    $allCasinos = get_all_published('kss_casino');
    foreach ($allCasinos as $casinoID) {
        $restricted = get_post_meta((int)$casinoID,'casino_custom_meta_rest_countries',true);
        if (is_array($restricted)) $restrictedFliped = array_flip($restricted);
        if($premID!=$postID && !isset($restrictedFliped[$visitorsISO])) {
            $ret['all'][] = [
                "name" => get_the_title($casinoID),
                "id" => $casinoID
            ];
        }
    }
}elseif($_GET['type']=='comparisonData'){
    $casinoBonusPage = get_post_meta($postID, 'casino_custom_meta_bonus_page', true);
    $bonusISO = get_bonus_iso($casinoBonusPage,$countryISO);
    $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
    $bonusAmount = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_promo_amount", true) ? get_post_meta($bonusName, $bonusISO . "bs_custom_meta_promo_amount", true) : '-' ;
    $bonusPerc = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_bc_perc", true) ? get_post_meta($bonusName, $bonusISO . "bs_custom_meta_bc_perc", true) : '-';
    $D = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_wag_d", true) ? get_post_meta($bonusName, $bonusISO . "bs_custom_meta_wag_d", true) : false;
    $B = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_wag_b", true) ? get_post_meta($bonusName, $bonusISO . "bs_custom_meta_wag_b", true) : false;
    $S = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_wag_s", true) ? get_post_meta($bonusName, $bonusISO . "bs_custom_meta_wag_s", true) : false;
    if($D==$B){
        $double = $D;
        $D = false;
        $B = false;
    }
    $ret = [
      'bonusAmount' => $bonusAmount,
      'bonusPerc' =>  $bonusPerc,
      'wag_d' =>  $D,
      'wag_b' =>  $B,
      'wag_s' =>  $S,
      'double' =>  $double
    ];
}elseif($_GET['type']=='casinoComparison'){
    $postID = $_GET['id']!='-' ? $_GET['id']: '-';
    $enabled = $_GET['id']!='-' ? 'enabled': 'disabled';
    $reviewLink = $_GET['id']!='-' ? get_the_permalink($_GET['id']) : '#';
    $img = $_GET['id']!='-' ? get_the_post_thumbnail_url($_GET['id']) : '/wp-content/themes/best50casino.com/assets/images/stamp_b.svg';
    $casinoBonusPage = get_post_meta($postID, 'casino_custom_meta_bonus_page', true);
    $minDep = get_post_meta($postID, 'casino_custom_meta_min_dep', true) ? get_post_meta($postID, 'casino_custom_meta_min_dep', true) : '-';
    $bonusISO = get_bonus_iso($casinoBonusPage,$visitorsISO);
    $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
    $bonusAmount = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_promo_amount", true) ? get_post_meta($bonusName, $bonusISO . "bs_custom_meta_promo_amount", true) : '-' ;
    $bonusPerc = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_bc_perc", true) ? get_post_meta($bonusName, $bonusISO . "bs_custom_meta_bc_perc", true) : '-';
    $D = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_wag_d", true) ? get_post_meta($bonusName, $bonusISO . "bs_custom_meta_wag_d", true) : false;
    $B = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_wag_b", true) ? get_post_meta($bonusName, $bonusISO . "bs_custom_meta_wag_b", true) : false;
    $S = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_wag_s", true) ? get_post_meta($bonusName, $bonusISO . "bs_custom_meta_wag_s", true) : false;
    if($D==$B){
        $double = $D;
        $D = false;
        $B = false;
    }
    $sum = (get_post_meta($postID, 'casino_custom_meta_sum_rating', true) * 10);
    if ($sum <= 50) {
        $percentageleft = 0;
        $percentageright = ($sum / 100 * 360);
    } else {
        $percentageright = 180;
        $percentageleft = (($sum - 50) / 100 * 360);
    }
    $platforms = get_post_meta($postID, 'casino_custom_meta_platforms', true);
    if ($platforms) {
        $platformsArray = array('apple' => 'iPhone App', 'android' => 'Android App', 'windows' => 'Windows Phone App', 'download' => 'Casino Download',);
        foreach ($platforms as $platform) {
            $platformsAr[]= [
                'name' => $platformsArray[$platform],
                'code' => $platform,
            ];
        }
    }else{
        $platformsAr[]= [
            'name' => 'none',
            'code' => 'minus',
        ];
    }
//    if($postID=='-'){
//        $platforms = [
//            'name' => 'none',
//            'code' => 'minus',
//        ];
//    }
    $name = $postID != '-' ? 'Visit '.get_the_title($postID) : 'Visit';
    $ret = [
        'img' => $img,
        'bonusAmount' => $bonusAmount,
        'bonusPerc' =>  $bonusPerc,
        'wag_d' =>  $D,
        'wag_b' =>  $B,
        'wag_s' =>  $S,
        'double' =>  $double,
        'r_r' =>  $percentageright,
        'r_l' =>  $percentageleft,
        'sum' =>  $sum,
        'number' =>  round($sum)/10,
        'minDep' =>  $minDep,
        'aff' => get_post_meta($postID, 'casino_custom_meta_affiliate_link_review', true),
        'platforms' => $platformsAr,
        'cta' => $name,
        'reviewLink' => $reviewLink,
        'enabled' => $enabled
    ];
}
header("Access-Control-Allow-Origin: *");
$ret = json_encode(array('items' => [$ret]));
echo $ret;
die();
?>