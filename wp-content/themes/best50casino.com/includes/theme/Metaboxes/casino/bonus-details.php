<?php global $wpalchemy_media_access;
$activeCountries = WordPressSettings::getCountryEnabledSettings();
$activeCountriesWithNames = WordPressSettings::getCountryEnabledSettingsWithNames();

$prefix = 'casino_custom_meta_';

$filledCountries = get_post_meta($post->ID, $prefix . 'bonus_contries_filled', true) ? get_post_meta($post->ID, $prefix . 'bonus_contries_filled', true) : [];

$casinoRestrictions = get_post_meta($post->ID,'casino_custom_meta_rest_countries',true);
$casinoRestrictions = is_array($casinoRestrictions) ? array_flip($casinoRestrictions) : [];
$casinoPayments = get_post_meta($post->ID,'casino_custom_meta_dep_options',true);
$casinoPayments = is_array($casinoPayments) ? array_flip($casinoPayments) : [];


$fieldsToRead ='';

foreach ($activeCountriesWithNames as $iso => $name) {
    if(isset($casinoRestrictions[$iso]))continue;
    $fieldsToRead .= $iso.$prefix.'exclusive'.",".$iso.$prefix.'no_bonus'.",".$iso.$prefix.'no_bonus_code'.",".$iso.$prefix.'_is_free_spins'.",".$iso.$prefix.'_is_no_dep'.",".$iso.$prefix.'_is_vip'.",".
        $iso.$prefix.'bonus_type'.",".$iso.$prefix.'spins_type'.",".$iso.$prefix.'cashback_type'.",".$iso.$prefix.'min_dep'.",".$iso.$prefix.'sp_terms'.",".$iso.$prefix.'no_depo'.",".
        $iso.$prefix.'bc_code'.",".$iso.$prefix.'cta_for_top'.",".$iso.$prefix.'cta_for_top_2'.",".$iso.$prefix.'bc_perc'.",".$iso.$prefix .'wag_b'.",".$iso.$prefix.'wag_d'.",".$iso.$prefix.'wag_s'.",".$iso.$prefix.'bonus_types';
}

$pieces = explode(",", $fieldsToRead);

