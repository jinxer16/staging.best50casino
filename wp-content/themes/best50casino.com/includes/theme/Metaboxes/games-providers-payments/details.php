<?php global $wpalchemy_media_access;
$activeCountriesWithNames = WordPressSettings::getCountryEnabledSettingsWithNames();
switch ($post->post_type) {
    case 'kss_games':
        $prefix = 'games_custom_meta_';
        $meta_id = 'games_main_casino';
        break;
    case 'kss_softwares':
        $prefix = 'software_custom_meta_';
        $meta_id = 'main_casino';
        break;
    case 'kss_transactions':
        $prefix = 'transactions_custom_meta_';
        $meta_id = 'main_casino';
        break;
}
if (!get_option('oldsettingsSetForStuffMeta')) {
    foreach ($activeCountriesWithNames as $iso => $name) {
        $metaPartZ3[] = $iso . $prefix . $meta_id;
    }
    $endCasinoMetaZ3 = [
        '_promo_casino_meta_fields' => $metaPartZ3,
    ];
    foreach (get_all_posts($post->post_type) as $postID) {
        foreach ($endCasinoMetaZ3 as $key => $value) {
            $ret = update_post_meta($postID, $key, $value);
        }
        foreach ($activeCountriesWithNames as $iso => $name) {
            $casinooo = get_post_meta($postID, $iso . $prefix . $meta_id, true);
            if ($casinooo && !is_numeric($casinooo)) {
                $page = get_page_by_title($casinooo, OBJECT, 'kss_casino');
                update_post_meta($postID, $iso . $prefix . $meta_id, $page->ID);
            }
        }
    }
    update_option('oldsettingsSetForStuffMeta', true);
}

?>
<div class="d-flex flex-wrap">
    <?php
    foreach ($activeCountriesWithNames as $iso => $name) { ?>
        <div class="col-4 p-3">
            <h4 class="mb-1"><img src="<?= get_template_directory_uri() . '/assets/flags/' . $iso ?>.svg" width="20"
                                  class="ml-1 mr-1"> Casino for <?= ucwords($name) ?></h4>
            <p class="mb-0">
                <?php
                $casinos = get_all_valid_casino($iso);
                $mb->the_field($iso . $prefix . $meta_id);
                $style = get_post_meta($post->ID, $iso . $prefix . $meta_id, true) ? 'style="background:#a8dba4;"' : '';
                ?>
                <select name="<?php $mb->the_name(); ?>" <?= $style ?>>
                    <option value="">None...</option>
                    <?php foreach ($casinos as $casinoID) { ?>
                        <option value="<?= $casinoID ?>" <?php $mb->the_select_state($casinoID); ?>><?= get_the_title($casinoID) ?></option>
                    <?php } ?>
                </select>
            </p>
        </div>
        <?php
    }
    ?>
</div>
