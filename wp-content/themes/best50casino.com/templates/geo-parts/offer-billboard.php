<div class="billboard-wrapper bonus-bill d-flex mb-10p container flex-wrap  pl-0 pr-0 w-100">
    <div class="w-24 w-md-40 pl-5p pr-5p pt-2p pb-2p d-md-flex d-none">
        <div class="bg-dark p-10p rounded-5 overflow-hidden text-white w-100 h-100 mt-2p mb-2p d-xl-flex d-lg-flex flex-column justify-content-between text-center position-relative">
            <?php
            $bookieid = get_post_meta($post->ID, 'bonus_custom_meta_bookie_offer', true);
            $bonusName = get_post_meta($post->ID, 'bonus_custom_meta_bonus_offer', true);
            $bonusISO = get_bonus_iso($post->ID);
            $geoBonusArgs = is_country_enabled($bonusName, $bookieid, 'bc_bonus');

            if ($geoBonusArgs['isExclusive']) {
                echo '<div class="ribbon-exclusive"><i class="fa fa-star" aria-hidden="true"></i>
        <span class="text-17 p-5p">Exclusive</span></div>';
            } ?>
            <div class="company-logo">
                <img class="img-fluid d-block mx-auto" loading="lazy" src="<?php echo $logo; ?>"
                     alt="<?php echo get_the_title($bookieid); ?>">
            </div>
            <!--        <div class="company-rating">-->
            <!--            --><?php //echo get_rating($bookieid, "own"); ?>
            <!--        </div>-->
            <div class="promo-details-amount text-21 <?php echo $geoBonusArgs['flagStyle'] ?>">
                <?php
                if ($geoBonusArgs['restr'] != 1) {
                    echo get_flags('', '', $geoBonusArgs['flagISO']) . '  ' . get_post_meta($bonusName, $countryISO . "bs_custom_meta_cta_for_top", true);
                } else {
                    echo get_flags('', '', $geoBonusArgs['flagISO']);
                }
                ?>
            </div>
            <?php if (($geoBonusArgs['bonusText']['FlagText'] && $geoBonusArgs['restr'] != 1) || $geoBonusArgs['noBonus'] == 1) { ?>
                <div class="promo-details-amount-sub"><i>
                        <?php echo $geoBonusArgs['bonusText']['FlagText']; ?>
                    </i></div>
            <?php } ?>
            <?php if (isset($geoBonusArgs['bonusCode'])) { ?>
                <div class="" style="border: 1px dashed red;padding: 3px 28px;margin: 5px auto;width: max-content;">
                    <?php echo $geoBonusArgs['bonusCode']; ?>
                </div>
            <?php } else {
                ?>
                <div class="" style="border: 1px dashed red;padding: 3px 28px;margin: 5px auto;width: max-content;">
                    No Code Required
                </div>
                <?php
            } ?>
            <div class="promo-details-type">
                <?php echo $geoBonusArgs['bonusText']['left-billboard']; ?>
            </div>

            <?php $cta = $geoBonusArgs['ctaText']['left-billboard']; ?>
            <?php $ctaAtts = $geoBonusArgs['restr'] != 1 ? 'target="_blank" rel="nofollow"' : ''; ?>
            <a class="btn cta-table catholic-cta rounded-0 bumper text-decoration-none text-uppercase  d-block mx-auto font-weight-bold"
               data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO ?>"
               href="<?php echo $geoBonusArgs['aff_bo']; ?>" <?php echo $ctaAtts; ?>><?php echo $cta; ?></a>
        </div>
    </div>
    <div class="w-50 w-md-60  pl-5p pr-5p pt-2p pb-2p w-sm-100">
        <div class="rounded-5 mt-2p mb-2p bg-dark position-relative text-white overflow-hidden h-100 d-flex flex-column justify-content-between align-items-start p-10p">
            <h1 class="billboard-title w-sm-65 text-20 border-bottom border-white pb-5p mt-5p"><?php echo get_the_title($bookieid); ?>
                Bonus</h1>
            <div class="company-rating mb-10p d-none d-xl-block d-lg-block" style="font-size:12px;">
                <?php echo get_rating($bookieid, "with_text"); ?>
            </div>
            <div class="company-rating  d-block mb-10p text-16 d-xl-none d-lg-none">
                <?php echo get_rating($bookieid, "own"); ?>
            </div>
            <span class="billboard-subtitle"><?php echo get_post_meta($post->ID, 'bonus_custom_meta_subtlt', true); ?></span>
            <ul class="billboard-list list-typenone text-white p-0 position-relative m-5p">
                <?php foreach ($offerList as $item) { ?>
                    <li class="pl-2p"><?php echo $item; ?></li>
                <?php } ?>
            </ul>
            <?php if (!in_array($post->ID, array('4946', '7021'))) { ?>
                <a class="btn btn-cta bg-white text-uppercase  text-decoration-none rounded-0  d-none d-xl-block d-lg-block text-dark catholic-cta bumper mb-1p mx-auto"
                   data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO ?>"
                   style="margin: inherit;"
                   href="<?php echo $geoBonusArgs['aff_bo2']; ?>" <?php echo $ctaAtts; ?>><?php echo $geoBonusArgs['ctaText']['center-billboard']; ?></a>
                <a class="btn cta-table rounded-0 text-uppercase  text-decoration-none catholic-cta d-block d-lg-none d-xl-none mx-auto w-100 bumper"
                   data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO ?>"
                   style="margin: inherit; z-index: 1;"
                   href="<?php echo $geoBonusArgs['aff_bo2']; ?>" <?php echo $ctaAtts; ?>><?php echo $geoBonusArgs['ctaText']['center-billboard']; ?></a>
            <?php } ?>
            <div class="center-background old-center" <?php set_background($image_id); ?>></div>
        </div>
    </div>
    <div class="w-25 pl-5p pr-5p pt-2p pb-2p d-lg-flex d-none">
        <div class="bg-dark p-10p rounded-5 overflow-hidden text-white w-100 h-100 mt-2p mb-2p d-md-flex flex-column justify-content-between">
            <span class="bonus-terms-title mb-5p d-block">BONUS TERMS</span>
            <?php if ($geoBonusArgs['restr'] != 1 || $geoBonusArgs['noBonus'] != 1) { ?>
                <div class="bonus-terms d-flex justify-content-around text-center mb-3p">
                    <div class="promo-details-amount-right text-14 d-flex flex-column ">
                        <span class="promodetailstitle">BONUS</span><?php echo $geoBonusArgs['bonusText']['right-bonus']; ?>
                    </div>
                    <div class="promo-details-percentage text-14 d-flex flex-column">
                        <span class="promodetailstitle">%</span><?php echo $geoBonusArgs['bonusText']['right-percentage']; ?>
                    </div>
                    <div class="promo-details-turnover text-14 d-flex flex-column">
                        <?php
                        $D = $geoBonusArgs['bonusText']['right-turnover-d'] ? '<i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Deposit" style="color:#29bf29;padding-right:1px;"></i>' . $geoBonusArgs['bonusText']['right-turnover-d'] : '';
                        $B = $geoBonusArgs['bonusText']['right-turnover-b'] ? '<i class="fa fa-gift" aria-hidden="true" data-toggle="tooltip" title="Bonus" style="color:#2da9f6;padding-left:3px;padding-right:1px;font-size: 1.3em;"></i>' . $geoBonusArgs['bonusText']['right-turnover-b'] : '';
                        $S = $geoBonusArgs['bonusText']['right-turnover-s'] ? '<i class="fa fa-refresh" aria-hidden="true" data-toggle="tooltip" title="Spins" style="color:orange;padding-left:3px;padding-right:1px;"></i>' . $geoBonusArgs['bonusText']['right-turnover-s'] : '';
                        if ($geoBonusArgs['bonusText']['right-turnover-d'] == $geoBonusArgs['bonusText']['right-turnover-b']) {
                            $D = '<i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Deposit" style="color:#29bf29;padding-right:1px;"></i> + <i class="fa fa-gift" aria-hidden="true" data-toggle="tooltip" title="Bonus" style="color:#2da9f6;padding-left:3px;padding-right:1px;font-size: 1.3em;"></i>' . $geoBonusArgs['bonusText']['right-turnover-b'];
                            $B = '';
                        }
                        ?>
                        <span class="promodetailstitle">TURNOVER  <i class="fa fa-info-circle" aria-hidden="true"
                                                                     data-toggle="tooltip" data-placement="left"
                                                                     title="You have to wager the deposit and bonus amount (and/or free spins) the number of times shown below to be able to withdraw the bonus money."
                                                                     style="font-size:12px;"></i></span><span
                                class="wag"><?php echo $D . '' . $B . '' . $S; ?></span>
                    </div>
                </div>
            <?php }
            if ($geoBonusArgs['restr'] == 1 || $geoBonusArgs['noBonus'] == 1) { ?>
                <div class="text-center">No Bonus Available</div>
            <?php } ?>
            <div class="bonus-payments text-13">
                <span class="text-center d-block mt-3p mb-3p"><?php echo $geoBonusArgs['bonusText']['right-billboard']; ?></span>
                <?php if ($geoBonusArgs['restr'] != 1) { ?>
                    <ul class="inline-list cards-list d-flex justify-content-between">
                        <?php
                        $payments = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_dep_options', true);
                        if ($payments) {
                            foreach ($payments as $option) {
                                $image_id = get_post_meta($option, 'casino_custom_meta_sidebar_icon', true);

                                ?>
                                <li><img loading="lazy" src="<?php echo $image_id; ?>" width="40" height="40"
                                         alt="<?php echo get_the_title($option); ?>" data-toggle="tooltip"
                                         title="<?php echo ucwords(get_the_title($option)); ?> "/></li>
                                <?php

                            }
                        } ?>
                    </ul>
                <?php } ?>

            </div>
            <?php if ($geoBonusArgs['restr'] != 1) { ?>
                <a class="btn cta-table catholic-cta rounded-0 text-uppercase p-md-2  text-decoration-none d-block mx-auto w-80 bumper"
                   data-casinoid="<?php echo $bookieid; ?>"
                   data-country="<?php echo $countryISO ?>" <?php echo $ctaFunction; ?>
                   href="<?php echo $geoBonusArgs['aff_bo3']; ?>" <?php echo $ctaAtts; ?>>
                    <?php
                    $title = $geoBonusArgs['ctaText']['right-billboard'];
                    $array = array("casino","Casino");
                    echo str_ireplace($array, '', $title);
                    ?>
                </a>
                <?php
            } else {
                ?>
                <a class="btn cta-table catholic-cta rounded-0 text-uppercase text-decoration-none p-md-2 d-block mx-auto w-80 bumper btndisa"
                   data-casinoid="<?php echo $bookieid; ?>"
                   data-country="<?php echo $countryISO ?>" <?php echo $ctaFunction; ?>
                   href="javascript:void(0)" <?php echo $ctaAtts; ?>>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
</div>
</div>

<?php if($geoBonusArgs['restr'] != 1 && $countryISO=='gb'){ ?>
    <div class="promo-details-tc d-xs-flex f-xs-center bg-yellowish bg-xs-none mb-5p col-12" style="line-height: 1.2;">
        <?php if(get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms_link", true) !=""){
            echo '<a class="position-relative white-space-initial text-9 text-grey text-italic text-center mb-2p p-5p" style="line-height:1.1;" data-casinoid="'.$post->ID.'" data-country="'.$countryISO.'"  href="'.get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms_link", true).'" target="_blank" rel="nofollow">'.get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms", true).'</a>';
        }else{
            if(get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms", true) !="") {
                echo '<p class="position-relative white-space-initial text-9 text-grey text-italic text-center mb-2p p-5p" style="line-height:1.1;" data-casinoid="'.$post->ID.'" data-country="'.$countryISO.'">'.get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms", true).'</p>';
            }
        } ?>
    </div>
<?php } ?>

<div class="col-12">
    <ul class="offer-anchors-mobile d-flex d-md-flex d-xl-none d-lg-none  text-white flex-wrap align-items-center pl-5p pt-2"
        style="width: 100%;position: relative;top: 0;z-index: 9;">
        <li><a href="#intro" class="text-white">Sign Up</a></li>
        <li><a href="#bonus-code"
               class="text-white"><?php echo get_post_meta($post->ID, 'bonus_custom_meta_Tab_bonus_code', true); ?></a>
        </li>
        <li><a href="#offers" class="text-white">Promotions</a></li>
        <li><a href="#faq" class="text-white">FAQ</a></li>
        <li class="review-ach bg-primary"><a class="text-white" href="<?php echo get_the_permalink($bookieid); ?>">Review</a>
        </li>
    </ul>
    <ul class="offer-anchors d-md-none d-xl-flex d-lg-flex d-none mb-20p">
        <li><a href="#intro"><?php echo get_post_meta($post->ID, 'bonus_custom_meta_Tab_intro', true); ?></a></li>
        <li><a href="#bonus-code"><?php echo get_post_meta($post->ID, 'bonus_custom_meta_Tab_bonus_code', true); ?></a>
        </li>
        <li><a href="#offers"><?php echo get_post_meta($post->ID, 'bonus_custom_meta_Tab_offers', true); ?></a></li>
        <li><a href="#faq">FAQ</a></li>
        <li class="review-ach"><a href="<?php echo get_the_permalink($bookieid); ?>">Full Casino Review</a></li>
    </ul>
</div>