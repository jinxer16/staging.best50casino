<?php global $wpalchemy_media_access;?>
<div class="d-flex flex-wrap form-table">
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Choose Bonus Category Filter</h4>
        <?php $layout = get_terms(array(
            'taxonomy' => 'bonus-types',
            'hide_empty' => false,
        ) );?>
        <p class="mb-0">
            <?php $mb->the_field('cat_in_filter'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="cat_in" class="w-100">
                <option value="">All</option>
                <option value="exclusive">Exclusive</option>
                <?php foreach ($layout as $term){ ?>
                    <option value="<?=$term->term_id?>" <?php $mb->the_select_state($term->term_id); ?>><?=$term->name?></option>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Choose Audit</h4>
        <?php $layout = [
            'ecogra' => 'eCogra',
            'tst' => 'TST',
            'gli' => 'GLI',
            'itech-labs' => 'iTech Labs'
        ];?>
        <div class="mb-0 d-flex multicheck" data-attribute="audit">
            <?php $mb->the_field('audit', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
                <?php foreach ($layout as $key=>$value){ ?>
                    <p class="mb-1 d-flex mr-1 w-25" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?=$key?>" <?php $mb->the_checkbox_state($key);?>/><label class="w-80"><?=$value?></label>
                    </p>
                <?php } ?>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#software">Providers</h4>
        <div class="multicheck panel-collapse collapse" id="software" data-attribute="software">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('software', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
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
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#live_software">Live Providers</h4>
        <div class="multicheck panel-collapse collapse" id="live_software" data-attribute="live_software">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('live_software', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                foreach ($payments as $bm) {
                    if (get_post_meta($bm,'software_custom_meta_livecasino', true)) { ?>
                        <p class="mb-1 d-flex mr-1" style="width:12%">
                            <input type="checkbox" name="<?php $mb->the_name(); ?>"
                                   value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label
                                class="w-80"><?= get_the_title($bm); ?></label>
                        </p>
                        <?php
                    }
                } ?>
            </div>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#deposit">Deposit Methods</h4>
        <div class="multicheck panel-collapse collapse" id="deposit" data-attribute="deposit">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('deposit', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= get_all_posts(['kss_transactions','kss_crypto']);
                asort($payments);
                foreach ($payments as $bm) { ?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label
                            class="w-80"><?= get_the_title($bm); ?></label>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#withdraw">Withdrawal Methods</h4>
        <div class="multicheck panel-collapse collapse" id="withdraw" data-attribute="withdraw">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('withdraw', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= get_all_posts(['kss_transactions','kss_crypto']);
                asort($payments);
                foreach ($payments as $bm) { ?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label
                            class="w-80"><?= get_the_title($bm); ?></label>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Live Casino</h4>
        <div class="mb-1 d-flex mr-1 align-items-center">
            <?php $mb->the_field('live_video'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="on" <?php $mb->the_checkbox_state('on');?>  data-attribute="live_video" class="checkbox"/><label class="w-80">Live Casino</label>

        </div>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Mobile App</h4>
        <div class="mb-1 d-flex mr-1 align-items-center">
            <?php $mb->the_field('mobile'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>"
                   value="on" <?php $mb->the_checkbox_state('on');?>  data-attribute="mobile" class="checkbox"/><label class="w-80">Mobile App</label>

        </div>
    </div>
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Mobile Platforms</h4>
        <?php $layout = [
            'android' => 'Android',
            'apple' => 'iPhone',
            'windows' => 'Windows Phone',
            'windows' => 'Windows App'
        ];?>
        <div class="mb-0 d-flex multicheck" data-attribute="mob_plat">
            <?php $mb->the_field('mob_plat', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
            <?php foreach ($layout as $key=>$value){ ?>
                <p class="mb-1 d-flex mr-1 w-33" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?=$key?>" <?php $mb->the_checkbox_state($key);?>/><label class="w-80"><?=$value?></label>
                </p>
            <?php } ?>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#lang_sup_site">Language Supported (Site)</h4>
        <div class="multicheck panel-collapse collapse" id="lang_sup_site" data-attribute="lang_sup_site">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('lang_sup_site', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= WordPressSettings::getAvailableLanguages();
                foreach ($payments as $bm=>$value) { ?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label
                            class="w-80"><?=$value?></label>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#lang_sup_cs">Language Supported (CS)</h4>
        <div class="multicheck panel-collapse collapse" id="lang_sup_cs" data-attribute="lang_sup_cs">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('lang_sup_cs', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= WordPressSettings::getAvailableCSLanguages();
                foreach ($payments as $bm=>$value) { ?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label
                            class="w-80"><?=$value?></label>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#cur_acc">Currencies Accepted</h4>
        <div class="multicheck panel-collapse collapse" id="cur_acc" data-attribute="cur_acc">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('cur_acc', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= WordPressSettings::getAvailableCurrencies();
                foreach ($payments as $bm=>$value) { ?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label
                            class="w-80"><?=$value?></label>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#year_est">Year of Establishment</h4>
        <div class="multicheck panel-collapse collapse" id="year_est" data-attribute="year_est">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('year_est', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                for ($i=0;$i<=10;$i++) {
                    $year = date('Y',strtotime(date("Y") . " - ".$i." year"))?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?= $year; ?>" <?php $mb->the_checkbox_state($year); ?>/><label
                            class="w-80"><?=$year?></label>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">Licensed in (AND)</h4>
        <?php $layout = [
            'Malta' => 'Malta',
            'Montenegro' => 'Montenegro',
            'Gibraltar' => 'Gibraltar',
            'UK' => 'UK',
            'Isle of Man' => 'Isle of Man',
            'Costa Rica' => 'Costa Rica',
            'Curacao' => 'Curacao',
            'Tasmania' => 'Tasmania',
            'Antigua ' => 'Antigua ',
            'Panama' => 'Panama',
            'Philippines (Cagayan)' => 'Philippines (Cagayan)',
            'Austria' => 'Austria',
            'Belize' => 'Belize',
            'Kahnawake (Canada)' => 'Kahnawake (Canada)',
            'Alderney' => 'Alderney',
            'Estonia' => 'Estonia',
            'Sweden' => 'Swedish Gambling Authority',
            'Denmark' => 'Denmark',
            'Belgium' => 'Belgium',
            'Other' => 'Other',
        ];?>
        <div class="mb-0 d-flex flex-wrap multicheck" data-attribute="license_country">
            <?php $mb->the_field('license_country', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
            <?php foreach ($layout as $key=>$value){ ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?=$key?>" <?php $mb->the_checkbox_state($key);?>/><label class="w-80"><?=$value?></label>
                </p>
            <?php } ?>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">Licensed in (OR)</h4>
        <?php $layout = [
            'Malta' => 'Malta',
            'Montenegro' => 'Montenegro',
            'Gibraltar' => 'Gibraltar',
            'UK' => 'UK',
            'Isle of Man' => 'Isle of Man',
            'Costa Rica' => 'Costa Rica',
            'Curacao' => 'Curacao',
            'Tasmania' => 'Tasmania',
            'Antigua ' => 'Antigua ',
            'Panama' => 'Panama',
            'Philippines (Cagayan)' => 'Philippines (Cagayan)',
            'Austria' => 'Austria',
            'Belize' => 'Belize',
            'Kahnawake (Canada)' => 'Kahnawake (Canada)',
            'Alderney' => 'Alderney',
            'Estonia' => 'Estonia',
            'Sweden' => 'Swedish Gambling Authority',
            'Denmark' => 'Denmark',
            'Belgium' => 'Belgium',
            'Other' => 'Other',
        ];?>
        <div class="mb-0 d-flex flex-wrap multicheck" data-attribute="license_country_or">
            <?php $mb->the_field('license_country_or', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
            <?php foreach ($layout as $key=>$value){ ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?=$key?>" <?php $mb->the_checkbox_state($key);?>/><label class="w-80"><?=$value?></label>
                </p>
            <?php } ?>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">RNG Games</h4>
        <?php $layout = [
            'Baccarat' => 'Baccarat',
            'Backgammon' => 'Backgammon',
            'Bingo' => 'Bingo',
            'BlackJack' => 'BlackJack',
            'Card Games' => 'Card Games',
            'Caribbean Stud Poker' => 'Caribbean Stud Poker',
            'Casino HoldEm' => 'Casino HoldEm',
            'Craps' => 'Craps',
            'Keno' => 'Keno',
            'Lottery' => 'Lottery',
            'Poker' => 'Poker',
            'Punto Banco' => 'Punto Banco',
            'Roulette' => 'Roulette',
            'Scratch Cards' => 'Scratch Cards',
            'Sic Bo' => 'Sic Bo',
            'Slots' => 'Slots',
            'Τable Games' => 'Τable Games',
            'Video Poker' => 'Video Poker',
            'Other games' => 'Other games',
        ];?>
        <div class="mb-0 d-flex flex-wrap multicheck" data-attribute="games">
            <?php $mb->the_field('games', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
            <?php foreach ($layout as $key=>$value){ ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?=$key?>" <?php $mb->the_checkbox_state($key);?>/><label class="w-80"><?=$value?></label>
                </p>
            <?php } ?>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">LIVE Games</h4>
        <?php $layout = [
            'Casino Hold\'em' => 'Casino Hold\'em',
            'Live Baccarat' => 'Baccarat',
            'Live Blackjack' => 'Blackjack',
            'Live Roulette' => 'Roulette',
            'TV Games' => 'TV Games',
        ];?>
        <div class="mb-0 d-flex flex-wrap multicheck" data-attribute="live_games">
            <?php $mb->the_field('live_games', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
            <?php foreach ($layout as $key=>$value){ ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?=$key?>" <?php $mb->the_checkbox_state($key);?>/><label class="w-80"><?=$value?></label>
                </p>
            <?php } ?>
        </div>
    </div>
</div>