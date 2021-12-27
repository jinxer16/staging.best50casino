<?php
function get_label($choice, $mob=NULL){
    switch ($choice){
        case 'hot':
            $ret ='<div class="ribbon home 5"><span>hot</span></div>';
            if ($mob == 'left'){$ret ='<div class="ribbon home 1" style="left: 10px;"><span>hot</span></div>';}elseif($mob == 'right'){$ret ='<div class="ribbon home 1" style="left: 0px;"><span>hot</span></div>';}
            break;
        case 'new':
            $ret ='<div class="ribbon home new-home"><span style="background: linear-gradient(#ffcd00 0%, #ffcd00 100%);color: #212d33;">New</span></div>';
            if ($mob == 'left'){$ret ='<div class="ribbon home new-home" style="left: 10px;"><span>New</span></div>';}elseif($mob == 'right'){$ret ='<div class="ribbon home new-home" style="left: 0px;"><span>New</span></div>';}
            break;
        case 'exclusive':
            $ret ='<div class="ribbon home exclusive"><span style="background: #990d0d ;">Exclusive</span></div>';
            if ($mob == 'left'){$ret ='<div class="ribbon home exclusive" style="left: 10px;"><span>Exclusive</span></div>';}elseif($mob == 'right'){$ret ='<div class="ribbon home exclusive" style="left: 0px;"><span>Exclusive</span></div>';}
            break;
    }
    return $ret;
}


