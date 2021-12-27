<?php if(!get_post_meta($post->ID, 'hide_featured', true)){ ?>
				<figure class="image-banner m-0 ">
                      <img class="bg-image" src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" loading="lazy" width="720" height="350" alt="<?php echo get_the_title($post->ID); ?>"/>
                      <figcaption>
                      	<h1 class="text-center"><?php  echo get_the_title($post->ID); ?></h1>
                      </figcaption>
                    </figure> 		
<?php }
else{
    ?>
    <h1 class="star"><?php  echo get_the_title($post->ID); ?></h1>
    <?php
}
?>
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
                      	<?php
							$related_args = array(
								'post_type' => 'kss_guides',
								'posts_per_page' => 3,
								'post_status' => 'publish',
								'post__not_in' => array( $post->ID ),
								);
							$related = new WP_Query( $related_args );
							if( $related->have_posts() ) : ?>
							<h6>Latest Guides<a href="<?php echo get_site_url(); ?>/casino-guides/" class="pull-right"><small>See all Guides >></small></a></h6>
							<div class="row offer-boxes d-flex flex-wrap">
						<?php
                        while( $related->have_posts() ): $related->the_post(); ?>
									<div class="col-lg-4 col-xl-4 col-12">
										<div class="offer-box">
											<a href="" class="offer-info"><i class="fa fa-info"></i></a>
											<a class="text-decoration-none" href="<?php echo get_the_permalink($post->ID); ?>">
												<div class="offer-image cover">
													<img class="bg-image" loading="lazy" src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt=""/>
												</div>
												<div class="offer-content">
													<p class="text-center"><?php echo $post->post_title; ?></p>
													<hr>
												</div>
											</a>
										</div>                        
									</div>
						<?php   endwhile;?> 
							</div>
						<?php	endif;
							wp_reset_postdata(); ?>
                    </div>