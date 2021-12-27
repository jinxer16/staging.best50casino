<?php global $wpalchemy_media_access; ?>
<?php
$fields = get_post_meta($post->ID, '_tabs_info_fields', true);
if (!$fields || empty($fields)) {
    $fields = ['tabName_1'];
}
?>
<div class="d-flex flex-wrap my_meta_control container">
    <div class="repeater-content w-100">
            <button class="btn btn-primary btn-sm repeater-add-btn tabs-repeater mb-1" data-type="tab">
                Add Tab
            </button>
        <div class="w-100 tab repeater-rows sortable ">
            <?php
            $i = 0;
            foreach ($fields as $field) {
                $whatIWantString = substr($field, strpos($field, "_") + 1);
                $whatIWantNumber = intval(substr($whatIWantString, 0, 1));
                ?>
                <div class="items">
                    <h4 class="w-100 bg-primary m-0 border-bottom d-flex align-items-center justify-content-between">
                        <a class="text-white p-2 d-block" data-toggle="collapse"
                           href="#details-<?= $field ?>" aria-expanded="true">Tab Content</a>
                        <?php if ($i > 0) { ?>
                            <div class="pull-right repeater-remove-btn">
                                <button class="btn btn-danger remove-btn btn-sm">
                                    Remove
                                </button>
                            </div>
                        <?php } ?>
                    </h4>
                    <div class="panel-collapse collapse show w-100" id="details-<?= $field ?>">
                        <div>
                            <div class="d-flex align-items-center p-5p mb-5p mt-5p">
                                <?php $mb->the_field($prefix . $field);
                                $metaValues = $mb->get_the_value();
                                ?>
                                <label for="<?php $mb->the_name(); ?>[title]"
                                       class="mb-0 mr-5p font-weight-bold">Title:</label>
                                <input type="text" class="w-100 father" name="<?php $mb->the_name(); ?>[title]"
                                       value="<?= $metaValues['title'] ?>"/>
                            </div>
                            <div class="d-flex align-items-center p-5p mb-5p mt-5p">
                                <?php $pages = get_pages($args); ?>
                                <label for="<?php $mb->the_name(); ?>[page]"
                                       class="mb-0 mr-5p font-weight-bold"><?php _e('Page'); ?></label>
                                <select id="<?php $mb->the_name(); ?>[page]" name="<?php $mb->the_name(); ?>[page]"
                                        class="select2-field"
                                        style="width: 100%;">
                                    <option value="">Select Page...</option>
                                    <?php foreach ($pages as $page) { ?>
                                        <option value="<?= $page->ID ?>" <?php selected($metaValues['page'], $page->ID); ?>><?= $page->post_title ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="d-flex align-items-center p-5p mb-5p mt-5p">
                                <label for="<?php $mb->the_name(); ?>[icon]"
                                       class="mb-0 mr-5p font-weight-bold"><?php _e('Icon'); ?></label>
                                <input type="text" id="<?php $mb->the_name(); ?>_icon"
                                       name="<?php $mb->the_name(); ?>[icon]"
                                       value="<?= $metaValues['icon'] ?>" class="mr-1 w-50"/>
                                <button data-dest-selector="#<?php $mb->the_name(); ?>_icon"
                                        class="w-20 btn btn-info btn-sm btn-block add-logo-button">Add Image
                                </button>
                                <div class="image-preview mr-1 col-2"
                                     id="<?php $mb->the_name(); ?>_icon_preview">
                                    <img src="<?= $metaValues['icon'] ?>" width="80" class="mr-1">
                                </div>
                            </div>
                            <h4 class="w-100 bg-secondary m-0 border-bottom d-flex align-items-center">
                                <a class="text-white p-2 d-block" data-toggle="collapse"
                                   href="#details-<?= $field ?>_subtabs" aria-expanded="true">SubTabs Content</a>
                            </h4>
                            <div class="panel-collapse collapse show w-100" id="details-<?= $field ?>_subtabs">
                                <div class=" w-100">
                                        <button class="btn btn-warning btn-sm repeater-add-btn tabs-repeater mb-1" data-type="subtab" data-id="subtab-<?= $field ?>">
                                            Add Subtab
                                        </button>
                                    <div class="w-100 d-flex subtab repeater-rows  sortable" id="subtab-<?= $field ?>">
                                        <?php $subFields = $metaValues['subfields'];
                                        if (!$subFields || empty($subFields)) {
                                            $subFields = ['subtabName_1'=>[]];
                                        }
                                        ?>
                                        <?php foreach ($subFields as $subField=>$value) { ?>
                                            <div class="col-2 items p-10p border">
                                                <div class="d-flex flex-wrap align-items-center p-5p mb-5p mt-5p">
                                                    <label for="<?php $mb->the_name(); ?>[subfields][<?= $subField ?>][title]"
                                                           class="mb-0 mr-5p font-weight-bold">Title:</label>
                                                    <input type="text" class="w-100 father"
                                                           name="<?php $mb->the_name(); ?>[subfields][<?= $subField ?>][title]"
                                                           value="<?= $metaValues['subfields'][$subField]['title'] ?>"/>
                                                </div>
                                                <div class="d-flex flex-wrap align-items-center p-5p mb-5p mt-5p">
                                                    <?php $pages = get_pages($args); ?>
                                                    <label for="<?php $mb->the_name(); ?>[subfields][<?= $subField ?>][page]"
                                                           class="mb-0 mr-5p font-weight-bold"><?php _e('Page'); ?></label>
                                                    <select id="<?php $mb->the_name(); ?>[subfields][<?= $subField ?>][page]"
                                                            name="<?php $mb->the_name(); ?>[subfields][<?= $subField ?>][page]"
                                                            class="select2-field"
                                                            style="width: 100%;">
                                                        <option value="">Select Page...</option>
                                                        <?php foreach ($pages as $page) { ?>
                                                            <option value="<?= $page->ID ?>" <?php selected($metaValues['subfields'][$subField]['page'], $page->ID); ?>><?= $page->post_title ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="w-100">OR</div>
                                                    <select id="<?php $mb->the_name(); ?>[subfields][<?= $subField ?>][sort]"
                                                            name="<?php $mb->the_name(); ?>[subfields][<?= $subField ?>][sort]"
                                                            class="select2-field"
                                                            style="width: 100%;">
                                                        <option value="">Select Sorting...</option>
                                                        <?php
                                                        $sortingOptions= [
                                                             'bs_custom_meta_promo_amount' => 'Bonus Amount',
                                                             'bs_custom_meta_bc_perc' => 'Bonus Percentage',
                                                             'bs_custom_meta_wag_b' => 'Wagering',
                                                             'bs_custom_meta_exclusive' => 'Exclusive',
                                                             'bs_custom_meta_cashback_type' => 'Cash Back',
                                                             'bs_custom_meta_nodep' => 'No Deposit',
                                                             'casino_custom_meta_com_estab' => 'Foundation Date',
                                                             'launch' => 'Launched Date',
                                                             'witspeed' => 'Withdrawal Speed',
                                                             'highrollers' => 'Highrollers',
                                                             'rating' => 'Rating',
                                                             'popular' => 'Popularity',
                                                             'casino_custom_meta_game_rat' => 'Casino Games',
                                                             'payout' => 'Payout',
                                                             'spins' => 'Free Spins',
                                                             'bonus' => 'Bonus',
                                                             'jackpot' => 'Jackpot',
                                                        ]; ?>
                                                        <?php foreach ($sortingOptions as $option=>$title) { ?>
                                                        <option value="<?=$option?>" <?php selected($metaValues['subfields'][$subField]['sort'], $option); ?>>
                                                            <?=$title?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="repeater-remove-btn w-200 mt-10p">
                                                        <button class="btn btn-danger remove-btn tabs-repeater btn-sm">
                                                            Remove
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++;
            } ?>
        </div>
    </div>
</div>