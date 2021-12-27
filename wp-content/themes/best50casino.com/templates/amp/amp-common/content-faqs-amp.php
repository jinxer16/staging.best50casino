<?php
$faqs = @get_post_meta($post->ID,'faqs',true) ?? false;
if ($faqs ) {
    $faqColor = get_post_meta($post->ID, 'faqs_color',true)? get_post_meta($post->ID, 'faqs_color',true) : '#03898F';
    ?>
    <a id="faq" class="position-relative text-decoration-none" style="top: -100px;"></a>
    <div class="faq p-15p w-100 mb-10p mt-10p" id="" style="background-color: <?=$faqColor?>">
    <div class="text-whitte text-center" style="font-size: 28px;margin-bottom: 8px;"> <?php echo @get_post_meta($post->ID,'faqs_intro_heading',true) ?> </div>
    <div class="text-15 text-whitte text-center mb-10p"> <?php echo @get_post_meta($post->ID,'faqs_intro_text',true) ?> </div>

    <div class="accordion d-flex flex-wrap justify-content-between" id="faqs">
        <amp-accordion class="d-flex flex-wrap justify-content-between w-100"  animate expand-single-section>
    <?php $i = 0;
    foreach ($faqs as $value) {
        ?>
            <section class="mb-5p">
                <h4 class="w-100 d-flex justify-content-between header p-5p bg-whitte rounded-5">
                    <?php echo $value['question']; ?> <i class="fa fa-plus float-right mt-3p"></i>
                </h4>
                <div class="bg-whitte pt-5p pb-5p pl-10p pr-10p"
                     style="border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;margin-top: -2px;">
                    <div class="text-black">
                    <?php if ( $value['answer'] !=''){
                     echo $value['answer'];
                    } ?>
                    </div>
                </div>
            </section>
        <?php
        $i++;
    }?>
        </amp-accordion>
    </div>
    </div>
<?php }?>