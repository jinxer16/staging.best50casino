<style>
    .cta-txt .promo-details-type {
        margin: 0;
    }
    .promo-details-amount.disabled:before {
        content: " ";
        background: url(https://www.best50casino.com/wp-content/themes/best50casino/assets/images/restrict.svg);
        background-size: 40px;
        position: absolute;
        width: 40px;
        height: 40px;
        top: -2px;
        left: -7px;
        background-repeat: no-repeat;
    }
    .tcs{
        display: flex;
        justify-content: center;
        overflow: hidden;
        color: #676767;
        line-height: initial;
    }
</style>

<div class="premium-casinos-mega-wrapper position-fixed w-100 h-100 overflow-auto"
     style="left: 0;top: 0;background-color: rgba(0, 0, 0, .6); z-index: 1002;" id="premium-casinos">
    <?php //print_r($premiumCasinosArray); ?>
	<div class="premium-casinos-wrapper" id="premium-casinos">
		<!--div class="row"-->
		<div class="premium-header position-relative w-100 d-flex " style="  padding: 10px 15px;   justify-content: space-evenly;">
            <?php $casinoName = $post->post_type =='kss_casino' ? get_the_title($post->ID) :$bookiename;?>
			<span class="line_1"><?php echo $casinoName; ?> <b>does not accept</b> players from <?php echo $GLOBALS['countryName'];?>.</span>
			<span class="line_2">We highly <b>recommend</b> these casinos instead:</span>
			<i style="right: 14px" class="fa cursor-point fa-times position-absolute close-x "  data-id="premium-casinos"></i>
		</div>
		<!--/div-->
		<div class="row horizontal premium-casinos prem d-flex">

		<?php

			foreach ($premiumCasinosArray as $key=>$premiumCasino){ ?>
				<?php

				$casinoName = get_the_title($premiumCasino);
//				$argz = array(
//							'post_type' => array('bc_bonus'),
//							'post_status' => array('publish'),
//							'meta_key' => 'bs_custom_meta_parent_casino',
//							'meta_value' =>$casinoName,
//							'tax_query' => array(
//								array (
//									'taxonomy' => 'bonus-types',
//									'field' => 'term_id',
//									'terms' => '47',
//								)
//							),
//
//				);?>


				<?php $nmr = array('1'=> 'st', '2'=>'nd', '3'=>'rd', '4'=>'th'); ?>
				<?php $logo_id_s = getImageId(get_post_meta($premiumCasino, 'casino_custom_meta_trans_logo', true)); ?>
				<?php $logo_s = wp_get_attachment_image_src($logo_id_s, 'bonus', true); ?>
<!--				--><?php //$casinoBonus = get_posts( $argz )?>

			<div class="col-lg-<?php echo $colNumber?> col-md-4 d-none d-lg-block d-xl-block premium-item premium-item_<?php echo ($key+1); ?> col-4 casino position-relative pl-15p pr-15p">
				<div class="wraping position-relative w-100 m-auto bg-white">
						<a href="<?php echo get_the_permalink($premiumCasino);?>" <i class="fa fa-info" aria-hidden="true" title="" style="z-index:9;font-size: 14px;color: #fff;border: 2px solid;padding: 2px 6px;position: absolute;border-radius: 50%;right: 6px;top: 6px;"></i></a>
						<?php $LogoURL = get_the_post_thumbnail_url($premiumCasino);?>
							<a href="<?php echo get_the_permalink($premiumCasino)?>"><figure <?php set_background($LogoURL , true ); ?> class="d-block w-100 cover position-relative m-0" style="height: 130px;  border-radius: 5px 5px 0 0;"></figure></a>
							<div class="ribbon new <?php echo ($key+1); ?>">
                                <span>
                                    <span class="span-number"><?php echo ($key+1); ?></span>
                                    <?php echo $nmr[$key+1]?>
                                </span>
                            </div>

						<div class="company-rating backed" style="background: #212d33;">
                            <?php
                            $casinoBonusPage = get_post_meta($premiumCasino, 'casino_custom_meta_bonus_page', true);
                            $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
                            $bonusISO = get_bonus_iso($casinoBonusPage);
                            $term_list = get_the_terms( $bonusName, 'bonus-types');

                            ?>
						<?php if (get_post_meta($bonusName, $bonusISO."bs_custom_meta_exclusive", true)){echo '<div class="exclusive-inline"><i class="fa fa-star" aria-hidden="true"></i><span>Exclusive Bonus</span></div>';}?>
							<?php echo get_rating($premiumCasino, "own"); ?>
						</div>
						<div class="promo-details-wrap d-flex flex-column align-items-center justify-content-start" style="min-height: 94px;">
						<div class="promo-details-amount text-24 " style="font-weight: 500;color: #03898f;">
							<?php echo get_flags( '', '', $geoBonusArgs['flagISO']).'  '.get_post_meta($bonusName, $bonusISO."bs_custom_meta_cta_for_top", true); ?>
						</div>
						<?php if(get_post_meta($bonusName, $bonusISO."bs_custom_meta_cta_for_top_2", true)){ ?>
						<div class="promo-details-amount-sub"><i>
							<?php echo get_post_meta($bonusName, $bonusISO."bs_custom_meta_cta_for_top_2", true); ?>
						</i></div>
						<?php } ?>
						<div class="promo-details-type">

						<?php // print_r($casinoBonus);
						$bonusCategory = get_the_terms($bonusName, 'bonus-types' );
						echo $bonusCategory[0]->name;
                            ?>
						</div>
					</div>
					<?php
                    if ($GLOBALS['countryISO'] == 'gb') {
                        $cta = 'PLAY';
                    } else {
                        $cta = 'PLAY NOW';
                    } ?>
					<a class="btn cta-table catholic-cta bumper text-decoration-none" data-casinoid="<?php echo $premiumCasino; ?>" data-country="<?php echo $bonusISO?>"  href="<?php echo get_post_meta((int)$premiumCasino, 'casino_custom_meta_affiliate_link', true); ?>" target="_blank" rel="nofollow"><?php echo $cta; ?></a>
				    <?php $TCs = get_post_meta($bonusName, $bonusISO.'bs_custom_meta_sp_terms', true);
                    //get_post_meta($bonusObject->ID, $localIso.'bs_custom_meta_sp_terms', true) ? $advancedTCs.'<i class="fa fa-caret-down expand-tcs" data-id="'.$bonusObject->ID.'"></i>' : $simpleTCs;
                    if($TCs){ ?>
                        <span class="tcs text-11"><?php echo $TCs; ?></span>
                    <?php } ?>
                </div>
			</div>

		<?php	}
		?>
		</div>
	</div>
</div>