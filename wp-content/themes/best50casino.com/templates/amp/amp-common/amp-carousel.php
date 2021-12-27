<amp-state id="selected">
    <script type="application/json">
        {
            "slide": 0
        }
    </script>
</amp-state>
<div class="w-100 position-relative">
    <amp-carousel width="414"
                  height="196"
                  layout="responsive"
                  type="slides"
                  autoplay
                  delay="3000"
                  on="slideChange:AMP.setState({selected: {slide: event.index}})">
        <div class="carousel-item">
            <div class="d-block w-100"
                 style="height:196px;background-image: url('<?= get_post_meta($post->ID, "casino_custom_meta_comp_mobi_screen_1", true) ?>');background-size: contain;"></div>
        </div>
        <?php
        $comp2meta= get_post_meta($post->ID,"casino_custom_meta_comp_screen_2",true);
        if ($comp2meta != '') { ?>
            <div class="carousel-item">
                <div class="d-block w-100"
                     style="height:196px;background-image: url('<?= get_post_meta($post->ID, "casino_custom_meta_comp_mobi_screen_2", true) ?>');background-size: contain;"></div>
            </div>
            <?php
        }
        ?>
        <?php
        $comp3meta= get_post_meta($post->ID,"casino_custom_meta_comp_screen_3",true);
        if ($comp3meta != '') { ?>
            <div class="carousel-item">
                <div class="d-block w-100"
                     style="height:196px;background-image: url('<?= get_post_meta($post->ID, "casino_custom_meta_comp_mobi_screen_3", true) ?>');background-size: contain;"></div>
            </div>
            <?php
        }
        ?>
    </amp-carousel>
    <p class="dots position-absolute bottom-m-15 w-100">
        <span [class]="selected.slide == 0 ? 'current' : ''" class="current"></span>
        <?php
        $comp2meta= get_post_meta($post->ID,"casino_custom_meta_comp_screen_2",true);
        if ($comp2meta != '') { ?>
            <span [class]="selected.slide == 1 ? 'current' : ''"></span>
            <?php
        }
        $comp3meta= get_post_meta($post->ID,"casino_custom_meta_comp_screen_3",true);
        if ($comp3meta != '') { ?>
            <span [class]="selected.slide == 2 ? 'current' : ''"></span>
            <?php
        }
        ?>
    </p>
    <div class="w-33 d-flex  pb-10p flex-column position-absolute top-0">
        <amp-img
                src="<?= get_post_meta($post->ID, "casino_custom_meta_trans_logo", true); ?>"
                class="img-fluid d-block mx-auto"
                width="100" height="45">
        </amp-img>
        <span class="font-weight-bold text-center text-whitte">Review <?php echo date("Y"); ?></span>
        <div class="company-rating bonus-stars d-flex justify-content-center mb-5p mt-5p mb-xl-0 mb-lg-0"
             style="font-size:17px;">
            <?php
            $args = array(
                'post_type' => 'player_review',
                'posts_per_page' => 999,
                'post_status' => array('publish'),
                'numberposts' => 999,
                'no_found_rows' => true,
                'fields' =>'ids',
                'update_post_term_cache' => false,
                'orderby' => 'rand',
                'meta_query' => array(
                    array(
                        'key' => 'review_casino',
                        'value' => $post->ID,
                    )
                )
            );
            $getreview = get_posts($args);
            $totalVotes = count($getreview);
            $sumVotes=0;
            foreach ($getreview as $review){
                $votes = get_post_meta($review,'review_rating',true);
                $sumVotes +=  (float)$votes;
            }
            wp_reset_postdata();

            if ($totalVotes == 0 ){
                $rating =0;
            }else {
                $rating = (($sumVotes/$totalVotes)/2);
            }
            $ratingWhole = floor($rating);
            $ratingDecimal = $rating - $ratingWhole;
            $j = 5;
            $helper = 1;
            $html = '';
            for ($i = 0; $i < $ratingWhole; $i++) {
                $j -= 1;
                $html .= '<div class="star-wrap-review-bg star-' . $helper . '" id="star-' . $helper . '"><div class="icon-star pretty-star" style="width:100%"></div></div>';
                $helper++;
            }
            if ($ratingDecimal != 0) {
                $j -= 1;
                $test = $ratingDecimal * 100;
                $html .= '<div class="star-wrap-review-bg star-' . $helper . '" id="star-' . $helper . '"><div class="icon-star pretty-star" style="width:' . $test . '%"></div></div>';
                $helper++;
            }
            for ($i = 0; $i < $j; $i++) {
                $html .= '<div class="star-wrap-review-bg star-' . $helper . '" id="star-' . $helper . '"><div class="icon-star pretty-star" style="width:0%"></div></div>';
                $helper++;
            }
            echo $html;
            ?>

        </div>
        <?php if ($totalVotes == 0){
            ?>
            <span class="text-11 pl-5p mb-10p text-center pt-2p text-whitte">No Reviews</span>
            <?php
        }else{
            ?>
            <span class="text-11 pl-5p mb-5p text-center pt-2p text-whitte"> <?=round($rating,1)*2?>/10 From <?=$totalVotes?> Reviews</span>
            <?php
        }?>
        <amp-list height="41"
                  layout="fixed-height"
                  src="/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?type=cta&country=AMP_GEO(ISOCountry)&id=<?= $post->ID ?>"
                  binding="no">
            <template type="amp-mustache">
                <a class="btn bumper btn bg-yellow text-13 w-80 d-block mx-auto text-decoration-none p-3p text-center btn_large text-dark roundbutton font-weight-bold"
                   data-casinoid="<?php echo $post->ID; ?>"
                   data-country="{{countryinfo.iso}}"
                   href="{{0.aff_re2}}" rel="nofollow" target="_blank"><span>Visit</span></a>
            </template>
        </amp-list>
    </div>
</div>