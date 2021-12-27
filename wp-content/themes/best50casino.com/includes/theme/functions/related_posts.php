<?php
function related_posts($post_type, $ex_ids = "")
{
$args = array(
'post_type' => $post_type,
'post_status' => array('publish'),
'ignore_sticky_posts' => 1,
'post__not_in' => array($ex_ids),
'posts_per_page' => 777
);
$posts = new WP_Query($args);
$ret="";
if ($posts->have_posts()) {
while ($posts->have_posts()) {
$posts->the_post();
$post_id = get_the_ID();
$ret .= '<div class="recent-wrapper d-flex  flex-lg-wrap flex-xl-wrap br-1 mt-2p mb-5p mr-1p pt-3p pr-3p pb-3p  overflow-hidden" style="border: 1px solid #d9d9d9; ">';
    $ret .= '	<a class="mr-5p w-sm-100 w-30" href="' . get_the_permalink($post_id) . '" title="Permalink to ' . the_title_attribute('echo=0') . '" rel="bookmark">
        <img class="img-fluid" src="' . get_the_post_thumbnail_url($post_id, 'thumb-400') . '" loading="lazy"></a>';
    $ret .= '<div class="w-sm-100 w-69">';
        $ret .= '   <b class="float-right pt-5p" style="color: #b3b3b3;">' . get_the_date('d M y') . '</b>';
        $ret .= '	<p class="mb-5p"><a class="text-bold font-weight-bold text-black text-16" href="' . get_the_permalink($post_id) . '" title="Permalink to ' . the_title_attribute('echo=0') . '" rel="bookmark">' . get_the_title($post_id) . '</a></p>';
        $ret .= '	<p class="mb-5p">' . wp_trim_words(get_the_excerpt($post_id),20). '</p>';
        $ret .= '	<p class="mb-5p"><a class="float-right mb-3p btn br-5 smaller text-13 rounded-0 text-bold bg-dark text-white" href="' . get_the_permalink($post_id) . '">Read More <i
                    class="fa fa-chevron-right" aria-hidden="true"></i></a></p>';
        $ret .= '</div>';
    $ret .= '</div>';
} // end while
wp_reset_postdata();
} // end if
return $ret;
}
