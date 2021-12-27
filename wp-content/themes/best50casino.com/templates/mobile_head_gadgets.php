<?php
$countryName = $GLOBALS['countryName'];
$countryISO = $GLOBALS['countryISO'];
$themeSettingsCountries = get_option('countries_enable_options');
$localIso =  $GLOBALS['visitorsISO']; //Αν η χωρα ειναι ενεργοποιημενη
$themeSettings = WordPressSettings::getFeaturedFrontpage();
$promoCasinoID = $themeSettings['featured'];
$casinoBonusPage = get_post_meta($promoCasinoID, 'casino_custom_meta_bonus_page', true);
$bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
$bonusISO = get_bonus_iso($casinoBonusPage);
$geoBonusArgs = is_country_enabled($bonusName,$promoCasinoID, 'kss_casino');
?>
<div class="gadgets-cont mt-5p pl-10p pr-10p mb-10p d-md-none d-block w-100" id="gadgets-cont">
    <div class="row d-flex flex-wrap m-0 w-100">
        <div class="center-part position-relative w-100 d-flex flex-column justify-content-between align-self-start bg-dark p-5p mb-3p" style="box-shadow: 0 0 3px 1px #56565661;">
            <div class="ribbon casm"><span style="font-size: 10px;line-height: 29px;top: 25px;left: -50px;">Best of <?php echo date('F'); ?></span></div>
            <!--                    <i class="fa fa-times-circle-o" data-id="gadgets-cont" id="close" aria-hidden="true" style="opacity: 0.6;position: absolute;right: -7px;top: -24px;font-size: 27px;z-index: 9999;color: #212d33;"></i>-->

            <div class="col-12 d-flex flex-column pr-0 pl-0">
                <img class="img-fluid d-block mx-auto" loading="lazy" src="<?= get_post_meta($promoCasinoID, 'casino_custom_meta_trans_logo', true); ?>" alt="<?php echo get_the_title($promoCasinoID); ?>" style="max-height: 80px; height: 80px;">

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
                    $casinoBonusPage = get_post_meta($promoCasinoID, 'casino_custom_meta_bonus_page', true);
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
                    <?php echo  get_rating($promoCasinoID, "frontpage"); ?>
                </div>
            </div>
            <div class="d-flex mt-10p mb-5p justify-content-center m-md-auto ">
                <a href="<?php echo get_the_permalink($promoCasinoID); ?>"
                   class="btn btn-cta review p-5p text-white w-32 bg-primary font-weight-bold text-16 rounded-10" style="margin: 0 4px;">Review</a>
                <a href="<?php echo get_post_meta($promoCasinoID,"casino_custom_meta_affiliate_link", true); ?>" target="_blank" rel="nofollow"
                   class="btn btn-cta sign-up bumper p-5p w-32 font-weight-bold text-16 rounded-10 text-dark" data-casinoid="<?php echo $promoCasinoID; ?>" data-country="<?php echo $bonusISO?>" style="margin: 0 4px;">Visit</a>
            </div>
        </div>


        <div class="promo-details-tc col-12 bg-yellowish">
            <?php
            if (get_post_meta($bonusName, $bonusISO . "bs_custom_meta_sp_terms_link", true)) {
                echo '<a class="bumper text-9 text-grey text-italic text-center mb-0 p-5p" data-casinoid="'.$promoCasinoID.'" data-country="'.$bonusISO.'" style="color:#d7dcdf;" href="' . get_post_meta($bonusName, $bonusISO . "bs_custom_meta_sp_terms_link", true) . '" target="_blank" rel="nofollow">' . get_post_meta($bonusName, $bonusISO . "bs_custom_meta_sp_terms", true) . '</a>';
            } else {
                if (get_post_meta($bonusName, $bonusISO . "bs_custom_meta_sp_terms", true)) {
                    echo '<p class="position-relative white-space-initial text-9 text-grey text-italic text-center mb-0 p-5p" data-casinoid="'.$post->ID.'" data-country="'.$countryISO.'">'.get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms", true).'</p>';
                }
            } ?>
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
            }
            //Get time after 24 hours
            var after24 = new Date().addHours(10).getTime();

            if (span) {
                span.onclick = function () {
                    modal.style.setProperty("display", "none", "important");
                    localStorage.setItem('desiredTime', after24);
                }
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