<?php
global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';
?>
 <div class="col-12 mb-2 p-0 d-flex align-items-center">
    <label class="mb-0">Hide Slots</label>
     <?php $mb->the_field($prefix.'hide_slots'); ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?>
               class="ml-1"/>
 </div>