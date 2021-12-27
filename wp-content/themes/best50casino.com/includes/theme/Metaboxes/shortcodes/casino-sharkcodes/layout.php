<?php global $wpalchemy_media_access;?>
<div class="d-flex flex-wrap form-table">
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Choose Layout</h4>
        <?php $layout = [
            'default' => 'Review (3col Page)',
            'default_3' => 'Review (2col Page) ',
            'home' => 'Review (Home)',
            'default_4' => 'Bonus (3col Page)',
            'default_2' => 'Bonus (2col Page)',
            'sidebar' => 'Sidebar',
            'sidebar_3' => 'Sidebar with hover effect',
            'horizontal' => 'Horizontal',
            'line' => 'Why Play Line'];?>
        <p class="mb-0">
            <?php $mb->the_field('layout'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="layout">
                <?php foreach ($layout as $key=>$value){ ?>
                    <option value="<?=$key?>" <?php $mb->the_select_state($key); ?>><?=$value?></option>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Sort by</h4>
        <?php $layout = [
            'premium' => __('Premium on top, restricted on bottom'),
            'premium_only' => __('Premium only'),
            'popular' => __('Rating'),
            'special_popular' => __('Specific Rating'),
            'exclusive' => __('Exclusive Bonuses'),
            'new' => __('New Casino (Foundation Date)'),
            'custom' => __('Custom Sorting'),
            'random' => __('Random')];?>
        <p class="mb-0">
            <?php $mb->the_field('sort_by'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="sort_by">
                <option value="">None...</option>
                <?php foreach ($layout as $key=>$value){ ?>
                    <option value="<?=$key?>" <?php $mb->the_select_state($key); ?>><?=$value?></option>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Specific Ratings</h4>
        <?php $layout = [
            'bonuses' => __('Bonuses'),
            'software' => __('Softwares'),
            'B50quality' => __('B50quality'),
            'payout' => __('Payout Speed'),
            'fairness' => __('Fairness'),];?>
        <p class="mb-0">
            <?php $mb->the_field('specific_ratings'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="specific_ratings" class="w-100">
                <option value="">None...</option>
                <?php foreach ($layout as $key=>$value){ ?>
                    <option value="<?=$key?>" <?php $mb->the_select_state($key); ?>><?=$value?></option>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Limit</h4>
        <p class="mb-0">
            <?php $mb->the_field('limit'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" data-attribute="limit"/>
        </p>
    </div>
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Title of the table</h4>
        <p class="mb-0">
            <?php $mb->the_field('title'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" data-attribute="title"/>
        </p>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Choose Bonus Category For Tables</h4>
        <?php $layout = get_terms(array(
            'taxonomy' => 'bonus-types',
            'hide_empty' => false,
        ) );?>
        <p class="mb-0">
            <?php $mb->the_field('cat_in'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="cat_in" class="w-100">
                <option value="all">All</option>
                <?php foreach ($layout as $term){ ?>
                    <option value="<?=$term->term_id?>" <?php $mb->the_select_state($term->term_id); ?>><?=$term->name?></option>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Choose Tabs</h4>
        <?php $layout = get_all_posts('table_tabs');?>
        <p class="mb-0">
            <?php $mb->the_field('tabs_id'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="tabs_id" class="w-100">
                <option value="">Select Tab Filtering...</option>
                <?php foreach ($layout as $postID){ ?>
                    <option value="<?=$postID?>" <?php $mb->the_select_state($postID); ?>><?=get_the_title($postID)?></option>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#offset_csn">Offset Casino</h4>
        <div class="multicheck nc_shortcode_meta_offset_csn panel-collapse collapse" id="offset_csn" data-attribute="offset_csn">
            <div class="d-flex flex-wrap ">
            <?php $mb->the_field('offset_csn', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            $payments= get_all_published('kss_casino');
            asort($payments);
            foreach ($payments as $bm) { ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?= get_the_title($bm); ?></label>
                </p>
            <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#cho_csn">Chosen Casino</h4>
        <div class="multicheck nc_shortcode_meta_offset_csn panel-collapse collapse" id="cho_csn" data-attribute="cho_csn">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('cho_csn', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= get_all_published('kss_casino');
                asort($payments);
                foreach ($payments as $bm) { ?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?= get_the_title($bm); ?></label>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#custom_cas_order">Custom Casino Order</h4>
        <div id="custom_cas_order" class="panel-collapse collapse">
            <ol class="mini-sort m-0" data-attribute="custom_cas_order" style=" columns: 3;-webkit-columns: 3;-moz-columns: 3;">
                    <?php $mb->the_field('custom_cas_order'); ?>
                    <?php
                    $payments= get_all_published('kss_casino');
                    asort($payments);
                    foreach ($payments as $bm) { ?>
                        <li class="ui-state-default p-5p bg-secondary ml-7p" data-id="<?= $bm; ?>"> <?= get_the_title($bm); ?></li>
                    <?php } ?>
            </ol>
        </div>
    </div>
</div>
