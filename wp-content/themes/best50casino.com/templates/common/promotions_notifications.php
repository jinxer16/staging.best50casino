<?php
$countryISO = $GLOBALS['countryISO'];
$localIso =  $GLOBALS['visitorsISO']; //Αν η χωρα ειναι ενεργοποιημενη
$countryName = $GLOBALS['countryName'];
$themeSettingsCountries = get_option('countries_enable_options');
$isCountryEnabled = in_array($countryISO, $themeSettingsCountries['enabled_countries_iso'][0]) ? true : false;
$themeSettings = get_option('promo_options_page');
$promotionsArray = WordPressSettings::getPremiumPromotions($countryISO,'premium');

//$dttest = $dt->format('Y-m-d H:i');
$date = date('Y-m-d H:i:s');

if( $promotionsArray ):
    foreach ($promotionsArray as $key=>$value){ // Αν έχει λήξει αφαίρεσε το promo από τον πίνακα
        if (get_post_meta((int)$value, 'promo_custom_meta_end_offer', true) < $date){
            unset( $promotionsArray[$key] );
        }
    }
    $numberOPosts = count($promotionsArray);
    ?>
    <div class="promotion-notes text-dark d-none d-lg-block d-xl-block " style="margin-right: -6px; margin-top: -200px;">
        <div class="panel-collapse panel-collapse-list collapse show" id="small-promo">
            <span class="starship" style="margin-bottom:0;display: block;box-sizing: border-box;background: #212d33;color: #fff;position: relative;text-align: center;border-bottom: 3px solid #ffcd00;">Latest Promos <a data-toggle="collapse" href="#small-promo" style="float:right;color:white;padding-right: 5px;"><i class="fa fa-close"></i></a></span>
            <ul class="promo-wrapper-small  collapse show" id="promo-list">
                <?php
                $promotionsArrayMi2n = array_slice($promotionsArray, 0, 2);
                //    print_r(array_slice($promotionsArray, 0, 2) ) ; get_post_meta((int)$casinos, 'promo_custom_meta_end_offer', true) >= $dttest &&
                foreach ($promotionsArrayMi2n as $casinos) {
                    if ((get_post_meta((int)$casinos, 'promo_custom_meta_valid_all', true) || in_array($todayDay ,get_post_meta((int)$casinos, 'promo_custom_meta_valid_on', true) ) )) {
                        ?>
                        <li class="sigle-promo-wrapper text-14 flex-nowrap w-100 mt-0 justify-content-between align-items-center overflow-hidden p-5p" style="color:#000;">
                            <?php
                            $casinoMainID = get_post_meta((int)$casinos, 'promo_custom_meta_casino_offer', true);
                            $casinoBonusPage = get_post_meta($casinoMainID, 'casino_custom_meta_bonus_page', true);
                            $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
                            ?>
                            <img style="margin-right:5px;" width="25" height="25" src="<?php echo get_post_meta($casinoMainID, 'casino_custom_meta_sidebar_icon', true); ?>" class="img-responsive" loading="lazy" alt="<?php echo get_the_title($casinoMainID); ?>">
                            <a class="text-left" href="<?php echo get_the_permalink($casinoBonusPage) . '#offers'; ?>"><?php echo get_the_title((int)$casinos); ?></a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
            <a href="<?php echo get_site_url(); ?>/casino-promotions/" style="width: 100%;background: #03898f;display: block;padding: 0 10px 0px 10px;color: white;">All Promotions</a>
        </div>
        <?php if ($numberOPosts >= 2) {?>
            <div class="panel-collapse" id="big-promo">
                <span class="starship" style="margin-bottom:0;display: block;box-sizing: border-box;background: #212d33;color: #fff;position: relative;text-align: center;border-bottom: 3px solid #ffcd00;">Latest Promos <a id="closepromo" style="float:right;color:white;cursor:pointer;padding-right: 5px;"><i class="fa fa-close"></i></a></span>
                <ul class="promo-wrapper " id="promo-list-2">
                    <?php
                    $promotionsArrayMin = array_slice($promotionsArray, 0, 6);
                    foreach ($promotionsArrayMin as $casinos) {
                        if ((get_post_meta((int)$casinos, 'promo_custom_meta_valid_all', true) || in_array( $todayDay , get_post_meta((int)$casinos, 'promo_custom_meta_valid_on', true)))) {
//                            if (!in_array($date, get_post_meta((int)$casinos, 'promo_custom_meta_valid_on', true))) {
                                $offerEndTime = get_post_meta((int)$casinos, 'promo_custom_meta_end_offer', true);
//                            }
                            ?>
                            <li class="sigle-promo-wrapper collapseli d-flex flex-wrap justify-content-between align-items-center overflow-hidden p-5p mt-2p mb-2p"  style="color:#000;">
                                <?php
                                $casinoMainID = get_post_meta((int)$casinos, 'promo_custom_meta_casino_offer', true);
                                $casinoBonusPage = get_post_meta($casinoMainID, 'casino_custom_meta_bonus_page', true);
                                $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
                                ?>
                                <img width="30" height="30" src="<?php echo get_post_meta($casinoMainID, 'casino_custom_meta_sidebar_icon', true); ?>"
                                     class="img-responsive" loading="lazy" alt="<?= get_the_title($casinoMainID); ?>">
                                <a class="d-flex text-left justify-content-between" style="width: 86%;"
                                   href="<?php echo get_the_permalink($casinoBonusPage) . '#offers'; ?>">
                                    <b style="font-weight: 500;border-bottom: 1px solid;">  <?php echo get_the_title($casinoMainID); ?>: </b>
                                    <span data-title="Countddown" class="countdown" data-time="<?php echo $offerEndTime; ?>"></span></a>
                                <a class="text-left" href="<?php echo get_the_permalink($casinoBonusPage) . '#offers'; ?>"><?php echo get_the_title($casinos); ?>
                                    <small><b>more</b></small>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <a class="w-100 d-block text-white" href="<?php echo get_site_url(); ?>/casino-promotions/" style="background: #03898f;padding: 0 10px 0px 10px;">All Promotions</a>
            </div>
        <?php } ?>
        <div id="folder-collapse" class="position-relative text-right float-right"><a id="openpromo" style="cursor: pointer;" class="pointer" rel="nofollow"><img  width="50" src="<?php echo get_template_directory_uri().'/assets/images/svg/envelope.svg'; ?>" class="img-fluid bg-white" loading="lazy" alt="promo"><span class="no-o-promo"><?php echo $numberOPosts; ?></span></a></div>
    </div>
<?php
endif;

