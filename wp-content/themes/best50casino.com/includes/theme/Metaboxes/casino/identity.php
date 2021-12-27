<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';
if(!get_option('LicenseCasinoDataArrange')){
    foreach(get_all_posts() as $casinoID){
        $newMeta=[];
        $lic = get_post_meta($casinoID,'casino_custom_meta_license_country',true);
        if(is_array($lic)){
            foreach($lic as $li){
                if($li && !is_numeric($li)){
                    $page = get_page_by_title($li, OBJECT, 'license');
                    $newMeta[]=$page->ID;
                }
            }
        }
        if(!empty($newMeta)){update_post_meta($casinoID,'casino_custom_meta_license_country',$newMeta);}
    }
    update_option('LicenseCasinoDataArrange',true);
}
?>
<div class="d-flex flex-wrap">
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Website</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'com_url'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Owner</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'com_off_name'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Address</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'com_head'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Established</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'com_estab'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">CS Hours</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'comun_hours'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">Licensed in</h4>
        <div class="d-flex flex-wrap">
            <?php $mb->the_field($prefix.'license_country', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            $licenses = get_all_posts('license');
            foreach ($licenses as $bm) { ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?= get_the_title($bm); ?></label>
                </p>
            <?php } ?>

        </div>
    </div>
</div>
