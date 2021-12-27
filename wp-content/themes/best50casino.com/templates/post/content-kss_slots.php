<h1 class="star"><span><?php the_title(); ?></span></h1>
<div class="row game_presentation">
	<div class="col-sm-12 the_game">
		<?php if (!get_post_meta($post->ID, 'slot_custom_meta_slot_offline', true)){?>
            <?php if(get_post_meta($post->ID, 'slot_custom_meta_thumb_of_game_mob_gen', true)){ ?>
                <img style="max-height: 450px;width: 100%;" class="img-fluid" src="<?php echo get_post_meta($post->ID, 'slot_custom_meta_thumb_of_game', true)?>" loading="lazy" alt="<?php the_title(); ?>" >
            <?php }else{ ?>
                <?php if(get_post_meta($post->ID, 'slot_custom_meta_thumb_of_game_mob', true)){ ?>
                    <div class="d-none d-lg-block d-xl-block">
                    <a href="#" class="big"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
                    <?php echo get_post_meta($post->ID, 'slot_custom_meta_slot_script', true); ?>
                    </div>
                    <img class="img-responsive d-block d-lg-none d-xl-none visible-sm visible-xs" loading="lazy" src="<?php echo get_post_meta($post->ID, 'slot_custom_meta_thumb_of_game', true)?>" alt="<?php the_title(); ?>" >
                <?php  }else{ ?>
                    <a href="#" class="big"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
                    <?php echo get_post_meta($post->ID, 'slot_custom_meta_slot_script', true); ?>
                <?php } ?>
            <?php } ?>
		<?php }else{ ?>
				<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/images/offline.jpg" loading="lazy" alt="Slot Offline" >
		<?php }?>
		
	</div>
</div>
<?php
$softwaName = get_post_meta($post->ID, 'slot_custom_meta_slot_software' , true);

$countryEnabledSettings = get_option('countries_enable_options');

$thisISO = $GLOBALS['countryISO'] ;
$casino_id = get_post_meta($softwaName, $thisISO.'software_custom_meta_main_casino' , true) ? get_post_meta($softwaName, $thisISO.'software_custom_meta_main_casino' , true): get_post_meta($post->ID,'slot_custom_meta_slot_main_casino', true);

$casino_score = get_post_meta($casino_id, 'casino_custom_meta_sum_rating', true)*10;
$casinoRestrictedCountries = get_post_meta($casino_id, 'casino_custom_meta_rest_countries', true);
$localISO = $GLOBALS['visitorsISO'];

//if(in_array($localISO,$casinoRestrictedCountries )){
//    $casino_id = next_casino($thisISO, $localISO, $casino_id,$softwaName , 'soft');
//}
$casino_cons = explode (',', get_post_meta($casino_id, 'casino_custom_meta_why_play' , true) );
$casino_cons = array_slice($casino_cons,0,4);


//if(current_user_can('administrator')){
//    var_dump($casino_id);
//}
?>
<div class="row more_games game-cta d-flex flex-wrap text-center p-10p mb-20p text-21 align-items-center" style="background:#f0f0f0;color:#181818;">
	<div class="col-lg-2 col-md-2 col-sm-4 col-6 casino">
		<a class="" href="<?php echo get_the_permalink($casino_id) ?>"><img class="img-fluid" src="<?php echo get_the_post_thumbnail_url($casino_id); ?>" loading="lazy" alt="<?php echo get_the_title($casino_id); ?>" ></a>
	</div>
	<div class="col-lg-8 col-md-10 col-sm-8 col-9 pros-list d-none d-md-block d-lg-block d-xl-block">
		<span class="font-weight-bold text-15 mb-3p" style="vertical-align: top">Four reasons why you should choose <?php echo str_replace(" Casino","",get_the_title($casino_id)); ?>:</span>
		<ul class="check-list list-typenone mb-0 mt-0 pl-0 text-left">
			<?php foreach ($casino_cons as $pros){ ?>
				<li class="position-relative pl-25p" style="list-style: none;"><?php echo $pros; ?></li>
			<?php }?>
		</ul>
	</div>
	<div class="col-lg-2 col-md-12 col-sm-12 col-6 casino">
		<div class="d-block d-md-none d-xl-none d-lg-none" style="font-size:16px;"><?php echo get_the_title($casino_id);?></div>
		<div class="ratings d-block d-md-none d-xl-none d-lg-none"><div class="star-rating"><span style="width: <?php echo $casino_score;?>px;"></span></div></div>
		<a href="<?php echo get_post_meta($casino_id, 'casino_custom_meta_affiliate_link', true); ?>" rel="nofollow" data-casinoid="<?php echo $casino_id; ?>" data-country="<?php echo $thisISO?>" class="btn btn_tiny btn_yellow font-weight-bold d-block cta play_button bumper">VISIT</a>
	</div>
	<div class="col-12 col-sm-12 d-none d-md-block d-lg-block d-xl-block cta-desc font-weight-bold">
		<a href="<?php echo get_site_url(); ?>/online-casino-reviews/">* For a complete guide on what criteria we use in our casino reviews click here *</a>
	</div>
</div>

<div class=" game_details">
    <h3 class="star">Slot Table</h3>