$countryISO = $GLOBALS['countryISO'];
$localIso =  $GLOBALS['visitorsISO']; //Αν η χωρα ειναι ενεργοποιημενη
$feautred = WordPressSettings::getFeaturedFrontpage();
$image = get_post_meta($feautred['featured'], 'casino_custom_meta_comp_screen_1', true);
$casinoBonusPage = get_post_meta($feautred['featured'], 'casino_custom_meta_bonus_page', true);
$bonusISO = get_bonus_iso($casinoBonusPage);
?>
    <div class="container">
        <?php echo get_post_meta($feautred['featured'],$localIso.'bs_custom_meta_exclusive',true); ?>
    <div class="gadgets-cont pt-10p w-100 mb-3 d-md-flex d-none flex-wrap">
                <div class="col-7 col-md-7 col-lg-7 col-xl-7 col pl-0  pr-10p">
                    <div class="center-part position-relative d-flex flex-wrap w-100 justify-content-start"
                         style="height: 330px; box-shadow: 0 0 3px 1px #56565661;">
                        <div class="ribbon casm"><span>Best of <?php echo date('F'); ?></span></div>
                        <div class="side-l w-50 w-md-100 d-flex flex-column justify-content-around h-100" style="width: 50%;">
                            <div class="company-logo">
                                <img class="img-fluid d-block mx-auto" loading="lazy"  src="<?= get_post_meta($feautred['featured'], 'casino_custom_meta_trans_logo', true);?>"
                                     alt="<?php echo get_the_title($feautred['featured']); ?>"
                                     style="min-width: 180px;max-width: 180px;">
                            </div>
                            <div class="promo-details-amount text-center text-uppercase font-weight-bold text-23" style="z-index: 99;line-height: 1.3;">
                                <?php
                                $casinoBonusPage = get_post_meta($feautred['featured'], 'casino_custom_meta_bonus_page', true);
                                $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);

                                echo get_post_meta($bonusName, $bonusISO . "bs_custom_meta_cta_for_top", true) . '<br>' .  get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top_2', true); ?>
                            </div>
                            <?php
                            if ($GLOBALS['countryISO'] == 'gb') {
                                ?>
                            <div class="w-45 w-md-60 text-center d-block mx-auto " style="border: 1px solid #ffcd00; padding: 3px 1px;margin: 10px 0;">
                            <?php
                            }else{
                                ?>
                                <div class="w-45 w-md-60 text-center d-block mx-auto " style="border: 1px solid #ffcd00; padding: 3px 1px;margin: 10px 0;">
                                <?php
                            }
                            ?>
                              <?php
                              if (get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_bc_code', true)) {
                                    echo 'Bonus Code: ' . get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_bc_code', true);
                                } else {
                                  if ( get_post_meta($bonusName, $bonusISO.'bs_custom_meta_exclusive', true) == 'on'){
                                      echo 'EXCLUSIVE';
                                  }
                                  else{
                                        echo 'NO CODE REQUIRED';
                                    }
                                } ?>
                            </div>
                            <div class="d-block mx-auto mb-5p">
                                <?php echo get_rating($feautred['featured'], "frontpage"); ?>
                            </div>
                            <div class="promo-details-tc" style="font-size: 10px;">
                                <?php
                                if (get_post_meta($bonusName, $localIso . "bs_custom_meta_sp_terms_link", true)) {
                                    echo '<a class="bumper" data-casinoid="'.$feautred['featured'].'" data-country="'.$localIso.'" style="color:#fff;" href="' . get_post_meta($bonusName, $localIso . "bs_custom_meta_sp_terms_link", true) . '" target="_blank" rel="nofollow">' . get_post_meta($bonusName, $localIso . "bs_custom_meta_sp_terms", true) . '</a>';
                                } else {
                                    if (get_post_meta($bonusName, $localIso . "bs_custom_meta_sp_terms", true)) {
                                        echo get_post_meta($bonusName, $localIso . "bs_custom_meta_sp_terms", true);
//                                        echo 'T&C\'s Apply';
                                    }
                                } ?>
                            </div>
                            <p class="d-flex  justify-content-center">
                                <a href="<?php echo get_the_permalink($feautred['featured']); ?>"
                                   class="btn btn-cta review p-12p text-18" style="margin: 0 4px;">Review</a>
                                <a href="<?php echo get_post_meta($feautred['featured'],"casino_custom_meta_affiliate_link", true); ?>" target="_blank" rel="nofollow"
                                   class="btn btn-cta sign-up bumper p-12p text-18 text-dark" data-casinoid="<?php echo $feautred['featured']; ?>" data-country="<?php echo $bonusISO?>" style="margin: 0 4px;">Visit</a>
                            </p>
                        </div>
                        <div class="side-r w-50 d-none d-md-none d-lg-block d-xl-block">
                            <img class="img-fluid d-block mx-auto position-relative" style="top: 10%;" loading="lazy" src="<?= get_post_meta($feautred['featured'], 'casino_custom_meta_head_img', true);?>" alt="<?php echo get_the_title($feautred['featured']); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-5 col-md-5 col-lg-5 col-xl-5 small-gadgets-wrapper d-none d-md-flex flex-wrap pl-10p pr-0 hidden-xs">
                <?php
            $feauterdcasinos = [
                $feautred['featured_1_id']=>$feautred['featured_1_label'],
                $feautred['featured_2_id']=>$feautred['featured_2_label'],
                $feautred['featured_3_id']=>$feautred['featured_3_label'],
                $feautred['featured_4_id']=>$feautred['featured_4_label'],
            ];
            foreach ($feauterdcasinos as $dataID=>$label) {

                $casinoBonusPage = get_post_meta($dataID, 'casino_custom_meta_bonus_page', true);
                $bonusISO = get_bonus_iso($casinoBonusPage);
                $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
               $bonusCTA = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top', true);

                $arr = explode(' ', $bonusCTA);
                $last = array_pop($arr);
                $words = explode( " ", $bonusCTA );
                array_splice( $words, -1 );
                $str = implode( " ", $words );

               $bonusCTA2 = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top_2', true);
                $new = explode (' ', $bonusCTA2, 3);
                $string = $new[2];

                $trimmed = explode(' ',trim($bonusCTA2));


            ?>
           <div style="" class="special-gadget-wrapper-new teaser d-flex flex-column position-relative justify-content-around mt-2p">
               <div class="ribbon home 5"><span class="ribbonclass-<?=$label?>"><?=$label?></span></div>

                        <div class="company-logo">
                            <img class="img-fluid d-block mx-auto" loading="lazy" width="100" height="50" src="<?= get_post_meta($dataID, 'casino_custom_meta_trans_logo', true); ?>"
                                 alt="<?php echo get_the_title($dataID); ?>"
                                 style="min-width: 100px;max-width: 100px;max-height: 50px;">
                        </div>

                        <div class="text-white text-center text-uppercase font-weight-bold text-18"><?php echo $str;?><span class="text-secondary"> <?=$last?></span></div>
                        <div class="text-white text-center text-uppercase font-weight-bold text-18"><span class="text-secondary"><?= $trimmed[0] . ' ' .$trimmed[1]?></span> <?=$string;?></div>

               <div class="text-center text-10" style="color: #d7dcdf;">
                   <?php $affLink = get_post_meta($dataID, 'casino_custom_meta_affiliate_link', true); ?>
                   <?php if ($dataID == 7897){
                       echo '<a class="bumper" data-casinoid="'.$dataID.'" data-country="'.$dataID.'" style="color:#fff;" href="' .  $affLink . '" target="_blank" rel="nofollow">T&C\'s Apply. 18+</a>';
                   }else{
                       echo '<a class="bumper" data-casinoid="'.$dataID.'" data-country="'.$dataID.'" style="color:#fff;" href="' .  $affLink . '" target="_blank" rel="nofollow">T&C\'s Apply</a>';
                   }
                   ?>
               </div>
                        <span class="d-flex text-center mt-5p mb-0 justify-content-center">
                            <a href="<?php echo get_post_meta($dataID, 'casino_custom_meta_affiliate_link', true); ?>" target="_blank" rel="nofollow"
                               class="btn btn-cta sign-up text-dark p-2p font-weight-bold text-uppercase bumper" data-casinoid="<?php echo $dataID; ?>" data-country="<?php echo $bonusISO?>">Claim Bonus</a>
                        </span>
                    </div>
                <?php
            }
        ?>
                </div>
            </div>
    <div class="gadgets-cont mt-5p mb-10p pt-10p d-md-none d-block w-100" id="gadgets-cont">
            <div class="row d-flex flex-wrap m-0 w-100">
                <div class="center-part position-relative w-100 d-flex flex-column justify-content-between align-self-start bg-dark p-5p mb-3p" style="box-shadow: 0 0 3px 1px #56565661;">
                    <div class="ribbon casm"><span style="font-size: 10px;line-height: 29px;top: 25px;left: -50px;">Best of <?php echo date('F'); ?></span></div>