array_push($pieces, $prefix."bonus_contries_filled");
//$doupdate = [$fieldsToRead];
$fieldsToUpdate = ['exclusive','no_bonus','no_bonus_code','_is_free_spins','_is_no_dep','_is_vip','promo_code', 'bonus_type','spins_type','cashback_type','min_dep','no_depo','sp_terms','bc_code','cta_for_top','cta_for_top_2','bc_perc','wag_b','wag_d', 'wag_s','bonus_contries_filled'];
if (!get_option('bonusMeAddLasts')) {
$prefixbonus = 'bs_custom_meta_';
foreach (get_all_posts('kss_casino') as $postID) {

    update_post_meta($postID, '_casino_bonus_details_fields', $pieces);

    foreach ($activeCountriesWithNames as $iso => $name) {
        $casinoRestrictionsOff = get_post_meta($postID,'casino_custom_meta_rest_countries',true);
        $casinoRestrictionsOff = is_array($casinoRestrictionsOff) ? array_flip($casinoRestrictionsOff) : [];
        if (isset($casinoRestrictionsOff[$iso])) continue;
        $bonusPage = get_post_meta($postID, 'casino_custom_meta_bonus_page', true);
        $bonusid = get_post_meta($bonusPage, 'bonus_custom_meta_bonus_offer', true);
        if ($bonusid) {
            foreach ($fieldsToUpdate as $fields) {
                if($fields === 'bonus_contries_filled'){
                    $value = get_post_meta($bonusid, $prefixbonus.$fields, true);
                    update_post_meta($postID, $prefix.$fields, $value);
                }else{
                    $value = get_post_meta($bonusid, $iso.$prefixbonus.$fields, true);
                    update_post_meta($postID, $iso.$prefix .$fields, $value);
                }
            }
        }
    }
}
    update_option('bonusMeAddLasts', true);
}
?>
<div class="d-flex flex-wrap">
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
                    <div class="col-2 p-3 d-flex align-items-center">
                        <label class="mb-0">Exclusive</label>
                        <?php $mb->the_field($iso . $prefix . 'exclusive'); ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
                        <!--            --><?php //wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'sl_ga', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
                    </div>
                    <div class="col-2 p-3 d-flex align-items-center">
                        <label class="mb-0">No Bonus</label>
                        <?php $mb->the_field($iso . $prefix . 'no_bonus'); ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>" id="no_bonus" onclick="noBonus(this,'nobonus','<?echo $iso;?>')"
                               value="1"<?php $mb->the_checkbox_state('1'); ?> class="ml-1"/>
                        <!--            --><?php //wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'sl_ga', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
                    </div>
                    <div class="col-2 p-3 d-flex align-items-center">
                        <label class="mb-0">No Bonus Code</label>
                        <?php $mb->the_field($iso . $prefix . 'no_bonus_code'); ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>" id="no_bonus_code" onclick="noPromoCode(this,'nopromocode','<?echo $iso;?>')"
                               value="1"<?php $mb->the_checkbox_state('1'); ?> class="ml-1"/>
                        <!--            --><?php //wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'sl_ga', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
                    </div>

                    <div class="col-2 p-3 d-flex align-items-center">
                        <label class="mb-0">Mobile Bonus</label>
                        <?php $mb->the_field($iso . $prefix . '_is_mobile_bonus'); ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
                    </div>
                    <div class="col-2 p-3 d-flex align-items-center">
                        <label class="mb-0">Welcome Bonus</label>
                        <?php $mb->the_field($iso . $prefix . '_is_welcome_bonus'); ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
                    </div>
                    <div class="col-2 p-3 d-flex align-items-center">
                        <label class="mb-0">Reload Bonus</label>
                        <?php $mb->the_field($iso . $prefix . '_is_reload_bonus'); ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
                    </div>
                    <div class="col-2 p-3 d-flex align-items-center">
                        <label class="mb-0">Live Casino Bonus</label>
                        <?php $mb->the_field($iso . $prefix . '_is_live_bonus'); ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
                    </div>

                    <div class="col-2 p-3 d-flex align-items-center">
                        <label class="mb-0">Free Spins</label>
                        <?php $mb->the_field($iso . $prefix . '_is_free_spins'); ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
                        <!--            --><?php //wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'sl_ga', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
                    </div>
                    <div class="col-2 p-3 d-flex align-items-center">
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

                    <div class="col-2 p-3 d-flex align-items-baseline">
                        <label class="mb-0 mr-1">No Deposit</label>
                        <p class="mb-0">
                            <?php $mb->the_field($iso . $prefix . 'nodep'); ?>
                            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-" value="<?php $mb->the_value(); ?>"/>
                            <i>Only for sorting Casino Shortcodes and Tab functionality</i>
                        </p>
                    </div>

                    <div class="col-3 p-3 d-flex align-items-baseline">
                        <label class="mb-0 mr-1">Minimum Deposit</label>
                        <p class="mb-0">
                            <?php $mb->the_field($iso . $prefix . 'min_dep'); ?>
                            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-" value="<?php $mb->the_value(); ?>"/>
                            <i></i>
                        </p>
                    </div>

                    <div class="col-3 p-3 d-flex align-items-baseline">
                        <label class="mb-0 mr-1">T&C's</label>
                        <p class="mb-0">
                            <?php $mb->the_field($iso . $prefix . 'sp_terms'); ?>
                            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-" value="<?php $mb->the_value(); ?>"/>
                            <i></i>
                        </p>
                    </div>


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
                            <input class=" w-100" type="text" name="<?php $mb->the_name(); ?>" data-default="-" data-required="true"
                                   value="<?php $mb->the_value(); ?>"/>
                            <i>100% up to $500</i>
                        </p>
                    </div>

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
                </div>
            </div>
        </div>
    <?php }
    ?>
    <div class="col-12 p-0">
        <h4 class="bg-secondary p-1">Bonus Countries Filled</h4>
        <div class="d-flex flex-wrap countries-filled-wrap">
            <?php $mb->the_field($prefix.'bonus_contries_filled', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
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
