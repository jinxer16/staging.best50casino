<?php
$folder= '/dev.best50casino.com';
$folder= '';
require_once($_SERVER['DOCUMENT_ROOT'] . $folder . '/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . $folder . '/wp-settings.php');
require_once($_SERVER['DOCUMENT_ROOT'] . $folder . '/wp-load.php');
$visitorsISO = $_GET['country'];
$postID = $_GET['id'];
$type = $_GET['type'];
$countryISO = WordPressSettings::isCountryActive($visitorsISO) ? $visitorsISO: 'glb';
if ($type == 'deposits'){
    $availableMeans = get_post_meta($postID, 'casino_custom_meta_dep_options', true);
}elseif($type == 'withdrawals'){
    $availableMeans = get_post_meta($postID, 'casino_custom_meta_withd_options', true);
}

$leftUrl = $_GET['left'];
$leftdepototal= ceil(count($availableMeans)/6);
$offset = ($leftdepototal - $leftUrl) * 6;
$newLeft = $_GET['left'] -1;
$paymentOrder['ids'] = WordPressSettings::getPremiumPayments($countryISO);
$order = explode(",", $paymentOrder['ids']);


$res = array_intersect($order, $availableMeans);
$correctOrder = array_unique(array_merge($res, $availableMeans));
$depArrayRest = array_slice($correctOrder,$offset,6);

$datapayments =[];
$datawith = [];
foreach ($depArrayRest as $rest) {
    if ($type == 'deposits'){
        $image_id = get_post_meta($rest, 'casino_custom_meta_sidebar_icon', true);
        $name = get_the_title($rest);
        $mindep = get_post_meta($postID, 'casino_custom_meta_' . $rest . '_min_dep', true);
        $maxdep = get_post_meta($postID, 'casino_custom_meta_' . $rest . '_max_dep', true);
        $deptime = get_post_meta($postID, 'casino_custom_meta_' . $rest . '_dep_time', true);
        $deptimesent='';
        if ($deptime == ''){
            $deptimesent ='instant';
        }else{
            $deptimesent  = get_post_meta($postID, 'casino_custom_meta_' . $rest . '_dep_time', true);
        }
        $datapayments[] = array(
            "name"=>$name,
            "image"=>$image_id,
            "mindep"=>$mindep,
            "maxdep"=>$maxdep,
            "deptime"=>$deptimesent
        );
    }elseif($type == 'withdrawals') {
        $image_id = get_post_meta($rest, 'casino_custom_meta_sidebar_icon', true);
        $name = get_the_title($rest);
        $minwith = get_post_meta($postID, 'casino_custom_meta_' . $rest . '_min_wit', true);
        $maxwith = get_post_meta($postID, 'casino_custom_meta_' . $rest . '_max_wit', true);
        $withtime = get_post_meta($postID, 'casino_custom_meta_' . $rest . '_wit_time', true);
        $withtimesent='';
        if ($withtime == ''){
            $withtimesent ='instant';
        }else{
            $withtimesent  = get_post_meta($postID, 'casino_custom_meta_' . $rest . '_wit_time', true);
        }
        $datawith[] = array(
            "name"=>$name,
            "image"=>$image_id,
            "minwith"=>$minwith,
            "maxwith"=>$maxwith,
            "withtime"=>$withtimesent
        );
    }
}
$ret =[
    'casino_deposits'=> $datapayments,
    'casino_withdrawal'=> $datawith,
];
header("Access-Control-Allow-Origin: *");
if($newLeft<0){
    $ret = json_encode(array('items' => []));
}else{
    if ($type == 'deposits'){
        $ret = json_encode(array('items' => $datapayments, "next"=>"https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/amp-payments.php?country=$visitorsISO&type=deposits&id=$postID&items=6&left=$newLeft"));
    }elseif($type == 'withdrawals'){
        $ret = json_encode(array('items' => $datawith, "nextdepo"=>"https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/amp-payments.php?country=$visitorsISO&type=withdrawals&id=$postID&items=6&left=$newLeft"));
    }
}



echo $ret;
die();