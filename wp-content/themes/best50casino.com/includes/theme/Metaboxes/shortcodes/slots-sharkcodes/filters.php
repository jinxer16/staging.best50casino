<?php global $wpalchemy_media_access;?>
<div class="d-flex flex-wrap form-table">
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#platform">Providers</h4>
        <div class="multicheck panel-collapse collapse" id="platform" data-attribute="platform">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('platform', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= get_all_posts('kss_softwares');
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
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#casino">You Can Play it on AND on: (Choose Casino)</h4>
        <div class="multicheck panel-collapse collapse" id="casino" data-attribute="casino">
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
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#slot_category">Slot Category</h4>
        <div class="multicheck panel-collapse collapse" id="slot_category" data-attribute="slot_category">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('slot_category', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= ['classic' => 'Classic', 'video' => 'Video', 'progressive' => 'Progressive', '3d' => '3D'];
                foreach ($payments as $bm=>$value) { ?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?=$value?></label>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#themes">Themes</h4>
        <div class="multicheck panel-collapse collapse" id="themes" data-attribute="themes">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('themes', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= WordPressSettings::getSlotThemes();
                foreach ($payments as $bm=>$value) { ?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?=$value?></label>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-3 p-3">
        <h4 class="text-white bg-primary p-1">Label</h4>
        <?php $layout = [ 'NEW' => 'NEW', 'LEGEND' => 'LEGEND', 'BEST' => 'BEST', 'Default' => 'Default'];?>
        <div class="mb-0 d-flex multicheck" data-attribute="label">
            <?php $mb->the_field('label', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
            <?php foreach ($layout as $key=>$value){ ?>
                <p class="mb-1 d-flex mr-1 w-25" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?=$key?>" <?php $mb->the_checkbox_state($key);?>/><label class="w-80"><?=$value?></label>
                </p>
            <?php } ?>
        </div>
    </div>
    <div class="col-1 p-3">
        <h4 class="text-white bg-primary p-1">Reels</h4>
        <?php $layout = ['3' =>'3', '5' => '5'];?>
        <p class="mb-0">
            <?php $mb->the_field('reels'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="reels">
                <option value="">None...</option>
                <?php foreach ($layout as $key=>$value){ ?>
                    <option value="<?=$key?>" <?php $mb->the_select_state($key); ?>><?=$value?></option>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Paylines</h4>
        <?php $layout = [ '1-10' => '1-10',
            '15' => '15',
            '20' => '20',
            '25' => '25',
            '30-100' => '30-100',
            '243' => '243',
            '1024' => '1024'];
        ?>
        <select class="mb-0 d-flex" data-attribute="paylines">
            <option value="">None...</option>
            <?php $mb->the_field('paylines'); ?>
            <?php foreach ($layout as $key=>$value){ ?>
                    <option value="<?=$key?>" <?php $mb->the_select_state($key); ?>><?=$value?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">RTP</h4>
        <?php $layout = [ '98' => '98+', '96' => '96+', '94' => '94+', '90' => '90+'];?>
        <select class="mb-0 d-flex" data-attribute="rtp">
            <option value="">None...</option>
            <?php $mb->the_field('rtp'); ?>
            <?php foreach ($layout as $key=>$value){ ?>
                <option value="<?=$key?>" <?php $mb->the_select_state($key); ?>><?=$value?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Offset</h4>
        <p class="mb-0">
            <?php $mb->the_field('slot_offset'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" data-attribute="slot_offset"/>
        </p>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#slot_not_in">Exclude Slots:</h4>
        <div class="multicheck panel-collapse collapse" id="slot_not_in" data-attribute="slot_not_in">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('slot_not_in', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= get_all_published('kss_slots');
                foreach ($payments as $bm) { ?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?=get_the_title($bm)?></label>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#slot_in">Include Slots:</h4>
        <div class="multicheck panel-collapse collapse" id="slot_in" data-attribute="slot_in">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('slot_in', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= get_all_published('kss_slots');
                foreach ($payments as $bm) { ?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?=get_the_title($bm)?></label>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>