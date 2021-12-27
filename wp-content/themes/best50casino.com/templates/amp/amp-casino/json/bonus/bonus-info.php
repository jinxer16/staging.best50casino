<?php
$folder= '/dev.best50casino.com';
$folder= '';
require_once($_SERVER['DOCUMENT_ROOT'] . $folder . '/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . $folder . '/wp-settings.php');
require_once($_SERVER['DOCUMENT_ROOT'] . $folder . '/wp-load.php');
$visitorsISO = $_GET['country'];
$postID = $_GET['id'];
$countryISO = WordPressSettings::isCountryActive($visitorsISO) ? $visitorsISO: 'glb';
$casinoBonusPage = get_post_meta($postID, 'casino_custom_meta_bonus_page', true);
$bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
$bonusISO = get_bonus_iso($casinoBonusPage);

$geoBonusArgs = is_country_enabled($bonusName,$postID, 'kss_casino');
$premiumCasinosstring = WordPressSettings::getPremiumCasino($countryISO,'premium');
$cas = explode(",", $premiumCasinosstring);
$i=0;
foreach ($cas as $idcasino){
    $bonuspage = get_post_meta($idcasino, 'casino_custom_meta_bonus_page', true);
    $bonusName = get_post_meta($bonuspage, 'bonus_custom_meta_bonus_offer', true);
    $bonusISO = get_bonus_iso($bonuspage);
    $ctatop = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_cta_for_top", true);
    $ctatop2 = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_cta_for_top_2", true);
    $ctaLink = get_post_meta($idcasino, 'casino_custom_meta_affiliate_link_review', true);
    $name = get_the_title($idcasino);
    $image = get_the_post_thumbnail_url($idcasino);
    $permalink = get_the_permalink($idcasino);
    $isBonusExclusiveMobile = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_exclusive", true) ? 'd-flex' : 'd-none';
    $databestcasinos[] = array("name"=>$name,"image"=>$image,"cta"=>$ctatop,"cta2"=>$ctatop2,"link"=>$permalink,"afflink"=>$ctaLink,"exclusive"=>$isBonusExclusiveMobile);
    if(++$i > 5) break;
}
$paymentOrder['id']  = WordPressSettings::getPremiumPayments($countryISO);
$order = explode(",", $paymentOrder['id']);
$availableMeans = get_post_meta($postID, 'casino_custom_meta_dep_options', true);
$res = array_intersect($order, $availableMeans);
$correctOrder = array_unique(array_merge($res, $availableMeans));
$depArrayFirst = array_slice($correctOrder, 0, 6);
foreach ($depArrayFirst as $ids){
    $image_id = get_post_meta($ids, 'casino_custom_meta_sidebar_icon', true);
    $name = get_the_title($ids);
    $datapayments[] = array("name"=>$name,"image"=>$image_id);
}

$curr = $GLOBALS['countryCurrency'];
$flagISO = $visitorsISO != 'nl' ? $visitorsISO : 'eu';
$ctaLink = $geoBonusArgs['aff_re2'];

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


$data = get_post_meta($casinoBonusPage, $bonusISO."_promotions", true);
$datagloabl =get_post_meta($casinoBonusPage,"glb_promotions", true);
$emptyvar ='';
$datasent= '';
if (empty($data) && $datagloabl != ''){
    $datasent =get_post_meta($casinoBonusPage,"glb_promotions", true);
}elseif (empty($data) && (empty($datagloabl))){
    $emptyvar= 'empty';
}elseif($data != ''){
    $datasent = get_post_meta($casinoBonusPage, $bonusISO."_promotions", true);
}

$ret =[
    'promotions_table'=> $datasent,
    'vip_cashback'=> $datasentcash,
    'premium_payments'=> $datapayments,
    'premium_casinos'=> $databestcasinos,
    "countryinfo"=>[
        'name'=>$GLOBALS['countryName'],
        'symbol'=>$curr['symbol'],
        'code'=>$curr['code'],
        'currname'=>$curr['name'],
        'iso'=>$visitorsISO,
    ],
    $geoBonusArgs,
];
header("Access-Control-Allow-Origin: *");
$ret = json_encode(array('items' => [$ret]));
echo $ret;
die();