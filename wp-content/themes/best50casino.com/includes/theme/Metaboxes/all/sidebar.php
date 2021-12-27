<?php global $wpalchemy_media_access;
if (!get_option('oldsettingsSetForSidebarMeta')) {
    $metaPartZ3 = ['posts_no_sidebar', 'posts_no_casino_sidebar'];

    $endCasinoMetaZ3 = [
        '_sidebar_fields' => $metaPartZ3,
    ];
    foreach (get_all_posts(['post', 'page', 'kss_guides', 'kss_casino', 'kss_slots', 'kss_news', 'kss_softwares', 'kss_transactions', 'kss_offers', 'bc_countries']) as $postID) {
        foreach ($endCasinoMetaZ3 as $key => $value) {
            $ret = update_post_meta($postID, $key, $value);
        }
    }
    update_option('oldsettingsSetForSidebarMeta', true);
}
?>
<div class="d-flex flex-wrap">
    <div class="col-12 mb-2 p-0 d-flex align-items-center">
        <label class="mb-0">2-column Layout</label>
        <?php $mb->the_field('posts_no_sidebar'); ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?>
               class="ml-1"/>
    </div>
    <div class="col-12 mb-2 p-0 d-flex align-items-center">
        <label class="mb-0">Hide Casino Table on Right Sidebar</label>
        <?php $mb->the_field('posts_no_casino_sidebar'); ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?>
               class="ml-1"/>
    </div>

    <div class="col-12 p-0 d-flex align-items-center">
        <label class="mb-0">Hide Comment Form</label>
        <?php $mb->the_field('no_comments'); ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php $mb->the_checkbox_state('1'); ?>class="ml-1"/>
    </div>
</div>