<?php
/**
 * Created by PhpStorm.
 * User: Panos
 * Date: 16/7/2019
 * Time: 4:33 μμ
 */

add_shortcode('anchor', 'get_anchors');
function get_anchors($atts){
    $atts = shortcode_atts(
        array(
            'id' => '', // horizontal, vertical, full, sidebar
        ), $atts, 'anchor');
    return '<div id="'.$atts['id'].'"></div>';
}

function get_test($atts)
{
    $atts = shortcode_atts(
        array(
            'page' => '1',
            'limit' => '5',
            'sort' => 'default',//rating|date
            'layout' => 'default',//sidebar|top|table-bonus|table-review|bonus
            'offset' => '0',
            'geocountry' => '',//geocountry="##geocountry##"
            'disablegeo' => '', //απενεργοποιεί το geo
            'ids' => '',
            'except_ids' => '',
            'acceptsplayers_from' => '', //specific geo px μπαίνω από ελλάδα και βλέπω ποιοι δέχονται Άγγλους
            'notacceptsplayers_from' => '', // Το αντίθετο
            'dep_available' => '',
            'with_available' => '',
            '247' => '',
            'livechat' => '',
            'callback' => '',
            'newbet' => '',
            'skype' => '',
            'gkaniota' => '',
            'is_premium' => '',
            'windows_app' => '',
            'languages' => '',
            'lisencedat' => '',
            'raterange' => '',
            'bet_markets',
            'sports' => '',
            'products' => '',
            'bets' => '', //Δεν ξέρουμε τι ακριβώς είναι
            'ordersort' => '',
            'geo_exclusive' => '', //Σε ποια καζίνο έχουμε exclusive bonus στην εκάστοτε χώρα
            'contact_languages' => '',
            'currencies' => '',
            'platformes' => '',
            'mobile_app' => '',
            'local_lisencedat' => '',
            'isnot_premium' => '',
            'seperate_premium' => '',
            'restricted_countries',
            'contact_ways' => '',
            'live_video' => '',
            'service' => '',
            'partial' => '', //eiναι service μερικό cashout
            'additional' => '', //Offered Bets (except from the usual)
            'player_type' => '', // Bookmaker type Asian High Odds ktl
            'region' => '',
        ), $atts, 'test');



    $test = ShortcodeFilters::returnBookies($atts);
    print_r($test);
    $count = 0;
    foreach($test as $kk=>$asd){
        $count++;
//        echo $count.'--->'.$kk.'----->'.$asd.'<br>';
        echo $count.'--->'.get_the_title($asd).'----->'.$asd.'<br><pre>';
        print_r(get_post_meta($asd, 'gkaniota', true));
        echo '</pre>';
    }

//    $filterMeta = get_post_meta(2383,'contact_ways',true);
//    $commonElements = array_intersect(['Live Chat'],$filterMeta);
//    $commonElementsNumber = count($commonElements);
//    echo $commonElementsNumber;

}

add_shortcode('test', 'get_test');

?>