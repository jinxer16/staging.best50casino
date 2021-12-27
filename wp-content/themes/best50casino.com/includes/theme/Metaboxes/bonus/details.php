<?php global $wpalchemy_media_access;
$activeCountries = WordPressSettings::getCountryEnabledSettings();
$activeCountriesWithNames = WordPressSettings::getCountryEnabledSettingsWithNames();
$prefix = 'bs_custom_meta_';
$filledCountries = get_post_meta($post->ID, $prefix . 'bonus_contries_filled', true) ? get_post_meta($post->ID, $prefix . 'bonus_contries_filled', true) : [];
$bonusPage = get_posts([
        'numberposts'=>1,
        'post_type'=>'bc_bonus_page',
        'fields' => 'ids',
        'post_status' => array('publish'),
        'meta_query'=>[
            ['key'=>'bonus_custom_meta_bonus_offer',
            'value'=>$post->ID,
            'compare'=>'==']
        ]
]);
$casinoID=get_post_meta($bonusPage[0],'bonus_custom_meta_bookie_offer',true);
$casinoRestrictions = get_post_meta($casinoID,'casino_custom_meta_rest_countries',true);
$casinoRestrictions = is_array($casinoRestrictions) ? array_flip($casinoRestrictions) : [];
$casinoPayments = get_post_meta($casinoID,'casino_custom_meta_dep_options',true);
$casinoPayments = is_array($casinoPayments) ? array_flip($casinoPayments) : [];
//if (!get_option('oldsettingsSetForBonusMeta')) {
////    $metaPartZ1 = [
////        $prefix . 'bonus_contries_filled', $prefix . 'bonus_unavailable',
////    ];
////    foreach ($activeCountriesWithNames as $iso => $name) {
////        $metaPartZ1[] = $iso . $prefix . 'exclusive';
////        $metaPartZ1[] = $iso . $prefix . 'bonus_type';
////        $metaPartZ1[] = $iso . $prefix . 'spins_type';
////        $metaPartZ1[] = $iso . $prefix . 'cashback_type';
////        $metaPartZ1[] = $iso . $prefix . 'rewards_type';
////        $metaPartZ1[] = $iso . $prefix . 'min_dep';
////        $metaPartZ1[] = $iso . $prefix . 'sp_terms';
////        $metaPartZ1[] = $iso . $prefix . 'sp_terms_link';
////        $metaPartZ1[] = $iso . $prefix . 'bc_code';
////        $metaPartZ1[] = $iso . $prefix . 'cta_for_top';
////        $metaPartZ1[] = $iso . $prefix . 'cta_for_top_2';
////        $metaPartZ1[] = $iso . $prefix . 'promo_amount';
////        $metaPartZ1[] = $iso . $prefix . 'bc_perc';
////        $metaPartZ1[] = $iso . $prefix . 'wag_b';
////        $metaPartZ1[] = $iso . $prefix . 'wag_d';
////        $metaPartZ1[] = $iso . $prefix . 'wag_s';
////        $metaPartZ1[] = $iso . $prefix . 'top_up_cta';
////        $metaPartZ1[] = $iso . $prefix . 'dep_options';
////        $metaPartZ1[] = $iso . $prefix . 'first_cta';
////        $metaPartZ1[] = $iso . $prefix . 'second_cta';
////
////    }
////    $endCasinoMetaZ1 = [
////        '_bonus_text_fields' => $metaPartZ1,
////    ];
//    foreach (get_all_posts('bc_bonus') as $postID) {
//        $filledCountriezs = get_post_meta($postID, $prefix . 'bonus_contries_filled', true);
//        foreach ($filledCountriezs as $filledIso) {
//            $payments = get_post_meta($postID, $filledIso . 'bs_custom_meta_dep_options', true);
//            $newMeta = [];
//            foreach ($payments as $payment) {
//                if (!is_numeric($payment) && !is_null($payment)) {
//                    echo  '<br>'.get_the_title($postID).': <br>'.$filledIso.': <br>';
//                    $page = get_page_by_title($payment, OBJECT, 'kss_transactions');
//                    $newMeta[] = $page->ID;
//                }
//            }
//            if (!empty($newMeta)) {
//                update_post_meta($postID, $filledIso . 'bs_custom_meta_dep_options', $newMeta);
//            }
//        }
////        foreach ($endCasinoMetaZ1 as $key => $value) {
////            $ret = update_post_meta($postID, $key, $value);
////        }
//    }
//    update_option('oldsettingsSetForBonusMeta', true);
//}
//
//function get_old_post_meta($postID,$metaKey){
//    $mydb = new wpdb( 'best50casino_root', 'Q=_R~)Cd;5Rx', 'best50casino_wp_db_45', 'localhost' );
//    $ret = $mydb->get_results("SELECT meta_value FROM wp_postmeta WHERE
//                        meta_key LIKE '%".$metaKey."%'
//                        AND post_id = ".$postID, ARRAY_A);
//    return maybe_unserialize($ret[0]['meta_value']);
//}
////update_option('oldsettingsSetForBonusMetaOld', true);
//if (!get_option('oldsettingsSetForBonusMetaOld')) {
//    $default = ini_get('max_execution_time');
//    set_time_limit(2000);
//    $prefix = 'bs_custom_meta_';
//    foreach (get_all_posts('bc_bonus') as $postID) {
//
//        $filledCountriezs = get_post_meta($postID, $prefix . 'bonus_contries_filled', true);
//        foreach ($filledCountriezs as $filledIso) {
//
//            $Newpayments = get_post_meta($postID,$filledIso . 'bs_custom_meta_dep_options',true); //Παλιά μετα
//            if(count($Newpayments)==3)continue;
//            $payments = get_old_post_meta($postID,$filledIso . 'bs_custom_meta_dep_options'); //Παλιά μετα
//            $newMeta = [];
//            if(is_array($payments)){
//                foreach ($payments as $payment) {
//                    if (!is_numeric($payment) && !is_null($payment)) {
//                        $page = get_page_by_title($payment, OBJECT, 'kss_transactions');
//                        $newMeta[] = $page->ID;
//                    }
//                }
//            }else{
//                echo  '<br>'.get_the_title($postID).': <br>'.$filledIso.': <br>';
//            }
//            if (!empty($newMeta)) {
//                update_post_meta($postID, $filledIso . 'bs_custom_meta_dep_options', $newMeta);
//            }
//        }
//    }
//    set_time_limit($default);
//    update_option('oldsettingsSetForBonusMetaOld', true);
//}
//if (!get_option('oldsettingsSetForBonusMetaSpecial') || get_option('oldsettingsSetForBonusMetaSpecial') == false ) {
//    global $wpdb;
//    $default = ini_get('max_execution_time');
//    set_time_limit(2000);
//    $ret = $wpdb->get_results("SELECT DISTINCT post_id, meta_key FROM `wp_postmeta` WHERE meta_key LIKE '%bs_custom_meta_dep_options%' AND meta_value LIKE 'a:3:{i:0;s:%'", ARRAY_A);
//    foreach($ret as $notGoodBonus){
//        $payments = get_post_meta($notGoodBonus['post_id'], $notGoodBonus['meta_key'], true);
//        $newMeta = [];
//        if(is_array($payments)){
//            foreach ($payments as $payment) {
//                if (!is_numeric($payment) && !is_null($payment)) {
//                    $page = get_page_by_title($payment, OBJECT, 'kss_transactions');
//                    $newMeta[] = $page->ID;
//                }
//            }
//        }
//        if (!empty($newMeta)) {
//            update_post_meta($notGoodBonus['post_id'], $notGoodBonus['meta_key'], $newMeta);
//        }
//        echo $notGoodBonus['post_id'].'<br>';
//    }
//    set_time_limit($default);
//    update_option('oldsettingsSetForBonusMetaSpecial', true);
//}
?>
<div class="d-flex flex-wrap">

