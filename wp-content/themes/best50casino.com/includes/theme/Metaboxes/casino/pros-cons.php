<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';
?>
<div class="d-flex flex-wrap">

    <div class="col-4 p-3">
        <label class="mb-0">Pros</label>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'pros'); ?>
            <textarea class="w-100" type="text" rows="5" name="<?php $metabox->the_name($prefix.'pros'); ?>" value=""><?php $metabox->the_value($prefix.'pros'); ?></textarea>
        </p>
    </div>
    <div class="col-4 p-3">
        <label class="mb-0">Cons</label>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'why_not_play'); ?>
            <textarea class="w-100" type="text" rows="5" name="<?php $metabox->the_name($prefix.'why_not_play'); ?>" value=""><?php $metabox->the_value($prefix.'why_not_play'); ?></textarea>
        </p>
    </div>