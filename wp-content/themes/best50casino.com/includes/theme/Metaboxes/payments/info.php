<?php global $wpalchemy_media_access;
$prefix = 'transactions_custom_meta_';
//if (!get_option('oldsettingsSetForPayMeta') && get_option('oldsettingsSetForPayMeta') !=false) {
//    $metaPartZ3 = [$prefix . 'withd_rating',$prefix . 'depos_rating',$prefix . 'seo_title'];
//
//    $endCasinoMetaZ3 = [
//        '_transactions_info_meta_fields'=>$metaPartZ3,
//    ];
//    foreach (get_all_posts('kss_transactions') as $postID) {
//        foreach ($endCasinoMetaZ3 as $key=>$value){
//            $ret = update_post_meta($postID,$key,$value);
//        }
//    }
//    update_option('oldsettingsSetForPayMeta', true);
//}
?>
<div class="d-flex flex-wrap">
    <div class="col-4 p-1">
        <label class="mb-0">Withdraw Rating</label>
        <?php $mb->the_field($prefix.'withd_rating'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-4 p-1">
        <label class="mb-0">Deposit Rating</label>
        <?php $mb->the_field($prefix.'depos_rating'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-4 p-1">
        <label class="mb-0">SEO Title</label>
        <?php $mb->the_field($prefix.'seo_title'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value($prefix.'seo_title'); ?>" class="mr-1 w-100"/>
    </div>
</div>