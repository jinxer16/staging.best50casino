<?php
function comparison_casino($atts)
{
    $atts = shortcode_atts(
        array(
            'casino_main'=> '',
            'title_text' => '',
            'title_type' => '',
        ), $atts, 'compare');


    ob_start();

?>
            <div class="section-comparison mb-10p d-flex flex-wrap shadow-box  mt-10p" id="compare">
                <span class="widget2-heading w-100 text-left">Compare Against Other Casinos</span>
                <div class="bg-dark">

                </div>
                <?php
                $args = array(
                    'post_type' => 'kss_casino',
                    'posts_per_page' => 3,
                    'post_status' => array('publish'),
                    'numberposts' => 3,
                    'no_found_rows' => true,
                    'update_post_term_cache' => false,
                    'orderby' => 'rand',
                );
                $slots= get_posts($args);
                foreach ($slots as $slot){
                    ?>
                    <div class="d-flex flex-wrap w-33">
                        <div class="w-100 pl-10p pr-10p">
                            <img class="stamp img-fluid w-100" style="height: 140px;" src="<?php echo get_the_post_thumbnail_url($slot);?>">
                            <div class="d-flex flex-column text-white text-center" style="background: rgb(2,1,19);
                                background: linear-gradient(90deg, rgba(2,1,19,1) 0%, rgba(47,47,55,1) 48%, rgba(0,0,0,1) 100%);">
                                <span class="text-20">Welcome Bonus</span>
                                <span class="font-weight-bold text-23">1500$</span>

                            </div>
                        </div>
                        <div class="d-flex flex-column w-100" style="border-bottom: 1px solid #ab8f8f; border-top: 1px solid #ab8f8f;">
                            <div class="text-18 text-center bg-gray-light">
                                Rating
                            </div>
                            <div class="text-center w-100" style="border-bottom: 1px solid #ab8f8f;">
                                97
                            </div>
                            <div class="d-flex flex-column text-center w-100 bg-gray-light" style="border-bottom: 1px solid #ab8f8f;">
                                <span class="text-18">Bonus Percentage</span>
                                <span class="font-weight-bold text-21" style="color: #180e2f">-</span>
                            </div>
                            <div class="d-flex flex-column text-center w-100" style="border-bottom: 1px solid #ab8f8f;">
                                <span class="text-18">Minimum Deposit Over</span>
                                <span class="font-weight-bold text-21">10</span>
                            </div>
                            <div class="d-flex flex-column text-center w-100 bg-gray-light" style="border-bottom: 1px solid #ab8f8f;">
                                <span class="text-18">Turn Over</span>
                                <span class="font-weight-bold text-21" style="color: #180e2f">x35</span>
                            </div>
                            <div class="d-flex flex-column text-center w-100" style="border-bottom: 1px solid #ab8f8f;">
                                <span class="text-18">Apss</span>
                                <span class="font-weight-bold text-21" style="color: #180e2f"></span>
                            </div>
                        </div>

                        <div class="w-100 pl-10p pr-10p">
                            <div class="d-flex flex-column text-white text-center p-15p" style="background: rgb(2,1,19);
                                background: linear-gradient(90deg, rgba(2,1,19,1) 0%, rgba(47,47,55,1) 48%, rgba(0,0,0,1) 100%);">
                                <a class="btn bumper btn btn bg-yellow rounded text-15 w-90 m-auto d-block p-7p btn_large  bumper font-weight-bold" style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);" href="#" rel="nofollow" target="_blank">
                                    Visit <?= get_the_title($slot);?></a>

                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>


<?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode('compare','comparison_casino');