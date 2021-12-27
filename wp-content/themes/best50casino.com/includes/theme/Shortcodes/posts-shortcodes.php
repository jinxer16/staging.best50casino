<?php

function posts_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'layout' => '', // horizontal, vertical, full, sidebar
            'limit' => '',
            'type' => '',
            'sort_by' => '',
            'post_id' => '',
            'title' => '',
        ), $atts, 'posts');


    ob_start();


    if ( $atts['post_id'] ){
    $post_idz = explode(",", $atts['post_id']);

    $query_slot = array( // A QUERY that initializes the default (all) IDS
        'post_type'      => array('post','page','kss_news','bc_offers','kss_guides','kss_softwares','kss_transactions'),
        'post_status'    => array('publish,draft'),
        'fields' => 'ids',
        'post__in' => $post_idz,
        'orderby'=>'post__in',
        'suppress_filters' => true,
    );
    }else{
        $postype ='';
        if ($atts['type'] == 'news'){
            $postype ='kss_news';
        }elseif ($atts['type'] == 'promotions'){
            $postype ='bc_offers';
        }
        elseif ($atts['type'] == 'guides'){
            $postype ='kss_guides';
        }elseif ($atts['type'] == 'payments'){
            $postype ='kss_transactions';
        }elseif ($atts['type'] == 'softwares'){
            $postype ='kss_softwares';
        }elseif ($atts['type'] == 'any'){
            $postype =  array('post','page','kss_news','bc_offers','kss_guides');
        }elseif ($atts['type'] == 'page'){
        $postype ='page';
        }
        $limit='';
        if (!$atts['limit']){
            $limit = -1;
        }else{
            $limit = $atts['limit'];
        }

        $paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
        $query_slot = array( // A QUERY that initializes the default (all) IDS
            'post_status'    => array('publish'),
            'post_type'      => $postype,
            'posts_per_page' => $limit,
            'order' => 'DESC',
            'orderby' => 'menu_order',
            'paged' => $paged,
            'fields' => 'ids',
            'suppress_filters' => true,
        );
    }
    $query_slots = get_posts( $query_slot );

    $widthclass ='';
    if ($atts['limit'] == 2){
        $widthclass = '50';
    }else{
        $widthclass = '33';
    }
    if ($atts['title']){
    ?>
    <span class="widget2-new-heading text-center"><?=$atts['title']?></span>
    <?php
    }
    if ('boxes' == $atts['layout']){
        ?>
            <div class="d-flex flex-wrap w-100 mb-15p">
                <?php
                foreach ($query_slots as $postID){
                    ?>
                    <div class="d-flex flex-row text-dark text-center w-<?=$widthclass?> w-sm-100  post-offer text-15 pt-xl-2 pt-lg-2 p-5p">
                    <div class="post-offer-content overflow-hidden bg-white position-relative" style="border-radius: 5px !important;">
                        <div class="thumbnail-image ">
                            <img class="w-100 img-fluid" src="<?=get_the_post_thumbnail_url($postID);?>" loading="lazy">
                        </div>
                        <div class="entry-title bg-white p-10p d-flex align-items-center justify-content-center">
                            <div class="offer-title">
                                <a class="align-self-center pl-1 pl-xl-0 text-decoration-none" style="color: black;" id="title-blog" href="<?=get_the_permalink($postID);?>">
                                    <?=get_the_title($postID);?>
                                </a>
                            </div>
                            <div class="button d-inline-block">
                                <a class="d-block text-12 pt-5p pr-10p pb-5p pl-10p text-decoration-none text-dark w-70 m-0 font-weight-bold position-absolute" style="border-radius: 5px !important;" href="<?=get_the_permalink($postID);?>">
                                    Read Article
                                </a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        <?php
    }elseif ('rows' == $atts['layout']){
        ?>
        <div class="d-flex flex-wrap w-100 mb-15p">
            <?php foreach ($query_slots as $postidd){
                $post_content = get_post($postidd);
                $content = $post_content->post_content;
                ?>
                <div class="d-flex flex-wrap w-100 posts-shadow">
                <div class="w-20 w-sm-100">
                    <img class="w-100 img-fluid" style="min-height: 110px;" src="<?=get_the_post_thumbnail_url($postidd);?>" loading="lazy">
                </div>
                <div class="w-80 w-sm-100 d-flex flex-column pl-20p p-sm-5p ">
                        <span class="text-primary font-weight-bold text-18"><?=get_the_title($postidd)?></span>
                        <span class="text-dark text-16"><?php echo wp_trim_words( $content, 17 );?></span>
                    <a class="float-right mb-3p btn br-5 smaller text-13 rounded-0 text-bold bg-dark text-white mr-5p align-self-end" href="<?=get_the_permalink($postidd);?>">
                        Read More <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>

                </div>
            <?php
            }?>
        </div>
        <?php
    }
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode('posts', 'posts_shortcode');