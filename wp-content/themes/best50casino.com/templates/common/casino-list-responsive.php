<?php
$sort_by = 'meta_value_num';
$sort_val = 'casino_custom_meta_casino_priority';
$order = 'ASC';
$query_casino = array( // A QUERY that initializes the default (all) IDS
    'post_type'      => array('kss_casino'),
    'post_status'    => array('publish'),
    'posts_per_page' => 6,
    'fields' => 'ids',
//	'orderby'   => $sort_by,
//	'meta_key'  => $sort_val,
//	'order' => $order,
    'suppress_filters' => true,
);
$query_casinos = get_posts( $query_casino );
$ret="";
$ret .= '<div class="d-md-none d-lg-none d-xl-none d-block this">';
$ret .= '	<span class="h-auto d-block">';
$ret .= '		<div class="top10 top10--hp">';
$ret .= '			<ul class="pl-0 mb-0">';

    foreach ( $query_casinos as $casinos ) {
        if(!get_post_meta($casinos, 'casino_custom_meta_hidden', true) && !in_array($GLOBALS['countryISO'], get_post_meta($casinos, 'casino_custom_meta_rest_countries', true))){
            $ret .= '				<li class="top10__item position-relative">';
            $ret .= '					<span class="top10__link">';
            $ret .= '						<a href="'.get_the_permalink($casinos).'">';
            $casinoName = get_the_title($casinos);
            $imge_id = getImageId(get_post_meta($casinos, 'casino_custom_meta_sidebar_icon', true));
            $ret .=  							wp_get_attachment_image( $imge_id , "sidebar-40", "", array( "class" => "img-fluid top10__img", "alt"=> $casinoName)  );
            $ret .= '							<span class="top10__name">'.$casinoName.'</span>';
            $ret .= '						</a>';
            $ret .= '						<a class="top10__visit" href="'.get_post_meta( $casinos , "casino_custom_meta_affiliate_link" , true ).'"  rel="nofollow" target="_blank">Visit</a>';
            $ret .= '					</span>';
            $ret .= '				</li>';
        }
    }
$ret .= '			</ul>';

$ret .= '		</div>';
$ret .= '</div>';
echo $ret;