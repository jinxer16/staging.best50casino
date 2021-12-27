<?php include(locate_template('templates/amp/amp-menu.php', false, false)); ?>
<div class="container p-0 m-0">
    <div class="row p-0 m-0">
        <div class="col-12 mt-5p p-5p">
<!--            --><?php //include locate_template( array( '/common-templates/bottom-menu.php' ) );

$bookieid = get_post_meta($post->ID, 'bonus_custom_meta_bookie_offer', true);
$countryISO = $GLOBALS['countryISO'];
$localIso =  $GLOBALS['visitorsISO']; //
$bonusISO = get_bonus_iso($post->ID);
$bonusName = get_post_meta($post->ID, 'bonus_custom_meta_bonus_offer', true);
$geoBonusArgs = is_country_enabled($bonusName,$bookieid,'bc_bonus');
$bookiename = get_the_title($bookieid);
//Αν η χωρα ειναι ενεργοποιημενη    $countryISO = $GLOBALS['countryISO'];
 $offerList = explode( "|", get_post_meta($post->ID, 'bonus_custom_meta_wb_text', true));
 $image_id = get_post_meta($bookieid, 'casino_custom_meta_comp_screen_1', true);
 $image = wp_get_attachment_image_src($bookieid, 'thumb-230', true);
 $logo = get_post_meta($bookieid, 'casino_custom_meta_trans_logo', true);
$imge_id = getImageId(get_post_meta($bookieid, 'casino_custom_meta_sidebar_icon', true));

$ctaLink = $geoBonusArgs['aff_bo'];
$ctaFunction = $geoBonusArgs['ctaFunction'] ;

$countriesEnabledArray = \WordPressSettings::getCountryEnabledSettings();
$thisISO = WordPressSettings::isCountryActive($countryISO);
$premiumCasinosstring = WordPressSettings::getPremiumCasino($countryISO,'premium');

$casino_pros = explode(',', get_post_meta($bookieid, 'casino_custom_meta_pros', true));
$casino_cons = explode(',', get_post_meta($bookieid, 'casino_custom_meta_why_not_play', true));

