<?php global $wpalchemy_media_access;
if (!get_option('oldsettingsSetForSidebarMeta')) {
    $metaPartZ3 = ['in_page_game_script'];

    $endCasinoMetaZ3 = [
        '_sidebar_fields' => $metaPartZ3,
    ];
    foreach (get_all_posts(['post', 'page', 'kss_guides', 'kss_offers', 'kss_news']) as $postID) {
        foreach ($endCasinoMetaZ3 as $key => $value) {
            $ret = update_post_meta($postID, $key, $value);
        }
    }
    update_option('oldsettingsSetForSidebarMeta', true);
}
?>
<div class="d-flex flex-wrap">
    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom text-white p-1">Game Script</h4>
        <i>Game Script that shows at the end of the content (pages, posts, guides, news, promotions)</i>
        <div class="">
            <?php $mb->the_field('in_page_game_script'); ?>
            <textarea class="w-100" type="text" rows="5" name="<?php $mb->the_name(); ?>" value=""><?php $mb->the_value(); ?></textarea>
        </div>
    </div>
</div>