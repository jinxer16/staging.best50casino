<?php global $wpalchemy_media_access;?>
<div class="d-flex flex-wrap form-table">
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Table Layout</h4>
        <?php $layout = [
            'default' => 'Default (with filters)',
            'sample' => 'Sample (with title)',
//            'sidebar' => 'Sidebar',
            'power-page' => 'Power Page (no filters)'];?>
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
        <?php $layout = ['default' =>'Default', 'random' => 'Random', 'popular' => 'Popular','rtp'=>'RTP'];?>
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
        <h4 class="text-white bg-primary p-1">Slots per Row</h4>
        <?php $layout = ['normal' => '3', 'small' => '4'];?>
        <p class="mb-0">
            <?php $mb->the_field('break'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="break">
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
        <h4 class="text-white bg-primary p-1">Table Title</h4>
        <p class="mb-0">
            <?php $mb->the_field('title'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" data-attribute="title"/>
        </p>
    </div>
</div>