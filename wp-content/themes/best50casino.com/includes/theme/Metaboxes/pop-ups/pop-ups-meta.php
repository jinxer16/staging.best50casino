<?php
global $wpalchemy_media_access;
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<style>
    .my_meta_control label {
        display: block;
        font-weight: bold;
        margin: 6px;
        margin-bottom: 0;
        margin-top: 12px;
    }
    .my_meta_control textarea, .my_meta_control input[type='text'] {
        margin-bottom: 3px;
        width: 99%;
    }
    .w-50{
        width: 50%;
    }
    .w-33{
        width: 33.3%;
    }
    .w-100{
        width: 100%;
    }
    .onoffswitch {
        position: relative; width: 55px;
        -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
    }
    .onoffswitch-checkbox {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }
    .onoffswitch-label {
        display: block; overflow: hidden; cursor: pointer;
        height: 20px; padding: 0; line-height: 20px;
        border: 0 solid #FFFFFF; border-radius: 24px;
        background-color: #9E9E9E;
    }
    .onoffswitch-label:before {
        content: "";
        display: block; width: 24px; margin: -2px;
        background: #FFFFFF;
        position: absolute; top: 0; bottom: 0;
        right: 31px;
        border-radius: 24px;
        box-shadow: 0 6px 12px 0 #757575;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label {
        background-color: #67F743;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label, .onoffswitch-checkbox:checked + .onoffswitch-label:before {
        border-color: #67F743;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
        margin-left: 0;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label:before {
        right: 0;
        background-color: #67F743;
        box-shadow: 3px 6px 18px 0 rgba(0, 0, 0, 0.2);
    }


    .types .radiotypes{
        visibility: hidden; /* 1 */
        height: 0; /* 2 */
        width: 0; /* 2 */
    }

    .labeltypes {
        display: flex;
        flex: auto;
        vertical-align: middle;
        align-items: center;
        justify-content: center;
        text-align: center;
        cursor: pointer;
        background-color: gray;
        color: white;
        padding: 5px 10px;
        border-radius: 6px;
        user-select: none;
        margin-right: 8px;
    }

    .labeltypes:last-of-type {
        margin-right: 0;
    }

    .types .radiotypes:checked + label {
        background-color: #000073;
        color:white;
    }

    .types .radiotypes:hover:not(:checked) + label {
        background-color: gray;
        color: black;
    }


</style>

<?php
$activeCountries = WordPressSettings::getCountryEnabledSettings();
$activeCountriesWithNames = WordPressSettings::getCountryEnabledSettingsWithNames();
$prefix = 'pop_custom_meta_';
$filledCountries = get_post_meta($post->ID, $prefix . 'contries_filled', true) ? get_post_meta($post->ID, $prefix . 'contries_filled', true) : [];

?>
<div class="my_meta_control w-100 metabox" style="display: flex; flex-flow: wrap;">

    <div class="w-100 p-0">
        <h4 class="bg-secondary p-1">Bonus Countries Filled</h4>
        <div class="d-flex flex-wrap">
            <?php $mb->the_field($prefix . 'contries_filled', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            foreach ($activeCountriesWithNames as $iso => $name) { ?>
                <p class="mb-0 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?= $iso; ?>" <?php $mb->the_checkbox_state($iso); ?>/>
                    <a class="w-80" href="#section-<?= $iso ?>"><?= ucwords($name) ?></a>
                </p>
            <?php } ?>
        </div>
    </div>


    <div class="w-33" style="margin-bottom: 10px;">
        <label>Ενεργό pop-up</label>
        <div class="onoffswitch">
            <?php $mb->the_field($prefix .'pop_state'); ?>
            <input type="checkbox" class="onoffswitch-checkbox" id="myonoffswitch"  name="<?php $metabox->the_name(); ?>" value="on"<?php echo $metabox->is_value('on')?' checked="checked"':''; ?>/>
            <label class="onoffswitch-label" for="myonoffswitch"></label>
        </div>

        <label>Να τραβάει το global στις χώρες που δεν βάλατε η να μην βγαίνει καθόλου (Ναι/Οχι)</label>
        <div class="onoffswitch">
            <?php $mb->the_field($prefix .'pop_state_glb'); ?>
            <input type="checkbox" class="onoffswitch-checkbox" id="myonoffswitchglb"  name="<?php $metabox->the_name(); ?>" value="on"<?php echo $metabox->is_value('on')?' checked="checked"':''; ?>/>
            <label class="onoffswitch-label" for="myonoffswitchglb"></label>
        </div>
    </div>

    <div class="w-33" style="margin-bottom: 10px;">
        <?php $mb->the_field($prefix .'pop_type'); ?>
        <label style="text-align: center;">Type of Pop-up:</label>
        <div class="types" style="display: flex;">
            <input type="radio" name="<?php $mb->the_name(); ?>" class="radiotypes" id="offerra" value="offer"<?php echo $mb->is_value('offer')?' checked="checked"':''; ?>/>
            <label class="labeltypes" for="offerra"><span style="display: block; color: white;font-size: 20px;"><i class="fa fa-money" aria-hidden="true"></i></span>Offer</label>
            <input type="radio" name="<?php $mb->the_name(); ?>" id="newsra" class="radiotypes" value="newsletter"<?php echo $mb->is_value('newsletter')?' checked="checked"':''; ?>/>
            <label class="labeltypes"  for="newsra"><span style="display: block;color: white;font-size: 20px;"><i class="fa fa-newspaper-o" aria-hidden="true"></i></span>Newsletter</label>
        </div>
    </div>

    <div class="w-33" style="text-align: center; display: block; margin: auto; margin-bottom: 10px;">
        <?php $mb->the_field($prefix .'seconds_pop'); ?>
        <label for="tentacles">Seconds to show pop-up after (1-50):</label>
        <div class="quantity">
            <input type="number" id="tentacles" min="1" max="50" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>">
        </div>
    </div>


    <?php foreach ($activeCountriesWithNames as $iso => $name) { ?>
        <div class="col-12 p-0" id="section-<?= $iso ?>">
            <?php $class = in_array($iso, $filledCountries) ? '<i class="ml-2 fa fa-check text-white"></i>' : ""; ?>
            <h4 class="w-100 bg-primary m-0 border-bottom d-flex align-items-center"><img
                    src="<?= get_template_directory_uri() . '/assets/flags/' . $iso ?>.svg" width="20"
                    class="ml-1 mr-1"><a class="text-white p-2 d-block" data-toggle="collapse"
                                         href="#details-<?= $iso ?>">Details
                    for <?= ucwords($name) ?></a><?= $class ?></h4>
            <div class="panel-collapse collapse" id="details-<?= $iso ?>">
                <div class="d-flex flex-wrap">

                    <div class="w-50">
                        <?php $mb->the_field($iso . $prefix .'width_pop'); ?>
                        <label for="tentacles">width σε px συμπληρώστε μόνο τον αριθμό (600 το λιγότερο)</label>
                        <div class="quantity">
                            <input type="number" id="tentacles" min="600" max="1200" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>">
                        </div>
                    </div>

                    <div class="w-50">
                        <label>Τίτλος</label>
                        <p>
                            <?php $mb->the_field($iso . $prefix .'titleNewsle'); ?>
                            <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                        </p>
                    </div>


                    <div class="w-50">
                        <label>Background Color of Popup</label>
                        <?php $mb->the_field($iso . $prefix .'bg_color_news'); ?>
                        <input type="text" class="" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                    </div>

                    <div class="w-50">
                        <label>Text of button</label>
                        <?php $metabox->the_field($iso . $prefix .'btn_text'); ?>
                        <input type="text" class="" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                    </div>

                    <div class="w-50">
                        <label>Rel of button(with spaces e.x nofollow noopener)</label>
                        <?php $metabox->the_field($iso . $prefix .'btn_rel'); ?>
                        <input type="text" class="" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                    </div>

                    <div class="w-50">
                        <label>URL of button</label>
                        <?php $metabox->the_field($iso . $prefix .'btn_url'); ?>
                        <input type="text" class="" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                    </div>

                    <div class="w-50">
                        <label>Image</label>
                        <?php $mb->the_field($iso . $prefix .'imageNewsle'); ?>
                        <p>
                            <input type="text" class="image_input" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                            <button data-dest-selector="#<?php $mb->the_name(); ?>" class="button add-image-button">Add image</button>
                        </p>
                        <?php $mb->the_field($iso . $prefix .'align_img'); ?>
                        <label style="margin-bottom: 10px; margin-top: 5px;">Image align</label>
                        <div class="" style="display: flex;">
                            <input type="radio" name="<?php $mb->the_name(); ?>" class="" id="leeft" value="left"<?php echo $mb->is_value('left')?' checked="checked"':''; ?>/>
                            <span class="" style="padding-left: 5px; padding-right: 10px;">left</span>
                            <input type="radio" name="<?php $mb->the_name(); ?>" id="righht" class="" value="center"<?php echo $mb->is_value('center')?' checked="checked"':''; ?>/>
                            <span class="" style="padding-left: 5px; padding-right: 10px;">center</span>
                            <input type="radio" name="<?php $mb->the_name(); ?>" id="righht" class="" value="right"<?php echo $mb->is_value('right')?' checked="checked"':''; ?>/>
                            <span class="" style="padding-left: 5px; padding-right: 10px;">right</span>
                        </div>
                    </div>

                    <div class="w-50">
                        <label>URL of Image</label>
                        <?php $metabox->the_field($iso . $prefix .'img_url'); ?>
                        <input type="text" class="" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                    </div>
                    <div class="w-100">
                        <label>Κείμενο προσφοράς η newsletter</label>
                        <p>
                            <?php $mb->the_field($iso . $prefix .'textNews'); ?>
                            <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $iso.'textNews', array('wpautop'=>false, 'textarea_name'=>$mb->get_the_name()) );?>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    <?php }
    ?>
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
        $('.my_meta_control').on('click', '.add-image-button', function(e){
            e.preventDefault();
            dest_selector = esc_selector($(this).data('dest-selector')); // set
            media_window.open();
        });
    });
</script>

