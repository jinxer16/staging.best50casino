<?php
function get_bonus_iso($postID = NULL,$country_specific=null){
    $availableBonusCountries = get_post_meta($postID, 'casino_custom_meta_bonus_contries_filled', true);
    $isoToCheck = $country_specific === null ? $GLOBALS['countryISO'] : $country_specific;
    if(@!in_array($isoToCheck,$availableBonusCountries)){
        $ret = 'glb';
    }else{
        $ret = $isoToCheck;
    }
    return $ret;
}
function get_geolocation($apiKey, $ip, $lang = "en", $fields = "*", $excludes = "") {
    $url = "https://api.ipgeolocation.io/ipgeo?apiKey=".$apiKey."&ip=".$ip."&lang=".$lang."&fields=".$fields."&excludes=".$excludes;
    $cURL = curl_init();

    curl_setopt($cURL, CURLOPT_URL, $url);
    curl_setopt($cURL, CURLOPT_HTTPGET, true);
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json'
    ));
    return curl_exec($cURL);
}
function userinfo_global() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    if(strpos($ip,',')){
        $iip = explode(',',$ip);
        $ip = (!empty($iip[1]) ? $iip[1] : $iip[0]);
    }
//    if(!preg_match('/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/', $ip)){
//        $ip = $this->input->ip_address();
//    }
    $whitelist = array(
        '127.0.0.1',
        '::1'
    );

    if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
        // not valid

    $is_bot = (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/googlebot|-google|yandex|bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT']));
    $geocountries = WordPressSettings::getCountryEnabledSettings();
    if(!empty($geocountries) && !$is_bot){
        $apiKey = "5932bed399da4f308e4d4be0df212b94";
//        $ip = "94.65.201.60";
//        $ip = "2.17.4.55";
//        $ip = "2.103.254.0"; //uk
//        $ip = "167.154.10.50"; //NEVADA
//        $ip = "69.142.18.125"; //New Jersey
        $geocountry = get_geolocation($apiKey,$ip,'en',"country_code2,country_name,city,state_prov,city,currency");
        $geocountry = json_decode($geocountry, true);
        if($geocountry['state_prov'] == 'New Jersey' || $geocountry['state_prov'] == 'Nevada'){
            include(locate_template('/templates/blocked_users.php'));
            die();
        }
        $GLOBALS['countryName'] =  $geocountry['country_name'];
        $GLOBALS['countryCurrency'] =  $geocountry['currency'];
        $geocountry = strtolower($geocountry['country_code2']);
//        $GLOBALS['visitorsISO'] = $geocountry != 'nl' ? $geocountry : 'eu'; //TODO NA RVTHSO FOTI TI GINETAI ME SHMAIA OLLANDIAS
        $GLOBALS['visitorsISO'] = $geocountry;
        if (isset($geocountries[$geocountry])){
            $GLOBALS['countryISO'] = $geocountry;
        }else{
            $GLOBALS['countryISO'] = 'glb';
        }
    }else{
        $GLOBALS['countryISO'] = 'glb';
    }
    }else{
        $GLOBALS['visitorsISO'] = 'glb';
        $GLOBALS['countryISO'] = 'glb';
    }
}
add_action( 'init', 'userinfo_global' );