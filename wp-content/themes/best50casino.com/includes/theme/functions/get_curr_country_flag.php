<?php
function get_flags($postID='', $type = "", $countryISO ='', $size = '25', $atts = array()){
    $flagsShown='';
    $lanuagesArray = WordPressSettings::getAvailableLanguages();
    $flagsArray = WordPressSettings::getCountriesWithIDandName();
    $retAtts='';
    if($atts){
        foreach ($atts as $attr=>$value){
            $retAtts .= $attr .'="'.$value.'"';
        }
    }
    switch ($type){
        case 'site':
            $flagsShown = get_post_meta($postID, 'casino_custom_meta_lang_sup_site', true);
            $array = $lanuagesArray;
            break;
        case 'cs':
            $flagsShown = get_post_meta($postID, 'casino_custom_meta_lang_sup_cs', true);
            $array = $lanuagesArray;
            break;
        case 'rest':
            $flagsShown = get_post_meta($postID, 'casino_custom_meta_rest_countries', true);
            $array = $flagsArray;
            break;
        default:
            $flag = $countryISO;
            $array = $flagsArray;
            break;
    }
    $ret = '';
    if ($countryISO){
        $ret .= '<img '.$retAtts.' loading="lazy" src="'.get_template_directory_uri().'/assets/flags/round/'.$flag.'.svg" width="'.$size.'" data-toggle="tooltip" title="'.$array[$flag].'" alt="'.$array[$flag].'">';
    }else{
        if($flagsShown){
            foreach ($flagsShown as $flag){
                $ret .= '<img loading="lazy" src="'.get_template_directory_uri().'/assets/flags/round/'.$flag.'.svg" width="30" data-toggle="tooltip" title="'.$array[$flag].'" alt="'.$array[$flag].'">';
            }
        }else{
            $ret .= '<span>No information available</span>';
        }
    }

    return $ret;
}

function get_flags_amp($postID='', $type = "", $countryISO ='', $size = '25', $atts = array()){
    $flagsShown='';
    $lanuagesArray = WordPressSettings::getAvailableLanguages();
    $flagsArray = WordPressSettings::getCountriesWithIDandName();
    $retAtts='';
    if($atts){
        foreach ($atts as $attr=>$value){
            $retAtts .= $attr .'="'.$value.'"';
        }
    }
    switch ($type){
        case 'site':
            $flagsShown = get_post_meta($postID, 'casino_custom_meta_lang_sup_site', true);
            $array = $lanuagesArray;
            break;
        case 'cs':
            $flagsShown = get_post_meta($postID, 'casino_custom_meta_lang_sup_cs', true);
            $array = $lanuagesArray;
            break;
        case 'rest':
            $flagsShown = get_post_meta($postID, 'casino_custom_meta_rest_countries', true);
            $array = $flagsArray;
            break;
        default:
            $flag = $countryISO;
            $array = $flagsArray;
            break;
    }
    $ret = '';
    if ($countryISO){
        $ret .= '<amp-img '.$retAtts.' class="ml-2p"  src="'.get_template_directory_uri().'/assets/flags/round/'.$flag.'.svg" width="'.$size.'" height="'.$size.'" data-toggle="tooltip" title="'.$array[$flag].'" alt="'.$array[$flag].'"></amp-img>';
    }else{
        if($flagsShown){
            foreach ($flagsShown as $flag){
                $ret .= '<amp-img class="ml-2p"  src="'.get_template_directory_uri().'/assets/flags/round/'.$flag.'.svg" width="30" height="30" data-toggle="tooltip" title="'.$array[$flag].'" alt="'.$array[$flag].'"> </amp-img>';
            }
        }else{
            $ret .= '<span>No information available</span>';
        }
    }

    return $ret;
}


function get_countries($postID = "", $type = ""){
    $lanuagesArray = WordPressSettings::getAvailableLanguages();
    $countriesArray = WordPressSettings::getCountriesWithIDandName();
    switch ($type){
        case 'site':
            $countryShown = get_post_meta($postID, 'casino_custom_meta_lang_sup_site', true);
            $array = $lanuagesArray;
            break;
        case 'cs':
            $countryShown = get_post_meta($postID, 'casino_custom_meta_lang_sup_cs', true);
            $array = $lanuagesArray;
            break;
        case 'rest':
            $countryShown = get_post_meta($postID, 'casino_custom_meta_rest_countries', true);
            $array = $countriesArray;
            break;
    }

    $ret = '';
    if($countryShown){
        foreach ($countryShown as $country){
            $ret .= '<span data-toggle="tooltip" title="'.ucwords($array[$country]).'">'.ucwords($array[$country]).'</span>, ';
        }
    }else{
        $ret .= '<span>-</span>, ';
    }
    return rtrim($ret, ", ");
}

function get_currencies($postID = ''){
    $currenciesArray = WordPressSettings::getAvailableCurrencies();
    $ret = '';
    if(get_post_meta($postID, 'casino_custom_meta_cur_acc', true)){
        foreach (get_post_meta($postID, 'casino_custom_meta_cur_acc', true) as $currency){
            $ret .= '<span data-toggle="tooltip" title="'.$currenciesArray[$currency].'">'.$currency.'</span>, ';
        }
    }else{
        $ret .= '<span>-</span>, ';
    }

    return rtrim($ret, ", ");
}
