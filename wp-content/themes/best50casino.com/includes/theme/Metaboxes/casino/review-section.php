<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';

if (!get_option('bonusMetafinalPsts')) {

$prefixbonux = 'bonus_custom_meta_';

$fieldsToRead = [
    $prefix.'h1',$prefix.'heading_state_intro',$prefix.'heading_intro',$prefix.'intro',$prefix.'heading_state_code', $prefix.'heading_code',$prefix.'promo_code',
    $prefix.'heading_state_hidden',$prefix.'heading_hidden',$prefix.'hidden_terms',$prefix.'heading_state_dep',
    $prefix.'no_depo',$prefix.'heading_dep',$prefix.'heading_state_spins',$prefix.'heading_spins',$prefix.'free_spins_text',$prefix.'heading_state_cash',
    $prefix.'heading_cash',$prefix.'vip_cashback',$prefix.'heading_state_loy',$prefix.'heading_loy',
    $prefix.'loyalt_bonus',$prefix.'heading_state_bonus',$prefix.'heading_bonus',$prefix.'live_bonus',$prefix.'heading_state_lic',$prefix.'heading_lic',$prefix.'banking',
    $prefix.'heading_state_pay',$prefix.'heading_pay',$prefix.'payments_text',$prefix.'heading_state_slot',$prefix.'heading_slot',$prefix.'li_mo',$prefix.'heading_state_live',
    $prefix.'heading_live',$prefix.'ot_in',$prefix.'note',$prefix.'heading_state_games',$prefix.'heading_games',$prefix.'sl_ga'
];

$fieldsToUpdate = [
    'h1','heading_state_intro','heading_intro','intro','heading_state_code','heading_code','promo_code',
    'heading_state_hidden','heading_hidden','hidden_terms','heading_state_dep',
    'no_depo','heading_dep','heading_state_spins','heading_spins','free_spins_text','heading_state_cash',
    'heading_cash','vip_cashback','heading_state_loy','heading_loy',
    'loyalt_bonus','heading_state_bonus','heading_bonus','live_bonus'
];

    foreach (get_all_posts('kss_casino') as $postID) {
        $bonusPage = get_post_meta($postID,'casino_custom_meta_bonus_page',true);
            update_post_meta($postID, '_review_section_fields',$fieldsToRead);
            foreach ($fieldsToUpdate as $fields) {
                $value = get_post_meta($bonusPage, $prefixbonux.$fields, true);
                update_post_meta($postID, $prefix.$fields,$value );
            }
        update_option('bonusMetafinalPsts', true);
    }
        echo 'done';
}else{
    echo 'not needed';
}

$activeCountries = WordPressSettings::getCountryEnabledSettings();
$activeCountriesWithNames = WordPressSettings::getCountryEnabledSettingsWithNames();

