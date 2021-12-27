<div class="w-100 d-flex flex-wrap bg-cover " style="background-image: url('<?= get_post_meta($post->ID,"casino_custom_meta_comp_screen_1",true);?>');background-size: contain; background-position: center; background-repeat: no-repeat;">
    <div class="w-40 d-flex pt-20p pl-5p pb-15p flex-column">
        <amp-img
            src="<?= get_post_meta($post->ID,"casino_custom_meta_trans_logo",true);?>"
            class="img-fluid d-block mx-auto"
            width="140" height="50">
        </amp-img>
        <span class="font-weight-bold text-center text-whitte">Review <?php echo date("Y"); ?></span>
        <div class="company-rating bonus-stars d-flex justify-content-center mb-10p mt-10p mb-xl-0 mb-lg-0" style="font-size:17px;">
            <?php
            $userratings = get_post_meta($post->ID,'user_rating_number',true);
            $usertotal = get_post_meta($post->ID,'user_rating_count',true);
            if ($usertotal == 0 ){
                $rating =0;
            }else {
                $rating = ($userratings/2);
            }
            $ratingWhole = floor($rating);
            $ratingDecimal = $rating - $ratingWhole;
            $j = 5;
            $helper = 1;
            $html = '';
            for($i=0;$i<$ratingWhole;$i++){
                $j -=1 ;
                $html .= '<div class="star-wrap-review-bg star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:100%"></div></div>';
                $helper ++;
            }
            if($ratingDecimal != 0){
                $j -=1 ;
                $test = $ratingDecimal*100;
                $html .= '<div class="star-wrap-review-bg star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:'.$test.'%"></div></div>';
                $helper ++;
            }
            for($i=0;$i<$j;$i++){
                $html .= '<div class="star-wrap-review-bg star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:0%"></div></div>';
                $helper ++;
            }
            echo $html;
            ?>

        </div>
        <?php if ($userratings == 0){
            ?>
            <span class="text-11 pl-5p mb-10p text-center pt-2p text-whitte">No reviews</span>
        <?php
        }else{
            ?>
        <span class="text-11 pl-5p mb-10p text-center pt-2p text-whitte"> <?=$userratings?> From <?=$usertotal?> Reviews</span>
            <?php
        }?>
            <amp-list height="41"
                      layout="fixed-height"
                      src="/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $post->ID ?>"
                      binding="no">
                <template type="amp-mustache">
                    <a class="btn bumper btn btn bg-yellow text-17 w-100 d-block mx-auto text-decoration-none p-5p text-center btn_large text-dark roundbutton font-weight-bold"
                       data-casinoid="<?php echo $post->ID; ?>"
                       data-country="{{countryinfo.iso}}"
                       href="{{0.aff_re2}}" rel="nofollow" target="_blank">Visit</a>
                </template>
            </amp-list>
    </div>
</div>