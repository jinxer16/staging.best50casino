<?php

$faqs = @get_post_meta($post->ID,'faqs',true) ?? false;
if ($faqs ) {
    $faqColor = get_post_meta($post->ID, 'faqs_color',true)? get_post_meta($post->ID, 'faqs_color',true) : '#153141';
    ?><div class="faq p-15p w-100 mb-10p mt-10p" id="faq" style="background-color: <?=$faqColor?>">
    <div class="text-whitte text-center" style="font-size: 28px;margin-bottom: 8px;"> <?php echo @get_post_meta($post->ID,'faqs_intro_heading',true) ?> </div>
    <div class="text-15 text-whitte text-center mb-10p"> <?php echo @get_post_meta($post->ID,'faqs_intro_text',true) ?> </div>

    <div class="accordion d-flex flex-row flex-wrap" id="faqs">
            <amp-accordion class="sample" expand-single-section>
                <?php $i = 0;
                foreach ($faqs as $value) {
                ?>
                <section>
                            <h2 class="question bg-whitte rounded-5 d-flex justify-content-between"><?php echo $value['question']; ?><i class="fa fa-plus float-right"></i></h2>
                            <p class="awnser text-black p-5p "><?php echo $value['answer']; ?></p>
                </section>

                    <?php
                    $i++;
                }
                ?>
            </amp-accordion>
    </div>

    </div>
<?php }?>