if (!get_option('slugupdate')) {
    foreach (get_all_posts('kss_casino') as $postID) {
        $bonusPage = get_post_meta($postID,'casino_custom_meta_bonus_page',true);
        $slug = get_post_field( 'post_name', $bonusPage );
        $title = get_the_title($bonusPage);
        $update_args = array(
            'ID' => $postID,
            'post_title'   => $title,
            'post_name' => $slug,
        );
        wp_update_post($update_args);
    }
    update_option('slugupdate', true);
}
?>
<div class="">
    <div class="col-12 p-3">
        <div class="col-12 p-0 d-flex mb-5p">
            <h4 class="w-20 font-weight-bold m-0 border-bottom"><a class="p-2 d-block">H1</a></h4>
            <div class="w-80">
                <?php $mb->the_field($prefix.'h1'); ?>
                <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                       value="<?php $mb->the_value(); ?>"/>
            </div>
        </div>
        <div class="col-12 p-0">
            <h4 class="w-100 bg-primary m-0 border-bottom"><a class="text-white p-2 d-block" data-toggle="collapse" href="#intro">Welcome intro</a></h4>

            <div class="w-50 d-flex pt-10p pb-10p">

                <div class="">
                    <?php $metabox->the_field($prefix.'heading_state_intro'); ?>
                    <label>Επιλογή Heading</label>
                    <select name="<?php $metabox->the_name(); ?>">
                        <option value="">Select...</option>
                        <option value="h1"<?php $metabox->the_select_state('h1'); ?>>h1</option>
                        <option value="h2"<?php $metabox->the_select_state('h2'); ?>>h2</option>
                        <option value="h3"<?php $metabox->the_select_state('h3'); ?>>h3</option>
                        <option value="h4"<?php $metabox->the_select_state('h4'); ?>>h4</option>
                        <option value="h5"<?php $metabox->the_select_state('h5'); ?>>h5</option>
                        <option value="h6"<?php $metabox->the_select_state('h6'); ?>>h5</option>
                        <option value="span"<?php $metabox->the_select_state('span'); ?>>Span</option>
                    </select>
                </div>
                <div class="">
                    <?php $metabox->the_field($prefix.'heading_intro'); ?>
                    <label>Heading</label>
                    <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
                </div>
            </div>
            <div class="panel-collapse collapse show" id="intro">
                <?php $mb->the_field($prefix.'intro'); ?>
                <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'intro', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
            </div>
        </div>
    </div>


    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom"><a class="text-white p-2 d-block" data-toggle="collapse" href="#promo_code">Bonus Code /Promo Code</a></h4>
        <div class="w-50 d-flex pt-10p pb-10p">
            <div class="">
                <?php $metabox->the_field($prefix.'heading_state_code'); ?>
                <label>Επιλογή Heading</label>
                <select name="<?php $metabox->the_name(); ?>">
                    <option value="">Select...</option>
                    <option value="h1"<?php $metabox->the_select_state('h1'); ?>>h1</option>
                    <option value="h2"<?php $metabox->the_select_state('h2'); ?>>h2</option>
                    <option value="h3"<?php $metabox->the_select_state('h3'); ?>>h3</option>
                    <option value="h4"<?php $metabox->the_select_state('h4'); ?>>h4</option>
                    <option value="h5"<?php $metabox->the_select_state('h5'); ?>>h5</option>
                    <option value="h6"<?php $metabox->the_select_state('h6'); ?>>h5</option>
                    <option value="span"<?php $metabox->the_select_state('span'); ?>>Span</option>
                </select>
            </div>
            <div class="">
                <?php $metabox->the_field($prefix.'heading_code'); ?>
                <label>Heading</label>
                <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </div>
        </div>
        <div class="panel-collapse collapse show" id="hidden_terms">
            <?php $mb->the_field($prefix.'promo_code'); ?>
            <?php wp_editor(html_entity_decode($mb->get_the_value($prefix.'promo_code'), ENT_QUOTES, 'UTF-8'), $prefix.'promo_code', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
        </div>
    </div>

    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom"><a class="text-white p-2 d-block" data-toggle="collapse" href="#hidden_terms">Hidden Terms</a></h4>
        <div class="w-50 d-flex pt-10p pb-10p">
            <div class="">
                <?php $metabox->the_field($prefix.'heading_state_hidden'); ?>
                <label>Επιλογή Heading</label>
                <select name="<?php $metabox->the_name(); ?>">
                    <option value="">Select...</option>
                    <option value="h1"<?php $metabox->the_select_state('h1'); ?>>h1</option>
                    <option value="h2"<?php $metabox->the_select_state('h2'); ?>>h2</option>
                    <option value="h3"<?php $metabox->the_select_state('h3'); ?>>h3</option>
                    <option value="h4"<?php $metabox->the_select_state('h4'); ?>>h4</option>
                    <option value="h5"<?php $metabox->the_select_state('h5'); ?>>h5</option>
                    <option value="h6"<?php $metabox->the_select_state('h6'); ?>>h5</option>
                    <option value="span"<?php $metabox->the_select_state('span'); ?>>Span</option>
                </select>
            </div>
            <div class="">
                <?php $metabox->the_field($prefix.'heading_hidden'); ?>
                <label>Heading</label>
                <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </div>
        </div>
        <div class="panel-collapse collapse show" id="hidden_terms">
            <?php $mb->the_field($prefix.'hidden_terms'); ?>
            <?php wp_editor(html_entity_decode($mb->get_the_value($prefix.'hidden_terms'), ENT_QUOTES, 'UTF-8'), $prefix.'hidden_terms', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
        </div>
    </div>

    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom"><a class="text-white p-2 d-block" data-toggle="collapse" href="#no_depo">Select Bonus</a></h4>
        <div class="w-50 d-flex pt-10p pb-10p">
            <div class="">
                <?php $metabox->the_field($prefix.'heading_state_dep'); ?>
                <label>Επιλογή Heading</label>
                <select name="<?php $metabox->the_name(); ?>">
                    <option value="">Select...</option>
                    <option value="h1"<?php $metabox->the_select_state('h1'); ?>>h1</option>
                    <option value="h2"<?php $metabox->the_select_state('h2'); ?>>h2</option>
                    <option value="h3"<?php $metabox->the_select_state('h3'); ?>>h3</option>
                    <option value="h4"<?php $metabox->the_select_state('h4'); ?>>h4</option>
                    <option value="h5"<?php $metabox->the_select_state('h5'); ?>>h5</option>
                    <option value="h6"<?php $metabox->the_select_state('h6'); ?>>h5</option>
                    <option value="span"<?php $metabox->the_select_state('span'); ?>>Span</option>
                </select>
            </div>
            <div class="">
                <?php $metabox->the_field($prefix.'heading_dep'); ?>
                <label>Heading</label>
                <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </div>
        </div>
        <div class="panel-collapse collapse show" id="no_depo">
            <?php $mb->the_field($prefix.'no_depo'); ?>
            <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'no_depo', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
        </div>
    </div>


    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom"><a class="text-white p-2 d-block" data-toggle="collapse" href="#wager">Free spins</a></h4>
        <div class="w-50 d-flex pt-10p pb-10p">
            <div class="">
                <?php $metabox->the_field($prefix.'heading_state_spins'); ?>
                <label>Επιλογή Heading</label>
                <select name="<?php $metabox->the_name(); ?>">
                    <option value="">Select...</option>
                    <option value="h1"<?php $metabox->the_select_state('h1'); ?>>h1</option>
                    <option value="h2"<?php $metabox->the_select_state('h2'); ?>>h2</option>
                    <option value="h3"<?php $metabox->the_select_state('h3'); ?>>h3</option>
                    <option value="h4"<?php $metabox->the_select_state('h4'); ?>>h4</option>
                    <option value="h5"<?php $metabox->the_select_state('h5'); ?>>h5</option>
                    <option value="h6"<?php $metabox->the_select_state('h6'); ?>>h5</option>
                    <option value="span"<?php $metabox->the_select_state('span'); ?>>Span</option>
                </select>
            </div>
            <div class="">
                <?php $metabox->the_field($prefix.'heading_spins'); ?>
                <label>Heading</label>
                <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </div>
        </div>
        <div class="panel-collapse collapse show" id="wager">
            <?php $mb->the_field($prefix.'free_spins_text'); ?>
            <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'free_spins_text', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
        </div>
    </div>


    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom"><a class="text-white p-2 d-block" data-toggle="collapse" href="#vip_cashback">Cashback text </a></h4>
        <div class="w-50 d-flex pt-10p pb-10p">
            <div class="">
                <?php $metabox->the_field($prefix.'heading_state_cash'); ?>
                <label>Επιλογή Heading</label>
                <select name="<?php $metabox->the_name(); ?>">
                    <option value="">Select...</option>
                    <option value="h1"<?php $metabox->the_select_state('h1'); ?>>h1</option>
                    <option value="h2"<?php $metabox->the_select_state('h2'); ?>>h2</option>
                    <option value="h3"<?php $metabox->the_select_state('h3'); ?>>h3</option>
                    <option value="h4"<?php $metabox->the_select_state('h4'); ?>>h4</option>
                    <option value="h5"<?php $metabox->the_select_state('h5'); ?>>h5</option>
                    <option value="h6"<?php $metabox->the_select_state('h6'); ?>>h5</option>
                    <option value="span"<?php $metabox->the_select_state('span'); ?>>Span</option>
                </select>
            </div>
            <div class="">
                <?php $metabox->the_field($prefix.'heading_cash'); ?>
                <label>Heading</label>
                <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </div>
        </div>
        <div class="panel-collapse collapse show" id="vip_cashback">
            <?php $mb->the_field($prefix.'vip_cashback'); ?>
            <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'vip_cashback', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
        </div>
    </div>

    <div class="col-12 mt-10p p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom"><a class="text-white p-2 d-block" data-toggle="collapse" href="#loyalt_bonus">Loaylty Bonus</a></h4>
        <div class="panel-collapse collapse show" id="loyalt_bonus">
            <div class="w-50 d-flex pt-10p pb-10p">
                <div class="">
                    <?php $metabox->the_field($prefix.'heading_state_loy'); ?>
                    <label>Επιλογή Heading</label>
                    <select name="<?php $metabox->the_name(); ?>">
                        <option value="">Select...</option>
                        <option value="h1"<?php $metabox->the_select_state('h1'); ?>>h1</option>
                        <option value="h2"<?php $metabox->the_select_state('h2'); ?>>h2</option>
                        <option value="h3"<?php $metabox->the_select_state('h3'); ?>>h3</option>
                        <option value="h4"<?php $metabox->the_select_state('h4'); ?>>h4</option>
                        <option value="h5"<?php $metabox->the_select_state('h5'); ?>>h5</option>
                        <option value="h6"<?php $metabox->the_select_state('h6'); ?>>h5</option>
                        <option value="span"<?php $metabox->the_select_state('span'); ?>>Span</option>
                    </select>
                </div>
                <div class="">
                    <?php $metabox->the_field($prefix.'heading_loy'); ?>
                    <label>Heading</label>
                    <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
                </div>
            </div>
            <?php $mb->the_field($prefix.'loyalt_bonus'); ?>
            <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'loyalt_bonus', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
        </div>
    </div>

    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom"><a class="text-white p-2 d-block" data-toggle="collapse" href="#loyalt_bonus">Live Casino Bonus</a></h4>
        <div class="w-50 d-flex pt-10p pb-10p">
            <div class="">
                <?php $metabox->the_field($prefix.'heading_state_bonus'); ?>
                <label>Επιλογή Heading</label>
                <select name="<?php $metabox->the_name(); ?>">
                    <option value="">Select...</option>
                    <option value="h1"<?php $metabox->the_select_state('h1'); ?>>h1</option>
                    <option value="h2"<?php $metabox->the_select_state('h2'); ?>>h2</option>
                    <option value="h3"<?php $metabox->the_select_state('h3'); ?>>h3</option>
                    <option value="h4"<?php $metabox->the_select_state('h4'); ?>>h4</option>
                    <option value="h5"<?php $metabox->the_select_state('h5'); ?>>h5</option>
                    <option value="h6"<?php $metabox->the_select_state('h6'); ?>>h5</option>
                    <option value="span"<?php $metabox->the_select_state('span'); ?>>Span</option>
                </select>
            </div>
            <div class="">
                <?php $metabox->the_field($prefix.'heading_bonus'); ?>
                <label>Heading</label>
                <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </div>
        </div>
        <div class="panel-collapse collapse show" id="live_bonus">
            <?php $mb->the_field($prefix.'live_bonus'); ?>
            <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'live_bonus', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
        </div>
    </div>

    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom"><a class="text-white p-2 d-block" data-toggle="collapse" href="#banking">Licensing Regulation & Security</a></h4>
        <div class="w-50 d-flex pt-10p pb-10p">
            <div class="">
            <?php $metabox->the_field($prefix.'heading_state_lic'); ?>
            <label>Επιλογή Heading</label>
            <select name="<?php $metabox->the_name(); ?>">
                <option value="">Select...</option>
                <option value="h1"<?php $metabox->the_select_state('h1'); ?>>h1</option>
                <option value="h2"<?php $metabox->the_select_state('h2'); ?>>h2</option>
                <option value="h3"<?php $metabox->the_select_state('h3'); ?>>h3</option>
                <option value="h4"<?php $metabox->the_select_state('h4'); ?>>h4</option>
                <option value="h5"<?php $metabox->the_select_state('h5'); ?>>h5</option>
                <option value="h6"<?php $metabox->the_select_state('h6'); ?>>h5</option>
                <option value="span"<?php $metabox->the_select_state('span'); ?>>Span</option>
            </select>
            </div>
            <div class="">
                <?php $metabox->the_field($prefix.'heading_lic'); ?>
                <label>Heading</label>
                <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </div>
        </div>

        <div class="panel-collapse collapse show" id="banking">
            <?php $mb->the_field($prefix.'banking'); ?>
            <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'banking', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
        </div>
    </div>

    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom"><a class="text-white p-2 d-block" data-toggle="collapse" href="#payments">Payment Methods</a></h4>
        <div class="w-50 d-flex pt-10p pb-10p">
            <div class="">
                <?php $metabox->the_field($prefix.'heading_state_pay'); ?>
                <label>Επιλογή Heading</label>
                <select name="<?php $metabox->the_name(); ?>">
                    <option value="">Select...</option>
                    <option value="h1"<?php $metabox->the_select_state('h1'); ?>>h1</option>
                    <option value="h2"<?php $metabox->the_select_state('h2'); ?>>h2</option>
                    <option value="h3"<?php $metabox->the_select_state('h3'); ?>>h3</option>
                    <option value="h4"<?php $metabox->the_select_state('h4'); ?>>h4</option>
                    <option value="h5"<?php $metabox->the_select_state('h5'); ?>>h5</option>
                    <option value="h6"<?php $metabox->the_select_state('h6'); ?>>h5</option>
                    <option value="span"<?php $metabox->the_select_state('span'); ?>>Span</option>
                </select>
            </div>
            <div class="">
                <?php $metabox->the_field($prefix.'heading_pay'); ?>
                <label>Heading</label>
                <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </div>
        </div>
        <div class="panel-collapse collapse show" id="payments">
            <?php $mb->the_field($prefix.'payments_text'); ?>
            <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'payments_text', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
        </div>
    </div>
    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom"><a class="text-white p-2 d-block" data-toggle="collapse" href="#li_mo">Slots & Jackpot Games</a></h4>
        <div class="w-50 d-flex pt-10p pb-10p">
            <div class="">
                <?php $metabox->the_field($prefix.'heading_state_slot'); ?>
                <label>Επιλογή Heading</label>
                <select name="<?php $metabox->the_name(); ?>">
                    <option value="">Select...</option>
                    <option value="h1"<?php $metabox->the_select_state('h1'); ?>>h1</option>
                    <option value="h2"<?php $metabox->the_select_state('h2'); ?>>h2</option>
                    <option value="h3"<?php $metabox->the_select_state('h3'); ?>>h3</option>
                    <option value="h4"<?php $metabox->the_select_state('h4'); ?>>h4</option>
                    <option value="h5"<?php $metabox->the_select_state('h5'); ?>>h5</option>
                    <option value="h6"<?php $metabox->the_select_state('h6'); ?>>h5</option>
                    <option value="span"<?php $metabox->the_select_state('span'); ?>>Span</option>
                </select>
            </div>
            <div class="">
                <?php $metabox->the_field($prefix.'heading_slot'); ?>
                <label>Heading</label>
                <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </div>
        </div>
        <div class="panel-collapse collapse show" id="li_mo">
            <?php $mb->the_field($prefix.'li_mo'); ?>
            <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'li_mo', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
        </div>
    </div>
    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom"><a class="text-white p-2 d-block" data-toggle="collapse" href="#ot_in">Live Casino</a></h4>
        <div class="w-50 d-flex pt-10p pb-10p">
            <div class="">
                <?php $metabox->the_field($prefix.'heading_state_live'); ?>
                <label>Επιλογή Heading</label>
                <select name="<?php $metabox->the_name(); ?>">
                    <option value="">Select...</option>
                    <option value="h1"<?php $metabox->the_select_state('h1'); ?>>h1</option>
                    <option value="h2"<?php $metabox->the_select_state('h2'); ?>>h2</option>
                    <option value="h3"<?php $metabox->the_select_state('h3'); ?>>h3</option>
                    <option value="h4"<?php $metabox->the_select_state('h4'); ?>>h4</option>
                    <option value="h5"<?php $metabox->the_select_state('h5'); ?>>h5</option>
                    <option value="h6"<?php $metabox->the_select_state('h6'); ?>>h5</option>
                    <option value="span"<?php $metabox->the_select_state('span'); ?>>Span</option>
                </select>
            </div>
            <div class="">
                <?php $metabox->the_field($prefix.'heading_live'); ?>
                <label>Heading</label>
                <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </div>
        </div>
        <div class="panel-collapse collapse show" id="ot_in">
            <?php $mb->the_field($prefix.'ot_in'); ?>
            <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'ot_in', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
        </div>
    </div>

    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom"><a class="text-white p-2 d-block" data-toggle="collapse" href="#note">Note</a></h4>
        <div class="panel-collapse collapse show" id="note">
            <?php $mb->the_field($prefix.'note'); ?>
            <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'note', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
        </div>
    </div>


    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom"><a class="text-white p-2 d-block" data-toggle="collapse" href="#sl_ga">Casino Games</a></h4>
        <div class="w-50 d-flex pt-10p pb-10p">
            <div class="">
                <?php $metabox->the_field($prefix.'heading_state_games'); ?>
                <label>Επιλογή Heading</label>
                <select name="<?php $metabox->the_name(); ?>">
                    <option value="">Select...</option>
                    <option value="h1"<?php $metabox->the_select_state('h1'); ?>>h1</option>
                    <option value="h2"<?php $metabox->the_select_state('h2'); ?>>h2</option>
                    <option value="h3"<?php $metabox->the_select_state('h3'); ?>>h3</option>
                    <option value="h4"<?php $metabox->the_select_state('h4'); ?>>h4</option>
                    <option value="h5"<?php $metabox->the_select_state('h5'); ?>>h5</option>
                    <option value="h6"<?php $metabox->the_select_state('h6'); ?>>h5</option>
                    <option value="span"<?php $metabox->the_select_state('span'); ?>>Span</option>
                </select>
            </div>
            <div class="">
                <?php $metabox->the_field($prefix.'heading_games'); ?>
                <label>Heading</label>
                <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </div>
        </div>
        <div class="panel-collapse collapse show" id="sl_ga">
            <?php $mb->the_field($prefix.'sl_ga'); ?>
            <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'sl_ga', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
        </div>
    </div>


</div>

