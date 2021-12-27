<?php global $wpalchemy_media_access; ?>

<div class="d-flex flex-wrap">
    <?php $mb->the_field('meta_result'); ?>
    <input type="text" id="meta_result" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
</div>
<?php