<div class="d-flex flex-wrap">
		<div class="col-sm-6" style="padding: 0;padding-right: 2px;">
			<table class="game_table">
				<tr>
					<td>Provider:</td><td class="logo"> <a href="<?php echo get_the_permalink($softwaName);?>"><img src="<?php echo get_the_post_thumbnail_url($softwaName);?>" loading="lazy" alt="<?php echo get_the_title($softwaName)?>" width="50" length="30" data-toggle="tooltip" title="<?php echo get_the_title($softwaName); ?>"></a></td>
				</tr>
				<tr>
					<td>Reels:</td><td><?php echo get_post_meta($post->ID, 'slot_custom_meta_slot_wheels', true); ?></td>
				</tr>
				<tr>
					<td>Slot Type:</td><td>
				<?php 		if ( 'Video' == get_post_meta($post->ID, 'slot_custom_meta_classic_video_rel', true) ) { 
								echo '<span class="icon-video-camera lazy-background tooltip-span" data-toggle="tooltip" title="Video"></span>';
							}else{ 
								echo '<span class="icon-slots lazy-background tooltip-span" data-toggle="tooltip" title="Classic"></span>';
							};
							if (get_post_meta($post->ID, 'slot_custom_meta_jackpot_option', true)) { 
								echo ', <span class="icon-jackpot lazy-background tooltip-span" data-toggle="tooltip" title="Jackpot"></span>';
							}else{ 
								echo '';
							}; 
							if (get_post_meta($post->ID, 'slot_custom_meta_3d_option', true)) {
								echo ', <span class="icon-3d_rotation tooltip-span" data-toggle="tooltip" title="3D Slot"></span>';
							}else{ 
								echo '';
							}; ?></td>
				</tr>
				<?php   $j =0;
                $SettingsThemes = WordPressSettings::getSlotThemes();
				$themes = get_post_meta($post->ID, 'slot_custom_meta_slot_theme',true);
						if ($themes) {
                        $values2 = array_slice($themes,0,2);
						$values1 = array_slice($themes,2,null);
						?>
				<tr>
					<td>Theme:</td><td><?php
                        $tooltip='';
                        foreach ($values2 as $value=>$as){
                            if($j==0){echo $SettingsThemes[$as];
                                $j = $j +1;
                            }else{
                                echo ', '.$SettingsThemes[$as];
                            }
                        }
                        if(!empty($values1)){
                            $j =0;
                            foreach ($values1 as $value=>$as){
                                if($j==0){
                                    $tooltip =  $SettingsThemes[$as];
                                    $j = $j +1;
                                }else{
                                    $tooltip .=  ', '.$SettingsThemes[$as];
                                }
                            }
                            if($tooltip){
                                $num = count($values1);
                                echo '<span class="slot-table-easy" title="'.$tooltip.'" data-toggle="tooltip"> +'.$num.'</span>';
                            }
                        }

					}?></td>
				</tr>
				<tr>
					<td>Paylines:</td><td><?php echo get_post_meta($post->ID, 'slot_custom_meta_slot_paylines', true); ?></td>
				</tr>
				<!--tr>
					<td>Ελάχιστες γραμμές:<?php// echo get_post_meta($post->ID, 'slot_custom_meta_slot_script', true); ?></td>
				</tr-->
				<tr>
					<td>Minimum Bet:</td><td><?php echo get_post_meta($post->ID, 'slot_custom_meta_min_bet', true); ?></td>
				</tr>
			</table>
		</div>
	<div class="col-sm-6" style="padding: 0;padding-left: 2px;">
			<table  class="game_table">
			<tr>
				<td>Maximum Bet:</td><td><?php echo get_post_meta($post->ID, 'slot_custom_meta_max_bet', true); ?></td>
			</tr>
			<tr>
				<td>Return to Player (RTP):</td><td><?php echo get_post_meta($post->ID, 'slot_custom_meta_rtp_perc', true); ?></td>
			</tr>
			<tr>
				<td>Progressive Jackpot:</td><td><?php if (get_post_meta($post->ID, 'slot_custom_meta_adv_jackpot_option', true)) { echo 'Yes';}else{ echo 'No';}; ?></td>
			</tr>
			<tr>
				<td>Scatter Symbol:</td><td><?php if ( get_post_meta($post->ID, 'slot_custom_meta_scatter_option', true)) { echo 'Yes';}else{ echo 'No';}; ?></td>
			</tr>
			<tr>
				<td>Wild Symbol:</td><td><?php if ( get_post_meta($post->ID, 'slot_custom_meta_wild_option', true)) { echo 'Yes';}else{ echo 'No';}; ?></td>
			</tr>
			<tr>
				<td>Free Spins:</td><td><?php if ( get_post_meta($post->ID, 'slot_custom_meta_free_spins_option', true)) { echo 'Yes';}else{ echo 'No';}; ?></td>
			</tr>
		</table>
		
	</div>
	</div>
	
</div>


<div class="row content">
	<div class="col-sm-12 entry">
		<?php the_content(); 
		$posttags = get_the_tags();
		if ($posttags) { ?>
		<ul class="tags-list">
		<?php foreach($posttags as $tag) {
			echo '<li><a href="'.get_tag_link($tag->term_id).'">'.$tag->name .'</a></li>'; 
		  }
		  ?>
			</ul>
		<?php }?>
	</div>
<!--	<span class="expand-me visible-xs">Show More</span></div>-->
</div>

<?php echo do_shortcode('[slot_promo slot="'.$post->ID.'"]')?>
        <?php $soft = get_post_meta($post->ID, 'slot_custom_meta_slot_software', true);
//        var_dump($soft);
        $title = 'You can also play '.get_the_title().' in the casinos below';
        $premium=WordPressSettings::getPremiumCasino($GLOBALS['countryISO'],'premium');?>
<?php echo related_casinos('post__in', -1,'soft', [$soft], $title,'Why Choose:','sign_up',$premium);?>


<?php
$currentID = $post->ID;
echo get_related_sg($currentID, 'slot','software');
echo get_related_sg($currentID, 'slot','best');