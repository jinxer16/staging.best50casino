<?php
//$post->ID = get_post_meta($post->ID, 'casino_custom_meta_bookie_offer', true);
//$bonusName = get_post_meta($post->ID, 'casino_custom_meta_bonus_offer', true);
$bonusISO = get_bonus_iso($post->ID);
$geoBonusArgs = is_country_enabled($post->ID, 'kss_casino');
$countryISO = $GLOBALS['countryISO'];
$ctaLink = $geoBonusArgs['aff_bo'];
$ctaFunction = $geoBonusArgs['ctaFunction'] ;

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
if (wp_is_mobile()){
    ?>
    <div class="w-sm-100 mb-10p p-5p">
        <div class="d-flex flex-column p-5p" style="background: rgb(5,9,11);
background: linear-gradient(180deg, rgba(5,9,11,1) 0%, rgba(29,41,47,1) 31%, rgba(38,75,93,1) 100%); min-height: 104.2%;">
            <img class="img-fluid d-block mx-auto" loading="lazy" src="<?php echo get_post_meta($post->ID, 'casino_custom_meta_trans_logo', true);?>" alt="<?php echo get_the_title($post->ID); ?>" style="min-width: 170px;max-width: 170px;">
            <h1 class="font-weight-bold text-center text-white text-20"><?php echo get_the_title($post->ID)?></h1>
            <div class="company-rating bonus-stars d-flex justify-content-center mb-10p mt-10p mb-xl-0 mb-lg-0" style="font-size:17px;">
                <?php
                if ($totalVotes === 0 ){
                    $rating =0;
                }else {
                    $rating = (($sumVotes/$totalVotes)/2);
                }
                $ratingWhole = floor($rating);
                $ratingDecimal = $rating - $ratingWhole;
                $j = 5;
                $helper = 1;
                $html = '<style>
                    .pretty-star { background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg); }
                    .icon-star { width: 100%;height: 100%; position: absolute; background-size: cover; background-repeat: no-repeat; background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg);}
                    .star-voting.star-game .star-wrap-bonus { height: 16px;width: 16px;}
                    .star-wrap-bonus { position: relative; width: 17px;height: 17px;float: left;border-right: 2px solid transparent;background-size: cover;background-repeat: no-repeat;background-image: url('.get_template_directory_uri().'/assets/images/star_empty.svg);}
                    .star-temp .icon-star {background-image: none;}      
                    </style>';
                for($i=0;$i<$ratingWhole;$i++){
                    $j -=1 ;
                    $html .= '<div class="star-wrap-bonus star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:100%"></div></div>';
                    $helper ++;
                }
                if($ratingDecimal !== 0){
                    $j -=1 ;
                    $test = $ratingDecimal*100;
                    $html .= '<div class="star-wrap-bonus star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:'.$test.'%"></div></div>';
                    $helper ++;
                }
                for($i=0;$i<$j;$i++){
                    $html .= '<div class="star-wrap-bonus star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:0%"></div></div>';
                    $helper ++;
                }
                echo $html;
                ?>
                <?php if ($totalVotes === 0){
                    ?>
                    <span class="text-11 pl-5p mb-10p text-center pt-2p text-white">No Reviews</span>
                    <?php
                }else{
                    ?>
                    <span class="text-11 pl-5p mb-10p text-center pt-2p text-white"> <?=round($rating,1)*2?>/10 From <?=$totalVotes?> Reviews</span>
                    <?php
                }?>
            </div>
            <div class="d-flex flex-wrap">
                <div class="w-33 d-flex flex-column mb-7p text-center text-white">
                    <span class="">BONUS</span>
                    <?php if ($geoBonusArgs['bonusText']['right-bonus']!=='') { ?>
                        <span class="chipbadge font-weight-bold w-45 d-block mx-auto"><?php echo $geoBonusArgs['bonusText']['right-bonus'];?></span>
                        <span class="text-13 text-italic"><?php echo $geoBonusArgs['bonusText']['FlagText'];?></span>
                    <?php
                    }else{
                        ?>
                        <span class="font-weight-bold text-18">-</span>
                        <?php
                    }?>
                </div>
                <div class="w-33 d-flex flex-column mb-7p text-center text-white">
                    <span class="">PERCENTAGE</span>
                    <?php if ($geoBonusArgs['bonusText']['right-percentage'] !=='') { ?>
                        <span class="font-weight-bold text-18"><?php echo $geoBonusArgs['bonusText']['right-percentage'];?></span>
                    <?php }else{
                        ?>
                        <span class="font-weight-bold text-18">-</span>
                        <?php
                    }?>
                </div>
                <div class="w-33 d-flex flex-column mb-7p text-center text-white">
                    <span class="">MIN.DEPOSIT</span>
                    <?php if ($geoBonusArgs['bonusText']['min-dep'] !=='') { ?>
                        <span class="font-weight-bold text-18"><?php echo $geoBonusArgs['bonusText']['min-dep'];?></span>
                    <?php }else{
                        ?>
                        <span class="font-weight-bold text-18">-</span>
                        <?php
                    }?>
                </div>

                <div class="w-100 d-flex flex-column">
                    <!--                        --><?php //if (get_post_meta($bonusName, $bonusISO."casino_custom_meta_no_bonus_code", true)!=1) { ?>
                    <div class="backbutton w-60 d-block mx-auto">
                        <a href="#" class="d-inline-block p-10p text-center text-decoration-none text-white font-weight-thick w-100 bg-primary rounded curl-top-right "
                           data-reveal="<?php if (get_post_meta($post->ID, $bonusISO."casino_custom_meta_bc_code", true) ==='' || get_post_meta($post->ID, $bonusISO."casino_custom_meta_no_bonus_code", true) === 1){
                               echo 'No code';
                           }else{
                               echo get_post_meta($post->ID, $bonusISO."casino_custom_meta_bc_code", true);
                           }
                           ?>">View Bonus Code</a>
                    </div>
                    <span class="bg-dark font-weight-bold text-white text-center d-block w-45 mx-auto">Click to reveal code</span>

                    <a class="btn bumper btn roundbutton font-weight-thick text-sm-13 p-sm-5p btn bg-yellow text-dark text-17 w-70 d-block mt-7p p-10p btn_large text-decoration-none mx-auto font-weight-thick bumper"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                        <span> CLAIM <?php echo get_post_meta($post->ID, $bonusISO."casino_custom_meta_bonus_type", true);?>  BONUS </span>
                    </a>
                    <!--                        --><?php //}else{ ?>
                    <!--                            <span class="bg-dark font-weight-bold text-white text-center d-block w-45 mx-auto">No Bonus</span>-->
                    <!--                        --><?php //} ?>
                    <?php if($geoBonusArgs['restr'] !== 1 && $countryISO === 'gb'){ ?>
                        <?php if(get_post_meta($post->ID, $countryISO."casino_custom_meta_sp_terms_link", true) !==""){?>
                            <span class="text-muted text-center text-13 font-weight-bold p-5p">
                            <?php echo get_post_meta($post->ID, $countryISO."casino_custom_meta_sp_terms", true);?>
                        </span>
                        <?php }else{
                            if(get_post_meta($post->ID, $countryISO."casino_custom_meta_sp_terms", true) !=="") {
                                ?>
                                <span class="text-muted text-center text-13 font-weight-bold p-5p">
                            <?php echo get_post_meta($post->ID, $countryISO."casino_custom_meta_sp_terms", true);?>
                        </span>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="w-sm-100 p-5p d-flex flex-wrap">
        <div class="w-100 d-flex flex-wrap title-ratings" style="background: rgb(5,9,11);background: linear-gradient(180deg, rgba(5,9,11,1) 0%, rgba(29,41,47,1) 31%, rgba(38,75,93,1) 100%);">
            <div class="w-100" style="background: linear-gradient(45deg, #2b898f, transparent);">
                <span class="font-weight-bold text-sm-13 text-16 text-white w-90 p-10p mb-0 d-block text-center mx-auto text-uppercase" style="letter-spacing: 1px;"><?php echo get_post_meta($post->ID, "casino_custom_meta_h1", true); ?> Ratings</span>
            </div>
            <div class="w-70 w-sm-100 d-flex flex-column align-items-center">
                <div class="d-flex flex-wrap p-10p bonus-ratings">
                    <!--                        <div class="w-20 d-flex justify-content-center">-->
                    <!--                            <span class="bg-bonus-icons lazy-background visible cherry"></span>-->
                    <!--                        </div>-->
                    <div class="w-48 w-sm-100 align-self-center">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_reli_rat',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class="">Reliability</span>
                            <span class="float-right text-right"> <?=$value?>/10</span>
                        </div>
                        <div class="progress w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                            <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--                        <div class="w-20 d-flex justify-content-center">-->
                    <!--                            <span class="bg-bonus-icons lazy-background visible diamond"></span>-->
                    <!--                        </div>-->
                    <div class="w-48 pl-sm-0 ml-20p m-sm-0p  w-sm-100">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_game_rat',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class="">Games</span>
                            <span class="float-right text-right"> <?=$value?>/10</span>
                        </div>
                        <div class="progress w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                            <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="w-48 w-sm-100">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_bank_rat',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class="">Banking</span>
                            <span class="float-right text-right"> <?=$value?>/10</span>
                        </div>
                        <div class="progress w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                            <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="w-48 pl-sm-0 ml-20p m-sm-0p  w-sm-100">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_live_rat',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class=""> Live Casino</span>
                            <span class="float-right text-right"> <?=$value?>/10</span>
                        </div>
                        <div class="progress w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                            <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="w-48 w-sm-100">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_overq_rat',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class="">Overall Quality</span>
                            <span class="float-right text-right"> <?=$value?>/10</span>
                        </div>
                        <div class="progress w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                            <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--                        <div class="w-20 d-flex justify-content-center">-->
                    <!--                            <span class="bg-bonus-icons lazy-background visible crown"></span>-->
                    <!--                        </div>-->
                    <div class="w-48 pl-sm-0 ml-20p m-sm-0p w-sm-100">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_cust_rat',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class="">Customer Support</span>
                            <span class="float-right text-right"> <?=$value?>/10</span>
                        </div>
                        <div class="progress w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                            <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value*10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--                        <div class="w-20 d-flex justify-content-center">-->
                    <!--                            <span class="bg-bonus-icons lazy-background visible bell"></span>-->
                    <!--                        </div>-->
                    <div class="w-48 w-sm-100">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_mob_rat',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class="">Mobile</span>
                            <span class="float-right text-right"> <?= $value?>/10</span>
                        </div>
                        <div class="progress w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">
                            <div class="progress-bar text-black font-weight-bold" role="progressbar" aria-valuenow="<?php echo $value*10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--                        <div class="w-20 d-flex justify-content-center">-->
                    <!--                            <span class="bg-bonus-icons lazy-background visible chip"></span>-->
                    <!--                        </div>-->
                    <div class="w-48 pl-sm-0 ml-20p m-sm-0p w-sm-100">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_bonus_rating',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class="">Bonus</span>
                            <span class="float-right text-right"> <?php echo $value;?>/10</span>
                        </div>
                        <div class="progress w-100 mb-15p " style="box-shadow: 0 1px 2px #828586bf;">
                            <div class="progress-bar text-black font-weight-bold"  role="progressbar" aria-valuenow="<?php echo $value*10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="w-30 w-sm-100 align-self-center circle-progress">
                <?php $sum = get_post_meta($post->ID,'casino_custom_meta_sum_rating',true);?>

                <div class="progress d-none d-lg-block d-xl-block mx-auto" data-total='<?php echo $sum *10;?>'>
                                    <span class="progress-left">
                                        <span class="progress-bar border-secondary"></span>
                                        </span>
                    <span class="progress-right">
                                         <span class="progress-bar border-secondary"></span>
                                      </span>
                    <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column text-dark valyeper  h-100  rounded-circle">
                            <span class="text-center font-weight-thick mb-0" style="font-size: 45px; margin-top: 39px;"><?php echo $sum;?></span>
                            <span class="font-weight-bold text-15 mt-0 text-center">Overall Rating</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 p-5p sign-steps mt-10p bg-dark d-flex flex-wrap justify-content-between align-items-center d-sm-column" style="align-self: flex-end;">
            <div class="step-wrapper d-flex pt-5p pb-5p w-70 w-sm-100 justify-content-between align-items-center d-sm-column">
                <div class="step d-flex align-items-center mb-5p pl-10p w-sm-100">
                    <span class="rounded-circle text-dark font-bold text-30 bg-yellow  pr-15p pl-15p mr-5p ml-5p">1</span>
                    <div class="ml-10p">
                        <div class="font-weight-bold text-shadow text-white text-16"><?php echo get_post_meta($post->ID,"casino_custom_meta_step1_1",true);?></div>
                        <div class="text-white text-11"><?php echo get_post_meta($post->ID,"casino_custom_meta_step1_2",true);?></div>
                    </div>
                </div>
                <div class="step d-flex align-items-center pl-10p mb-5p w-sm-100">
                    <span class="rounded-circle text-dark font-bold text-30 bg-yellow  pr-15p pl-15p mr-5p ml-5p">2</span>
                    <div class="ml-10p">
                        <div class="font-weight-bold text-shadow text-white text-16"><?php echo get_post_meta($post->ID,"casino_custom_meta_step2_1",true);?></div>

                        <div class="text-white text-11"><?php echo get_post_meta($post->ID,"casino_custom_meta_step2_2",true);?></div>
                    </div>
                </div>
                <div class="step d-flex align-items-center pl-10p mb-5p w-sm-100">
                    <span class="rounded-circle text-dark font-bold text-30 bg-yellow  pr-15p pl-15p mr-5p ml-5p">3</span>
                    <div class="ml-10p">
                        <div class="font-weight-bold text-shadow text-white text-16"><?= get_post_meta($post->ID,"casino_custom_meta_step3_1",true);?></div>
                        <div class="text-white text-11">
                            <?php echo get_post_meta($post->ID,"casino_custom_meta_step3_2",true);?></div>
                    </div>
                </div>
            </div>
            <div class="step-btn-wrapper d-none d-lg-block d-xl-block w-20 pr-15p">
                <a class="btn bumper btn btn bg-yellow text-17 w-sm-100 d-block p-10p btn_large text-decoration-none text-dark rounded font-weight-bold bumper"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                    <span>CLAIM BONUS</span>
                </a>
            </div>
        </div>
    </div>
    <?php
}else{
    ?>
    <div class="w-70 w-sm-100 p-5p d-flex flex-wrap">
        <div class="w-100 d-flex flex-wrap title-ratings" style="background: rgb(5,9,11);background: linear-gradient(180deg, rgba(5,9,11,1) 0%, rgba(29,41,47,1) 31%, rgba(38,75,93,1) 100%);">
            <div class="w-100" style="background: linear-gradient(45deg, #2b898f, transparent);max-height: 40px;">
                <span class="font-weight-bold text-sm-13 text-16 text-white w-90 p-10p text-center mb-0 d-block mx-auto text-uppercase" style="letter-spacing: 1px;"><?php echo get_post_meta($post->ID, "casino_custom_meta_h1", true); ?> Ratings</span>
            </div>
            <div class="w-70 w-sm-100 d-flex flex-column align-items-center">
                <div class="d-flex flex-wrap p-10p bonus-ratings">
                    <!--                        <div class="w-20 d-flex justify-content-center">-->
                    <!--                            <span class="bg-bonus-icons lazy-background visible cherry"></span>-->
                    <!--                        </div>-->
                    <div class="w-48 w-sm-100 align-self-center">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_reli_rat',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class="">Reliability</span>
                            <span class="float-right text-right"> <?=$value?>/10</span>
                        </div>
                        <div class="progress w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                            <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--                        <div class="w-20 d-flex justify-content-center">-->
                    <!--                            <span class="bg-bonus-icons lazy-background visible diamond"></span>-->
                    <!--                        </div>-->
                    <div class="w-48 pl-sm-0 ml-20p m-sm-0p  w-sm-100">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_game_rat',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class="">Games</span>
                            <span class="float-right text-right"> <?=$value?>/10</span>
                        </div>
                        <div class="progress w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                            <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="w-48 w-sm-100">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_bank_rat',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class="">Banking</span>
                            <span class="float-right text-right"> <?=$value?>/10</span>
                        </div>
                        <div class="progress w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                            <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="w-48 pl-sm-0 ml-20p m-sm-0p  w-sm-100">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_live_rat',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class=""> Live Casino</span>
                            <span class="float-right text-right"> <?=$value?>/10</span>
                        </div>
                        <div class="progress w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                            <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="w-48 w-sm-100">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_overq_rat',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class="">Overall Quality</span>
                            <span class="float-right text-right"> <?=$value?>/10</span>
                        </div>
                        <div class="progress w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                            <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--                        <div class="w-20 d-flex justify-content-center">-->
                    <!--                            <span class="bg-bonus-icons lazy-background visible crown"></span>-->
                    <!--                        </div>-->
                    <div class="w-48 pl-sm-0 ml-20p m-sm-0p w-sm-100">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_cust_rat',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class="">Customer Support</span>
                            <span class="float-right text-right"> <?=$value?>/10</span>
                        </div>
                        <div class="progress w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                            <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value*10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--                        <div class="w-20 d-flex justify-content-center">-->
                    <!--                            <span class="bg-bonus-icons lazy-background visible bell"></span>-->
                    <!--                        </div>-->
                    <div class="w-48 w-sm-100">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_mob_rat',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class="">Mobile</span>
                            <span class="float-right text-right"> <?= $value?>/10</span>
                        </div>
                        <div class="progress w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">
                            <div class="progress-bar text-black font-weight-bold" role="progressbar" aria-valuenow="<?php echo $value*10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--                        <div class="w-20 d-flex justify-content-center">-->
                    <!--                            <span class="bg-bonus-icons lazy-background visible chip"></span>-->
                    <!--                        </div>-->
                    <div class="w-48 pl-sm-0 ml-20p m-sm-0p w-sm-100">
                        <?php
                        $value =get_post_meta($post->ID,'casino_custom_meta_bonus_rating',true) ;
                        ?>
                        <div class="font-weight-bold text-white text-18">
                            <span class="">Bonus</span>
                            <span class="float-right text-right"> <?php echo $value;?>/10</span>
                        </div>
                        <div class="progress w-100 mb-15p " style="box-shadow: 0 1px 2px #828586bf;">
                            <div class="progress-bar text-black font-weight-bold"  role="progressbar" aria-valuenow="<?php echo $value*10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="w-30 w-sm-100 align-self-center circle-progress">
                <?php $sum = get_post_meta($post->ID,'casino_custom_meta_sum_rating',true);?>

                <div class="progress d-none d-lg-block d-xl-block mx-auto" data-total='<?php echo $sum *10;?>'>
                                    <span class="progress-left">
                                        <span class="progress-bar border-secondary"></span>
                                        </span>
                    <span class="progress-right">
                                         <span class="progress-bar border-secondary"></span>
                                      </span>
                    <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column text-dark valyeper  h-100  rounded-circle">
                            <span class="text-center font-weight-thick mb-0" style="font-size: 45px; margin-top: 39px;"><?php echo $sum;?></span>
                            <span class="font-weight-bold text-15 mt-0 text-center">Overall Rating</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100 p-5p sign-steps bg-dark d-flex flex-wrap justify-content-between align-items-center d-sm-column" style="align-self: flex-end;">
            <div class="step-wrapper d-flex pt-5p pb-5p w-70 w-sm-100 justify-content-between align-items-center d-sm-column">
                <div class="step d-flex align-items-center mb-5p pl-10p w-sm-100">
                    <span class="rounded-circle text-dark font-bold text-30 bg-yellow  pr-15p pl-15p mr-5p ml-5p">1</span>
                    <div class="ml-10p">
                        <div class="font-weight-bold text-shadow text-white text-16"><?php echo get_post_meta($post->ID,"casino_custom_meta_step1_1",true);?></div>
                        <div class="text-white text-11"><?php echo get_post_meta($post->ID,"casino_custom_meta_step1_2",true);?></div>
                    </div>
                </div>
                <div class="step d-flex align-items-center pl-10p mb-5p w-sm-100">
                    <span class="rounded-circle text-dark font-bold text-30 bg-yellow  pr-15p pl-15p mr-5p ml-5p">2</span>
                    <div class="ml-10p">
                        <div class="font-weight-bold text-shadow text-white text-16"><?php echo get_post_meta($post->ID,"casino_custom_meta_step2_1",true);?></div>

                        <div class="text-white text-11"><?php echo get_post_meta($post->ID,"casino_custom_meta_step2_2",true);?></div>
                    </div>
                </div>
                <div class="step d-flex align-items-center pl-10p mb-5p w-sm-100">
                    <span class="rounded-circle text-dark font-bold text-30 bg-yellow  pr-15p pl-15p mr-5p ml-5p">3</span>
                    <div class="ml-10p">
                        <div class="font-weight-bold text-shadow text-white text-16"><?php echo get_post_meta($post->ID,"casino_custom_meta_step3_1",true);?></div>
                        <div class="text-white text-11">
                            <?php echo get_post_meta($post->ID,"casino_custom_meta_step3_2",true);?></div>
                    </div>
                </div>
            </div>
            <div class="step-btn-wrapper d-none d-lg-block d-xl-block w-20 pr-15p">
                <a class="btn bumper btn btn bg-yellow text-17 w-sm-100 d-block p-10p btn_large text-decoration-none text-dark rounded font-weight-bold bumper"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                    <span>CLAIM BONUS</span>
                </a>
            </div>
        </div>

    </div>
    <div class="w-30 w-sm-100 p-5p">
        <div class="d-flex flex-column p-5p" style="background: rgb(5,9,11);
background: linear-gradient(180deg, rgba(5,9,11,1) 0%, rgba(29,41,47,1) 31%, rgba(38,75,93,1) 100%); min-height: 104.2%;">
            <img class="img-fluid d-block mx-auto" loading="lazy" src="<?php echo get_post_meta($post->ID, 'casino_custom_meta_trans_logo', true);?>" alt="<?php echo get_the_title($post->ID); ?>" style="min-width: 170px;max-width: 170px;">
            <h1 class="font-weight-bold text-center text-white text-20"><?php echo get_the_title($post->ID)?></h1>
            <div class="company-rating bonus-stars d-flex justify-content-center mb-10p mt-10p mb-xl-0 mb-lg-0" style="font-size:17px;">
                <?php
                if ($totalVotes === 0 ){
                    $rating =0;
                }else {
                    $rating = (($sumVotes/$totalVotes)/2);
                }
                $ratingWhole = floor($rating);
                $ratingDecimal = $rating - $ratingWhole;
                $j = 5;
                $helper = 1;
                $html = '<style>
                    .pretty-star { background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg); }
                    .icon-star { width: 100%;height: 100%; position: absolute; background-size: cover; background-repeat: no-repeat; background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg);}
                    .star-voting.star-game .star-wrap-bonus { height: 16px;width: 16px;}
                    .star-wrap-bonus { position: relative; width: 17px;height: 17px;float: left;border-right: 2px solid transparent;background-size: cover;background-repeat: no-repeat;background-image: url('.get_template_directory_uri().'/assets/images/star_empty.svg);}
                    .star-temp .icon-star {background-image: none;}      
                    </style>';
                for($i=0;$i<$ratingWhole;$i++){
                    $j -=1 ;
                    $html .= '<div class="star-wrap-bonus star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:100%"></div></div>';
                    $helper ++;
                }
                if($ratingDecimal !== 0){
                    $j -=1 ;
                    $test = $ratingDecimal*100;
                    $html .= '<div class="star-wrap-bonus star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:'.$test.'%"></div></div>';
                    $helper ++;
                }
                for($i=0;$i<$j;$i++){
                    $html .= '<div class="star-wrap-bonus star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:0%"></div></div>';
                    $helper ++;
                }
                echo $html;
                ?>
                <?php if ($totalVotes === 0){
                    ?>
                    <span class="text-11 pl-5p mb-10p text-center pt-2p text-white">No Reviews</span>
                    <?php
                }else{
                    ?>
                    <span class="text-11 pl-5p mb-10p text-center pt-2p text-white"> <?=round($rating,1)*2?>/10 From <?=$totalVotes?> Reviews</span>
                    <?php
                }?>
            </div>
            <div class="d-flex flex-wrap">
                <div class="w-33 d-flex flex-column mb-7p text-center text-white">
                    <span class="">BONUS</span>
                    <?php if ($geoBonusArgs['bonusText']['right-bonus']!=='') { ?>
                        <span class="chipbadge font-weight-bold w-45 d-block mx-auto"><?php echo $geoBonusArgs['bonusText']['right-bonus'];?></span>
                        <span class="text-13 text-italic"><?php echo $geoBonusArgs['bonusText']['FlagText'];?></span>
                    <?php } ?>
                </div>
                <div class="w-33 d-flex flex-column mb-7p text-center text-white">
                    <span class="">PERCENTAGE</span>
                    <?php if ($geoBonusArgs['bonusText']['right-percentage'] !=='') { ?>
                        <span class="font-weight-bold text-18"><?php echo $geoBonusArgs['bonusText']['right-percentage'];?></span>
                    <?php } ?>
                </div>
                <div class="w-33 d-flex flex-column mb-7p text-center text-white">
                    <span class="">MIN.DEPOSIT</span>
                    <?php if ($geoBonusArgs['bonusText']['min-dep'] !=='') { ?>
                        <span class="font-weight-bold text-18"><?php echo $geoBonusArgs['bonusText']['min-dep'];?></span>
                    <?php } ?>
                </div>

                <div class="w-100 d-flex flex-column">
                    <!--                        --><?php //if (get_post_meta($bonusName, $bonusISO."casino_custom_meta_no_bonus_code", true)!=1) { ?>
                    <div class="backbutton w-60 d-block mx-auto">
                        <a href="#" class="d-inline-block p-10p text-center text-decoration-none text-white font-weight-thick w-100 bg-primary rounded curl-top-right "
                           data-reveal="<?php if (get_post_meta($post->ID, $bonusISO."casino_custom_meta_bc_code", true) ==='' || get_post_meta($post->ID, $bonusISO."casino_custom_meta_no_bonus_code", true) === 1){
                               echo 'No code';
                           }else{
                               echo get_post_meta($post->ID, $bonusISO."casino_custom_meta_bc_code", true);
                           }
                           ?>">View Bonus Code</a>
                    </div>
                    <span class="bg-dark font-weight-bold text-white text-center d-block w-45 mx-auto">Click to reveal code</span>

                    <a class="btn bumper btn btn bg-yellow text-dark text-17 w-70 d-block mt-7p p-10p btn_large text-decoration-none roundbutton mx-auto font-weight-thick bumper"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                        <span> CLAIM <?php echo get_post_meta($post->ID, $bonusISO."casino_custom_meta_bonus_type", true);?>  BONUS </span>
                    </a>
                    <!--                        --><?php //}else{ ?>
                    <!--                            <span class="bg-dark font-weight-bold text-white text-center d-block w-45 mx-auto">No Bonus</span>-->
                    <!--                        --><?php //} ?>
                    <?php if($geoBonusArgs['restr'] !== 1 && $countryISO === 'gb'){ ?>
                        <?php if(get_post_meta($post->ID, $countryISO."casino_custom_meta_sp_terms_link", true) !==""){?>
                            <span class="text-muted text-center text-13 font-weight-bold p-5p">
                            <?php echo get_post_meta($post->ID, $countryISO."casino_custom_meta_sp_terms", true);?>
                        </span>
                        <?php }else{
                            if(get_post_meta($post->ID, $countryISO."casino_custom_meta_sp_terms", true) !=="") {
                                ?>
                                <span class="text-muted text-center text-13 font-weight-bold p-5p">
                            <?php echo get_post_meta($post->ID, $countryISO."casino_custom_meta_sp_terms", true);?>
                        </span>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>


<div class="w-100 mt-20p m-sm-0p">
    <ul class="offer-anchors-mobile d-flex d-md-flex d-xl-none d-lg-none  text-white flex-wrap align-items-center pl-5p pt-2" style="width: 100%;position: relative;top: 0;z-index: 9;">
        <li class="rounded-5 p-5p m-2p w-48 text-whitte  text-center text-13"><a href="#intro" class="text-white text-sm-13 text-decoration-none">Full casino Review</a></li>
        <li class="rounded-5 p-5p m-2p w-48  text-whitte  text-center text-13"><a href="#welcome_bonus" class="text-white text-sm-13 text-decoration-none">Welcome Bonus</a></li>
        <li class="rounded-5 p-5p m-2p w-48  text-whitte  text-center text-13"><a href="#bonus_code" class="text-white text-sm-13 text-decoration-none">Bonus Code</a></li>
        <li class="rounded-5 p-5p m-2p w-48  text-whitte  text-center text-13"><a href="#free_spins" class="text-white text-sm-13 text-decoration-none">Free Spins & Promotions</a></li>
        <li class="rounded-5 p-5p m-2p w-48  text-whitte  text-center text-13"><a href="#faq" class="text-white text-sm-13 text-decoration-none">FAQ</a></li>
    </ul>
    <ul class="offer-anchors d-md-none d-xl-flex d-lg-flex d-none mb-10p">
        <li><a href="#intro" class="text-white text-decoration-none">Full casino Review</a></li>
        <li><a href="#welcome_bonus" class="text-white text-decoration-none">Welcome Bonus</a></li>
        <li><a href="#bonus_code" class="text-white text-decoration-none">Bonus Code</a></li>
        <li><a href="#free_spins" class="text-white text-decoration-none">Free Spins & Promotions</a></li>
        <li><a href="#faq" class="text-white text-decoration-none">FAQ</a></li>
    </ul>
</div>