<?php
global $wpalchemy_media_access;
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
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

    .types .radiotypes:checked + label {
        background-color: #000073;
        color:white;
    }
    .types .radiotypes:hover:not(:checked) + label {
        background-color: gray;
        color: black;
    }
</style>

<div class="Gifts metabox">

    <label>Ενεργό</label>
    <div class="onoffswitch">
        <?php $mb->the_field('state'); ?>
        <input type="checkbox" class="onoffswitch-checkbox" id="myonoffswitch"  name="<?php $mb->the_name(); ?>" value="on"<?php echo $mb->is_value('on')?' checked="checked"':''; ?>/>
        <label class="onoffswitch-label" for="myonoffswitch"></label>
    </div>


    <h1>Fortune Gifts</h1>
    <table border="0" cellspacing="0"  class="fortune_gifts_meta" >

        <tbody>
        <?php $my_counter = 0; $counter = 0; ?>
        <?php while($metabox->have_fields_and_multi('fortune_gifts_meta',array('length' => 1, 'limit' => 10))): ?>
            <?php $metabox->the_group_open('tr'); ?>
            <?php $metabox->the_field('order'); ?>
            <td class="fortune_gifts_meta_td">
                <div class="fortune_gifts_meta_order" style="text-align: center;background-color: #a0a5aa; font-size: 16px; padding:7px; font-weight: bold;"><?php echo ($my_counter + 1);?></div>
                <input type="text" class="fortune_gifts_meta_sort_order" style="display: none;" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </td>
                <td id="tab2-<?=$my_counter+1?>" class="tab-pane fade show w-505">
                    <label>Gift text</label>
                    <?php $metabox->the_field('gift'); ?>
                    <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
                </td>

                <td id="tab4-<?=$my_counter+1?>" class="tab-pane fade show w-505">
                    <label>Url</label>
                    <?php $metabox->the_field('url'); ?>
                    <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
                </td>

            <td id="tab4-<?=$my_counter+1?>" class="tab-pane fade show w-505">
                <label>Background color of piece</label>
                <?php $metabox->the_field('bg_piece'); ?>
                <input type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </td>

            <?php $my_counter++;?>
            <?php $metabox->the_group_close(); ?>
        <?php endwhile; ?>
        <p><a href="#" class="docopy-fortune_gifts_meta button">Add gift</a></p>
        </tbody>
    </table>


    <hr/>

    <label>Λεκτικό κουμπιού</label>
    <p>
        <?php $metabox->the_field('button_text'); ?>
        <input type="text" name="<?php $metabox->the_name('button_text'); ?>" value="<?php $metabox->the_value('button_text'); ?>"/>
    </p>

    <label>Όροι και προυποθέσεις text</label>
    <p>
        <?php $metabox->the_field('terms'); ?>
        <input type="text" name="<?php $metabox->the_name('terms'); ?>" value="<?php $metabox->the_value('terms'); ?>"/>
    </p>


    <label>Background image</label>
    <p>
        <?php $metabox->the_field('background_image'); ?>
        <input type="text" id="<?php $metabox->the_name(); ?>" name="<?php $metabox->the_name(); ?>" value="<?= $metabox->get_the_value()?>" class="mr-1" />
        <img src="<?= $metabox->get_the_value()?>" width="80" class="mr-1">
        <button data-dest-selector="#<?php $metabox->the_name(); ?>" class="btn btn-primary btn-sm add-backimage-button">Add Image</button>
    </p>



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
        $('.Gifts').on('click', '.add-backimage-button', function(e){
            e.preventDefault();
            dest_selector = esc_selector($(this).data('dest-selector')); // set
            media_window.open();
        });


        $(".last.tocopy input.fortune_gifts_meta_sort_order").prop("disabled", true);

        $('.docopy-fortune_gifts_meta').click(function(){
            $(".wpa_group").not(".last.tocopy").each(function () {
                $(this).find('input.fortune_gifts_meta_sort_order').prop('disabled',false);
            });
        });

        $( ".fortune_gifts_meta_table" ).find('tbody').sortable( {
            dropOnEmpty: false,
            cursor: "move",
            handle: ".fortune_gifts_meta_td",
            update: function( event, ui ) {
                $(this).children().each(function(index) {
                    $(this).find('.fortune_gifts_meta_order').html(index + 1);
                    $(this).find('input.fortune_gifts_meta_sort_order').val(index + 1);
                });
            }
        });



    });
</script>
