<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';
$csName = WordPressSettings::getAvailableCSChannels() ?>
    <div class="d-flex flex-wrap">
<?php
foreach ($csName as $cs){ ?>
    <div class="col-4 d-flex mb-2 align-items-center">
        <label class="w-30 bg-primary m-0 border-bottom text-white p-2"><?=$cs?></label>
        <?php $mb->the_field($prefix.strtolower(str_replace(' ', '_', $cs)).'_option'); ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
        <?php $mb->the_field($prefix.strtolower(str_replace(' ', '_', $cs)).'option_det'); ?>
        <input type="text" name="<?php $mb->the_name($prefix.strtolower(str_replace(' ', '_', $cs)).'option_det'); ?>"
               value="<?php $mb->the_value($prefix.strtolower(str_replace(' ', '_', $cs)).'option_det'); ?>" class="w-80"/>
    </div>
<?php
}
?>
    </div>
