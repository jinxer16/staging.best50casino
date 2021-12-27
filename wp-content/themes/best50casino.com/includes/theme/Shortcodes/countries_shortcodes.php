<?php
function more_countires($atts){

    $atts = shortcode_atts(
        array(
            'popular' => '',
        ), $atts, 'more-countries' ) ;


    $payments = WordPressSettings::getPremiumPayments($GLOBALS['countryISO']);
//        print_r($payments);
    $pieces = explode(",", $payments);
    $sliced_array = array_slice($pieces, 0, 6);
    $morepayments = array_slice($pieces,6);

    ob_start();
    ?>
    <h2 class="content-title mb-10p mt-10p">More Countries</h2>
    <div class="d-flex flex-wrap w-100">

    <?php
    $countries =  WordPressSettings::getCountryEnabledSettingsPosts();
    foreach ($countries as $country=>$id){
            if ($country != $GLOBALS['countryISO']){
                ?>
                <a class="p-10p border-trans payment-box text-decoration-none ml-2p mt-1p mb-1p mr-2p"  href="<?= get_the_permalink($id);?>">
                    <div class="d-flex flex-wrap">
                        <div class="w-100 w-sm-100 d-flex flex-wrap align-self-center">
                            <figure class="countries w-15 align-self-center align-middle m-auto">
                                <?php if (get_post_meta($id, 'countries_custom_meta_icon', true)){
                                    $imge_link = get_post_meta($id, 'countries_custom_meta_icon', true);
                                    $countryPostName = get_post_meta($id, 'countries_custom_meta_sd_txt', true);
                                    ?>
                                    <img class="img-fluid align-self-center align-middle rounded-circle " style="width: 30px; height: 30px;"src="<?=$imge_link?>" loading="lazy" alt="<?php echo $countryPostName?>">
                                <?php }else{ ?>
                                    <a class="text-decoration-none" href="<?php get_the_permalink($id); ?>"><img src="https://bestcasino.gr/wp-content/uploads/2017/04/λογο.png" alt="" ></a>
                                <?php }	?>
                            </figure>
                            <span class="nmr_casino w-85 countriez pl-5p align-self-center d-flex float-left justify-content-start align-middle align-self-center">
                                <?php echo $countryPostName; ?>
						    </span>
                        </div>
                    </div>
                </a>

                <?php
            }}
        ?>
    </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;

}
add_shortcode('more-countries','more_countires');




function countries_initial($atts, $content="null") {

    $countries =  WordPressSettings::getCountryEnabledSettingsPosts();
    $countryid =  isset($countries[$GLOBALS['countryISO']]) ? $countries[$GLOBALS['countryISO']] :false;

    if ( $countryid != false && get_post_status($countryid) == 'publish') {
        $limit = 10;
    }else{
        $limit = 40;
    }

    return '<div class="pay-table-filter mb-10p mt-10p">' . do_shortcode('[table layout="countries" limit="'.$limit.'" sort_by="premium" 2nd_column_list="bonus" 3rd_column="license" 3rd_column_icons="dep" cta="sign_up" title="Top  Casino Brands in '.$GLOBALS['countryName'].'" 2nd_col_title="Bonus" 3rd_col_title="License & Payments" country_specific="'.$GLOBALS['countryISO'].'"]') . '</div>';
}
add_shortcode ("countries-parent", "countries_initial");