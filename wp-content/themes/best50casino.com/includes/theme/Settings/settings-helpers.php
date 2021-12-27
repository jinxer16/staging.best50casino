<?php
/**
 * Created by PhpStorm.
 * User: Panos
 * Date: 23/7/2019
 * Time: 8:44 μμ
 */

add_action('wp_ajax_loadAdsFields', 'loadAdsFields');
//add_action('wp_ajax_nopriv_loadAdsFields', 'loadAdsFields' );
function loadAdsFields()
{
    $country = $_GET['country'];
    $settingsType = $_GET['settingsType'];
    if($settingsType=='casino'){
        $ret = SettingsSpace\GeoAdsCasino::loadAds($country);
    }elseif($settingsType=='countries'){
        $ret = SettingsSpace\GeoAds::loadAds($country);
    }
    echo $ret;
    die ();
}
add_action('wp_ajax_loadOptions', 'loadOptions');
//add_action('wp_ajax_nopriv_loadAdsFields', 'loadAdsFields' );
function loadOptions()
{
    $country = $_GET['country'];
    $ret = SettingsSpace\Featured::loadOptions($country);
    echo $ret;
    die ();
}
add_action('wp_ajax_loadPremium', 'loadPremium');
//add_action('wp_ajax_nopriv_loadPremium', 'loadPremium' );
function loadPremium()
{
    $country = $_GET['country'];
    $postType = $_GET['postType'];
    $ret = SettingsSpace\Premium::loadPremium($country,$postType);
    echo $ret;
    die ();
}


add_action('wp_ajax_saveAdSettings', 'saveAdSettings');
//add_action('wp_ajax_nopriv_loadAdsFields', 'loadAdsFields' );
function saveAdSettings()
{
    $settingsArray = $_GET['input'];
    $settingscountry = $_GET['settingscountry'];
    $settingscasino =$_GET['settingscasino'];
    if($settingscasino){
        $ret = SettingsSpace\GeoAdsCasino::saveAds($settingscountry,$settingsArray,$settingscasino);
    }else{
        $ret = SettingsSpace\GeoAds::saveAds($settingscountry,$settingsArray);
    }
    echo json_encode($ret);
    die ();
}


add_action('wp_ajax_filterPremiumPromoAdmin', 'filterPremiumPromoAdmin');
//add_action('wp_ajax_nopriv_loadAdsFields', 'loadAdsFields' );
function filterPremiumPromoAdmin()
{
    $country = $_GET['country'];
    $firstfilter = $_GET['firstfilter'];
    $secondfilter =$_GET['secondfilter'];
    $typefilter =$_GET['typefilter'];

    $ret = SettingsSpace\Premium::FilterPremiumBy($country,$firstfilter,$secondfilter,$typefilter);
    echo $ret;
    die ();
}



add_action('wp_ajax_savePremiumPromoAjax', 'savePremiumPromoAjax');
//add_action('wp_ajax_nopriv_loadAdsFields', 'loadAdsFields' );
function savePremiumPromoAjax()
{
    $ids = $_POST['ids'];
    $postType = $_POST['postType'];
    $premium =  $_POST['premium'];
    $category =  $_POST['category'];
    $day =  $_POST['day'];
    $iso = $_POST['code'];
    $settingsUpdated = SettingsSpace\Premium::savePremiumPromos($ids,$premium,$iso,$postType,$category,$day);
    $ret = '<div class="d-flex">';
    $ret .= $settingsUpdated ? '<span class="bg-success ml-1 p-2 rounded-10">Settings Updated</span>':'<span class="bg-warning ml-1 p-2 rounded-10">Settings Not Updated</span>';
    $ret .= '</div>';
    echo $ret;
    die ();
}

add_action('wp_ajax_ResetPromoFilters', 'ResetPromoFilters');
//add_action('wp_ajax_nopriv_loadAdsFields', 'loadAdsFields' );
function ResetPromoFilters()
{
    $postType = $_POST['postType'];
    $category =  $_POST['category'];
    $day =  $_POST['day'];
    $iso = $_POST['code'];
    $settingsreset = delete_option('premium-'.$postType.'-'.$category.'-'.$day.'-' . $iso);
    $ret = '<div class="d-flex">';
    $ret .= $settingsreset ? '<span class="bg-success ml-1 p-2 rounded-10">Settings Updated</span>':'<span class="bg-warning ml-1 p-2 rounded-10">Settings Not Updated</span>';
    $ret .= '</div>';
    echo $ret;
    die ();
}


