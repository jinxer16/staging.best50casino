<!--if casino major background casino_custom_meta_alt_bg-->
<?php $ratingsHeading=get_post_meta($post->ID,'casino_custom_meta_h2_ratings',true);?>
<?php $heightOf =  $ratingsHeading ? 505: 450; ?>
<div class="position-relative w-100 h-100 overflow-hidden bg-dark" style="height:<?php echo $heightOf; ?>px; background-size:cover;background-image: url('<?=get_post_meta($post->ID,'casino_custom_meta_rat_bg',true);?>')">
    <amp-img class="img-fluid position-relative top-m-30 left-m-30" src="/wp-content/themes/best50casino.com/assets/images/stamp_b.svg" height="180" width="180"></amp-img>
    <div class="pull-right billb-right d-flex flex-column position-absolute top-m-10 p-5p" style="left: 50%">
        <amp-img class="d-block" src="<?= get_post_meta($post->ID, 'casino_custom_meta_trans_logo', true);?>" alt="<?php echo get_the_title($post->ID); ?>" height="80" width="160"></amp-img>
        <?php
        $reli = get_post_meta($post->ID,'casino_custom_meta_reli_rat',true) ;
        $payo = get_post_meta($post->ID,'casino_custom_meta_paym_op',true)  ;
        $payspeed = get_post_meta($post->ID,'casino_custom_meta_payo_spe',true);
        $bank = get_post_meta($post->ID,'casino_custom_meta_bank_rat',true) ;
        $playo = get_post_meta($post->ID,'casino_custom_meta_playo_rat',true);
        $expo = get_post_meta($post->ID,'casino_custom_meta_expo_rat',true);
        $overq = get_post_meta($post->ID,'casino_custom_meta_overq_rat',true);
        $mobi = get_post_meta($post->ID,'casino_custom_meta_mob_rat',true);
        $liv = get_post_meta($post->ID,'casino_custom_meta_live_rat',true) ;
        $custom = get_post_meta($post->ID,'casino_custom_meta_cust_rat',true) ;
        $slot = get_post_meta($post->ID,'casino_custom_meta_slot_rat',true);
        $jack = get_post_meta($post->ID,'casino_custom_meta_jack_rat',true);
        $prov = get_post_meta($post->ID,'casino_custom_meta_prov_rat',true);
        $other = get_post_meta($post->ID,'casino_custom_meta_otg_rat',true);
        $games =get_post_meta($post->ID,'casino_custom_meta_game_rat',true);
        $bonus = get_post_meta($post->ID,'casino_custom_meta_bonus_rating',true);
        $total =get_post_meta($post->ID,'casino_custom_meta_sum_rating',true);

        ?>
        <span class="font-weight-bold text-24 text-whitte pl-15p"><?= $total?>/10</span>
        <div class="company-rating mb-10p mb-xl-0 mb-lg-0 pl-15p text-17">
            <?php
            $sum = $total /2;
            $ratingWhole = floor($sum);
            $ratingDecimal = $sum - $ratingWhole;
            $j = 5;
            $helper = 1;
            $html ='';
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

    <div class="d-flex flex-wrap pr-10p pl-10pp w-100 position-absolute" style="top: 160px;">
        <div class="d-flex flex-column w-100 pl-10p pr-10p ratings-review text-whitte">
            <?php $ratingsHeading=get_post_meta($post->ID,'casino_custom_meta_h2_ratings',true);?>
            <?php if($ratingsHeading){ ?>
                <h2 class="border-bottom border-white text-white pl-0p text-left"><?php echo $ratingsHeading;?></h2>
            <?php } ?>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start">
                    <span class="d-flex mb-2p">Reliability:</span>
                </div>
                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-whitte w-100" style="box-shadow: 0 1px 2px #828586bf; height: 15px;">
                        <div class="progress-bar  text-black font-weight-bold h-100 overf-h float-left text-center" style="width: <?=$reli*10;?>%"  role="progressbar" aria-valuenow="<?php echo $reli; ?>" aria-valuemin="0" aria-valuemax="10">
                            <span class="position-relative d-flex justify-content-start text-whitte text-12 pl-5p" style="bottom: 2px;"><?= $reli?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start">
                   <span class="d-flex mb-2p">Banking:
                    <a role="button" class="pl-5p text-whitte pointer" on="tap:AMP.setState({visible: !visible})"><i class="fa fa-info-circle text-whitte" aria-hidden="true"></i></a>
                </span>
                </div>
                <div class="more-ratings hide" [class]="visible ? 'show position-absolute d-block bg-gray-light p-5p top-50' : 'hide'">
                    <span class="d-flex mb-2p text-dark text-12"><i class="fa fa-money text-dark pt-2p pr-4p pl-4p pb-2p" aria-hidden="true"></i> Payment Options: <span class="font-weight-bold text-primary pl-3p"> <?= $payo;?></span>/100</span>
                    <span class="d-flex mb-2p text-dark text-12"><i class="fa fa-fast-forward text-dark pt-2p pr-4p pl-4p pb-2p" aria-hidden="true"></i> Payout Speed: <span class="font-weight-bold text-primary pl-3p"> <?= $payspeed;?></span>/100</span>
                </div>
                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-whitte w-100" style="box-shadow: 0 1px 2px #828586bf; height: 15px;">
                        <div class="progress-bar  text-black font-weight-bold h-100 overf-h float-left text-center" style="width: <?=$bank*10;?>%"  role="progressbar" aria-valuenow="<?php echo $bank; ?>" aria-valuemin="0" aria-valuemax="10">
                            <span class="position-relative d-flex justify-content-start text-whitte text-12 pl-5p" style="bottom: 2px;"><?= $bank?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start">
                    <span class="d-flex mb-2p">Overall Quality:
                      <a role="button" class="pl-5p text-whitte pointer" on="tap:AMP.setState({showed: !showed})"><i class="fa fa-info-circle text-whitte" aria-hidden="true"></i></a>
                    </span>
                </div>
                <div class="more-ratings hide" [class]="showed ? 'show position-absolute d-block bg-gray-light p-5p bottom-90' : 'hide'">
                    <span class="d-flex mb-2p text-dark text-12"><i class="fa fa-users text-dark pt-2p pr-4p pl-4p pb-2p" aria-hidden="true"></i> Players Opinion: <span class="font-weight-bold text-primary pl-3p"> <?=$playo;?></span>/10</span>
                    <span class="d-flex mb-2p text-dark text-12"><i class="fa fa-trophy text-dark text-16 pt-2p pr-4p pl-4p pb-2p" aria-hidden="true"></i> Our Opinion: <span class="font-weight-bold text-primary pl-3p"> <?= $expo;?></span>/10</span>
                </div>
                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-whitte w-100" style="box-shadow: 0 1px 2px #828586bf; height: 15px;">
                        <div class="progress-bar  text-black font-weight-bold h-100 overf-h float-left text-center" style="width: <?=$overq*10;?>%"  role="progressbar" aria-valuenow="<?php echo $overq; ?>" aria-valuemin="0" aria-valuemax="10">
                            <span class="position-relative d-flex justify-content-start text-whitte text-12 pl-5p" style="bottom: 2px;"><?= $overq?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start">
                    <span class="d-flex mb-2p">Mobile:</span>
                </div>
                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-whitte w-100 " style="box-shadow: 0 1px 2px #828586bf; height: 15px;">
                        <div class="progress-bar  text-black font-weight-bold h-100 overf-h float-left text-center" style="width: <?=$mobi*10;?>%"  role="progressbar" aria-valuenow="<?php echo $mobi; ?>" aria-valuemin="0" aria-valuemax="10">
                            <span class="position-relative d-flex justify-content-start text-whitte text-12 pl-5p" style="bottom: 2px;"><?= $mobi?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start">
                    <span class="d-flex mb-2p">Games:
                      <a role="button" class="pl-5p text-whitte pointer" on="tap:AMP.setState({ignite: !ignite})"><i class="fa fa-info-circle text-whitte" aria-hidden="true"></i></a>
                    </span>
                </div>
                <div class="more-ratings hide" [class]="ignite ? 'show position-absolute d-block bg-gray-light p-5p bottom-0' : 'hide'">
                    <span class="d-flex mb-2p pl-5p text-dark text-12"><span class="toolicons pl-20p d-inline-block free-casino" style="background-size: contain;"></span> Slots: <span class="font-weight-bold text-primary pl-3p"> <?= $slot;?></span>/10</span>
                    <span class="d-flex mb-2p pl-5p text-dark text-12"><span class="toolicons pl-20p d-inline-block cards-casino" style="background-size: contain;"></span> Jackpots: <span class="font-weight-bold text-primary pl-3p"> <?= $jack;?></span>/10</span>
                    <span class="d-flex mb-2p pl-5p text-dark text-12"><span class="toolicons pl-20p d-inline-block spades-casino" style="background-size: contain;"></span>Providers: <span class="font-weight-bold pl-3p text-primary"> <?=$prov;?></span>/10</span>
                    <span class="d-flex mb-2p pl-5p text-dark text-12"><span class="toolicons pl-20p d-inline-block scratch-casino" style="background-size: contain;"></span> Other games: <span class="font-weight-bold text-primary pl-3p"> <?= $other;?></span>/10</span>
                </div>
                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-whitte  w-100 " style="box-shadow: 0 1px 2px #828586bf; height: 15px;">
                        <div class="progress-bar  text-black font-weight-bold h-100 overf-h float-left text-center" style="width: <?=$games*10;?>%"  role="progressbar" aria-valuenow="<?php echo $games; ?>" aria-valuemin="0" aria-valuemax="10">
                            <span class="position-relative d-flex justify-content-start text-whitte text-12 pl-5p" style="bottom: 2px;"><?= $games?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start">
                    <span class="d-flex mb-2p">Live Casino:</span>
                </div>
                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-whitte  w-100 " style="box-shadow: 0 1px 2px #828586bf; height: 15px;">
                        <div class="progress-bar  text-black font-weight-bold h-100 overf-h float-left text-center" style="width: <?=$liv*10;?>%"  role="progressbar" aria-valuenow="<?php echo $liv; ?>" aria-valuemin="0" aria-valuemax="10">
                            <span class="position-relative d-flex justify-content-start text-whitte text-12 pl-5p" style="bottom: 2px;"><?= $liv?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start">
                    <span class="d-flex mb-2p">Customer Support:</span>
                </div>
                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-whitte  w-100 " style="box-shadow: 0 1px 2px #828586bf; height: 15px;">
                        <div class="progress-bar  text-black font-weight-bold h-100 overf-h float-left text-center" style="width: <?=$custom*10;?>%"  role="progressbar" aria-valuenow="<?php echo $custom; ?>" aria-valuemin="0" aria-valuemax="10">
                            <span class="position-relative d-flex justify-content-start text-whitte text-12 pl-5p" style="bottom: 2px;"><?= $custom?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-wrap d-flex w-100 justify-content-between">
                <div class="w-60 d-flex justify-content-start">
                    <span class="d-flex mb-2p"><a class="text-whitte text-decoration-none" href="/welcome-bonus/" target="_blank">Bonus:</a></span>
                </div>
                <div class="w-40 justify-content-end align-self-center">
                    <div class="progress bg-whitte w-100 " style="box-shadow: 0 1px 2px #828586bf; height: 15px;">
                        <div class="progress-bar  text-black font-weight-bold h-100 overf-h float-left text-center" style="width: <?=$bonus*10;?>%"  role="progressbar" aria-valuenow="<?php echo $bonus; ?>" aria-valuemin="0" aria-valuemax="10">
                            <span class="position-relative d-flex justify-content-start text-whitte text-12 pl-5p" style="bottom: 2px;"><?= $bonus?></span>
                        </div>
                    </div>
                </div>
            </div>

            <a on="tap:AMP.setState({howwas: !howwas})" class="text-center w-100 text-11 text-decoration-none" style="color: #8c8c8c;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> How the total rating is calculated</a>
            <div class="more-ratings hide" [class]="howwas ? 'position-absolute d-block bg-gray-light p-4p' : 'hide'" style="bottom: 77px; left: 0;">
                <p class="text-black text-12">
                    Reliability accounts for 35%, while Banking and Overall Quality for 12,5% each of the total rating. Bonus and Mobile account for 10% individually, while Games and Live Casino take up a 7.5% separately. CS weighs in on a 5%
                </p>
            </div>
        </div>
    </div>

    <div class="position-absolute w-100 bottom-0">
    <amp-list height="60"
              layout="fixed-height"
              src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $post->ID ?>"
              binding="no">
        <template type="amp-mustache">
            <a class="btn bg-yellow text-center text-17 w-70 d-block mx-auto p-7p mb-7p mt-10p btn_large text-dark text-decoration-none roundbutton font-weight-bold bumper position-absolute tada" style="bottom:0; left:16%; box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"
               data-casinoid="<?php echo $post->ID; ?>"
               data-country="{{countryinfo.iso}}"
               href="{{0.aff_re2}}" rel="nofollow" target="_blank"><span>VISIT</span></a>
        </template>
    </amp-list>
    </div>
</div>