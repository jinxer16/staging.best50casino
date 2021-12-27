<?php global $wpalchemy_media_access;?>
<div class="d-flex flex-wrap form-table">
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Title of 2nd Column</h4>
        <p class="mb-0">
            <?php $mb->the_field('2nd_col_title'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" data-attribute="2nd_col_title"/>
        </p>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">2nd Column List</h4>
        <?php $layout = [
            'bonus' => 'Including Bonus List',
            'why' => 'Why Play List',];?>
        <p class="mb-0">
            <?php $mb->the_field('2nd_column_list'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="2nd_column_list" class="w-100">
                <option value="">None...</option>
                <?php foreach ($layout as $key=>$value){ ?>
                    <option value="<?=$key?>" <?php $mb->the_select_state($key); ?>><?=$value?></option>
                <?php } ?>
            </select>
        </p>
    </div>
</div>