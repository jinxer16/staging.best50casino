<h1 class="content-title"><?php the_title(); ?></h1>
<div class="row game_presentation">
	<div class="col-sm-12 the_game">
		<a href="#" class="big"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
		<?php
        if(!get_post_meta($post->ID, 'games_custom_meta_thumb_of_game_mob_gen', true)){
            echo get_post_meta($post->ID, 'games_custom_meta_slot_script', true);
        }else{
            echo '<img src="'.get_post_meta($post->ID, 'games_custom_meta_thumb_of_game', true).'" loading="lazy" class="img-fluid">';
        }  ?>
	</div>
</div>
<?php


$softwaName = get_post_meta($post->ID, 'games_custom_meta_slot_software' , true);
$countryEnabledSettings = get_option('countries_enable_options');
$thisISO = $GLOBALS['countryISO'] ;
$casino_id = get_post_meta($post->ID, $thisISO.'games_custom_meta_games_main_casino' , true);
$casino_score = get_post_meta($casino_id, 'casino_custom_meta_sum_rating', true)*10;
$localISO = $GLOBALS['visitorsISO'];
$casinoRestrictedCountries = get_post_meta($casino_id, 'casino_custom_meta_rest_countries', true);
$casino_cons = explode (',', get_post_meta($casino_id, 'casino_custom_meta_why_play' , true) );
$casino_cons = array_slice($casino_cons,0,4);

if(in_array($thisISO,$casinoRestrictedCountries)){
    $game = implode("",get_post_meta($post->ID, 'games_custom_meta_game_categ', true));
//    $casino_id = next_casino($thisISO, $localISO, $casino_id,$post->ID, 'game' );
}
$casino_score = get_post_meta($casino_id, 'casino_custom_meta_sum_rating', true)*10;
?>

<div class="row inner_row more_games game-cta  d-flex flex-wrap text-center p-10p mb-20p text-21 align-items-center" style="background:#f0f0f0;color:#181818;">
	<div class="col-lg-2 col-md-2 col-sm-4 col-6 casino">
		<a class="" href="<?php echo get_the_permalink($casino_id) ?>"><img class="img-fluid" src="<?php echo get_the_post_thumbnail_url((int)$casino_id); ?>" loading="lazy" alt="<?php echo get_the_title($casino_id); ?>" ></a>
	</div>
	<div class="col-lg-8 col-md-10 col-sm-8 pros-list d-none d-md-block d-lg-block d-xl-block">
		<span class="font-weight-bold text-15 mb-3p" style="vertical-align: top">Four reasons why you should choose <?php echo get_the_title((int)$casino_id); ?>:</span>
		<ul class="check-list list-typenone mb-0 mt-0 pl-0 text-left">
			<?php foreach ($casino_cons as $pros){ ?>
				<li class="position-relative pl-25p" style="list-style: none;"><?php echo $pros; ?></li>
			<?php }?>
		</ul>          
	</div>
	<div class="col-lg-2 col-md-12 col-sm-12 col-6 casino">
		<div class=" d-block d-md-none d-xl-none d-lg-none" style="font-size:16px;"><?php echo get_the_title($casino_id);?></div>
		<div class="ratings d-block d-md-none d-xl-none d-lg-none"><div class="star-rating"><span style="width: <?php echo $casino_score;?>px;"></span></div></div>
		<a href="<?php echo get_post_meta($casino_id, 'casino_custom_meta_affiliate_link', true); ?>" rel="nofollow" data-casinoid="<?php echo $casino_id; ?>" data-country="<?php echo $thisISO?>"  class="btn btn_tiny btn_yellow font-weight-bold d-block cta play_button bumper">Play Now</a>
	</div>
	<div class="col-12 col-sm-12 d-none d-md-block d-lg-block d-xl-block cta-desc font-weight-bold">
		<a href="<?php echo get_site_url(); ?>/online-casino-reviews/">* For a complete guide on what criteria we use in our casino reviews click here *</a>
	</div>
</div>
<div class="">
<?php the_content();
?> 

<?php
$title = 'Best Casinos to play '.get_the_title();
$game = get_post_meta($post->ID, 'games_custom_meta_game_categ', true);
echo related_casinos('popular', 5,'game', $game, $title,'Why Choose:','sign_up',null);
echo get_related_sg($post->ID, 'games','');
$posttags = get_the_tags();
if ($posttags) {
	?>
<ul class="tags-list">
<?php foreach($posttags as $tag) {
	echo '<li><a href="'.get_tag_link($tag->term_id).'">'.$tag->name .'</a></li>'; 
  }
  ?>
	</ul>
<?php }?>
</div>