<!--                    <i class="fa fa-times-circle-o" data-id="gadgets-cont" id="close" aria-hidden="true" style="opacity: 0.6;position: absolute;right: -7px;top: -24px;font-size: 27px;z-index: 9999;color: #212d33;"></i>-->

                        <div class="col-12 d-flex flex-column pr-0 pl-0">
                            <img class="img-fluid d-block mx-auto" loading="lazy" src="<?= get_post_meta($feautred['featured'], 'casino_custom_meta_trans_logo', true); ?>" alt="<?php echo get_the_title($feautred['featured']); ?>" style="max-height: 80px; height: 80px;">

                            <?php

                            $bonusCTA = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top', true);

                            $arr = explode(' ', $bonusCTA);
                            $last = array_pop($arr);
                            $words = explode( " ", $bonusCTA );
                            array_splice( $words, -1 );
                            $str = implode( " ", $words );

                            $bonusCTA2 = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top_2', true);
                            $new = explode (' ', $bonusCTA2, 3);
                            $string = $new[2];

                            $trimmed = explode(' ',trim($bonusCTA2));

                            ?>


                            <div class="text-white text-center font-weight-bold text-23"><?php echo $str;?><span class="text-secondary"> <?=$last?></span></div>
                            <div class="text-white text-center font-weight-bold text-23"><span class="text-secondary"><?= $trimmed[0] . ' ' .$trimmed[1]?></span> <?=$string;?></div>

                            <div class="gadget-bonuscode  font-weight-bold text-center text-white w-45 d-block mx-auto text-12 font-weight-bold" style="border: 1px solid #ffcd00; padding: 3px 1px;">
                                <?php
                                $casinoBonusPage = get_post_meta($feautred['featured'], 'casino_custom_meta_bonus_page', true);
                                $bonusISO = get_bonus_iso($casinoBonusPage);
                                $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
                                if (get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_bc_code', true)) {
                                    echo 'Bonus Code: ' . get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_bc_code', true);
                                } else {
                                    if ( get_post_meta($bonusName, $bonusISO.'bs_custom_meta_exclusive', true) == 'on'){
                                        echo 'EXCLUSIVE';
                                    }
                                    else{
                                        echo 'NO CODE REQUIRED';
                                    }
                                } ?>
                            </div>
                            <div class="text-center pt-5p">
                                <?php echo  get_rating($feautred['featured'], "frontpage"); ?>
                            </div>
                        </div>
                    <div class="d-flex mt-10p mb-5p justify-content-center m-md-auto ">
                    <a href="<?php echo get_the_permalink($feautred['featured']); ?>"
                       class="btn btn-cta review p-5p text-white w-32 bg-primary font-weight-bold text-16 rounded-10" style="margin: 0 4px;">Review</a>
                    <a href="<?php echo get_post_meta($feautred['featured'],"casino_custom_meta_affiliate_link", true); ?>" target="_blank" rel="nofollow"
                       class="btn btn-cta sign-up bumper p-5p w-32 font-weight-bold text-16 rounded-10 text-dark" data-casinoid="<?php echo $feautred['featured']; ?>" data-country="<?php echo $bonusISO?>" style="margin: 0 4px;">Visit</a>
                    </div>
                </div>


                <div class="promo-details-tc col-12 bg-yellowish">
                    <?php
                    if (get_post_meta($bonusName, $bonusISO . "bs_custom_meta_sp_terms_link", true)) {
                        echo '<a class="bumper text-9 text-grey text-italic text-center mb-0 p-5p" data-casinoid="'.$feautred['featured'].'" data-country="'.$bonusISO.'" style="color:#d7dcdf;" href="' . get_post_meta($bonusName, $bonusISO . "bs_custom_meta_sp_terms_link", true) . '" target="_blank" rel="nofollow">' . get_post_meta($bonusName, $bonusISO . "bs_custom_meta_sp_terms", true) . '</a>';
                    } else {
                        if (get_post_meta($bonusName, $bonusISO . "bs_custom_meta_sp_terms", true)) {
                            echo '<p class="position-relative white-space-initial text-9 text-grey text-italic text-center mb-0 p-5p" data-casinoid="'.$post->ID.'" data-country="'.$countryISO.'">'.get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms", true).'</p>';
                        }
                    } ?>
                </div>
            </div>
    </div>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById('gadgets-cont');
        // Get the <span> element that closes the modal
        var span = document.getElementById("close");

        // When the user clicks on <span> (x), close the modal

        document.addEventListener("DOMContentLoaded", function(event) {
            var currentTime = new Date().getTime();
            //Add hours function
            Date.prototype.addHours = function(h) {
                this.setTime(this.getTime() + (h*60*60*1000));
                return this;
            };
            //Get time after 24 hours
            var after24 = new Date().addHours(10).getTime();

            if (span){
                span.onclick = function() {
                    modal.style.setProperty("display", "none", "important");
                    localStorage.setItem('desiredTime', after24);
                };
            }
            if(localStorage.getItem('desiredTime') >= currentTime)
            {
                modal.style.setProperty("display", "none");
            }
            else
            {
                modal.style.setProperty("display", "block");
            }
        });
    </script>
<?php

