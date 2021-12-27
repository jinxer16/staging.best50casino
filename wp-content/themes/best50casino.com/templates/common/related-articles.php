<?php

$articles = @get_post_meta($post->ID,'related_posts',true) ?? false;
if ($articles ) {
    $title = get_post_meta($post->ID,'title_related',true);
    $post_idz = explode(",", $articles);

    $query_slot = array( // A QUERY that initializes the default (all) IDS
        'post_type'      => array('post','page','kss_news','bc_offers','kss_guides','kss_softwares','kss_transactions'),
        'post_status'    => array('publish,draft'),
        'fields' => 'ids',
        'post__in' => $post_idz,
        'orderby'=>'post__in',
        'suppress_filters' => true,
    );
    $query_slots = get_posts( $query_slot );
    $widthclass="";

    if ( count($post_idz) > 3){
        if (!get_post_meta($post->ID, 'posts_no_sidebar', true)) {
            $widthclass="33";
        }else{
            $widthclass="25";
        }
    }else{
        $widthclass="33";
    }
    if ($title){
?>
<span class="widget2-new-heading text-center"><?=$title?></span>
 <?php
 }
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
}
?>