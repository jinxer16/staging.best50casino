<?php
    if ( ((is_archive() && 'kss_slots' == $post->post_type) || 5459 == $post->ID ) && !is_tag()){
?>
<aside class="sidebar left_sidebar filters-power d-sm-block d-none">
    <button type="button" id="filt-btn" class="navbar-toggle filters p-10p rounded-5 w-100 bg-dark" data-toggle="collapse" data-target="#options">
        <span class="text-white">Filters <i class="fa fa-filter" aria-hidden="true"></i></span>
    </button>
    <div id="options" class="collapse show filter-options">
        <?php
        $prem_themes = array(
            '7s' => __('777', 'bet-o-shark'),
            'fruits' => __('Fruits', 'bet-o-shark'),
            'pharaoh' => __('Pharaoh', 'bet-o-shark'),
            'mythology' => __('Mythology', 'bet-o-shark'),
            'africa' => __('Africa', 'bet-o-shark'),
            'sport' => __('Sports', 'bet-o-shark'),
            'movies' => __('Movies', 'bet-o-shark'),
            'music' => __('Music', 'bet-o-shark'),
            'anc_greece' => __('Ancient Greece', 'bet-o-shark'),
        );
        $themes = array(
            'wild_west' => __('Wild West', 'bet-o-shark'),
            'east' => __('East', 'bet-o-shark'),
            'anc_rome' => __('Ancient Rome', 'bet-o-shark'),
            'comics' => __('Comics', 'bet-o-shark'),
            'women' => __('Women', 'bet-o-shark'),
            'crime' => __('Crime', 'bet-o-shark'),
            'sci_fi' => __('Sci-Fi', 'bet-o-shark'),
            'jungle' => __('Jungle', 'bet-o-shark'),
            'animals' => __('Animals', 'bet-o-shark'),
            'sea' => __('Sea', 'bet-o-shark'),
            'treasures' => __('Treasures', 'bet-o-shark'),
            'magic' => __('Magic', 'bet-o-shark'),
            'marvel' => __('Marvel', 'bet-o-shark'),
            'fairy_tales' => __('Fairytales', 'bet-o-shark'),
            'buterfly' => __('Butterflies', 'bet-o-shark'),
            'stones' => __('Gemstones', 'bet-o-shark'),

        ); ?>
        <h3 class="title text-white text-center mt-10p m-0 filters-title">Special Filters</h3>
        <div class="option-set special bg-primary text-white p-10p" data-group="type">
            <label class="mr-2" for="LEGEND">Legend</label><input type="checkbox" value=".LEGEND" id="LEGEND"/>
            <label class="mr-2" for="BEST">Best</label><input type="checkbox" value=".BEST" id="BEST"/>
            <label class="mr-2" for="bestRTP">Best Payout</label><input type="checkbox" value=".bestRTP" id="bestRTP"/>
            <label class="mr-2" for="Classic">Classic</label><input type="checkbox" value=".Classic" id="Classic"/>
            <label class="mr-2" for="Video">Video</label><input type="checkbox" value=".Video" id="Video"/>
            <label class="mr-2" for="3D">3D</label><input type="checkbox" value=".3D" id="3D"/>
            <label class="mr-2" for="Jackpot">Jackpot</label><input type="checkbox" value=".Jackpot" id="Jackpot"/>
        </div>
        <h3 class="title text-white text-center m-0 filters-title">Providers</h3>
        <div class="option-set bg-primary text-white p-10p" data-group="brand">
            <?php
                $soft_args = array(
                  'post_type'=>'kss_softwares',
                  'post_status'    => array('publish'),
                  'no_found_rows' => true,
                  'fields' => 'ids',
                  'update_post_term_cache' => false,
                  'posts_per_page' => 500,
                  'order' => 'ASC', );

                $cache_key = 'providers_all';
                if (false === ( $query_slots = wp_cache_get( $cache_key ) )){
                    $query_softs = get_posts($soft_args);
                    wp_cache_set( $cache_key, $query_softs, 'providers_all', DAY_IN_SECONDS );
                }
                $prem_softwares = array( 'Novomatic' , 'Netent', 'Microgaming', 'EGT', 'IGΤ', 'Playson', 'Amaya', 'iSoftbet' );

                    foreach ( $query_softs as $software ) {
                        $title = get_the_title($software);
                        if ('Play\'n GO' == $title) {
                            $class = "Play\'n.GO";
                        } else {
                            $class = str_replace(' ', '-', $title);
                        }
                        if (in_array($title, $prem_softwares)) { ?>
                            <label class="mr-2" for="<?php echo $class ?>"><?php echo $title ?></label><input type="checkbox" value=".<?php echo $class ?>" id="<?php echo $class ?>"/>
                        <?php }
                        wp_reset_postdata();
                    }

           ?>
                <div id="see-more-softwares" class="collapse">
                <?php

                    foreach ($query_softs as $software) {
                        $title = get_the_title($software);
                        if ('Play\'n GO' == $title) {
                            $class = "Play\'n.GO";
                        } else {
                            $class = str_replace(' ', '-', $title);
                        }
                        if (!in_array($title, $prem_softwares)) { ?>
                            <label class="mr-2" for="<?php echo $class ?>"><?php echo $title ?></label><input type="checkbox" value=".<?php echo $class ?>" id="<?php echo $class ?>"/>
                        <?php
                        }
                        wp_reset_postdata();
                    }
                    ?>
                </div>
                <a href="#see-more-softwares" data-toggle="collapse" class="catholic_link see-more-themes collapsed"></a>
			</div>
			<h3 class="title text-white text-center m-0 filters-title">Themes</h3>
		    <div class="option-set themes bg-primary text-white p-10p" data-group="color">
                <?php foreach ($prem_themes as $key=>$value){
                        echo '<label class="mr-2" for="'.$key.'">'.$value.'</label><input type="checkbox" value=".'.$key.'" id="'.$key.'" />';
                 }
                wp_reset_postdata();
                ?>
                 <div id="see-more-themes" class="collapse">
                 <?php
                 foreach ($themes as $key=>$value){
                        echo '<label class="mr-2" for="'.$key.'">'.$value.'</label><input type="checkbox" value=".'.$key.'" id="'.$key.'" />';
                 }
                 wp_reset_postdata();
                 ?>
                </div>
                <a href="#see-more-themes" data-toggle="collapse" class="catholic_link see-more-themes collapsed"></a>
		    </div>
		</div>
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('left-for-slots')) : else : ?>
		<?php endif; ?>
<?php } else { ?>
	<aside class="sidebar left_sidebar">
        <?php get_template_part( 'templates/sidebar-left/casino-games'); ?>

        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('secondary-sidebar')) : else : ?>

        <?php endif; ?>
    </aside>
<?php } ?>
