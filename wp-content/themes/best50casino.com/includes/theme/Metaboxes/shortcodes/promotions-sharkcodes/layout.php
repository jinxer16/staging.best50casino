<?php global $wpalchemy_media_access;?>
<div class="d-flex flex-wrap form-table">
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Choose layout</h4>
        <?php $layout = ['sidebar' => 'Sidebar',
            'page' => 'Page',
            'power-page' => 'Power Page'];?>
        <p class="mb-0">
            <?php $mb->the_field('layout'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="layout" class="w-100">
                <?php foreach ($layout as $key=>$value){ ?>
                    <option value="<?=$key?>" <?php $mb->the_select_state($key); ?>><?=$value?></option>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Choose Bonus Category</h4>
        <?php $layout = get_terms(array(
            'taxonomy' => 'promotions-type',
            'hide_empty' => false,
        ) );
        ?>
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
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Limit</h4>
        <p class="mb-0">
            <?php $mb->the_field('limit'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" data-attribute="limit"/>
        </p>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#casino">Choose Casino</h4>
        <div class="multicheck nc_shortcode_meta_offset_csn panel-collapse collapse" id="casino" data-attribute="casino">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('casino', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
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
</div>