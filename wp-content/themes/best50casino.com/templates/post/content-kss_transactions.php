<?php if(!get_post_meta($post->ID, 'hide_featured', true)){ ?>
		<figure class="image-banner">
		  <img class="bg-image" loading="lazy" src="<?php the_post_thumbnail_url(); ?>" width="720" height="350" alt=""/>
		  <figcaption>
			<h2><?php the_title(); ?></h2>
			<?php //the_excerpt(); ?>
		  </figcaption>
		</figure> 		
<?php }else{
	?>
	<h1 class="star"><?php echo get_post_meta($post->ID, 'transactions_custom_meta_seo_title', true) ? get_post_meta($post->ID, 'transactions_custom_meta_seo_title', true) : get_the_title(); ?></h1>
	<?php
} ?>
	<div class="entry">                    
		<?php the_content();
		$posttags = get_the_tags();
		if ($posttags) {
			?>
		<ul class="tags-list">
		<?php foreach($posttags as $tag) {
			echo '<li><a href="'.get_tag_link($tag->term_id).'">'.$tag->name .'</a></li>'; 
		  }
		  ?>
			</ul>
		<?php }
		echo get_post_meta($post->ID, 'in_page_game_script', true);?>

		<hr> 
		<a class="catholic_link special col-sm-12" href="<?php echo get_site_url(); ?>/payment-methods/">See all Payment Methods</a>
	</div>