<!--    <div class="col-12 p-0">-->
<!--        <h4 class="bg-secondary p-1 mb-1">Country Bonus Unavailable</h4>-->
<!--        <i class="mb-2 d-block">Casino accepts players from this country, but does not provide country specific-->
<!--            bonus</i>-->
<!--        <div class="d-flex flex-wrap">-->
<!--            --><?php //$mb->the_field($prefix . 'bonus_unavailable', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
<!--            --><?php
//            foreach ($activeCountriesWithNames as $iso => $name) { if(isset($casinoRestrictions[$iso]))continue;?>
<!--                <p class="mb-0 d-flex mr-1" style="width:12%">-->
<!--                    <input type="checkbox" name="--><?php //$mb->the_name(); ?><!--"-->
<!--                           value="--><?//= $iso; ?><!--" --><?php //$mb->the_checkbox_state($iso); ?><!--/><label-->
<!--                            class="w-80">--><?//= ucwords($name) ?><!--</label>-->
<!--                </p>-->
<!--            --><?php //} ?>
<!--        </div>-->
<!--    </div>-->
    <?php foreach ($activeCountriesWithNames as $iso => $name) {
        if(isset($casinoRestrictions[$iso]))continue;?>
        <div class="col-12 p-0 country-bonus-section my_meta_control metabox" id="my_meta_control_country_<?= $iso ?>" data-country="<?= $iso?>">
            <?php $class = in_array($iso, $filledCountries) ? '<i class="ml-2 fa fa-check text-white"></i>' : ""; ?>
            <h4 class="w-100 bg-primary m-0 border-bottom d-flex align-items-center"><img
                        src="<?= get_template_directory_uri() . '/assets/flags/' . $iso ?>.svg" width="20"
                        class="ml-1 mr-1"><a class="text-white p-2 d-block" data-toggle="collapse"
                                             href="#details-<?= $iso ?>">Details
                    for <?= ucwords($name) ?></a><?= $class ?></h4>
            <div class="panel-collapse collapse" id="details-<?= $iso ?>">
                <div class="d-flex flex-wrap">
                    <div class="col-4 p-3 d-flex align-items-center">
                        <label class="mb-0">Exclusive</label>
                        <?php $mb->the_field($iso . $prefix . 'exclusive'); ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
                        <!--            --><?php //wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'sl_ga', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
                    </div>
                    <div class="col-4 p-3 d-flex align-items-center">
                        <label class="mb-0">No Bonus</label>
                        <?php $mb->the_field($iso . $prefix . 'no_bonus'); ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>" id="no_bonus" onclick="noBonus(this,'nobonus','<?echo $iso;?>')"
                               value="1"<?php $mb->the_checkbox_state('1'); ?> class="ml-1"/>
                        <!--            --><?php //wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'sl_ga', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
                    </div>
                    <div class="col-4 p-3 d-flex align-items-center">
                        <label class="mb-0">No Bonus Code</label>
                        <?php $mb->the_field($iso . $prefix . 'no_bonus_code'); ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>" id="no_bonus_code" onclick="noPromoCode(this,'nopromocode','<?echo $iso;?>')"
                               value="1"<?php $mb->the_checkbox_state('1'); ?> class="ml-1"/>
                        <!--            --><?php //wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'sl_ga', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
                    </div>
                    <div class="col-4 p-3 d-flex align-items-center">
                        <label class="mb-0">Free Spins</label>
                        <?php $mb->the_field($iso . $prefix . '_is_free_spins'); ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
                        <!--            --><?php //wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'sl_ga', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
                    </div>
                    <div class="col-4 p-3 d-flex align-items-center">
                        <label class="mb-0">No Deposit</label>
                        <?php $mb->the_field($iso . $prefix . '_is_no_dep'); ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="1"<?php $mb->the_checkbox_state('1'); ?> class="ml-1"/>
                        <!--            --><?php //wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'sl_ga', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
                    </div>
                    <div class="col-4 p-3 d-flex align-items-center">
                        <label class="mb-0">VIP</label>
                        <?php $mb->the_field($iso . $prefix . '_is_vip'); ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="1"<?php $mb->the_checkbox_state('1'); ?> class="ml-1"/>
                        <!--            --><?php //wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'sl_ga', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
                    </div>
                    <div class="col-2 p-3 d-flex align-items-baseline">
                        <label class="mb-0 mr-1">Bonus</label>
                        <p class="mb-0">
                            <?php $mb->the_field($iso . $prefix . 'bonus_type'); ?>
                            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-"
                                   value="<?php $mb->the_value(); ?>"/>
                            <i>Currency in Front (€100) (appears on new Review Page #CASINO CASINO BONUS, on New Bonus Page Right CTA on billboard/can be replaced with Promotions amount)</i>
                        </p>
                    </div>
                    <div class="col-2 p-3 d-flex align-items-baseline">
                        <label class="mb-0 mr-1">Spins</label>
                        <p class="mb-0">
                            <?php $mb->the_field($iso . $prefix . 'spins_type'); ?>
                            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-"
                                   value="<?php $mb->the_value(); ?>"/>
                            <i>Appears nowhere</i>
                        </p>
                    </div>
                    <div class="col-2 p-3 d-flex align-items-baseline">
                        <label class="mb-0 mr-1">Cashback</label>
                        <p class="mb-0">
                            <?php $mb->the_field($iso . $prefix . 'cashback_type'); ?>
                            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-"
                                   value="<?php $mb->the_value(); ?>"/>
                            <i>Only for sorting Casino Shortcodes and Tab functionality</i>
                        </p>
                    </div>
<!--                    <div class="col-2 p-3 d-flex align-items-baseline">-->
<!--                        <label class="mb-0 mr-1">Rewards</label>-->
<!--                        <p class="mb-0">-->
<!--                            --><?php //$mb->the_field($iso . $prefix . 'rewards_type'); ?>
<!--                            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--" data-default="-"-->
<!--                                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--                            <i>Appears nowhere</i>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                    <div class="col-2 p-3 d-flex align-items-baseline">-->
<!--                        <label class="mb-0 mr-1">No Deposit</label>-->
<!--                        <p class="mb-0">-->
<!--                            --><?php //$mb->the_field($iso . $prefix . 'nodep'); ?>
<!--                            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--" data-default="-"-->
<!--                                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--                            <i>Only for sorting Casino Shortcodes and Tab functionality</i>-->
<!--                        </p>-->
<!--                    </div>-->
                    <div class="col-3 p-3 d-flex align-items-baseline">
                        <label class="mb-0 mr-1">Minimum Deposit</label>
                        <p class="mb-0">
                            <?php $mb->the_field($iso . $prefix . 'min_dep'); ?>
                            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-"
                                   value="<?php $mb->the_value(); ?>"/>
                            <i></i>
                        </p>
                    </div>
<!--                    <div class="col-3 p-3 d-flex align-items-baseline">-->
<!--                        <label class="mb-0 mr-1">T&C's</label>-->
<!--                        <p class="mb-0">-->
<!--                            --><?php //$mb->the_field($iso . $prefix . 'sp_terms'); ?>
<!--                            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--" data-default="-"-->
<!--                                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--                            <i></i>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                    <div class="col-3 p-3 d-flex align-items-baseline">-->
<!--                        <label class="mb-0 mr-1">T&C's Link</label>-->
<!--                        <p class="mb-0">-->
<!--                            --><?php //$mb->the_field($iso . $prefix . 'sp_terms_link'); ?>
<!--                            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--" data-default="-"-->
<!--                                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--                            <i></i>-->
<!--                        </p>-->
<!--                    </div>-->
                    <div class="col-3 p-3 d-flex align-items-baseline">
                        <label class="mb-0 mr-1">Bonus Code</label>
                        <p class="mb-0">
                            <?php $mb->the_field($iso . $prefix . 'bc_code'); ?>
                            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-"
                                   value="<?php $mb->the_value(); ?>"/>
                            <i></i>
                        </p>
                    </div>
                    <div class="col-3 p-3 d-flex align-items-baseline">
                        <label class="mb-0 mr-1">Bonus CTA (for Bonus Page LEFT TOP)</label>
                        <p class="mb-0">
                            <?php $mb->the_field($iso . $prefix . 'cta_for_top'); ?>
                            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-" data-required="true"
                                   value="<?php $mb->the_value(); ?>"/>
                            <i>100% up to $500</i>
                        </p>
                    </div>
                    <div class="col-3 p-3 d-flex align-items-baseline">
                        <label class="mb-0 mr-1">Bonus Special Details(for Bonus Page LEFT TOP)</label>
                        <p class="mb-0">
                            <?php $mb->the_field($iso . $prefix . 'cta_for_top_2'); ?>
                            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-" data-required="true"
                                   value="<?php $mb->the_value(); ?>"/>
                            <i>100% up to $500</i>
                        </p>
                    </div>
<!--                    <div class="col-3 p-3 d-flex align-items-baseline">-->
<!--                        <label class="mb-0 mr-1">Promotion's amount</label>-->
<!--                        <p class="mb-0">-->
<!--                            --><?php //$mb->the_field($iso . $prefix . 'promo_amount'); ?>
<!--                            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--" data-default="-" data-required="true"-->
<!--                                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--                            <i>Bonus Terms for bonus page</i>-->
<!--                        </p>-->
<!--                    </div>-->
                    <div class="col-3 p-3 d-flex align-items-baseline">
                        <label class="mb-0 mr-1">Percentage</label>
                        <p class="mb-0">
                            <?php $mb->the_field($iso . $prefix . 'bc_perc'); ?>
                            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-"
                                   value="<?php $mb->the_value(); ?>"/>
                            <i>Bonus Terms for bonus page</i>
                        </p>
                    </div>
                    <div class="col-3 p-3 d-flex align-items-baseline">
                        <label class="mb-0 mr-1">Wagering Bonus (B)</label>
                        <p class="mb-0">
                            <?php $mb->the_field($iso . $prefix . 'wag_b'); ?>
                            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-"
                                   value="<?php $mb->the_value(); ?>"/>
                            <i>Bonus Terms for bonus page</i>
                        </p>
                    </div>
                    <div class="col-3 p-3 d-flex align-items-baseline">
                        <label class="mb-0 mr-1">Wagering Bonus (D)</label>
                        <p class="mb-0">
                            <?php $mb->the_field($iso . $prefix . 'wag_d'); ?>
                            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-"
                                   value="<?php $mb->the_value(); ?>"/>
                            <i>Bonus Terms for bonus page</i>
                        </p>
                    </div>
                    <div class="col-3 p-3 d-flex align-items-baseline">
                        <label class="mb-0 mr-1">Wagering Spins (S)</label>
                        <p class="mb-0">
                            <?php $mb->the_field($iso . $prefix . 'wag_s'); ?>
                            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-"
                                   value="<?php $mb->the_value(); ?>"/>
                            <i>Bonus Terms for bonus page</i>
                        </p>
                    </div>

<!--                    <div class="col-3 p-3 d-flex align-items-baseline">-->
<!--                        <label class="mb-0 mr-1">CTA text Bonus Page UP left</label>-->
<!--                        <p class="mb-0">-->
<!--                            --><?php //$mb->the_field($iso . $prefix . 'top_up_cta'); ?>
<!--                            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--" data-default="-"-->
<!--                                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--                            <i>Bonus Terms for bonus page</i>-->
<!--                        </p>-->
<!--                    </div>-->

<!--                    <div class="col-12 p-3">-->
<!--                        <h4 class="text-white bg-primary p-1">Deposit Methods</h4>-->
<!--                        <div class="d-flex flex-wrap">-->
<!--                            --><?php //$mb->the_field($iso . $prefix . 'dep_options', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
<!--                            --><?php
//                            $payments = get_all_posts('kss_transactions');
//                            asort($payments);
//                            foreach ($payments as $bm) {
//                                if(!isset($casinoPayments[$bm]))continue;?>
<!--                                <p class="mb-0 d-flex mr-1" style="width:12%">-->
<!--                                    <input type="checkbox" name="--><?php //$mb->the_name(); ?><!--" data-disabled="true" data-default="--><?//= $bm; ?><!--"-->
<!--                                           value="--><?//= $bm; ?><!--" --><?php //$mb->the_checkbox_state($bm); ?><!--/><label-->
<!--                                            class="w-80">--><?//= get_the_title($bm); ?><!--</label>-->
<!--                                </p>-->
<!--                            --><?php //} ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-3 p-3 d-flex align-items-baseline">-->
<!--                        <label class="mb-0 mr-1">CTA text Bonus Page sign up offer</label>-->
<!--                        <p class="mb-0">-->
<!--                            --><?php //$mb->the_field($iso . $prefix . 'first_cta'); ?>
<!--                            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--" data-default="-"-->
<!--                                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--                            <i>Bonus Terms for bonus page (appears on OLD bonus page)</i>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                    <div class="col-3 p-3 d-flex align-items-baseline">-->
<!--                        <label class="mb-0 mr-1">CTA text Bonus Page 2nd (PROMO CODE)</label>-->
<!--                        <p class="mb-0">-->
<!--                            --><?php //$mb->the_field($iso . $prefix . 'second_cta'); ?>
<!--                            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--" data-default="-"-->
<!--                                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--                            <i>Bonus Terms for bonus page (appears on OLD bonus page)</i>-->
<!--                        </p>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    <?php }
    ?>
    <div class="col-12 p-0">
        <h4 class="bg-secondary p-1">Bonus Countries Filled</h4>
        <div class="d-flex flex-wrap countries-filled-wrap">
            <?php $mb->the_field($prefix . 'bonus_contries_filled', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            foreach ($activeCountriesWithNames as $iso => $name) { if(isset($casinoRestrictions[$iso]))continue;?>
                <p class="mb-0 d-flex mr-1" style="width:12%" data-countryFill="<?= $iso ?>">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?= $iso; ?>" <?php $mb->the_checkbox_state($iso); ?> hidden/><a class="w-80 <?php echo $mb->get_the_checkbox_state($iso)!=null ? 'font-weight-bold':''; ?>"
                                                                                                   href="#section-<?= $iso ?>"><?= ucwords($name) ?> </a>
                </p>
            <?php } ?>
        </div>
    </div>
</div>
