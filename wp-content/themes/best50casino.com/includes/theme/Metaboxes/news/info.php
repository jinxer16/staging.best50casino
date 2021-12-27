<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';
if (!get_option('oldsettingsSetForNewsMeta')) {
    $metaPartZ3 = [$prefix . 'casino_offer', $prefix . 'promote_offer'];

    $endCasinoMetaZ3 = [
        '_news_details_meta_fields' => $metaPartZ3,
    ];
    foreach (get_all_posts('kss_news') as $postID) {
        foreach ($endCasinoMetaZ3 as $key => $value) {
            $ret = update_post_meta($postID, $key, $value);
        }
    }
    update_option('oldsettingsSetForNewsMeta', true);
}
?>
<div class="d-flex flex-wrap">
    <div class="col-6 p-0 d-flex align-items-center">
        <label class="mb-0">Promote News</label>
        <?php $mb->the_field($prefix . 'promote_offer'); ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?>
               class="ml-1"/>
    </div>
    <div class="col-6 p-3">
        <h4 class="mb-1">Casino</h4>
        <p class="mb-0">
            <?php
            $casinos = get_all_valid_casino();
            $mb->the_field($prefix . 'casino_offer');
            ?>
            <select name="<?php $mb->the_name(); ?>">
                <option value="">None...</option>
                <?php foreach ($casinos as $casinoID) { ?>
                    <option value="<?= $casinoID ?>" <?php $mb->the_select_state($casinoID); ?>><?= get_the_title($casinoID) ?></option>
                <?php } ?>
            </select>
        </p>
    </div>
</div>