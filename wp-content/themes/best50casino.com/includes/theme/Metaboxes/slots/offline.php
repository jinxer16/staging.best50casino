<?php global $wpalchemy_media_access;
$prefix = 'slot_custom_meta_';

$metaPartZ3 = [$prefix . 'slot_offline'];

$endCasinoMetaZ3 = [
    '_slot_offline_meta_fields'=>$metaPartZ3,
];
foreach (get_all_posts('kss_slots') as $postID) {
    foreach ($endCasinoMetaZ3 as $key=>$value){
        $ret = update_post_meta($postID,$key,$value);
    }
}
?>
<div class="d-flex flex-wrap">
    <div>
        <label class="mb-0">Offline</label>
        <?php $mb->the_field($prefix.'slot_offline'); ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
</div>
