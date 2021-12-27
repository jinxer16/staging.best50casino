    <h1 id="aksiologisi" class="w-100 text-whitte bg-dark text-left bg-primary p-5p m-0p text-16">
        <a class="target-anchor" id="top"></a>
        <?= get_post_meta($post->ID,"casino_custom_meta_h1",true)?get_post_meta($post->ID,"casino_custom_meta_h1",true):get_the_title($post->ID);?>
        <amp-position-observer on="enter:hideAnim.start; exit:showAnim.start" layout="nodisplay">
        </amp-position-observer>
    </h1>
    <!-- get_the_content(null, null, $post->ID) //-->
    <a id="<?=$anchorsids[0]?>" class="position-relative text-decoration-none" style="top: -70px;"></a>
    <div class="review-box-body p-5p border w-100 shadow">
        <?php echo apply_filters('the_content', get_the_content(null,null,$post->ID)); ?>
    </div>
    <div class="w-100 p-5p sign-steps bg-dark d-flex flex-wrap justify-content-between align-items-center flex-column border">
        <div class="step-wrapper d-flex pt-5p pb-5p justify-content-between flex-column w-100">
            <div class="step d-flex mb-5p pl-10p w-sm-100">
                <span class="rounded-circle text-dark font-bold text-30 bg-yellow  pr-15p pl-15p mr-5p ml-5p">1</span>
                <div class="ml-10p">
                    <div class="font-weight-bold text-shadow text-whitte text-17"><?= get_post_meta($post->ID,"casino_custom_meta_step1_1",true);?></div>
                    <div class="text-whitte font-weight-bold text-11"><?= get_post_meta($post->ID,"casino_custom_meta_step1_2",true);?></div>
                </div>
            </div>
            <div class="step d-flex pl-10p mb-5p w-sm-100">
                <span class="rounded-circle text-dark font-bold text-30 bg-yellow  pr-15p pl-15p mr-5p ml-5p">2</span>
                <div class="ml-10p">
                    <div class="font-weight-bold text-shadow text-whitte text-17"><?= get_post_meta($post->ID,"casino_custom_meta_step2_1",true);?></div>

                    <div class="text-whitte font-weight-bold text-11"><?= get_post_meta($post->ID,"casino_custom_meta_step2_2",true);?></div>
                </div>
            </div>
            <div class="step d-flex pl-10p mb-5p w-sm-100">
                <span class="rounded-circle text-dark font-bold text-30 bg-yellow  pr-15p pl-15p mr-5p ml-5p">3</span>
                <div class="ml-10p">
                    <div class="font-weight-bold text-shadow text-whitte text-17"><?= get_post_meta($post->ID,"casino_custom_meta_step3_1",true);?></div>
                    <div class="text-whitte font-weight-bold text-11">
                        <?= get_post_meta($post->ID,"casino_custom_meta_step3_2",true);?></div>
                </div>
            </div>
        </div>
    </div>
