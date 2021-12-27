<?php global $wpalchemy_media_access;
$prefix = 'bonus_custom_meta_';
?>
<div class="d-flex flex-wrap">
    <div class="w-100 d-flex flex-wrap justify-content-between">
        <div style="width:32%;">
            <label>Step 1 Title</label>
            <p>
                <?php $mb->the_field($prefix.'step1_1'); ?>
                <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                       value="<?php $mb->the_value(); ?>"/>
            </p>
            <label>Step 1 Description</label>
            <p>
                <?php $mb->the_field($prefix.'step1_2'); ?>
                <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                       value="<?php $mb->the_value(); ?>"/>
            </p>
        </div>
        <div style="width:32%;">
            <label>Step 2 Title</label>
            <p>
                <?php $mb->the_field($prefix.'step2_1'); ?>
                <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                       value="<?php $mb->the_value(); ?>"/>
            </p>
            <label>Step 2 Description</label>
            <p>
                <?php $mb->the_field($prefix.'step2_2'); ?>
                <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                       value="<?php $mb->the_value(); ?>"/>
            </p>
        </div>
        <div style="width:32%;">
            <label>Step 3 Title</label>
            <p>
                <?php $mb->the_field($prefix.'step3_1'); ?>
                <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                       value="<?php $mb->the_value(); ?>"/>
            </p>
            <label>Step 3 Description</label>
            <p>
                <?php $mb->the_field($prefix.'step3_2'); ?>
                <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                       value="<?php $mb->the_value(); ?>"/>
            </p>
        </div>
    </div>
</div>