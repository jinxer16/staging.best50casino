<div class="d-flex flex-column p-5p" style="background: rgb(5,9,11);background: linear-gradient(180deg, rgba(5,9,11,1) 0%, rgba(29,41,47,1) 31%, rgba(38,75,93,1) 100%); ">
                    <amp-img
                            class="img-fluid d-block w-100 mx-auto pt-10p"
                            alt="<?php echo get_the_title($bookieid); ?>"
                            src="<?= get_post_meta($bookieid, 'casino_custom_meta_trans_logo', true);?>"
                            width="170"
                            height="80">
                      </amp-img>
                <span class="font-weight-bold text-center text-whitte text-20">
                       <a class="target-anchor" id="top"></a>
                    <?= get_the_title($post->ID)?>
                    <amp-position-observer on="enter:hideAnim.start; exit:showAnim.start" layout="nodisplay">
                    </amp-position-observer>
                </span>
<div class="company-rating bonus-stars d-flex justify-content-center mb-10p mt-10p text-17 ">
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
                'value' => $bookieid,
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
    $html='';
    for($i=0;$i<$ratingWhole;$i++){
        $j -=1 ;
        $html .= '<div class="star-wrap-review  star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:100%"></div></div>';
        $helper ++;
    }
    if($ratingDecimal != 0){
        $j -=1 ;
        $test = $ratingDecimal*100;
        $html .= '<div class="star-wrap-review  star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:'.$test.'%"></div></div>';
        $helper ++;
    }
    for($i=0;$i<$j;$i++){
        $html .= '<div class="star-wrap-review star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:0"></div></div>';
        $helper ++;
    }
    echo $html;
    ?>
    <span class="text-11 pl-5p mb-5p text-center pt-2p text-whitte"> <?=round($rating,1)*2?>/10 From <?=$totalVotes?> Reviews</span>
</div>
<amp-list  height="220" layout="fixed-height"  src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $bookieid; ?>" binding="refresh">
    <template type="amp-mustache">
<div class="d-flex flex-wrap">
    <div class="w-33 d-flex flex-column mb-7p text-center text-whitte">
        <span class="">BONUS</span>
        <span class="chipbadge text-13 pt-3p rounded-15 pb-3p pl-0 pr-0 font-weight-bold w-45 d-block mx-auto" style="box-shadow: 0 2px 5px rgba(0,0,0,.25);background-color: #b60c0c;">
            {{0.bonusText.right-bonus}}</span>
        <span class="text-15 text-italic">{{0.bonusText.FlagText}}</span>
    </div>
    <div class="w-33 d-flex flex-column mb-7p text-center text-whitte">
        <span class="">PERCENTAGE</span>
        <span class="font-weight-bold text-15">{{0.bonusText.right-percentage}}</span>
    </div>
    <div class="w-33 d-flex flex-column mb-7p text-center text-whitte">
        <span class="">MIN.DEPOSIT</span>
        <span class="font-weight-bold text-15">{{0.bonusText.min-dep}}</span>
    </div>

    <div class="w-100 d-flex flex-column">
        <div class="backbutton w-60 d-block mx-auto">
            <a class="p-10p text-center text-whitte position-relative text-decoration-none font-weight-thick w-100 bg-primary rounded curl-top-right show" on="tap:AMP.setState({visible: !visible})" [class]="visible ? 'hide' : 'd-inline-block p-10p text-center text-whitte position-relative font-weight-thick text-decoration-none w-100 bg-primary rounded curl-top-right'" role="button" >View Bonus Code</a>
            <a class="p-10p text-center position-relative text-decoration-none font-weight-thick w-100 border-dashed bg-whitte text-15 text-muted rounded hide"  [class]="visible ? 'd-inline-block p-10p text-center position-relative font-weight-thick w-100 border-dashed bg-whitte text-15 text-muted rounded' : 'hide'"  on="tap:AMP.setState({visible: !visible})" role="button">{{0.bonusCode}}</a>
        </div>
        <a class="bg-dark font-weight-bold text-whitte text-center d-block w-50 mx-auto text-decoration-none"  role="button">Click to reveal code</a>
        <a class="btn bumper btn btn bg-yellow text-black text-17 w-70 d-block mt-7p text-decoration-none p-7p btn_large text-center roundbutton mx-auto font-weight-thick bumper"  data-casinoid="<?php echo $post->ID; ?>" data-country="{{0.ISO}}"  href="{{0.aff_bo}}"  rel="nofollow" target="_blank">
         <span> CLAIM {{0.bonusText.right-bonus}} BONUS </span>
        </a>
        <?php if('{{0.restr}}' != 'true' || '{{0.ISO}}' == "gb"){ ?>
                <span class="text-muted text-center text-13 font-weight-bold p-5p">{{0.bonusText.terms}}</span>
            <?php
            }
        ?>
    </div>
</div>
</template>
</amp-list>
</div>





