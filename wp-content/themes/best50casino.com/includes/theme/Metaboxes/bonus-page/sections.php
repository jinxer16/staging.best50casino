<?php global $wpalchemy_media_access;
$prefix = 'bonus_custom_meta_';
$activeCountries = WordPressSettings::getCountryEnabledSettings();
$activeCountriesWithNames = WordPressSettings::getCountryEnabledSettingsWithNames();
?>
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
         <div class="panel-collapse collapse show" id="promo_code">
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
                 <?php ?>
             </div>
         </div>

             <?php $mb->the_field($prefix.'promo_code'); ?>
             <?php
             wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'promo_code', array('wpautop' => false, 'textarea_name' => $mb->get_the_name()));
             ?>
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


<!--<div class="mt-10p d-flex flex-wrap col-12">-->
<!--     <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">Intro</h4>-->
<!--        <p class="mb-1">-->
<!--            --><?php //$mb->the_field($prefix.'Tab_intro'); ?>
<!--            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--"-->
<!--                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--        </p>-->
<!--     </div>-->
<!--     <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">welcome bonus Title</h4>-->
<!--        <p class="mb-1">-->
<!--            --><?php //$mb->the_field($prefix.'title_intro'); ?>
<!--            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--"-->
<!--                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--        </p>-->
<!--     </div>-->
<!---->
<!--    <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">Bonus Code Tab</h4>-->
<!--        <p class="mb-1">-->
<!--            --><?php //$mb->the_field($prefix.'Tab_bonus_code'); ?>
<!--            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--"-->
<!--                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--        </p>-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">Bonus Code Title</h4>-->
<!--        <p class="mb-1">-->
<!--            --><?php //$mb->the_field($prefix.'title_bonus_code'); ?>
<!--            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--"-->
<!--                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--        </p>-->
<!--    </div>-->
<!--    <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">Bonus Code Text</h4>-->
<!--        <p class="mb-0">-->
<!--            --><?php //$mb->the_field($prefix.'txt_bonus_code'); ?>
<!--            <textarea class="w-100" type="text" rows="5" name="--><?php //$mb->the_name(); ?><!--" value="">--><?php //$mb->the_value(); ?><!--</textarea>-->
<!--        </p>-->
<!--    </div>-->
<!--    <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">Bonuses Tab</h4>-->
<!--        <p class="mb-1">-->
<!--            --><?php //$mb->the_field($prefix.'Tab_offers'); ?>
<!--            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--"-->
<!--                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--        </p>-->
<!--    </div>-->
<!---->
<!--    <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">Bonuses Title</h4>-->
<!--        <p class="mb-1">-->
<!--            --><?php //$mb->the_field($prefix.'title_offers'); ?>
<!--            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--"-->
<!--                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--        </p>-->
<!--    </div>-->
<!--    <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">Bonuses Intro</h4>-->
<!--        <p class="mb-0">-->
<!--            --><?php //$mb->the_field($prefix.'intro_offers'); ?>
<!--            <textarea class="w-100" type="text" rows="5" name="--><?php //$mb->the_name(); ?><!--" value="">--><?php //$mb->the_value(); ?><!--</textarea>-->
<!--        </p>-->
<!--    </div>-->
<!--    <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">Bonuses Text</h4>-->
<!--        <p class="mb-0">-->
<!--            --><?php //$mb->the_field($prefix.'txt_offers'); ?>
<!--            <textarea class="w-100" type="text" rows="5" name="--><?php //$mb->the_name(); ?><!--" value="">--><?php //$mb->the_value(); ?><!--</textarea>-->
<!--        </p>-->
<!--    </div>-->
<!--    <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">FAQ (TO BE REPLACED)</h4>-->
<!--        <i>Seperated by |</i>-->
<!--        <p class="mb-0">-->
<!--            --><?php //$mb->the_field($prefix.'faq_text'); ?>
<!--            <textarea class="w-100" type="text" rows="5" name="--><?php //$mb->the_name(); ?><!--" value="">--><?php //$mb->the_value(); ?><!--</textarea>-->
<!--        </p>-->
<!--    </div>-->
<!--    <div class="col-6 d-flex flex-wrap">-->
<!--        --><?php //$mb->the_field($prefix.'screeshot'); ?>
<!--        <h4 class="w-100 bg-primary m-0 border-bottom text-white p-2">Screenshot</h4>-->
<!--        <p class="p-2">-->
<!--            <input type="text" id="--><?php //$mb->the_name(); ?><!--" name="--><?php //$mb->the_name(); ?><!--" value="--><?php //$mb->the_value(); ?><!--" class="mr-1"/>-->
<!--            <button data-dest-selector="#--><?php //$mb->the_name(); ?><!--" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>-->
<!--            <img src="--><?php //$mb->the_value(); ?><!--" width="80" class="mr-1">-->
<!--        </p>-->
<!--    </div>-->
<!--</div>-->



<script type="text/javascript">
    jQuery(document).ready(function($){

        // $(".last.tocopy input.faqs_sort_order").prop("disabled", true);
        // $(".last.tocopy input.imga").prop("disabled", true);
        //
        // $('.promorionbtn').click(function(){
        //     $(".wpa_group").not(".last.tocopy").each(function () {
        //         $(this).find('input.faqs_sort_order').prop('disabled',false);
        //         $(this).find('input.imga').prop('disabled',false);
        //     });
        // });
        //
        // $('.vipbutton').click(function(){
        //     $(".wpa_group").not(".last.tocopy").each(function () {
        //         $(this).find('input.faqs_sort_order').prop('disabled',false);
        //         $(this).find('input.imga').prop('disabled',false);
        //     });
        // });

        $( ".sliders_table" ).find('tbody').sortable( {
            dropOnEmpty: false,
            cursor: "move",
            handle: ".slider_td",
            update: function( event, ui ) {
                $(this).children().each(function(index) {
                    $(this).find('.slider_order').html(index + 1);
                    $(this).find('input.faqs_sort_order').val(index + 1);
                });
            }
        });

        $( ".vips_table" ).find('tbody').sortable( {
            dropOnEmpty: false,
            cursor: "move",
            handle: ".vip_td",
            update: function( event, ui ) {
                $(this).children().each(function(index) {
                    $(this).find('.vips_order').html(index + 1);
                    $(this).find('input.faqs_sort_order').val(index + 1);
                });
            }
        });


    });
</script>
