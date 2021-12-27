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
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#casino">You Can Play it on: (Choose Casino)</h4>
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
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#games_in">Show Games:</h4>
        <div class="multicheck panel-collapse collapse" id="games_in" data-attribute="games_in">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('games_in', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= get_all_published('kss_games');
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
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#games_not_in">Exclude Games:</h4>
        <div class="multicheck panel-collapse collapse" id="games_not_in" data-attribute="games_not_in">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('games_not_in', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= ['BlackJack' => 'BlackJack',
                    'Caribbean Stud Poker' => 'Caribbean Stud Poker',
                    'Casino HoldEm' => 'Casino HoldEm',
                    'Baccarat' => 'Baccarat',
                    'Punto Banco' => 'Punto Banco',
                    'Sic Bo' => 'Sic Bo',
                    'Video Poker' => 'Video Poker',
                    'Craps' => 'Craps',
                    'Kino' => 'Kino',
                    'Lottery' => 'Lottery',
                    'Bingo' => 'Bingo',
                    'Roulette' => 'Roulette',
                    'Slots' => 'Slots'];
                foreach ($payments as $bm=>$value) { ?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?=$value?></label>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Offset</h4>
        <p class="mb-0">
            <?php $mb->the_field('slot_offset'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" data-attribute="slot_offset"/>
        </p>
    </div>
</div>