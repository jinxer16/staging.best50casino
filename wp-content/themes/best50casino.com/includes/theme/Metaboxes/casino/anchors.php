<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';
?>
<div class="d-flex flex-wrap">
    <div class="col-12 p-0">
        <h4 class="w-20 font-weight-bold mb-5p border-bottom">Comma Separated Anchors</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'anchors'); ?>
            <textarea class="w-100" type="text" rows="5" name="<?php $metabox->the_name($prefix.'anchors'); ?>" value="" placeholder="anchor1,anchor2..."><?php $metabox->the_value($prefix.'anchors'); ?></textarea>
        </p>
    </div>
    <div class="col-12 p-0">
        <h4 class="w-20 font-weight-bold mb-5p border-bottom">Comma Separated IDs</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'anchor_ids'); ?>
            <textarea class="w-100" type="text" rows="5" name="<?php $metabox->the_name($prefix.'anchor_ids'); ?>" value="" placeholder=anchor-id-1,anchor-id-1..."><?php $metabox->the_value($prefix.'anchors'); ?></textarea>
        </p>
    </div>
</div>
