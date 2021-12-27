<?php
$folder= '/dev.best50casino.com';
$folder= '';

require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-settings.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
$visitorsISO = $_GET['country'];
$postID = $_GET['id'];
$shortcodeType = $_GET['shortcodeType'];
$atts = shortcode_parse_atts($_GET['atts']);
$casinos = ShortcodeFilters::returnBookies($atts);
foreach ($casinos['casinos'] as $casinoID){
    $stars = get_rating((int)$casinoID, 'svg');
    $ret[] =
        [
            "id" => $casinoID,
            "name" => get_the_title($casinoID),
            "permalink" => get_permalink($casinoID),
            "img" =>  get_the_post_thumbnail_url($casinoID, 'book_logo'),
            "rating" =>  [
                "number"=>get_post_meta((int)$casinoID, 'casino_custom_meta_sum_rating', true).'/10',
                "star1"=>'wp-content/themes/best50casino.com/assets/images/'.$stars[0].'.svg',
                "star2"=>'wp-content/themes/best50casino.com/assets/images/'.$stars[1].'.svg',
                "star3"=>'wp-content/themes/best50casino.com/assets/images/'.$stars[2].'.svg',
                "star4"=>'wp-content/themes/best50casino.com/assets/images/'.$stars[3].'.svg',
                "star5"=>'wp-content/themes/best50casino.com/assets/images/'.$stars[4].'.svg'
            ],
        ];
}
header("Access-Control-Allow-Origin: *");
$ret = json_encode(array('items' => $ret));
echo $ret;
die();