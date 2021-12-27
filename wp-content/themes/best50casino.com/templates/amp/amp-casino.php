<?php
include locate_template( array( '/templates/amp/amp-header.php' ) );

$imge_id = getImageId(get_post_meta($post->ID, 'casino_custom_meta_sidebar_icon', true)); ?>

<?php $imge_id = get_image_id_by_link(get_post_meta($post->ID, 'casino_custom_meta_sidebar_icon', true));
//NEEDED
$metaids = get_post_meta($post->ID, 'casino_custom_meta_anchors', true);
$anchorsids = explode(",", $metaids);
$casinoBonusPage = get_post_meta($post->ID, 'casino_custom_meta_bonus_page', true);
$bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
$restricted=get_post_meta($post->ID, 'casino_custom_meta_rest_countries',true);
$countriesEnabledArray = \WordPressSettings::getCountryEnabledSettings();
foreach($countriesEnabledArray as $key=>$value){
    if(!in_array($key,$restricted)){
        $countriesEnabledArray2[]=$key;
    }
}
$countriesEnabledArray2=json_encode($countriesEnabledArray2);
$restricted=json_encode($restricted);

/////////////////////////////////////////////////////
$bonusISO = get_bonus_iso($casinoBonusPage);
$countryISO = $GLOBALS['countryISO'];
$localIso =  $GLOBALS['visitorsISO']; //Αν η χωρα ειναι ενεργοποιημενη
$image_id = get_post_meta($post->ID, 'casino_custom_meta_comp_screen_1', true);
$logo_id = get_post_meta($post->ID, 'casino_custom_meta_trans_logo', true);
$logo_idmo = getImageId(get_post_meta($post->ID, 'casino_custom_meta_trans_logo', true));
$imge_id = getImageId(get_post_meta($post->ID, 'casino_custom_meta_sidebar_icon', true));
$geoBonusArgs = is_country_enabled($bonusName,$post->ID, 'kss_casino');



$ctaLink = $geoBonusArgs['aff_re2'];
$ctaFunction = $geoBonusArgs['ctaFunction'];


$premiumCasinosstring = WordPressSettings::getPremiumCasino($countryISO,'premium');

$premiumCasinosArray =  explode(",",$premiumCasinosstring);
$isCasinoPremium = in_array($post->ID, $premiumCasinosArray);

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
include locate_template( array( '/templates/amp/amp-casino/amp-casino-content.php' ) );
include locate_template( array( '/templates/amp/amp-footer.php' ) );