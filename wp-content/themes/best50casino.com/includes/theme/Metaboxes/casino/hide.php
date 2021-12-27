<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_'; ?>
<div class="d-flex flex-wrap">

    <div class="col-12 d-flex flex-wrap mb-2 align-items-center">
        <label class="w-50 m-0">Hidden</label>

        <?php $mb->the_field($prefix.'hidden'); ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php $mb->the_checkbox_state('1'); ?> class="ml-1"/>
        <i class="w-100">Check to hide casino from shortcode tables</i>
    </div>
    <div class="col-6 d-flex flex-wrap mb-2 align-items-center">
        <label class="w-50 m-0">Flagged</label>
        <?php $mb->the_field($prefix.'flaged'); ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php $mb->the_checkbox_state('1'); ?> class="ml-1"/>
        <i class="w-100">Check to hide casino from shortcode tables. Το be used when the aff account is not active</i>
    </div>
    </div>