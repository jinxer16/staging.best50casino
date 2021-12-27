<?php global $wpalchemy_media_access;?>
<div class="d-flex flex-wrap form-table">
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Title of 3rd Column</h4>
        <p class="mb-0">
            <?php $mb->the_field('3rd_col_title'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" data-attribute="3rd_col_title"/>
        </p>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">3rd Column Text</h4>
        <?php $layout = [
            'rtp' => 'Best Payout',
            'fast_payout' => 'Fastest Payout',
            'year' => 'Year of Establishment',
            'license' => 'License',
            'url' => 'URL',
            'cs' => 'CS Channels',
            'live' => 'Live Casino Games'];?>
        <p class="mb-0">
            <?php $mb->the_field('3rd_column'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="3rd_column" class="w-100">
                <option value="">None...</option>
                <?php foreach ($layout as $key=>$value){ ?>
                    <option value="<?=$key?>" <?php $mb->the_select_state($key); ?>><?=$value?></option>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">3rd Column Icons</h4>
        <?php $layout = [
            'fast_payout' => 'Fastest Payout',
            'safe' => 'Safe Casino',
            'apps' => 'Mobile Apps',
            'dep' => 'Deposit Methods',
            'wit' => 'Withdrawal Methods',
            'prov' => 'Providers',
            'lv_prov' => 'Live Providers',
            'lang' => 'Website languages'];?>
        <p class="mb-0">
            <?php $mb->the_field('3rd_column_icons'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="3rd_column_icons" class="w-100">
                <option value="">None...</option>
                <?php foreach ($layout as $key=>$value){ ?>
                    <option value="<?=$key?>" <?php $mb->the_select_state($key); ?>><?=$value?></option>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#pay_order">Payment Methods Order</h4>
        <div id="pay_order"  class="panel-collapse collapse">
        <ol  class="mini-sort m-0" data-attribute="pay_order" style=" columns: 3;-webkit-columns: 3;-moz-columns: 3;">
            <?php $mb->the_field('pay_order'); ?>
            <?php
            $payments= get_all_posts('kss_transactions');
            asort($payments);
            foreach ($payments as $bm) { ?>
                <li class="ui-state-default p-5p bg-secondary ml-7p" data-id="<?= $bm; ?>"> <?= get_the_title($bm); ?></li>
            <?php } ?>
        </ol>
        </div>
    </div>
</div>