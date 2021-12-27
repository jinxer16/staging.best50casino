<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';
?>
<div class="d-flex flex-wrap">
    <div class="col-6 p-3">
        <h4 class="text-white bg-primary p-1">Text for Slots</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'text_slots_link'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-6 p-3">
        <h4 class="text-white bg-primary p-1">URL for Slots</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'url_slots_link'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-6 p-3">
        <h4 class="text-white bg-primary p-1">Text for Promotions/News</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'text_offers_news_link'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-6 p-3">
        <h4 class="text-white bg-primary p-1">URL for Promotions/News</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'url_offers_news_link'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>

    <div class="col-6 p-3">
        <h4 class="text-white bg-primary p-1">Bonus Page</h4>
        <?php $bonusPages = get_all_posts('bc_bonus_page');
        asort($bonusPages);?>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'bonus_page'); ?>
            <select name="<?php $mb->the_name(); ?>">
                <option value="">None...</option>
                <?php foreach ($bonusPages as $pageID){ ?>
                    <option value="<?=$pageID?>" <?php $mb->the_select_state($pageID); ?>><?=get_the_title($pageID)?></option>
                <?php } ?>
            </select>
        </p>
    </div>
</div>