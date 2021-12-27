<div class="billboard-wrapper bonus-bill d-flex mb-10p container flex-wrap  pl-0 pr-0 w-100">
    <div class="w-24 w-md-40 pl-5p pr-5p pt-2p pb-2p d-md-flex d-none">
            <div class="bg-dark p-10p rounded-5 overflow-hidden text-white w-100 h-100 mt-2p mb-2p d-xl-flex d-lg-flex flex-column justify-content-between text-center position-relative">
            <?php if ($geoBonusArgs['isExclusive']){echo '<div class="ribbon-exclusive text-white"><i class="fa fa-star" aria-hidden="true"></i>
            <span class="p-5p text-17">Exclusive</span></div>';}?>
            <div class="company-logo">
                <img class="img-fluid d-block mx-auto" src="<?php echo $logo_id; ?>" loading="lazy" alt="<?php echo get_the_title($post->ID); ?>" >
            </div>
            <!--            <div class="company-rating">-->
            <!--                --><?php //echo get_rating($post->ID, "own"); ?>
            <!--            </div>-->
            <div class="promo-details-amount text-21  <?php echo $geoBonusArgs['flagStyle']?>">
                <?php
                if ($geoBonusArgs['restr'] != 1){
                    echo get_flags( '', '', $geoBonusArgs['flagISO']).'  '.get_post_meta($bonusName, $countryISO."bs_custom_meta_cta_for_top", true);
                }else{
                    echo get_flags( '', '', $geoBonusArgs['flagISO']);
                }
                ?>
            </div>
            <?php if(($geoBonusArgs['bonusText']['FlagText'] && $geoBonusArgs['restr'] != 1) || $geoBonusArgs['noBonus'] == 1){ ?>
                <div class="promo-details-amount-sub"><i>
                        <?php echo $geoBonusArgs['bonusText']['FlagText']; ?>
                    </i></div>
            <?php } ?>
            <?php if(isset($geoBonusArgs['bonusCode'])){?>
                <div class="" style="border: 1px dashed red;padding: 3px 28px;margin: 5px auto;width: max-content;">
                    <?php echo $geoBonusArgs['bonusCode']; ?>
                </div>
            <?php }else{ ?>
                <div class="" style="border: 1px dashed red;padding: 3px 28px;margin: 5px auto;width: max-content;">
                    No Code Required
                </div>
            <?php } ?>
            <?php if($geoBonusArgs['restr'] != 1){?>
                <div class="promo-details-type">
                    <?php echo $geoBonusArgs['bonusText']['left-billboard']; ?>
                </div>
            <?php } ?>

            <?php $cta = $geoBonusArgs['ctaText']['left-billboard-review']; ?>
            <?php $ctaAtts = $geoBonusArgs['restr'] != 1 ? 'target="_blank" rel="nofollow"' : ''; ?>
            <a class="btn cta-table rounded-0 text-uppercase catholic-cta bumper text-decoration-none d-block mx-auto font-weight-bold"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO?>"  href="<?php echo $geoBonusArgs['aff_re1']; ?>" <?php echo $ctaAtts; ?>>
                <?php if($post->ID == '7016'){
                    echo 'JOIN';
                }else{
                    echo $cta;
                }
                 ?>
            </a>
        </div>
    </div>
    <div class="w-50 w-md-60  pl-5p pr-5p pt-2p pb-2p w-sm-100">
        <div class="rounded-5 mt-2p mb-2p bg-dark position-relative text-white overflow-hidden h-100 d-flex flex-column justify-content-between align-items-start p-10p">
            <h1 class="billboard-title w-sm-65 text-20 border-bottom border-white pb-5p mt-5p"><?php echo the_title(); ?></h1>
            <div class="company-rating mb-10p mb-xl-0 mb-lg-0" style="font-size:12px;">
                <?php echo get_rating($post->ID, "with_text"); ?>
            </div>
            <span class="billboard-subtitle" style="font-size: 1.1em;margin-top: 10px;font-weight: 700;font-size: 13px;">Casino Highlights:</span>
            <ul class="billboard-list-review list-typenone pl-0 mt-10p mt-xl-0 mt-lg-0">
                <?php echo '<li class="hiddem-sm hidden-xs d-none d-lg-block d-xl-block text-13">- Ranked #'.get_rank_casino($post->ID).' by Players in '.$GLOBALS['countryName'].'</li>'; ?>
                <?php echo '<li class="d-block d-lg-none mb-3p d-xl-none text-13">- Ranked #'.get_rank_casino($post->ID).' by Players in '.strtoupper($GLOBALS['countryISO']).'</li>'; ?>
                <?php if (is_array(get_post_meta($post->ID, 'casino_custom_meta_dep_options', true))){
                echo '<li class="mb-3p mb-xl-0 mb-lg-0 text-13 ">- '.sizeof(get_post_meta($post->ID, 'casino_custom_meta_dep_options', true)).' deposit methods</li>'; }
                ?>
                <?php if (is_array(get_post_meta($post->ID, 'casino_custom_meta_softwares', true))){
               echo '<li class="mb-xl-0 mb-lg-0 mb-3p text-13">- Games from '.sizeof(get_post_meta($post->ID, 'casino_custom_meta_softwares', true)).' Providers</li>'; }
               ?>
            </ul>
            <?php if(!in_array($post->ID, array('7016','4831')) ){?>
                <a class="mx-auto btn btn-cta bg-white rounded-0 text-uppercase w-md-100 d-none d-xl-block d-lg-block text-decoration-none d-md-block text-dark catholic-cta bumper" data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO?>" style="margin: inherit; z-index: 1;" href="<?php echo $geoBonusArgs['aff_bo2']; ?>" <?php echo $ctaAtts; ?>><?php echo $geoBonusArgs['ctaText']['center-billboard']; ?></a>
                <a class="mx-auto btn cta-table rounded-0 text-uppercase catholic-cta text-decoration-none d-block d-md-none d-lg-none d-xl-none mx-auto w-100 bumper" data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO?>" style="margin: inherit; z-index: 1;" href="<?php echo $geoBonusArgs['aff_bo2']; ?>" <?php echo $ctaAtts; ?>><?php echo $geoBonusArgs['ctaText']['center-billboard']; ?></a>
            <?php }?>
            <div class="center-background"  <?php set_background($image_id); ?>></div>
        </div>
    </div>
    <div class="w-24 pl-5p pr-5p pt-2p pb-2p d-lg-flex d-none">
        <div class="bg-dark p-10p rounded-5 overflow-hidden text-white w-100 h-100 mt-2p mb-2p d-md-flex flex-column justify-content-between">
            <?php $SpecialTitle = $post->ID == 8330 || $post->ID == 8611 || $post->ID == 7688  ? str_replace(" Casino", "", get_the_title($post->ID)) : get_the_title($post->ID); ?>
            <?php $toBeOrNotToBe = $post->ID == 7688 ? "Why NOT to Choose" : "Why Choose";?>
            <h3 class="text-center border-bottom border-white pb-4p mt-4p font-weight-normal"><?=$toBeOrNotToBe?> <?php echo $SpecialTitle; ?></h3>
            <ul class="billboard-list list-typenone text-white p-0 position-relative mt-5p mb-5p">
                <?php foreach ( $offerList as $item ){ ?>
                    <li class="pt-2p pb-2p"><?php echo $item; ?></li>
                <?php } ?>
            </ul>

            <?php if($geoBonusArgs['restr'] != 1){?>
                <a class="btn cta-table rounded-0 catholic-cta p-md-2 d-block mx-auto bumper text-decoration-none text-uppercase w-80 " data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO?>" <?php echo $ctaFunction; ?> href="<?php echo $geoBonusArgs['aff_re2']; ?>" <?php echo $ctaAtts; ?>>
                    <?php
                    $title = $geoBonusArgs['ctaText']['right-billboard-review'];
                    $array = array("casino", "Casino");
                    echo str_ireplace($array, '', $title);
                    ?>
                </a>
                <?php
            }
            else{
                ?>
                <a class="btn cta-table catholic-cta rounded-0 p-md-2 text-uppercase d-block text-decoration-none mx-auto w-80 bumper btndisa" data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO?>" <?php echo $ctaFunction; ?> href="javascript:void(0)" <?php echo $ctaAtts; ?>>

                 </a>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php if($geoBonusArgs['restr'] != 1 && $countryISO=='gb'){ ?>
    <div class="promo-details-tc d-xs-flex f-xs-center bg-yellowish bg-xs-none mb-5p w-xs-100" style="line-height: 1.2;">
        <?php if(get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms_link", true) !=""){
            echo '<a class="position-relative white-space-initial text-9 text-grey text-italic text-center mb-2p text-decoration-none p-5p" style="line-height:1.1;" data-casinoid="'.$post->ID.'" data-country="'.$countryISO.'"  href="'.get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms_link", true).'" target="_blank" rel="nofollow">'.get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms", true).'</a>';
        }else{
            if(get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms", true) !="") {
                echo '<p class="position-relative white-space-initial text-9 text-grey text-italic text-decoration-none text-center mb-2p p-5p" style="line-height:1.1;" data-casinoid="'.$post->ID.'" data-country="'.$countryISO.'">'.get_post_meta($bonusName, $countryISO."bs_custom_meta_sp_terms", true).'</p>';
            }
        } ?>
    </div>
<?php } ?>

