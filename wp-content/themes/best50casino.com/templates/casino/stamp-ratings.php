<!--        if casino major background casino_custom_meta_alt_bg-->
<div class="position-relative w-100 h-100 overflow-hidden bg-dark" style="background-size:cover;background-image: url('<?=get_post_meta($post->ID,'casino_custom_meta_rat_bg',true);?>')">
    <img class="stamp mark-review img-fluid position-relative" src="/wp-content/themes/best50casino.com/assets/images/stamp_b.svg">
    <div class="d-flex position-absolute" style="left: 2%">
<!--        <img style="height: 40px; width: 40px;" class="img-fluid bg-dark p-5p d-block mx-auto"-->
<!--             src="https://www.best50casino.com/wp-content/themes/best50casino.com/assets/images/icons/icon-gray-wallet.png">-->
<!--        <img style="height: 40px; width: 40px;" class="img-fluid p-5p bg-dark d-block mx-auto"-->
<!--             src="https://www.best50casino.com/wp-content/themes/best50casino.com/assets/images/icons/icon-gray-wallet.png">-->
<!--        <img style="height: 40px; width: 40px;" class="img-fluid  p-5p bg-dark d-block mx-auto"-->
<!--             src="https://www.best50casino.com/wp-content/themes/best50casino.com/assets/images/icons/icon-gray-wallet.png">-->
    </div>

    <div  class="pull-right billb-right d-flex flex-column  position-absolute" style="top:-6px;left: 53%">
        <img class="img-fluid d-block mx-auto"  src="<?= get_post_meta($post->ID, 'casino_custom_meta_trans_logo', true);?>"
             alt="<?php echo get_the_title($post->ID); ?>"
             style="min-width: 145px;max-width: 145px;">
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
        $rating = $totalVotes != 0? $sumVotes/$totalVotes : 0;
        $reli = get_post_meta($post->ID,'casino_custom_meta_reli_rat',true);
        $payo = get_post_meta($post->ID,'casino_custom_meta_paym_op',true);
        $payspeed = get_post_meta($post->ID,'casino_custom_meta_payo_spe',true);
        $bank = get_post_meta($post->ID,'casino_custom_meta_bank_rat',true);
        $playo = round($rating,1);
        $expo = get_post_meta($post->ID,'casino_custom_meta_expo_rat',true);
        $overq = get_post_meta($post->ID,'casino_custom_meta_overq_rat',true);
        $mobi = get_post_meta($post->ID,'casino_custom_meta_mob_rat',true);
        $liv = get_post_meta($post->ID,'casino_custom_meta_live_rat',true);
        $custom = get_post_meta($post->ID,'casino_custom_meta_cust_rat',true);
        $slot = get_post_meta($post->ID,'casino_custom_meta_slot_rat',true);
        $jack = get_post_meta($post->ID,'casino_custom_meta_jack_rat',true);
        $prov = get_post_meta($post->ID,'casino_custom_meta_prov_rat',true);
        $other = get_post_meta($post->ID,'casino_custom_meta_otg_rat',true);
        $games =get_post_meta($post->ID,'casino_custom_meta_game_rat',true);
        $bonus = get_post_meta($post->ID,'casino_custom_meta_bonus_rating',true);
        $total =get_post_meta($post->ID,'casino_custom_meta_sum_rating',true);

        $sum = $total /2;
        ?>
        <a href="/online-casino-reviews/" target="_blank"  class="font-weight-bold text-24 text-white text-decoration-none position-relative"  style="left: 27%; bottom: 10px;" data-toggle="tooltip" title="Reliability accounts for 35%, while Banking and Overall Quality for 12,5% each of the total rating. Bonus and Mobile account for 10% individually, while Games and Live Casino take up a 7.5% separately. CS weighs in on a 5%."><span class="p-2p" style="background: #03898f47; "><?= $total?>/10 <i class="fa pt-3p pl-5p text-18 pointer fa-info-circle" aria-hidden="true"></i></span></a>
        <div class="company-rating mb-10p mb-xl-0 mb-lg-0 position-relative " style="font-size:17px;left: 27%; bottom: 10px;">
            <?php


            $ratingWhole = floor($sum);
            $ratingDecimal = $sum - $ratingWhole;
            $j = 5;
            $helper = 1;
            $html = '<style>
                    .pretty-star { background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg); }
                    .icon-star { width: 100%;height: 100%; position: absolute; background-size: cover; background-repeat: no-repeat; background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg);}
                    .star-voting.star-game .star-wrap-review { height: 16px;width: 16px;}
                    .star-wrap-review { position: relative; width: 21px;height: 21px;float: left;border-right: 2px solid transparent;background-size: cover;background-repeat: no-repeat;background-image: url('.get_template_directory_uri().'/assets/images/star_empty.svg);}
                    .star-temp .icon-star {background-image: none;}
                    </style>';
            for($i=0;$i<$ratingWhole;$i++){
                $j -=1 ;
                $html .= '<div class="star-wrap-review star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:100%"></div></div>';
                $helper ++;
            }
            if($ratingDecimal != 0){
                $j -=1 ;
                $test = $ratingDecimal*100;
                $html .= '<div class="star-wrap-review star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:'.$test.'%"></div></div>';
                $helper ++;
            }
            for($i=0;$i<$j;$i++){
                $html .= '<div class="star-wrap-review star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:0%"></div></div>';
                $helper ++;
            }
            echo $html;
            ?>

        </div>
    </div>

    <div class="d-flex flex-wrap pr-10p pl-10pp w-100 position-absolute" style="top: 122px;">
        <div class="d-flex flex-column w-100 pl-10p pr-10p ratings-review text-white">
            <?php $ratingsHeading=get_post_meta($post->ID,'casino_custom_meta_h2_ratings',true);?>
            <?php if($ratingsHeading){ ?>
                <h2 class="border-bottom border-white text-white pl-0p text-left"><?php echo $ratingsHeading;?></h2>
            <?php } ?>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start">
                    <span class="d-flex mb-2p">Reliability:</span>
                </div>
                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-white w-100" style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                        <div class="progress-bar text-black font-weight-bold h-100 overf-h float-left text-center"  role="progressbar" aria-valuenow="<?php echo $reli*10; ?>" aria-valuemin="0" aria-valuemax="100">
                            <span class="position-relative d-flex justify-content-start text-white text-12 pl-5p" style="bottom: 0;"><?= $reli?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start position-relative">
                   <span class="d-flex mb-2p">Banking:</span>
                    <i class="fa pt-3p pl-5p text-18 infohover pointer fa-info-circle" aria-hidden="true"></i>
                    <div class="more-ratings bg-white">
                        <span class="d-flex mb-2p text-black text-12"><i class="fa fa-money text-primary p-4p" aria-hidden="true"></i> Payment Options: <span class="font-weight-bold text-primary pl-3p"> <?= $payo;?></span>/10</span>
                        <span class="d-flex mb-2p text-black text-12"><i class="fa fa-fast-forward text-primary p-4p" aria-hidden="true"></i> Payout Speed: <span class="font-weight-bold text-primary pl-3p"> <?= $payspeed;?></span>/10</span>
                    </div>
                </div>

                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-white w-100" style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                        <div class="progress-bar  text-black font-weight-bold h-100 overf-h float-left text-center" role="progressbar" aria-valuenow="<?php echo $bank *10; ?>" aria-valuemin="0" aria-valuemax="100">
                            <span class="position-relative d-flex justify-content-start text-white text-12 pl-5p" style="bottom: 0;"><?= $bank?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start position-relative">
                    <span class="d-flex mb-2p">Overall Quality:</span>
                    <i class="fa pt-3p pl-5p text-18 infohover pointer fa-info-circle" aria-hidden="true"></i>
                    <div class="more-ratings bg-white">
                        <span class="d-flex mb-2p text-black text-12"><i class="fas fa-user-friends text-primary p-4p" aria-hidden="true"></i> Players Opinion: <span class="font-weight-bold text-primary pl-3p"> <?=$playo;?></span>/10</span>
                        <span class="d-flex mb-2p text-black text-12"><i class="fas fa-award text-primary text-16 p-4p" aria-hidden="true"></i> Our Opinion: <span class="font-weight-bold text-primary pl-3p"> <?= $expo;?></span>/10</span>
                    </div>
                </div>

                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-white w-100" style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                        <div class="progress-bar  text-black font-weight-bold h-100 overf-h float-left text-center" role="progressbar" aria-valuenow="<?php echo $overq *10; ?>" aria-valuemin="0" aria-valuemax="100">
                            <span class="position-relative d-flex justify-content-start text-white text-12 pl-5p" style="bottom: 0;"><?= $overq?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start">
                    <span class="d-flex mb-2p">Mobile:</span>
                </div>
                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-white w-100 " style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                        <div class="progress-bar  text-black font-weight-bold h-100 overf-h float-left text-center"   role="progressbar" aria-valuenow="<?php echo $mobi *10; ?>" aria-valuemin="0" aria-valuemax="100">
                            <span class="position-relative d-flex justify-content-start text-white text-12 pl-5p" style="bottom: 0;"><?= $mobi?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start position-relative">
                    <span class="d-flex mb-2p">Games:</span>
                    <i class="fa pt-3p pl-5p text-18 infohover pointer fa-info-circle" aria-hidden="true"></i>
                    <div class="more-ratings bg-white">
                        <span class="d-flex mb-2p text-black text-12 "><span class="toolicons free-casino"></span> Slots: <span class="font-weight-bold text-primary pl-3p"> <?= $slot;?></span>/10</span>
                        <span class="d-flex mb-2p text-black text-12"> <span class="toolicons cards-casino"></span> Jackpots: <span class="font-weight-bold text-primary pl-3p"> <?= $jack;?></span>/10</span>
                        <span class="d-flex mb-2p text-black text-12"><span class="toolicons spades-casino"></span>Providers: <span class="font-weight-bold pl-3p text-primary"> <?=$prov;?></span>/10</span>
                        <span class="d-flex mb-2p text-black text-12"><span class="toolicons scratch-casino"></span> Other games: <span class="font-weight-bold text-primary pl-3p"> <?= $other;?></span>/10</span>
                    </div>
                </div>

                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-white  w-100 " style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                        <div class="progress-bar  text-black font-weight-bold h-100 overf-h float-left text-center"  role="progressbar" aria-valuenow="<?php echo $games*10; ?>" aria-valuemin="0" aria-valuemax="100">
                            <span class="position-relative d-flex justify-content-start text-white text-12 pl-5p" style="bottom: 0;"><?= $games?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start">
                    <span class="d-flex mb-2p">Live Casino:</span>
                </div>
                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-white  w-100 " style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                        <div class="progress-bar  text-black font-weight-bold h-100 overf-h float-left text-center" role="progressbar" aria-valuenow="<?php echo $liv *10; ?>" aria-valuemin="0" aria-valuemax="100">
                            <span class="position-relative d-flex justify-content-start text-white text-12 pl-5p" style="bottom: 0;"><?= $liv?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start">
                    <span class="d-flex mb-2p">Customer Support:</span>
                </div>
                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-white  w-100 " style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                        <div class="progress-bar  text-black font-weight-bold h-100 overf-h float-left text-center" role="progressbar" aria-valuenow="<?php echo $custom *10; ?>" aria-valuemin="0" aria-valuemax="100">
                            <span class="position-relative d-flex justify-content-start text-white text-12 pl-5p" style="bottom: 0;"><?= $custom?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start">
                    <a href="/welcome-bonus/" target="_blank" class="d-flex mb-2p text-white text-decoration-none" data-toggle="tooltip" title="Bonus Amount & Percentage accounts for 30% of the total rating, while Free Spins & Bonus Codes for 20%. Reload & Loyalty Promotions account for 20%, while fair T&Cs take up a 10%. Reasonable Wagering Requirements weigh in on a 20%.">Bonus:</a>
                </div>
                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-white w-100 " style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                        <div class="progress-bar text-black font-weight-bold h-100 overf-h float-left text-center" role="progressbar" aria-valuenow="<?php echo $bonus*10; ?>" aria-valuemin="0" aria-valuemax="100">
                            <span class="position-relative d-flex justify-content-start text-white text-12 pl-5p" style="bottom: 0;"><?= $bonus?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    <a class="btn bumper btn btn bg-yellow text-17 w-70 d-block mx-auto p-5p mb-7p mt-10p btn_large text-decoration-none text-dark roundbutton font-weight-bold bumper position-absolute" style="bottom:0; left:16%; box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
        <span>
            <?php if($GLOBALS['countryISO'] == 'gb'){
                echo "Visit";
                }else{
                    echo "Visit";
                }?>
            </span>
    </a>

</div>