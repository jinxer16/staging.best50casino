<?php

$faqs = @get_post_meta($post->ID,'faqs',true) ?? false;
if ($faqs ) {
    $faqColor = get_post_meta($post->ID, 'faqs_color',true)? get_post_meta($post->ID, 'faqs_color',true) : '#03898F';
    ?><div class="faq p-3 w-100 mb-10p mt-10p" id="faq" style="background-color: <?=$faqColor?>">
    <div class="text-white text-center" style="font-size: 28px;margin-bottom: 8px;"> <?php echo @get_post_meta($post->ID,'faqs_intro_heading',true) ?> </div>
    <div class="text-15 text-white text-center mb-10p"> <?php echo @get_post_meta($post->ID,'faqs_intro_text',true) ?> </div>

    <div class="accordion d-flex flex-row flex-wrap" id="faqs">
        <?php $i = 0;
        foreach ($faqs as $value) {
            ?>
            <div class="card mb-1 w-100 p-xs-0 col-lg-6">
                <div class="card-header d-flex" id="heading<?php echo $i; ?>">
                    <button class="btn btn-link w-100 d-flex justify-content-between text-dark" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="<?php echo $i; ?>">
                        <h4 class="question m-0 border-0 font-weight-normal"><?php echo $value['question']; ?></h4>
                        <div class="icon"><i class="fa fa-plus"></i></div
                    </button>
                </div>
                <div id="collapse<?php echo $i; ?>" class="collapse" aria-labelledby="heading<?php echo $i; ?>" data-parent="#faqs">
                    <div class="card-body">
                        <?php echo $value['answer']; ?>
                    </div>
                </div>
            </div>
            <?php

            $i++;
        }
        ?>
    </div>
    </div>
<?php }?>