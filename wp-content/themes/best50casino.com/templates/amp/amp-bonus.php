<?php
include locate_template( array( '/templates/amp/amp-header.php' ) );

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
$premiumCasinosstring = WordPressSettings::getPremiumCasino($countryISO,'premium');
$casino_pros = explode(',', get_post_meta($bookieid, 'casino_custom_meta_pros', true));
$casino_cons = explode(',', get_post_meta($bookieid, 'casino_custom_meta_why_not_play', true));
$premiumCasinosArray =  explode(",",$premiumCasinosstring);
$isCasinoPremium = in_array($bookieid, $premiumCasinosArray);
$restricted=get_post_meta($bookieid, 'casino_custom_meta_rest_countries',true);
$countriesEnabledArray = \WordPressSettings::getCountryEnabledSettings();
foreach($countriesEnabledArray as $key=>$value){
    if(!in_array($key,$restricted)){
        $countriesEnabledArray2[]=$key;
    }
}
$countriesEnabledArray2=json_encode($countriesEnabledArray2);
$restricted=json_encode($restricted);
?>
    <amp-geo layout="nodisplay">
        <script type="application/json">
            {
                "ISOCountryGroups": {
                    "restricted": <?php echo $restricted?>,
                    "valid": <?php echo $countriesEnabledArray2?>,
                    "glb": ["unknown"]
                }
            }
        </script>
    </amp-geo>
<?php
include locate_template( array( '/templates/amp/amp-bonus/amp-bonus-content.php' ) );
include locate_template( array( '/templates/amp/amp-footer.php' ) );