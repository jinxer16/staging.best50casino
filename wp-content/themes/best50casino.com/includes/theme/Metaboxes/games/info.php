<?php global $wpalchemy_media_access;
$prefix = 'games_custom_meta_';
if (!get_option('oldsettingsSetForGamesMeta')) {
    $metaPartZ3 = [$prefix . 'slot_script',$prefix . 'thumb_of_game',$prefix . 'icon',$prefix . 'link_1',$prefix . 'text_link_1',$prefix . 'cta_text',
        $prefix . 'game_categ',$prefix . 'thumb_of_game_mob_gen',$prefix . 'thumb_of_game_mob',];

    $endCasinoMetaZ3 = [
        '_games_info_meta_fields'=>$metaPartZ3,
    ];
    foreach (get_all_posts('kss_games') as $postID) {
      foreach ($endCasinoMetaZ3 as $key=>$value){
            $ret = update_post_meta($postID,$key,$value);
        }
    }
    update_option('oldsettingsSetForGamesMeta', true);
}

?>
<div class="d-flex flex-wrap">
    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom text-white p-1">Game Script</h4>
        <div class="">
            <?php $mb->the_field($prefix.'slot_script'); ?>
            <textarea class="w-100" type="text" rows="5" name="<?php $mb->the_name(); ?>" value=""><?php $mb->the_value(); ?></textarea>
        </div>
    </div>
    <div class="col-6 p-3">
        <h4 class="mb-1 text-white bg-primary p-1">Slot Thumbnail</h4>
        <i>Instead of script in case of broken script</i>
        <?php $mb->the_field($prefix.'thumb_of_game'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
        <button data-dest-selector="#<?php $mb->the_name(); ?>" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>
        <img src="<?php $mb->the_value(); ?>" width="80" class="mr-1">
    </div>
    <div class="col-6 p-3 d-flex flex-column align-items-start justify-content-around">
        <div>
            <label class="mb-0">Use Thumb on mobile</label>
            <?php $mb->the_field($prefix.'thumb_of_game_mob'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
        </div>
        <div>
            <label class="mb-0">Use Thumb Everywhere</label>
            <?php $mb->the_field($prefix.'thumb_of_game_mob_gen'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">Type of RNG Game</h4>
        <div class="d-flex flex-wrap">
            <?php $mb->the_field($prefix.'game_categ', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            $RNGs= ['Baccarat' => 'Baccarat', 'Backgammon' => __('Backgammon'),
                'Bingo' => 'Bingo', 'BlackJack' => 'BlackJack',
                'Card Games' => __('Card Games'), 'Caribbean Stud Poker' => 'Caribbean Stud Poker',
                'Casino HoldEm' => 'Casino HoldEm', 'Craps' => __('Craps'),
                'Keno' => 'Keno', 'Lottery' => __('Lottery'),
                'Poker' => __('Poker'), '3-card Poker' => __('3-card Poker'),
                'Punto Banco' => 'Punto Banco', 'Roulette' => __('Roulette'),
                'Scratch Cards' => __('Scratch Cards'), 'Sic Bo' => 'Sic Bo',
                'Slots' => __('Slots'), 'Τable Games' => __('Τable Games'),
                'Video Poker' => 'Video Poker', 'Other games' => __('Other games'),
                'Casino Hold\'em' => __('Casino Hold\'em (live)'), 'Live Baccarat' => __('Baccarat (live)'),
                'Live Blackjack' => __('Blackjack (live)'), 'Live Roulette' => __('Roulette (live)'),
                'TV Games' => __('TV Games (live)'),];
            foreach ($RNGs as $key=>$value) { ?>
                <p class="mb-0 d-flex mr-1" style="width:13%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?=$key?>" <?php $mb->the_checkbox_state($key); ?>/><label class="w-80"><?=$value?></label>
                </p>
            <?php } ?>
        </div>
    </div>;
    <div class="col-6 p-3">
        <h4 class="mb-1 text-white bg-primary p-1">CTA Quote</h4>
        <?php $mb->the_field($prefix.'cta_text'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-6 p-3">
        <h4 class="mb-1 text-white bg-primary p-1">Text (info row) for shortcode</h4>
        <?php $mb->the_field($prefix.'text_link_1'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-6 p-3">
        <h4 class="mb-1 text-white bg-primary p-1">Guide Link for Shortcode</h4>
        <?php $mb->the_field($prefix.'link_1'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-6 p-3">
        <h4 class="mb-1 text-white bg-primary p-1">Icon</h4>
        <?php $mb->the_field($prefix.'icon'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
        <button data-dest-selector="#<?php $mb->the_name(); ?>" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>
        <img src="<?php $mb->the_value(); ?>" width="80" class="mr-1">
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($){
        var dest_selector;
        var media_window = wp.media({
            title: 'Add Media',
            library: {type: 'image'},
            multiple: false,
            button: {text: 'Add'}
        });
        media_window.on('select', function() {
            var first = media_window.state().get('selection').first().toJSON();
            jQuery(dest_selector).val(first.url);
            dest_selector = null; // reset
        });
        function esc_selector( selector ) {
            return selector.replace( /(:|\.|\[|\]|,)/g, "\\$1" );
        }
        $('.my_meta_control').on('click', '.add-logo-button', function(e){
            e.preventDefault();
            dest_selector = esc_selector($(this).data('dest-selector')); // set
            media_window.open();
        });
    });
</script>