function returnBonusRow($crypto_id){
    global $wpalchemy_media_access;
    global $metabox;
    global $mb;
    $ret = '<div id="cryptoRow_'.$crypto_id.'">';
        $ret .= '<h5><img class="mr-1 mb-1" src="'.get_post_meta($crypto_id,'icon',true).'" width="15"><a  class="text-dark" href="#"
           onClick="jQuery(\'#my_meta_control_country_'.$crypto_id.'\').toggle();return false;">'.get_post_meta($crypto_id,'short_title',true).'</a></h5>';
        $ret .= '<hr/>';
        $ret .= '<div class="my_meta_control metabox form-group" id="my_meta_control_country_'.$crypto_id.'" style="display: none;">';
        $ret .= '<div style="width:33%;float:left;">
        <label>Show only these geo data</label>';
	$ret .= '    <input type="checkbox" name="_bonus[book_' . $crypto_id . 'offer_onlygeo]" value="1" />
    </div>';
		$ret .= '<div style="width:33%;float:left;">';
        $ret .= '    <label>Type</label>';
////    $mb->get_the_field('book_' . $crypto_id . 'offer_type');
//        $meta = get_post_meta($crypto_id,'book_' . $crypto_id . 'offer_type',true) ? get_post_meta($crypto_id,'book_' . $crypto_id . 'offer_type',true) : '';
        $ret .= '    <input type="text" name="_bonus[book_' . $crypto_id . 'offer_type]" value=""/>';
        $ret .= '</div>';
        $ret .= '<div style="width:33%;float:left;">';
        $ret .= '    <label>Promotion\'s amount</label>';
//        $meta = get_post_meta($crypto_id,'book_' . $crypto_id . 'offer_amount',true) ? get_post_meta($crypto_id,'book_' . $crypto_id . 'offer_amount',true) : '';
        $ret .= '    <input type="text" name="_bonus[book_' . $crypto_id . 'offer_amount]" value=""/>';
        $ret .= '</div>';
        $ret .= '<div style="width:33%;float:left;">
                    <label>Minimum Deposit</label>
                    <input type="text" name="_bonus[book_' . $crypto_id . 'offer_mindep]" value=""/>
                </div>';
        $ret .= '<div style="width:33%;float:left;">
                    <label>Percentage</label>
                    <input type="text" name="_bonus[book_' . $crypto_id . 'offer_percentage]" value=""/>
                </div>';
        $ret .= '<div style="width:33%;float:left;"><label>Rollover</label>
                <input type="text" name="_bonus[book_' . $crypto_id . 'offer_tziros]" value=""/>
            </div>';
        $ret .= '<div style="width:33%;float:left;">
        <label>Minimum odds</label>
        <input type="text" name="_bonus[book_' . $crypto_id . 'offer_minbet]" value=""/>
    </div>';
        $ret .= '<div style="width:33%;float:left;">
        <label>Bonus Code</label>
        <input type="text" name="_bonus[book_' . $crypto_id . 'offer_code]" value=""/>
    </div>';
        $ret .= '<div style="width:33%;float:left;">
        <label>Short Title (under review logo)</label>
        <input type="text" name="_bonus[book_' . $crypto_id . 'offer_shorttitle]" value=""/>
    </div>';
        $ret .= '<div style="width:33%;float:left;">
        <label>Payments 2</label>';
    $ret .= '   <p>
            <select name="_bonus[book_' . $crypto_id . 'offer_payments]" multiple class="form-control">
                <option value="' . $crypto_id . '" selected>'.get_post_meta($crypto_id,'short_title',true).'</option>';
        $ret .= '        </select>
        </p>
    </div>';
        $ret .= '<div style="width:33%;float:left;">
        <label>Link</label>';
    $ret .= '  <input type="text" name="_bonus[book_' . $crypto_id . 'offer_link]" value=""/>
    </div>';
        $ret .= '<div style="width:33%;float:left;">
        <label>Exclusive</label>';
    $ret .= '    <input type="checkbox" name="_bonus[book_' . $crypto_id . 'offer_exclusive]" value="1" />
    </div>';
        $ret .= '<br style="clear:both;"/>';
        $ret .= '<div style="width:50%;float:left;">
        <label>Special Terms</label>';
        $ret .= '<input type="text" name="_bonus[book_' . $crypto_id . 'offer_special_terms]" value=""/>
    </div>';
        $ret .= '<div style="width:50%;float:left;">
        <label>Special Terms url</label>';
        $ret .= '<input type="text" name="_bonus[book_' . $crypto_id . 'offer_special_terms_url]" value=""/>
    </div>';
        $ret .= '<br style="clear:both;"/>
    <div style="width:50%;float:left;">
        <label>Small Terms</label>';
        $ret .= '<input type="text" name="_bonus[book_' . $crypto_id . 'offer_small_terms]" value=""/>
    </div>';
        $ret .= '<div style="width:50%;float:left;">
        <label>Small Terms url</label>';
    $ret .= '<input type="text" name="_bonus[book_' . $crypto_id . 'offer_small_terms_url]" value=""/>
    </div>';
        $ret .= '<br style="clear:both;"/>';
        $ret .= '<div style="width:33%;float:left;">
        <label>text for sticky boidebar Shortcode (i.e. Premium)</label>';
        $ret .= '<input type="text" name="_bonus[book_' . $crypto_id . 'sidebarshortcode_text]" value=""/>
    </div>';
        $ret .= '<div style="width:33%;float:left;">
        <label>CTA for Top Bookmakers (social campaign)</label>
        <input type="text" name="_bonus[book_' . $crypto_id . 'cta_text_top]" value=""/>
    </div>';
        $ret .= '<div style="width:33%;float:left;">
        <label>Call to Act Buttton (on Why to Play field)</label>
        <input type="text" name="_bonus[book_' . $crypto_id . 'cta_text]" value=""/>
    </div>';
        $ret .= '<div style="width:33%;float:left;">
        <label>Bookmaker url</label>
        <input type="text" name="_bonus[book_' . $crypto_id . 'main_url]" value=""/>
    </div>';
        $ret .= '<br style="clear:both;"/>';
        $ret .= '<hr/>';
        $ret .= '</div>';
        $ret .= '</div>';
    return $ret;
}
add_action('wp_ajax_returnBonusRowHandler', 'returnBonusRowHandler');
add_action('wp_ajax_nopriv_returnBonusRowHandler', 'returnBonusRowHandler' );
function returnBonusRowHandler()
{
    $crypto_id = $_GET['crypto_id'];
    if( function_exists('returnBonusRow')){
        $ret = returnBonusRow($crypto_id);
    }else{
        $ret = "returnBonusRow(asdasdasdasd)";
    }
    echo $ret;
    die ();
}
add_action('wp_ajax_loadMetaTable', 'loadMetaTable');
//add_action('wp_ajax_nopriv_loadMetaTable', 'loadMetaTable' );
function loadMetaTable(){
    $metaBy = $_POST['metaBy'];
    $bookIDorCountryISO = $_POST['bookIDorCountryISO'];
    $metaType = $_POST['metaType'];
    $metaName = $_POST['metaName'];
    if(class_exists('SettingsSpace\BonusTable') ){
        $ret = SettingsSpace\BonusTable::loadTable($metaBy,$bookIDorCountryISO,$metaType,$metaName);
    }else{
        $ret = 'Class does not exist!';
    }
    echo json_encode(['asd'=>$ret]);
    die ();
}
add_action('wp_ajax_saveMetaTable', 'saveMetaTable');
//add_action('wp_ajax_nopriv_saveMetaTable', 'saveMetaTable' );
function saveMetaTable(){
    $metaType = $_POST['metaType'];
    $type = $_POST['type'];
    $BookOrIsoOrMetaID = $_POST['BookOrIsoOrMetaID'];
    $settingsStr = $_POST['settings'];
    $settings = json_decode(stripslashes($settingsStr),true);
//    echo json_encode(['asd'=>$settings]);
//    die ();
    if(class_exists('SettingsSpace\BonusTable') ){
        $ret = SettingsSpace\BonusTable::saveTable($metaType,$type,$BookOrIsoOrMetaID,$settings);
    }else{
        $ret = 'Class does not exist!';
    }
    echo json_encode(['asd'=>$ret]);
    die ();
}