$premiumCasinosArray =  explode(",",$premiumCasinosstring);
$isCasinoPremium = in_array($bookieid, $premiumCasinosArray);
//$premiumCasinosArray =  array_values( $premiumCasinosArray);
$numberCasinos = count($premiumCasinosArray);
if ($numberCasinos>4){
    $premiumCasinosArray = array_slice($premiumCasinosArray, 0, 4);
    $colNumber = 3;
}else{
    $colNumber = 12/$numberCasinos;
}
?>

            <div class="d-flex flex-column p-5p" style="background: rgb(5,9,11);background: linear-gradient(180deg, rgba(5,9,11,1) 0%, rgba(29,41,47,1) 31%, rgba(38,75,93,1) 100%); ">
                    <amp-img
                            class="img-fluid d-block w-100 mx-auto pt-10p"
                            alt="<?php echo get_the_title($bookieid); ?>"
                            src="<?= get_post_meta($bookieid, 'casino_custom_meta_trans_logo', true);?>"
                            width="170"
                            height="80"
                           >
                      </amp-img>
                <span class="font-weight-bold text-center text-whitte text-20"><?= get_the_title($post->ID)?></span>
                <div class="company-rating bonus-stars d-flex justify-content-center mb-10p mt-10p mb-xl-0 mb-lg-0" style="font-size:17px;">
                    <?php


                    $userratings = get_post_meta($bookieid,'user_rating_number',true);
                    $usertotal = get_post_meta($bookieid,'user_rating_count',true);
                    //                    $rating = $userratings/$usertotal;
                    $rating =4.7;
                    $ratingWhole = floor($rating);
                    $ratingDecimal = $rating - $ratingWhole;
                    $j = 5;
                    $helper = 1;
                    $html = '<style>
                    .pretty-star { background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg); }
                    .icon-star { width: 100%;height: 100%; position: absolute; background-size: cover; background-repeat: no-repeat; background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg);}
                    .star-voting.star-game .star-wrap-bonus { height: 16px;width: 16px;}
                    .star-wrap-bonus { position: relative; width: 14px;height: 14px;float: left;border-right: 2px solid transparent;background-size: cover;background-repeat: no-repeat;background-image: url('.get_template_directory_uri().'/assets/images/star_empty.svg);}
                    .star-temp .icon-star {background-image: none;}      
                    </style>';
                    for($i=0;$i<$ratingWhole;$i++){
                        $j -=1 ;
                        $html .= '<div class="star-wrap-bonus mt-2p star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:100%"></div></div>';
                        $helper ++;
                    }
                    if($ratingDecimal != 0){
                        $j -=1 ;
                        $test = $ratingDecimal*100;
                        $html .= '<div class="star-wrap-bonus mt-2p star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:'.$test.'%"></div></div>';
                        $helper ++;
                    }
                    for($i=0;$i<$j;$i++){
                        $html .= '<div class="star-wrap-bonus mt-2p star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:0%"></div></div>';
                        $helper ++;
                    }
                    echo $html;
                    ?>
                    <span class="text-11 pl-5p pt-2p text-whitte">Rating 3,3 From 11 Reviews</span>
                </div>
                <div class="d-flex flex-wrap">
                    <div class="w-33 d-flex flex-column mb-7p text-center text-whitte">
                        <span class="">BONUS</span>
                        <span class="chipbadge text-13 pt-3p pb-3p pl-0 pr-0 font-weight-bold w-45 d-block mx-auto"><?=get_post_meta($bonusName, $bonusISO."bs_custom_meta_bonus_type", true);?></span>
                        <span class="text-15 text-italic"><?=get_post_meta($bonusName, $bonusISO."bs_custom_meta_cta_for_top_2", true);?></span>
                    </div>
                    <div class="w-33 d-flex flex-column mb-7p text-center text-whitte">
                        <span class="">TURN OVER</span>
                        <span class="font-weight-bold text-15"><?=get_post_meta($bonusName, $bonusISO."bs_custom_meta_bc_perc", true);?></span>
                    </div>
                    <div class="w-33 d-flex flex-column mb-7p text-center text-whitte">
                        <span class="">MIN.DEPOSIT</span>
                        <span class="font-weight-bold text-15"><?=get_post_meta($bonusName, $bonusISO."bs_custom_meta_min_dep", true);?></span>
                    </div>

                    <div class="w-100 d-flex flex-column">
                        <div class="backbutton w-60 d-block mx-auto">
                            <a href="#" class="d-inline-block p-10p text-center text-whitte position-relative font-weight-thick w-100 bg-primary rounded curl-top-right " data-reveal="<?= get_post_meta($bonusName, $bonusISO."bs_custom_meta_bc_code", true);?>">View Bonus Code</a>
                        </div>
                        <span class="bg-dark font-weight-bold text-whitte text-center d-block w-50 mx-auto">Click to reveal code</span>
                        <a class="btn bumper btn btn bg-yellow text-black text-17 w-70 d-block mt-7p p-7p btn_large text-center roundbutton mx-auto font-weight-thick bumper"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                            CLAIM <?=get_post_meta($bonusName, $bonusISO."bs_custom_meta_bonus_type", true);?>  BONUS
                        </a>
                        <?php if($geoBonusArgs['restr'] != 1 && $countryISO=='gb'){ ?>
                            <?php if(get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms_link", true) !=""){?>
                                <span class="text-muted text-center text-13 font-weight-bold p-5p">
                            <?=get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms", true);?>
                        </span>
                            <?php }else{
                                if(get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms", true) !="") {
                                    ?>
                                    <span class="text-muted text-center text-13 font-weight-bold p-5p">
                            <?=get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms", true);?>
                        </span>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>

                <!--                user_rating_count-->
                <!--                user_rating_number-->
            </div>

            <div class="w-100 d-flex mt-10p flex-wrap" style="background: rgb(5,9,11);
background: linear-gradient(180deg, rgba(5,9,11,1) 0%, rgba(29,41,47,1) 31%, rgba(38,75,93,1) 100%);">
                <div class="w-100 border-bottom">
                    <h1 class="font-weight-bold text-18 text-whitte w-90 p-7p mb-0 text-18 d-block mx-auto text-uppercase" style="letter-spacing: 1px;"><?= get_post_meta($post->ID, "bonus_custom_meta_h1", true); ?></h1>
                </div>
                <div class="w-100 mt-10p d-flex flex-column align-items-center">
                    <div class="d-flex flex-wrap text-whitte p-10p bonus-ratings">
                        <div class="w-20 d-flex justify-content-center">
                            <span class="bg-bonus-icons cherry"></span>
                        </div>
                        <div class="w-80 align-self-center">
                            <?php
                            $value =get_post_meta($post->ID,'bonus_custom_meta_bonus_match',true) ;
                            ?>
                            <div class="font-weight-bold text-whitte text-15">
                                <span class=""> Bonus match & Percentage</span>
                                <span class="float-right text-right"> <?=$value?> %</span>
                            </div>
                            <div class="progress bg-whitte mb-5p text-13 w-100 " style="box-shadow: 0 1px 2px #828586bf;">
                                <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="w-20 d-flex justify-content-center">
                            <span class="bg-bonus-icons  diamond"></span>
                        </div>
                        <div class="w-80">
                            <?php
                            $value =get_post_meta($post->ID,'bonus_custom_meta_free_spins',true) ;
                            ?>
                            <div class="font-weight-bold text-whitte text-15">
                                <span class=""> Free Spins & Bonus Codes</span>
                                <span class="float-right text-right"> <?=$value?> %</span>
                            </div>
                            <div class="progress bg-whitte mb-5p w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                                <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="w-20 d-flex justify-content-center">
                            <span class="bg-bonus-icons crown"></span>
                        </div>
                        <div class="w-80">
                            <?php
                            $value =get_post_meta($post->ID,'bonus_custom_meta_loaylty',true) ;
                            ?>
                            <div class="font-weight-bold text-whitte text-15">
                                <span class=""> Reload & loaylty promotions</span>
                                <span class="float-right text-right"> <?=$value?> %</span>
                            </div>
                            <div class="progress bg-whitte mb-5p w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                                <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="w-20 d-flex justify-content-center">
                            <span class="bg-bonus-icons bell"></span>
                        </div>
                        <div class="w-80">
                            <?php
                            $value =get_post_meta($post->ID,'bonus_custom_meta_fair_terms',true) ;
                            ?>
                            <div class="font-weight-bold text-whitte text-15">
                                <span class=""> Fair Terms & Conditions</span>
                                <span class="float-right text-right"> <?=$value?> %</span>
                            </div>
                            <div class="progress bg-whitte mb-5p w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">

                                <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="w-20 d-flex justify-content-center">
                            <span class="bg-bonus-icons chip"></span>
                        </div>
                        <div class="w-80">
                            <?php
                            $value =get_post_meta($post->ID,'bonus_custom_meta_wagering',true) ;
                            ?>
                            <div class="font-weight-bold text-whitte text-15">
                                <span class="">Reasonable Wagering Requirments</span>
                                <span class="float-right text-right"> <?=$value?> %</span>
                            </div>
                            <div class="progress bg-whitte mb-5p w-100 mb-10p " style="box-shadow: 0 1px 2px #828586bf;">
                                <div class="progress-bar text-black font-weight-bold"   role="progressbar" aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 mt-10p align-self-center circle-progress">
                    <?php $sum = (get_post_meta($bookieid,'casino_custom_meta_sum_rating',true)*10);?>

                    <div class="progress d-none d-lg-block d-xl-block mx-auto" data-total='<?= $sum;?>'>
                                    <span class="progress-left">
                                        <span class="progress-bar border-secondary"></span>
                                        </span>
                        <span class="progress-right">
                                         <span class="progress-bar border-secondary"></span>
                                      </span>
                        <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                            <div class="d-flex flex-column text-dark valyeper  h-100  rounded-circle">
                                <span class="text-center font-weight-thick mb-0" style="font-size: 45px; margin-top: 39px;"><?= round($sum);?>%</span>
                                <span class="font-weight-bold text-15 mt-0 text-center">Overall Rating</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 mt-10p">
                <ul class="offer-anchors d-flex mb-10p ml-0 mr-0 p-0 flex-wrap list-typenone ">
                    <li class="rounded-5 p-5p m-2p text-whitte text-center text-13" ><a href="#intro" class="text-whitte text-13"><?php echo get_post_meta($post->ID, 'bonus_custom_meta_Tab_intro', true); ?></a></li>
                    <li class="rounded-5 p-5p m-2p text-whitte text-center text-13" ><a href="#bonus-code" class="text-whitte text-13"><?php echo get_post_meta($post->ID, 'bonus_custom_meta_Tab_bonus_code', true); ?></a></li>
                    <li class="rounded-5 p-5p m-2p text-whitte text-center text-13" ><a href="#offers" class="text-whitte text-13"><?php echo get_post_meta($post->ID, 'bonus_custom_meta_Tab_offers', true); ?></a></li>
                    <li class="rounded-5 p-5p m-2p text-whitte text-center text-13" ><a href="#faq" class="text-whitte text-13">FAQ</a></li>
                    <li class="rounded-5 p-5p m-2p text-whitte text-center text-13 bg-primary review-ach"><a class="text-whitte text-13" href="<?php echo get_the_permalink($bookieid); ?>">Full Casino Review</a></li>
                </ul>
            </div>


            <span class="widget2-new-heading mb-5p w-100 d-block mt-0 pt-5p pb-5p pr-7p pl-7p text-uppercase font-weight-bold text-whitte text-left"><?= get_the_title($bookieid);?> Welcome Package Details</span>
            <div class="flex-wrap d-flex shadow-box p-5p" id="intro">
            <span class="w-100 text-justify">
<!--            --><?php //echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_intro",true)); ?>
                All newly registered 1xBet users from Russia, Ukraine, Portugal, Brazil, and the rest of the world, have an opportunity to claim a 1xBet casino welcome bonus worth up to €1500, plus 150 free spins for selected slots. Creating a new account by entering all the necessary info and connecting your phone number with the casino is the first step toward claiming the bonus. The second step is depositing at least €10 or a corresponding sum in another currency. Once you complete these steps, the bonus will be credited to your account automatically. The entire 1xBet casino sign-up bonus is worth up to €1500 and 150 free spins. It rewards new players not just on their first deposit, but three subsequent ones as well. Check out the explanation below for further information:
             <?php echo  do_shortcode('[box-list first="1st deposit 100% up to 300 Bonus +300 Free Spins" second="1st deposit 100% up to 300 Bonus +300 Free Spins " third="1st deposit 100% up to 300 Bonus +300 Free Spins " cta="Get this Bonus"]');?>
            The 1xBet casino bonus is worth even more with the exclusive offer from Best50 Casino. Claim the bonus through this link and get 30% more on top of the standard welcome offer. The offer is valid for all countries.
            </span>
            </div>


            <div class="widget2 mt-0 mb-0">
                <div class="d-flex flex-wrap bg-dark ">
                    <span class="w-70 text-left font-weight-bold text-whitte p-10p">Pros</span>
                    <span class="w-30 d-flex" style="background-color:#1f8e23;clip-path: polygon(39% 0, 100% 0, 100% 100%, 0% 100%);">
              <i class="fas fa-plus m-auto text-dark pl-15p text-center"></i>
            </span>
                </div>
                <div class="widget2-body p-10p">
                    <ul class="billboard-list list-typenone text-dark w-80 mx-auto p-0 position-relative mt-5p mb-5p">
                        <?php foreach ($casino_pros as $pros) { ?>
                            <li style="border-bottom: 1px solid #7d7b7b8c;" class="font-weight-bold"><?php echo $pros; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="widget2 mt-0 mb-0">
                <div class="d-flex flex-wrap bg-dark ">
                    <span class="w-70 font-weight-bold text-left text-whitte p-10p">Cons</span>
                    <span class="w-30 d-flex" style="background-color:#b50255;clip-path: polygon(39% 0, 100% 0, 100% 100%, 0% 100%);">
              <i class="fas fa-minus m-auto text-whitte pl-15p text-center"></i>
            </span>
                </div>
                <div class="widget2-body p-10p">
                    <ul class="cons-list list-typenone text-dark w-80 mx-auto p-0 position-relative mt-5p mb-5p">
                        <?php foreach ($casino_cons as $pros) { ?>
                            <li style="border-bottom: 1px solid #7d7b7b8c;" class="font-weight-bold"><?php echo $pros; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="p-10p w-100 bg-dark">
                <a class="btn bumper btn btn bg-yellow text-17 w-70 d-block text-center mx-auto p-7p btn_large text-dark roundbutton font-weight-bold bumper" style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                    <?php if($GLOBALS['countryISO'] == 'gb'){
                        echo "Visit";
                    }else{
                        echo "Visit";
                    }?></a>
            </div>
            

            <span class="widget2-new-heading mb-0 w-100 d-block mt-20p pt-5p pb-5p pr-7p pl-7p text-uppercase font-weight-bold text-whitte text-left" id="bonus-code"><?=get_the_title($bookieid);?> Bonus Code / Promo Code</span>
            <div class="flex-wrap d-flex shadow-box p-5p" id="bonus-codes">
             <span class="w-100 text-justify">
              <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_promo_code",true)); ?>
            </span>
                <div class="d-flex flex-wrap w-100 rounded">
                    <div class="w-33 bg-yellow text-dark text-center font-weight-bold p-10p d-block m-auto" style="border-top-left-radius:12px;border-right: 1px solid black;"><i class="fas fa-bolt d-inline-block text-17"></i> One Click</div>
                    <div class="w-33 bg-gray-light text-center p-10p font-weight-bold d-block m-auto" style="border-right: 1px solid black;"><i class="fas fa-mobile d-inline-block text-17"></i> By Phone</div>
                    <div class="w-33 bg-gray-light text-center font-weight-bold p-10p d-block m-auto" style="border-top-right-radius:12px;"><i class="fas fa-envelope d-inline-block text-17"></i> By Mail</div>
                    <div class="w-100 d-flex flex-column p-10p bg-dark">
                        <div class="bg-whitte w-80 d-block mx-auto p-7p" style="border-radius: 5px;">
                            <?php
                            $flagISO = $localIso != 'nl' ? $localIso : 'eu';
                            $ret = get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;'));
                            ?>
                            <span class="font-weight-bold"><?=$ret.' '.$GLOBALS['countryName']?><i class="fas fa-angle-down text-17 mt-5p float-right"></i></span>
                        </div>
                        <div class="bg-whitte w-80 mt-10p d-block mx-auto p-7p" style="border-radius: 5px;">
                            <?php $ret = get_post_meta($bonusName, $bonusISO."bs_custom_meta_bc_code", true);?>
                            <span class="font-weight-bold bg-primary text-whitte p-5p"><?=$ret;?><i class="fas fa-angle-down text-17 mt-5p float-right"></i></span>
                        </div>
                        <div class="bg-whitte w-80 mt-10p d-block mx-auto p-7p" style="border-radius: 5px;">
                            <?php
                            $curr = $GLOBALS['countryCurrency'];
                            ?>
                            <span class="font-weight-bold"> <?=$curr['symbol']?><?=$curr['code']?>(<?=$curr['name']?>) <i class="fas fa-angle-down text-17 mt-5p float-right"></i></span>
                        </div>

                        <a class="btn bumper btn btn bg-yellow text-17 w-80 d-block p-10p mx-auto mt-10p btn_large rounded font-weight-bold bumper"  rel="nofollow" target="_blank">REGISTER
                        </a>
                    </div>
                </div>
                <div class="d-flex flex-column w-100 mt-5p steps-bonus">
                    <div class="d-flex flex-wrap w-100 mt-3p"><div class="w-10 d-block m-auto p-5p"><span class="stepper text-whitte font-weight-bold d-inline-block mr-5p text-center">1</span></div><div class="w-80 bg-gray-light d-block m-auto p-7p text-13 font-weight-bold">Create your personal account by clicking on the registration button</div> </div>
                    <div class="d-flex flex-wrap w-100 mt-3p"><div class="w-10 d-block p-5p m-auto"><span class="stepper text-whitte font-weight-bold d-inline-block mr-5p text-center">2</span></div><div class="w-80 bg-gray-light d-block m-auto p-7p text-13 font-weight-bold">Provide the casino with your personal details</div> </div>
                    <div class="d-flex flex-wrap w-100 mt-3p"><div class="w-10 d-block p-5p m-auto"><span class="stepper text-whitte font-weight-bold d-inline-block mr-5p text-center">3</span></div><div class="w-80 bg-gray-light d-block m-auto p-7p text-13 font-weight-bold">Enter any of the casino's available promo codes,or Best50casino's exclusive code in the corresponding field</div> </div>
                    <div class="d-flex flex-wrap w-100 mt-3p"><div class="w-10 d-block p-5p m-auto"><span class="stepper text-whitte font-weight-bold d-inline-block mr-5p text-center">4</span></div><div class="w-80 bg-gray-light d-block m-auto p-7p text-13 font-weight-bold">Complete the registration process and claim your bonus</div> </div>
                    <a class="btn bumper btn btn bg-yellow text-17 text-center w-60 d-block p-10p mx-auto mt-10p btn_large roundbutton font-weight-bold bumper text-black"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">GET THIS BONUS <i class="fas fa-angle-right"></i>
                    </a>
                </div>
            </div>

            <span class="widget2-new-heading mb-0 w-100 d-block mt-20p pt-5p pb-5p pr-7p pl-7p text-uppercase font-weight-bold text-whitte text-left">Are there any Hidden terms on <?=get_the_title($bookieid);?> Bonus</span>
            <div class="flex-wrap d-flex shadow-box">
            <span class="w-100 text-justify">
              <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_hidden_terms",true)); ?>
            </span>
            </div>


<!--            --><?//= compareCasino($bookieid);?>

            <span class="widget2-new-heading mb-0 w-100 d-block mt-20p pt-5p pb-5p pr-7p pl-7p text-uppercase font-weight-bold text-whitte text-left">Is there a <?= get_the_title($bookieid);?> No Deposit Bonus?</span>
            <div class="flex-wrap d-flex shadow-box p-5p">
            <span class="w-100 text-justify">
              <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_no_depo",true)); ?>
            </span>
            </div>

            <span class="widget2-new-heading mb-0 w-100 d-block mt-20p pt-5p pb-5p pr-7p pl-7p text-uppercase font-weight-bold text-whitte text-left" id="offers"><?= get_the_title($bookieid);?> Free spins</span>
            <div class="flex-wrap d-flex shadow-box p-5p">
                <div class="w-100 d-flex">
                <span class="float-left text-left">
                     <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_free_spins_text",true)); ?>
                </span>
                    <amp-img
                            class="img-fluid float-right d-block m-auto"
                            alt="spins"
                            src="/wp-content/themes/best50casino.com/assets/images/spins-7.png"
                            width="100"
                            height="50">
                    </amp-img>

                </div>
            </div>

            <span class="widget2-new-heading mb-0 w-100 d-block mt-20p pt-5p pb-5p pr-7p pl-7p text-uppercase font-weight-bold text-whitte text-left">How to complete requirements of <?=get_the_title($bookieid);?> Bonus fast</span>
            <div class="flex-wrap d-flex shadow-box">
            <span class="w-100 text-justify">
                     <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_how_to_co",true)); ?>
            </span>
            </div>

            <span class="widget2-new-heading mb-0 w-100 d-block mt-20p pt-5p pb-5p pr-7p pl-7p text-uppercase font-weight-bold text-whitte text-left"><?= get_the_title($bookieid);?> Casino Promotions For existing Players</span>
            <div class="table-responsive w-100">
                <?php
                $data = get_post_meta($post->ID,$bonusISO."_promotions",true);
                ?>
                <table class="table-sm w-100"  style="border: 1px solid #84838394;">
                    <thead>
                    <tr>
                        <th scope="col" class="inline-hor-logo p-10p pb-10p text-dark font-weight-bold text-center  numeric d-table-cell w-auto" style=" color: #354046; background: #c7ccce;">TYPE OF OFFER</th>
                        <th scope="col" class="inline-hor-logo p-10p pb-10p text-dark font-weight-bold text-center  numeric d-table-cell w-auto" style=" color: #354046; background: #c7ccce;">INFO</th>
                        <th scope="col" class="inline-hor-logo p-10p pb-10p text-dark font-weight-bold text-center  numeric d-table-cell w-auto" style="  color: #354046; background: #c7ccce;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data as $promo){
                        ?>
                        <tr class="font-weight-bold" style="box-shadow: 0 1px 2px #828586bf; color: #797979">
                            <td class="text-left"><?=$promo['type_of'];?></td>
                            <td class="text-left"><?=$promo['info'];?></td>
                            <td class="text-left w-25">
                                <a class="btn bumper btn btn bg-yellow text-15 w-100 d-block p-7p btn_large  text-black rounded mx-auto font-weight-bold bumper"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                                    REVEAL CODE
                                </a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="shadow-box d-flex flex-wrap mt-20p w-100" style="border: 1px solid #8e8e8e94;">
                <span class="p-5p text-left font-weight-bold mb-5p"><i class="fas fa-user"></i> <?= get_the_title($bookieid);?> VIP Cashback Offer</span>
                <span class="w-100 p-5p text-justify">
            <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_vip_cashback",true)); ?>
            </span>
                <div class="table-responsive viptable w-100">
                    <table class="table-sm w-100"  style="border-left: 1px solid #84838394;border-bottom: 1px solid #84838394;border-right: 1px solid #84838394;">
                        <thead>
                        <tr class="font-weight-bold">
                            <th scope="col" class="inline-hor-logo p-10p pb-10p text-dark font-weight-bold text-center numeric d-table-cell w-auto" style="  background-color: #f7f7f7; color: #354046; background: #c7ccce;">Status</th>
                            <th scope="col" class="inline-hor-logo p-10p pb-10p text-dark font-weight-bold text-center numeric d-table-cell w-auto" style="  background-color: #f7f7f7; color: #354046; background: #c7ccce;">Cashback</th>
                            <th scope="col" class="inline-hor-logo p-10p pb-10p text-dark font-weight-bold text-center numeric d-table-cell w-auto" style="  background-color: #f7f7f7; color: #354046; background: #c7ccce;">Maximum Bonus</th>
                        </tr>
                        </thead>
                        <?php
                        $data = get_post_meta($post->ID,$bonusISO."_vip",true);

                        ?>
                        <tbody>
                        <?php
                        foreach ($data as $vip){
                            ?>
                            <tr class="font-weight-bold" style="box-shadow: 0 1px 2px #828586bf; color: #797979">
                                <td align="center" class="text-left" style="padding: 12px;"><?=$vip['level']?></td>
                                <td class="text-center"><?=$vip['experience']?></td>
                                <td class="text-center"><?=$vip['cashback']?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
                <div class="text-justify p-5p w-100">
                    You will have no doubt noticed the huge decrease in the cashback percentage for players that claim the elite VIP status. This is because rather than paying cashback on losses, users at the final stage of this enticing
                    scheme get cashback on every single bet placed whether it wins or loses. The exact percentage varies depending on the type of casino game.
                    <a class="btn bumper btn btn bg-yellow text-17 w-50 mr-10p mt-10p mb-10p float-right text-center p-7p btn_large text-dark roundbutton font-weight-bold bumper" style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                        Get this Bonus <i class="fas fa-angle-right"></i>
                    </a>
                </div>

            </div>
            <span class="widget2-new-heading mb-0 w-100 d-block mt-20p pt-5p pb-5p pr-7p pl-7p text-uppercase font-weight-bold text-whitte text-left dail-bonus"><?= get_the_title($bookieid);?> Loyalty Bonus</span>
            <div class="flex-wrap d-flex shadow-box">
            <span class="w-100 p-5p text-justify">
            <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_loyalt_bonus",true)); ?>
            </span>
            </div>



            <span class="widget2-new-heading mb-0 w-100 d-block mt-20p pt-5p pb-5p pr-7p pl-7p text-uppercase font-weight-bold text-whitte text-left "><?= get_the_title($bookieid);?> casino daily bonus /live casino bonus</span>
            <div class="flex-wrap d-flex shadow-box dail-bonus">
            <span class="w-100 p-5p text-justify">
            <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_live_bonus",true)); ?>
            </span>
                <div class="text-justify p-5p w-100">
                    Remember, you automatically attract the cashback when your account gets to a balance of 2EUR or below.  To top up your account through this bonus, visit your account and click Get Mega Cashback, and it will be done.
                    <a class="btn bumper btn btn bg-yellow text-17 w-50 mr-10p text-center mt-10p mb-10p float-right  p-7p btn_large text-dark roundbutton font-weight-bold bumper" style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                        Get this Bonus <i class="fas fa-angle-right"></i>
                    </a>
                </div>
            </div>


            <div class="widget2 mt-10p mb-10p">
                <span class="widget2-heading text-whitte pt-5p pb-5p pr-7p pl-7p font-weight-bold text-18 mb-2p w-100 d-block mt-0 bg-dark text-left">General Info</span>
                <div class="d-flex flex-wrap  w-100 ">
                    <div class="w-100 pt-10p pb-5p bg-gray-light box-sidebar">
                        <div class="w-90 m-auto">
                            <h6 class="mb-2p text-primary font-weight-bold"  style="border-bottom: 1px solid #525252;">Licensed in</h6>
                            <?php

                            foreach (get_post_meta($bookieid, 'casino_custom_meta_license_country') as $option) {
                                if ($option) {
                                    $i = 0;
                                    $len = count($option);
                                    foreach ($option as $licenseid){
                                        if ($licenseid == '13975'){
                                            $title = 'Sweden';
                                        }else{
                                            $title = get_the_title($licenseid);
                                        }
                                        if (count($option) > 1){

                                            if(++$i === $len) {
                                                echo  $title;
                                            }else{
                                                echo  $title .", ";
                                            }

                                        }else{
                                            echo  $title ;
                                        }

                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap mb-2p w-100 ">
                    <div class="w-100 pt-10p pb-5p bg-gray-light box-sidebar">
                        <div class="w-90 m-auto">
                            <h6 class="mb-2p text-primary font-weight-bold" style="border-bottom: 1px solid #777777f5;">Founded</h6>
                            <p><?php echo get_post_meta($bookieid, 'casino_custom_meta_com_estab', true); ?></p>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap w-100 ">
                    <div class="w-100 bg-gray pt-10p pb-5p box-sidebar">
                        <div class="w-90 m-auto">
                            <h6 class="mb-2p text-primary font-weight-bold" style="border-bottom: 1px solid #777777f5;">Website</h6>
                            <p class="text-dark"><a class="text-dark" rel="nofollow"
                                                    href="<?php echo get_post_meta($bookieid, 'casino_custom_meta_affiliate_link_review', true); ?>"><?php echo str_replace("https://", "", get_post_meta($bookieid, 'casino_custom_meta_com_url', true)); ?></a>
                            </p>
                        </div>
                    </div>
                </div>

                <?php if (get_post_meta($bookieid, 'casino_custom_meta_twitter_option') || get_post_meta($bookieid, 'casino_custom_meta_facebook_option') || get_post_meta($bookieid, 'casino_custom_meta_instagram_option')) { ?>
                    <div class="info-row w-100">
                        <h6>Social Media</h6>
                        <?php
                        $sret = '';
                        $social = get_post_meta($bookieid, 'casino_custom_meta_twitteroption_det');
                        $social1 = get_post_meta($bookieid, 'casino_custom_meta_facebookoption_det');
                        $social2 = get_post_meta($bookieid, 'casino_custom_meta_instagramoption_det');
                        if ($social[0]) {
                            $sret .= '<i style="font-size: 20px;margin-right:15px;" class="fa fa-twitter" aria-hidden="true" data-toggle="tooltip" title="' . $social[0] . '"></i>';
                        }
                        if ($social1[0]) {
                            $sret .= '<i style="font-size: 20px;margin-right:15px;" class="fa fa-facebook" aria-hidden="true" data-toggle="tooltip" title="' . $social1[0] . '"></i>';
                        }
                        if ($social2[0]) {
                            $sret .= '<i style="font-size: 20px;margin-right:15px;" class="fa fa-instagram" aria-hidden="true" data-toggle="tooltip" title="' . $social2[0] . '"></i>';
                        }
                        ?>
                        <p class="text-dark"><?php echo $sret; ?></p>

                    </div>
                    <?php
                } ?>
                <div class="d-flex flex-wrap mb-2p w-100 ">
                    <div class="w-100 bg-gray pt-10p pb-10p box-sidebar">
                        <div class="w-90 m-auto">
                            <h6 class="mb-2p text-primary font-weight-bold" style="border-bottom: 1px solid #777777f5;">Customer Service Hours</h6>
                            <p class="text-dark"><?php echo get_post_meta($bookieid, 'casino_custom_meta_comun_hours', true); ?></p>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap w-100 ">
                    <div class="w-100 bg-gray-light pt-10p pb-5p box-sidebar">
                        <div class="w-90 m-auto ">
                            <h6 class="mb-2p text-primary font-weight-bold" style="border-bottom: 1px solid #777777f5;">Email</h6>
                            <p class="text-dark">
                                <a class="text-dark" href="mailto:<?php echo get_post_meta($bookieid, 'casino_custom_meta_emailoption_det', true); ?>"><?php echo get_post_meta($bookieid, 'casino_custom_meta_emailoption_det', true); ?></a>
                            <p>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap mb-2p w-100 ">
                    <div class="w-100 bg-gray-light pt-10p pb-10p box-sidebar">
                        <div class="w-90 m-auto">
                            <h6 class="mb-2p text-primary font-weight-bold" style="border-bottom: 1px solid #777777f5;">Live Chat</h6>
                            <p class="text-dark"><?php if (get_post_meta($bookieid, 'casino_custom_meta_live_chat_option', true)) {
                                    echo 'Yes';
                                } else {
                                    echo 'No';
                                }; ?></p>
                        </div>
                    </div>
                </div>
                <?php if (get_post_meta($bookieid, 'casino_custom_meta_phoneoption_det', true)) { ?>
                    <div class="d-flex flex-wrap w-100 ">
                        <div class="w-100 bg-gray pt-10p pb-5p box-sidebar">
                            <div class="w-90 m-auto">
                                <h6 class="mb-2p text-primary font-weight-bold" style="border-bottom: 1px solid #777777f5;">Phone Number</h6>
                                <p class="text-dark"><?php echo get_post_meta($bookieid, 'casino_custom_meta_phoneoption_det', true); ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php $platforms = get_post_meta($bookieid, 'casino_custom_meta_platforms', true); ?>
                <?php if ($platforms) { ?>
                    <div class="d-flex flex-wrap mb-2p w-100 ">
                        <div class="w-100 bg-gray pt-10p pb-10p box-sidebar">
                            <div class="w-90 m-auto ">
                                <h6 class="mb-2p text-primary font-weight-bold" style="border-bottom: 1px solid #777777f5;">Platforms</h6>
                                <?php $platformsArray = array('apple' => 'iPhone App', 'android' => 'Android App', 'windows' => 'Windows Phone App', 'download' => 'Casino Download',); ?>
                                <?php foreach ($platforms as $platform) {
                                    echo '<b class="mr-15p text-20 mb-0"><i class="fa fa-' . $platform . ' " aria-hidden="true"  data-toggle="tooltip" title="' . $platformsArray[$platform] . '"></i></b>';
                                } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="widget2 w-100 mt-10p mb-10p">
                <span class="widget2-heading text-whitte pt-5p pb-5p pr-7p pl-7p font-weight-bold text-18 mb-2p w-100 d-block mt-0 bg-dark text-left">Additional Information</span>
                <div class="widget2-body p-10p">
                    <div class="info-row">
                        <h6>Website Languages</h6>
                        <ul class="inline-list countries-list p-0 mb-2p list-typenone d-inline-block">
                            <li><?php echo get_flags($bookieid, 'site'); ?></li>
                        </ul>
                    </div>
                    <div class="info-row">
                        <h6>Support Languages</h6>
                        <ul class="inline-list countries-list  p-0 mb-2p list-typenone d-inline-block ">
                            <li><?php echo get_countries($bookieid, 'cs'); ?></li>
                        </ul>
                    </div>
                    <div class="info-row">
                        <h6>Currencies</h6>
                        <ul class="inline-list cards-list p-0 mb-2p list-typenone d-inline-block">
                            <li><?php echo get_currencies($bookieid); ?></li>
                        </ul>
                    </div>
                    <div class="info-row">
                        <h6>Restricted countries</h6>
                        <ul class="inline-list countries-list p-0 mb-2p list-typenone d-inline-block">
                            <li><?php echo get_countries($bookieid, 'rest'); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="widget2">
                    <span class="widget2-heading text-whitte pt-5p pb-5p pr-7p pl-7p font-weight-bold text-17 mb-2p w-100 d-block mt-0 bg-dark text-left"><?= get_the_title($bookieid);?> Mobile / App Casino</span>
                    <?php
                    $meta = get_post_meta($bookieid, 'casino_custom_meta_mbapp_ticks', true);
                    $ticksmobile = explode(",", $meta);

                    if (get_post_meta($bookieid, 'casino_custom_meta_mbapp_bg', true)){
                        $bgimage = get_post_meta($bookieid, 'casino_custom_meta_mbapp_bg', true);
                    }else{
                        $bgimage = "/wp-content/themes/best50casino.com/assets/images/default_mb.png";
                    } ?>
                    <div class="d-flex flex-wrap" style="height:280px; background-size:cover; background-image: url('<?=$bgimage;?>'); background-repeat: no-repeat;">
                        <div class="align-self-center w-30 pt-20p pl-20p">
                            <ul class="billboard-list bill-mobil list-typenone p-5p">
                                <?php foreach ($ticksmobile as $value) {
                                    ?>
                                    <li class="font-weight-bold mb-10p text-18 text-white"><?=$value?></li>
                                    <?php
                                }?>
                            </ul>
                        </div>
                    </div>
                    <div class="p-10p" style="background-color: #0A246A;">
                        <a class="btn bumper btn btn bg-blue text-13 w-80 d-block mx-auto p-7p btn_large text-center text-whitte rounded font-weight-bold bumper" style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"  data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                            <?php if($GLOBALS['countryISO'] == 'gb'){
                                echo "Visit ".get_the_title($bookieid)." Mobile".'<i class="fas fa-angle-right mt-4p pl-2p"></i>' ;
                            }else{
                                echo "Visit ".get_the_title($bookieid)." Mobile".'<i class="fas fa-angle-right mt-4p pl-2p"></i>' ;
                            }?></a>
                    </div>
                </div>


                <div class="widget2 side-depo mt-10p mb-10p">
                    <span class="widget2-heading text-whitte pt-5p pb-5p pr-7p pl-7p font-weight-bold text-18 mb-2p w-100 d-block mt-0 bg-dark text-left"><?= get_the_title($bookieid);?> Casino Payments </span>
                    <div class="bg-gray text-left text-20 p-10p"><span>Deposit Methods</span></div>
                    <?php
                    $i=0;
                    $paymentOrder['ids'] = WordPressSettings::getPremiumPayments($countryISO);
                    $order = explode(",", $paymentOrder['ids']);
                    $availableMeans = get_post_meta($bookieid, 'casino_custom_meta_dep_options', true);
                    $res = array_intersect($order, $availableMeans);
                    $correctOrder = array_unique(array_merge($res, $availableMeans));
                    $depArrayFirst = array_slice($correctOrder, 0, 6);
                    $depArrayRest = array_slice($correctOrder, 6);
                    foreach ($depArrayFirst as $rest){
                        $image_id = get_post_meta($rest, 'casino_custom_meta_sidebar_icon', true);
                        $classcolor='';
                        if ( $i & 1 ) {
                            $classcolor = 'bg-gray';
                        } else {
                            $classcolor = 'bg-gray-light';
                        }
                        ?>
                        <div class="side-depo p-10p d-flex flex-wrap <?=$classcolor?>">
                            <div class="d-flex flex-wrap w-60">
                                <div class="w-30">
                                    <img class="img-fluid" style="width: 45px"  src="<?= $image_id;?>">
                                </div>
                                <div class="w-70 m-auto">
                                    <?= get_the_title($rest);?>
                                </div>
                            </div>
                            <div class="w-40 p-5p">
                                <a class="btn bumper btn btn bg-yellow text-15 w-sm-100 text-black text-center d-block p-5p btn_large rounded  bumper font-weight-bold"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                                    Deposit <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                </div>

                <?php

                $faqs = @get_post_meta($post->ID,'faqs',true) ?? false;
                if ($faqs ) {
                    $faqColor = get_post_meta($post->ID, 'faqs_color',true)? get_post_meta($post->ID, 'faqs_color',true) : '#153141';
                    ?>
                    <div class="faq p-15p w-100 mb-10p mt-10p" id="faq" style="background-color: <?=$faqColor?>">
                        <div class="text-whitte text-center" style="font-size: 28px;margin-bottom: 8px;"> <?php echo @get_post_meta($post->ID,'faqs_intro_heading',true) ?> </div>
                        <div class="text-15 text-whitte text-center mb-10p"> <?php echo @get_post_meta($post->ID,'faqs_intro_text',true) ?> </div>

                        <div class="accordion d-flex flex-row flex-wrap justify-content-between" id="faqs" itemscope itemtype="http://schema.org/FAQPage">
                            <amp-accordion animate expand-single-section>
                                <?php $i = 0;
                                foreach ($faqs as $value) {
                                    ?>
                                    <section>
                                        <div class="card w-50" itemscope itemprop="mainEntity" itemtype="http://schema.org/Question">
                                            <div class="card-header d-flex" id="heading<?php echo $i; ?>">
                                                <button class="btn btn-link w-100 d-flex justify-content-between bg-whitte rounded-5" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="<?php echo $i; ?>">
                                                    <div class="question" itemprop="name"><?php echo $value['question']; ?></div>
                                                    <div class="icon"><i class="fa fa-plus"></i></div
                                                </button>
                                            </div>
                                            <div id="collapse<?php echo $i; ?>" data-parent="#faqs"  itemprop="suggestedAnswer acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
                                                <div class="card-body" itemprop="text">
                                                    <?php echo $value['answer']; ?>
                                                </div>
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

                <div class="widget2 mt-10p mb-10p">
                    <?php include(locate_template('templates/common/players-reviews.php', false, false));?>
                </div>

                <div class="widget2 mt-10p mb-10p">
                    <?php
                    $flagISO = $localIso != 'nl' ? $localIso : 'eu';
                    $rete = get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;'));?>
                    <span class="widget2-heading text-whitte pt-5p pb-5p pr-7p pl-7p font-weight-bold text-18 mb-2p w-100 d-block mt-0 bg-dark text-left"> Best Casinos <?= $rete;?></span>
                    <?php
                    $getss = WordPressSettings::getPremiumCasino($countryCode = "glb", $type = 'premium');
                    $cas = explode(",", $getss);
                    $i=0;
                    foreach ($cas as $casinoID){
                        $bonuspage = get_post_meta($casinoID, 'casino_custom_meta_bonus_page', true);
                        $bonusName = get_post_meta($bonuspage, 'bonus_custom_meta_bonus_offer', true);
                        $bonusISO = get_bonus_iso($bonuspage);

                        $exclusiveMobileString = '<span style="width: 22px;height: 22px;background: #f71b1b;border-radius: 100px;-moz-border-radius: 100px;position:absolute; right:0%; -webkit-border-radius:100px;z-index: 9;font-weight: 700;text-align: center;padding: 5px;font-size: 13px;display: flex;align-items: center;justify-content: flex-end;color: #990d0d;" class="ar"><i class="fa fa-star" aria-hidden="true" style="color:#fff;font-size:11px;"></i></span>';
                        $isBonusExclusiveMobile = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_exclusive", true) ? $exclusiveMobileString : '';
                        ?>
                        <div class="p-10p d-flex flex-wrap" style="border: 1px solid #bfbfbfe0; background: #f1f1f1;">
                            <div class="w-30">
                                <a class="" href="<?= get_the_permalink($casinoID);?>">
                                    <img src="<?=get_the_post_thumbnail_url($casinoID);?>" class="img-fluid rounded" alt="<?= get_the_title($casinoID) ?>" style="height: 60px">
                                </a>
                            </div>
                            <div class="w-70 position-relative d-flex flex-column text-center align-self-center">
                                <span class="font-weight-bold"><?=get_post_meta($bonusName, $bonusISO."bs_custom_meta_cta_for_top", true)?></span>
                                <span class="font-weight-bold"><?=get_post_meta($bonusName, $bonusISO."bs_custom_meta_cta_for_top_2", true)?></span>

                                <?=$isBonusExclusiveMobile;?>
                            </div>
                        </div>
                        <?php
                        if(++$i > 5) break;
                    }
                    ?>
                </div>
        </div>
    </div>
</div>