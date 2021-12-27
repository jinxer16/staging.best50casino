<?php global $wpalchemy_media_access;
$prefix = 'promo_custom_meta_';
if (!get_option('oldsettingsSetForOffersMeta')) {
    $metaPartZ3 = [$prefix . 'promo_content',$prefix . 'cta',$prefix . 'cta_aff',
        $prefix . 'end_offer',$prefix .'valid_on',$prefix . 'promo_custom_meta_valid_all',
        $prefix . 'casino_offer',$prefix . 'tcs',$prefix . 'stick_side',
        $prefix . 'stick_page'
        ];

    $endCasinoMetaZ3 = [
        '_offers_details_meta_fields'=>$metaPartZ3,
    ];
    foreach (get_all_posts('bc_offers') as $postID) {
        foreach ($endCasinoMetaZ3 as $key=>$value){
            $ret = update_post_meta($postID,$key,$value);
        }
        $casino = get_post_meta($postID,$prefix.'casino_offer',true);
        if($casino && !is_numeric($casino)) {
            $page = get_page_by_title($casino, OBJECT, 'kss_casino');
            update_post_meta($postID, $prefix . 'casino_offer', $page->ID);
        }
    }
    update_option('oldsettingsSetForOffersMeta', true);
}
?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri()?>/includes/plugins/datetime/jquery.datetimepicker.full.min.js"></script>
<link rel='stylesheet' href="<?php echo get_stylesheet_directory_uri()?>/includes/plugins/datetime/jquery.datetimepicker.min.css"/>
<div class="d-flex flex-wrap">
    <div class="col-12 p-0">
        <h4 class="text-white bg-primary p-1">Content</h4>
        <?php $mb->the_field($prefix.'promo_content'); ?>
        <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'promo_content', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
    </div>
    <div class="col-5 p-1">
        <label class="mb-0">CTA</label>
        <?php $mb->the_field($prefix.'cta'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-5 p-1">
        <label class="mb-0">CTA URL</label>
        <?php $mb->the_field($prefix.'cta_aff'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
        <i>Custom else Default : aff </i>
    </div>

    <div class="col-2 p-1">
        <label class="mb-0">Casino</label>
        <p class="mb-0">
            <?php
            $casinos = get_all_valid_casino();
            $mb->the_field( $prefix . 'casino_offer');
            ?>
            <select name="<?php $mb->the_name(); ?>">
                <option value="">None...</option>
                <?php foreach ($casinos as $casinoID){ ?>
                    <option value="<?php echo $casinoID?>" <?php $mb->the_select_state($casinoID); ?>><?php echo get_the_title($casinoID)?></option>
                <?php } ?>
            </select>
        </p>
    </div>


    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer">Visible only at</h4>
            <div class="d-flex flex-wrap ">
                <p>
                    <?php
                    $countries = WordPressSettings::getCountryEnabledSettingsWithNames();
                    asort($countries);
                    unset($countries['-']);
                    $mb->the_field('validat', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI
                    foreach ($countries as $country_id => $country_name) {
                        $book = get_post_meta($post->ID,'promo_custom_meta_casino_offer',true);
                        $bookRestrictions = get_post_meta($book,'casino_custom_meta_rest_countries',true);
                        $bookRestrictions = is_array($bookRestrictions) ? array_flip($bookRestrictions) : [];
                        if(isset($bookRestrictions[$country_id])) continue; // Checks --- Book Restrictions
                        ?>
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?php echo  $country_id; ?>" <?php $mb->the_checkbox_state($country_id); ?>/><?php echo  ucwords($country_name); ?>
                    <?php } ?>
                </p>
            </div>
    </div>

    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer">Restricted at</h4>
        <div class="d-flex flex-wrap ">
            <p>
                <?php
                $mb->the_field('restrictedat', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI
                foreach ($countries as $country_id => $country_name) {
                    $book = get_post_meta($post->ID,'promo_custom_meta_casino_offer',true);
                    $bookRestrictions = get_post_meta($book,'casino_custom_meta_rest_countries',true);
                    $bookRestrictions = is_array($bookRestrictions) ? array_flip($bookRestrictions) : [];
                    if(isset($bookRestrictions[$country_id])) continue; // Checks --- Book Restrictions
                    ?>
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?php echo  $country_id; ?>" <?php $mb->the_checkbox_state($country_id); ?>/><?php echo  ucwords($country_name); ?>
                <?php } ?>
            </p>
        </div>
    </div>


    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#slots">Slots</h4>
        <div class="multicheck panel-collapse collapse" id="slots">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('slots', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= get_all_published('kss_slots');
                asort($payments);
                foreach ($payments as $bm) { ?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?php echo  $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?php echo  get_the_title($bm); ?></label>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-3 p-1">
        <label class="mb-0">End Time</label>
        <?php $mb->the_field($prefix.'end_offer'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100 event-date-id"/>
    </div>
    <div class="col-7 p-3">
        <h4 class="text-white bg-primary p-1">Days Valid (Choose at least One)</h4>
        <div class="d-flex flex-wrap">
            <?php $mb->the_field($prefix.'valid_on', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            $RNGs= ['Monday' => __('Monday'),
                'Tuesday' => __('Tuesday'),
                'Wednesday' => __('Wednesday'),
                'Thursday' => __('Thursday'),
                'Friday' => __('Friday'),
                'Saturday' => __('Saturday'),
                'Sunday' => __('Sunday'),];
            foreach ($RNGs as $key=>$value) { ?>
                <p class="mb-0 d-flex mr-1" style="width:13%">
                    <input type="checkbox" id="promo_custom_meta_valid_on" name="<?php $mb->the_name(); ?>"
                           value="<?php echo $key?>" <?php $mb->the_checkbox_state($key); ?>/><label class="w-80"><?php echo $value?></label>
                </p>
            <?php } ?>
        </div>
    </div>
    <div class="col-2 p-0 d-flex align-items-center">
        <label class="mb-0">All Days Valid</label>
        <?php $mb->the_field('promo_custom_meta_valid_all'); ?>
        <input type="checkbox" id="<?php echo 'promo_custom_meta_valid_all'?>" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom text-white p-1">TCs</h4>
        <div class="">
            <?php $mb->the_field($prefix.'tcs'); ?>
            <textarea class="w-100" type="text" rows="5" name="<?php $mb->the_name(); ?>" value=""><?php $mb->the_value(); ?></textarea>
        </div>
    </div>

    <div class="col-12 p-2 d-flex align-items-center">
        <label class="mb-0">Exclusive</label>
        <?php $mb->the_field('offer_exclusive'); ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>

    <div class="col-12 p-2 d-flex align-items-center">
        <label class="mb-0">Sticky on Casino's Bonus Page</label>
        <?php $mb->the_field($prefix.'stick_page'); ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
</div>
<script>
    jQuery(document).ready( function($) {
        jQuery('#promo_custom_meta_valid_all').click(function($){
            if (jQuery(this).is(':checked')){
                jQuery('input#promo_custom_meta_valid_on').each(function( index ) {
                    jQuery(this).prop('checked', true);
                });
            }else{
                jQuery('input#promo_custom_meta_valid_on').each(function( index ) {
                    jQuery(this).prop('checked', false);
                });
            }

        });

        jQuery('.event-date-id').datetimepicker({
            allowTimes: [
                '00:59', '01:59', '02:59', '03:59', '04:59', '05:59', '06:59', '07:59',
                '08:59', '09:59', '10:59', '11:59', '12:59', '13:59', '14:59', '15:59',
                '16:59', '17:59', '18:59', '19:59', '20:59', '21:59', '22:59', '23:59',
            ],
            format: 'Y-m-d H:i'
        });


        // jQuery(function($) {
        //     jQuery( ".event-date-id" ).datepicker({ dateFormat: 'yy-mm-dd' });
        //     // jQuery( ".event-date-id" ).datepicker({ dateFormat: 'dd-mm-yy' });
        // });
        // jQuery("input.event-date-id").on("keyup change", function(){
        //     var a = prompt("Enter the time as hh:mm", "23:59");
        //     var date = jQuery(this).val();
        //     jQuery("input.event-date-id").val(date + " " + a)
        // });
    });

</script>
