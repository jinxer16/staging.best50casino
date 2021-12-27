<?php
global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';
?>
<div class="d-flex flex-wrap">
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">Select Template</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'template'); ?>
            <select name="<?php $mb->the_name(); ?>">
                <option value="">Old Template</option>
                <option value="new" <?php $mb->the_select_state('new'); ?>>New Template</option>
            </select>
        </p>
    </div>
</div>