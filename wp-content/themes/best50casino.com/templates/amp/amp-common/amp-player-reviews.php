<div class="review-box w-100 mt-20p">
    <span class="widget2-heading text-whitte p-5p font-weight-bold text-18 mb-3p w-100 d-block mt-0 bg-dark text-left">Player's Comments</span>
    <div class="review-box-title text-whitte d-flex flex-wrap align-items-center">
        <?php
        if (is_singular( 'kss_casino' )) {
            $idgiven = $post->ID;
        }elseif(is_singular( 'bc_bonus_page')){
            $bookieid = get_post_meta($post->ID, 'bonus_custom_meta_bookie_offer', true);
            $idgiven = $bookieid;
        }
        ?>
        <div class="w-100" id="comment-section">
            <?php
            $args = [
                'post_type' => ['player_review'],
                'post_status' => ['publish'],
                'posts_per_page' => 3,
                'fields' => 'ids',
                'suppress_filters' => true,
                'meta_query' => [
                    [
                        'key' => 'review_casino',
                        'value' => $idgiven,
                        'compare' => 'LIKE',
                    ],
                ],
            ];
            $reviews = get_posts($args);
            foreach($reviews as $PlayerReview){ ?>
                <div class="d-flex  p-10p text-black border-bottom mb-2p align-items-center bg-gradient-green">
                    <div class="w-100 d-flex flex-column">
                        <p class="text-14 mb-3p">Reviewed On: <?=get_the_date( 'j/m/Y', $PlayerReview )?></p>
                        <div class="text-14 mb-3p d-flex">
                            <span class="font-weight-bold mr-5p text-13 align-items-center"><?=get_post_meta($PlayerReview, 'review_rating', true) ?> /10</span>
                            <span><?=userVotes::drawStarsDefault(get_post_meta($PlayerReview, 'review_rating', true)/2,20,'amp')?></span>
                        </div>
                        <p class="text-13 mb-3p p-5p"><?=get_the_content(null, null, $PlayerReview);?></p>
                        <?php $authorID = get_post_field('post_author', $PlayerReview); ?>
                        <span class="float-right text-black font-weight-bold" ><?=get_post_meta($PlayerReview,'review_name',true)?></span>
                        <?php
                        $best50Answer = get_post_meta($PlayerReview,'Best50_answer',true);
                        if($best50Answer){
                            ?>
                            <div class="d-flex">
                                <amp-img src="/wp-content/themes/best50casino.com/assets/images/stamp_b.svg" class="mr-5p p-1p" width="35" height="35">
                                </amp-img>
                                <p class="text-13 mb-3p p-5p border rounded-10" style="background: #f2f2f2"><?=strip_tags($best50Answer)?></p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            <?php  }?>
        </div>
    </div>
    <div class="text-whitte d-flex flex-wrap align-items-center">
<!--        <div class="w-100 w-sm-100 text-center">-->
<!--            <img class="p-5p mb-10p" src="--><?php //echo get_post_meta($post->ID, 'trans_logo_large', true) ?><!--">-->
<!--        </div>-->
<!--        <div class="w-100 w-sm-100 text-center">-->
<!--            <a class="rounded-10 btn btn-sm stripe-green pt-10p pb-10p pl-10p pr-10p text-14 mb-5p" data-toggle="collapse"-->
<!--               data-target="#rate-box" aria-expanded="false" aria-controls="rate-box"-->
<!--               href="javascript:void(0);">Leave Your Review</a>-->
<!--        </div>-->
        <div class="w-100 bg-dark p-10p" id="rate-box" data-casino="<?=$post->ID?>">
            <!--                            --><?php //if(is_user_logged_in()){
          include(locate_template('templates/amp/amp-common/amp-sign-up-form.php', false, false));
            //}?>
        </div>
    </div>
</div>