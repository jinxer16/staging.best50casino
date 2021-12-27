<?php

function bonustable_func($atts) {
	extract(shortcode_atts(array(
		'usa' => 'n',
		'num' => 10,
		'orderby' => 'menu_order',
		'sort' => 'ASC',
		'title' =>'',
		'tag'=>'',
                'version' =>1
	), $atts));


if ($orderby == 'menu_order'){
	
$loop = new WP_Query( array( 'post_type' => 'kss_casino', 'posts_per_page' => -1, 'order'=>$sort, 'orderby'=>'menu_order' )); 

} else if ($orderby == '_as_roomname') {

$loop = new WP_Query( array( 'post_type' => 'kss_casino', 'posts_per_page' => -1, 'order'=>$sort, 'orderby'=>'meta_value', 'meta_key'=>$orderby )); 

} else{

$loop = new WP_Query( array( 'post_type' => 'kss_casino', 'posts_per_page' => -1, 'order'=>$sort, 'orderby'=>'meta_value_num', 'meta_key'=>$orderby ) );
}

	$i=0;
	$posts = array();
	foreach ($loop->posts as $p) {
		if ($i>=$num) continue;
		
		if ($tag!='' && !has_term($tag, 'affiliate-tags', $p)) continue;
		$custom = get_post_custom($p->ID);
		
		if (strtoupper($usa)=="Y" && $custom["_as_usonly"][0]=="") continue;
				
		$posts[] = $p;
		$i++;
	}

ob_start();
$ret = apply_filters('bonustable', $posts);
if (is_array($ret) || $ret =="" || $ret == " ") {
	$ret = ob_get_contents();
}
ob_end_clean();

if (!is_array($ret) && $ret !="") {
} else {


if ($version==1){


$ret = '
 <table cellpadding="3" cellspacing="0" width="100%" class="comptable" align="center">
        
    <tr>
          <th width="19%" height="28" class="bleft">' . (get_gambling_option("replace-head-site")!="" ? get_gambling_option("replace-head-site") : "Broker") .'</th>
		     <th width="24%">' . (get_gambling_option("replace-head-bonus")!="" ? get_gambling_option("replace-head-bonus") : "Bonus") .'</th>
          <th width="13%" class="hideme">' . (get_gambling_option("replace-head-mindep")!="" ? get_gambling_option("replace-head-mindep") : "Min Deposit") .'</th>
		      <th width="13%" class="hideme">' . (get_gambling_option("replace-head-options")!="" ? get_gambling_option("replace-head-options") : "Payout") .'</th>
          <th width="12%" class="hideme">' . (get_gambling_option("replace-head-usa")!="" ? get_gambling_option("replace-head-usa") : "US Traders") .'</th>
          <th width="11%" class="hideme">' . (get_gambling_option("replace-head-review1")!="" ? get_gambling_option("replace-head-review1") : "Review") .'</th>

          <th width="15%" class="bright">' . (get_gambling_option("replace-head-visit")!="" ? get_gambling_option("replace-head-visit") : "Open Account") .'</th>
        </tr>

';
global $post;
$opost = $post;
foreach ($posts as $post) :
	setup_postdata($post); 
$x=$x+1;
$ret .= '


<tr>
          <td><a href="' . get_permalink() . '"><img width="100" src="'. get_post_meta($post->ID,"_as_roomlogo",true)  .'" alt="' . get_post_meta($post->ID,"_as_roomname",true) . '" /></a></td>
          <td class="blue blueh">'. get_post_meta($post->ID,"_as_bonustext",true)  .'</td>
          <td class="blue hideme">'. get_post_meta($post->ID,"_as_mindep",true)  .'</td>
                   <td class="hideme">'. get_post_meta($post->ID,"_as_optprofit",true)  .'</td>
          <td class="hideme">

'. (get_post_meta($post->ID,"_as_usonly",true)!="" ? '<img src="'. get_bloginfo('stylesheet_directory') .'/images/usa_flg.png" alt="USA Allowed" width="15" height="15" />' : '') .' 

</td>

  <td class="hideme"><a href="' . get_permalink() . '">' . (get_gambling_option("replace-head-review1")!="" ? get_gambling_option("replace-head-review1") : "Review") .'</a></td>
          <td align="center" class="bright"><a '. (get_theme_option('redirect-new-window')!="" ? "target=\"_blank\"" : "") .' href="'. get_bloginfo('url') .'/visit/'. get_post_meta($post->ID,"_as_redirectkey",true)  .'" class="visit">' . (get_gambling_option("replace-head-vbroker")!="" ? get_gambling_option("replace-head-vbroker") : "Visit Broker") .'</a></td>
 </tr>

';

endforeach;
$post = $opost;

 $ret .='</table>';
 
}//End of Version 1




if ($version==2){


$ret = '
<table cellpadding="0" cellspacing="0" width="100%" class="comptable" align="center">

<tr>
          <th width="23%" height="28" class="bleft">' . (get_gambling_option("replace-head-site")!="" ? get_gambling_option("replace-head-site") : "Broker") .'</th>
          <th width="24%">' . (get_gambling_option("replace-head-info")!="" ? get_gambling_option("replace-head-info") : "Info") .'</th>
          <th width="20%" class="hideme">' . (get_gambling_option("replace-head-bonus")!="" ? get_gambling_option("replace-head-bonus") : "Bonus") .'</th>
          <th width="13%" class="hideme">' . (get_gambling_option("replace-head-usa")!="" ? get_gambling_option("replace-head-usa") : "US Traders") .'</th>
          <th width="20%" class="bright">' . (get_gambling_option("replace-head-visit")!="" ? get_gambling_option("replace-head-visit") : "Open Account") .'</th>
        </tr>


';
global $post;
$opost = $post;
foreach ($posts as $post) :
	setup_postdata($post); 
$x=$x+1;
$ret .= '

     <tr>
          <td height="64"><a href="' . get_permalink() . '"><img width="100" src="'. get_post_meta($post->ID,"_as_roomlogo",true)  .'" alt="' . get_post_meta($post->ID,"_as_roomname",true) . '" /></a></td>
          <td style="text-align:left;">' . (get_gambling_option("replace-head-reviewassets")!="" ? get_gambling_option("replace-head-reviewassets") : "Assets") .': <span>'. get_post_meta($post->ID,"_as_numassets",true)  .'</span><br />
            ' . (get_gambling_option("replace-head-options")!="" ? get_gambling_option("replace-head-options") : "Payout") .': <span>'. get_post_meta($post->ID,"_as_optprofit",true)  .'</span><br />
            ' . (get_gambling_option("replace-head-demoacc")!="" ? get_gambling_option("replace-head-demoacc") : "Demo Account") .': <span>'. (get_post_meta($post->ID,"_as_demo",true)!="" ? 'Yes' : 'No') .'</span> <br />
			' . (get_gambling_option("replace-head-mindep")!="" ? get_gambling_option("replace-head-mindep") : "Min Deposit") .': <span>'. get_post_meta($post->ID,"_as_mindep",true)  .'</span></td>
          <td class="blue hideme">'. get_post_meta($post->ID,"_as_bonustext",true)  .'</td>
          <td class="hideme">'. (get_post_meta($post->ID,"_as_usonly",true)!="" ? '<img src="'. get_bloginfo('stylesheet_directory') .'/images/usa_flg.png" alt="USA Allowed" width="15" height="15" />' : '') .'</td>
          <td align="center" class="bright"><a '. (get_theme_option('redirect-new-window')!="" ? "target=\"_blank\"" : "") .' href="'. get_bloginfo('url') .'/visit/'. get_post_meta($post->ID,"_as_redirectkey",true)  .'" class="visit">' . (get_gambling_option("replace-head-vbroker")!="" ? get_gambling_option("replace-head-vbroker") : "Visit Broker") .'</a>

<a href="' . get_permalink() . '">' . (get_gambling_option("replace-head-reviewread")!="" ? get_gambling_option("replace-head-reviewread") : "Read Review") .'</a></td>
        </tr>


';

endforeach;
$post = $opost;

 $ret .='</table>';
 
}//End of Version 2



if ($version==3){


$ret = '
 <table cellpadding="3" cellspacing="0" width="100%" class="comptable" align="center">
        
    <tr>
          <th width="20%" height="28" class="bleft">' . (get_gambling_option("replace-head-site")!="" ? get_gambling_option("replace-head-site") : "Broker") .'</th>
		     <th width="17%">' . (get_gambling_option("replace-head-minacc")!="" ? get_gambling_option("replace-head-minacc") : "Min Account Size") .'</th>
          <th width="12%" class="hideme">' . (get_gambling_option("replace-head-lev")!="" ? get_gambling_option("replace-head-lev") : "Leverage") .'</th>
		      <th width="11%" class="hideme">' . (get_gambling_option("replace-head-spread")!="" ? get_gambling_option("replace-head-spread") : "Spread") .'</th>
          <th width="11%" class="hideme">' . (get_gambling_option("replace-head-usa")!="" ? get_gambling_option("replace-head-usa") : "US Traders") .'</th>
          <th width="10%" class="hideme">' . (get_gambling_option("replace-head-review1")!="" ? get_gambling_option("replace-head-review1") : "Review") .'</th>

          <th width="19%" class="bright">' . (get_gambling_option("replace-head-visit")!="" ? get_gambling_option("replace-head-visit") : "Open Account") .'</th>
        </tr>

';
global $post;
$opost = $post;
foreach ($posts as $post) :
	setup_postdata($post); 
$x=$x+1;
$ret .= '


<tr>
          <td><a href="' . get_permalink() . '"><img width="100" src="'. get_post_meta($post->ID,"_as_roomlogo",true)  .'" alt="' . get_post_meta($post->ID,"_as_roomname",true) . '" /></a></td>
          <td class="blue blueh">'. get_post_meta($post->ID,"_as_minaccountsize",true)  .'</td>
          <td class="blue hideme">'. get_post_meta($post->ID,"_as_leverage",true)  .'</td>
                   <td class="hideme">'. get_post_meta($post->ID,"_as_spread",true)  .'</td>
          <td class="hideme">

'. (get_post_meta($post->ID,"_as_usonly",true)!="" ? '<img src="'. get_bloginfo('stylesheet_directory') .'/images/usa_flg.png" alt="USA Allowed" width="15" height="15" />' : '') .' 

</td>
  <td class="hideme"><a href="' . get_permalink() . '">' . (get_gambling_option("replace-head-review1")!="" ? get_gambling_option("replace-head-review1") : "Review") .'</a></td>
          <td align="center" class="bright"><a '. (get_theme_option('redirect-new-window')!="" ? "target=\"_blank\"" : "") .' href="'. get_bloginfo('url') .'/visit/'. get_post_meta($post->ID,"_as_redirectkey",true)  .'" class="visit">' . (get_gambling_option("replace-head-vbroker")!="" ? get_gambling_option("replace-head-vbroker") : "Visit Broker") .'</a>



<a '. (get_theme_option('redirect-new-window')!="" ? "target=\"_blank\"" : "") .' href="'. get_post_meta($post->ID,"_as_demourl",true)  .'" class="demo">' . (get_gambling_option("replace-head-vdemo")!="" ? get_gambling_option("replace-head-vdemo") : "Demo") .'</a>


</td>
 </tr>

';

endforeach;
$post = $opost;

 $ret .='</table>';
 
}//End of Version 3





if ($version==4){


$ret = '
<table cellpadding="0" cellspacing="0" width="100%" class="comptable" align="center">

<tr>
          <th width="22%" height="28" class="bleft">' . (get_gambling_option("replace-head-site")!="" ? get_gambling_option("replace-head-site") : "Broker") .'</th>
          <th width="28%">' . (get_gambling_option("replace-head-info")!="" ? get_gambling_option("replace-head-info") : "Info") .'</th>
          <th width="19%" class="hideme">' . (get_gambling_option("replace-head-bonus")!="" ? get_gambling_option("replace-head-bonus") : "Bonus") .'</th>
          <th width="11%" class="hideme">' . (get_gambling_option("replace-head-usa")!="" ? get_gambling_option("replace-head-usa") : "US Traders") .'</th>
          <th width="20%" class="bright">' . (get_gambling_option("replace-head-visit")!="" ? get_gambling_option("replace-head-visit") : "Open Account") .'</th>
        </tr>


';
global $post;
$opost = $post;
foreach ($posts as $post) :
	setup_postdata($post); 
$x=$x+1;
$ret .= '

     <tr>
          <td height="64"><a href="' . get_permalink() . '"><img width="100" src="'. get_post_meta($post->ID,"_as_roomlogo",true)  .'" alt="' . get_post_meta($post->ID,"_as_roomname",true) . '" /></a></td>
          <td style="text-align:left;">' . (get_gambling_option("replace-head-spread")!="" ? get_gambling_option("replace-head-spread") : "Spread") .': <span>'. get_post_meta($post->ID,"_as_spread",true)  .'</span><br />
            ' . (get_gambling_option("replace-head-lev")!="" ? get_gambling_option("replace-head-lev") : "Leverage") .': <span>'. get_post_meta($post->ID,"_as_leverage",true)  .'</span><br />
            ' . (get_gambling_option("replace-head-minacc")!="" ? get_gambling_option("replace-head-minacc") : "Min Account Size") .': <span>'. get_post_meta($post->ID,"_as_minaccountsize",true)  .'</span><br />
            ' . (get_gambling_option("replace-head-demoacc")!="" ? get_gambling_option("replace-head-demoacc") : "Demo Account") .': <span>'. (get_post_meta($post->ID,"_as_demourl",true)!="" ? '<a '. (get_theme_option('redirect-new-window')!="" ? "target=\"_blank\"" : "") .' href="'. get_post_meta($post->ID,"_as_demourl",true)  .'">' . (get_gambling_option("replace-head-open")!="" ? get_gambling_option("replace-head-open") : "Open") .'</a>' : 'No') .'</span> <br />
			</td>
          <td class="blue hideme">'. get_post_meta($post->ID,"_as_bonustext",true)  .'</td>
          <td class="hideme">'. (get_post_meta($post->ID,"_as_usonly",true)!="" ? '<img src="'. get_bloginfo('stylesheet_directory') .'/images/usa_flg.png" alt="USA Allowed" width="15" height="15" />' : '') .'</td>
          <td align="center" class="bright"><a '. (get_theme_option('redirect-new-window')!="" ? "target=\"_blank\"" : "") .' href="'. get_bloginfo('url') .'/visit/'. get_post_meta($post->ID,"_as_redirectkey",true)  .'" class="visit">' . (get_gambling_option("replace-head-vbroker")!="" ? get_gambling_option("replace-head-vbroker") : "Visit Broker") .'</a>

<a href="' . get_permalink() . '">' . (get_gambling_option("replace-head-reviewread")!="" ? get_gambling_option("replace-head-reviewread") : "Read Review") .'</a></td>
        </tr>


';

endforeach;
$post = $opost;

 $ret .='</table>';
 
}//End of Version 4



if ($version==5){

$ret = '<div class="slots-full-title">
			<div class="slots-icon-wrap">
				<div class="title-icon"></div></div>
			<div class="slots-presentation-title"><h2>'.$atts['title'].'</h2></div>
			</div>' ;
$ret .= '
 <table cellpadding="3" cellspacing="0" width="100%" class="comptable" align="center">
        
    <tr>
          <th width="27%" height="28" class="bleft">' . (get_gambling_option("replace-head-site")!="" ? get_gambling_option("replace-head-site") : "Broker") .'</th>
		     <th width="25%">' . (get_gambling_option("replace-head-bonus")!="" ? get_gambling_option("replace-head-bonus") : "Bonus") .'</th>
          
		      <th width="14%" class="hideme">' . (get_gambling_option("replace-head-rate")!="" ? get_gambling_option("replace-head-rate") : "Rating") .'</th>
          
          <th width="15%" class="hideme">' . (get_gambling_option("replace-head-review1")!="" ? get_gambling_option("replace-head-review1") : "Review") .'</th>

          <th width="19%" class="bright">' . (get_gambling_option("replace-head-visit")!="" ? get_gambling_option("replace-head-visit") : "Open Account") .'</th>
        </tr>

';
global $post;
$opost = $post;
foreach ($posts as $post) :
	setup_postdata($post); 
$x=$x+1;
$ret .= '


<tr>
          <td><a href="' . get_permalink() . '"><img width="100" src="'. get_post_meta($post->ID,"_as_roomlogo",true)  .'" alt="' . get_post_meta($post->ID,"_as_roomname",true) . '" /></a></td>
          <td class="blue blueh">'. get_post_meta($post->ID,"_as_bonustext",true)  .'</td>
                        <td class="hideme">'. get_post_meta($post->ID,"_as_rating",true)  .'</td>
  
  <td class="hideme"><a href="' . get_permalink() . '">' . (get_gambling_option("replace-head-review1")!="" ? get_gambling_option("replace-head-review1") : "Review") .'</a></td>
          <td align="center" class="bright"><a target=\"_blank\ href="'. get_bloginfo('url') .'/visit/'. get_post_meta($post->ID,"_as_redirectkey",true)  .'" class="visit">' . (get_gambling_option("replace-head-vbroker")!="" ? get_gambling_option("replace-head-vbroker") : "Visit Broker") .'</a></td>
 </tr>

';

endforeach;
$post = $opost;

 $ret .='</table>';
 
}//End of Version 5

//***********SINTO ADDED-30-10 START
if ($version==8){


$ret = '
 <table cellpadding="3" cellspacing="0" width="100%" class="comptable" align="center">
        
    <tr>
          <th width="20%" height="28" class="bleft">' . (get_gambling_option("replace-head-site")!="" ? get_gambling_option("replace-head-site") : "Broker") .'</th>
		     <th width="17%">' . (get_gambling_option("replace-head-minacc")!="" ? get_gambling_option("replace-head-minacc") : "Min Account Size") .'</th>
          <th width="12%" class="hideme">' . (get_gambling_option("replace-head-lev")!="" ? get_gambling_option("replace-head-lev") : "Leverage") .'</th>
		      <th width="11%" class="hideme">' . (get_gambling_option("replace-head-spread")!="" ? get_gambling_option("replace-head-spread") : "Spread") .'</th>
          <th width="11%" class="hideme">' . (get_gambling_option("replace-head-usa")!="" ? get_gambling_option("replace-head-usa") : "US Traders") .'</th>
          <th width="10%" class="hideme">' . (get_gambling_option("replace-head-review1")!="" ? get_gambling_option("replace-head-review1") : "Review") .'</th>

          <th width="19%" class="bright">' . (get_gambling_option("replace-head-visit")!="" ? get_gambling_option("replace-head-visit") : "Open Account") .'</th>
        </tr>

';
global $post;
$opost = $post;
foreach ($posts as $post) :
	setup_postdata($post); 
$x=$x+1;
$ret .= '


<tr>
          <td><a href="' . get_permalink() . '"><img width="100" src="'. get_post_meta($post->ID,"_as_roomlogo",true)  .'" alt="' . get_post_meta($post->ID,"_as_roomname",true) . '" /></a></td>
          <td class="blue blueh">'. get_post_meta($post->ID,"_as_minaccountsize",true)  .'</td>
          <td class="blue hideme">'. get_post_meta($post->ID,"_as_leverage",true)  .'</td>
                   <td class="hideme">'. get_post_meta($post->ID,"_as_spread",true)  .'</td>
          <td class="hideme">

'. (get_post_meta($post->ID,"_as_usonly",true)!="" ? '<img src="'. get_bloginfo('stylesheet_directory') .'/images/usa_flg.png" alt="USA Allowed" width="15" height="15" />' : '') .' 

</td>
  <td class="hideme"><a href="' . get_permalink() . '">' . (get_gambling_option("replace-head-review1")!="" ? get_gambling_option("replace-head-review1") : "Review") .'</a></td>
          <td align="center" class="bright"><a '. (get_theme_option('redirect-new-window')!="" ? "target=\"_blank\"" : "") .' href="'. get_bloginfo('url') .'/visit/'. get_post_meta($post->ID,"_as_redirectkey",true)  .'" class="visit">' . (get_gambling_option("replace-head-vbroker")!="" ? get_gambling_option("replace-head-vbroker") : "Visit Broker") .'</a>



<a '. (get_theme_option('redirect-new-window')!="" ? "target=\"_blank\"" : "") .' href="'. get_post_meta($post->ID,"_as_demourl",true)  .'" class="demo">' . (get_gambling_option("replace-head-vdemo")!="" ? get_gambling_option("replace-head-vdemo") : "Demo") .'</a>


</td>
 </tr>

';

endforeach;
$post = $opost;

 $ret .='</table>';
 
}//End of Version 8
//***********SINTO ENDED-30-10


 return $ret;
}
}

add_shortcode('bonustable', 'bonustable_func');



if (!function_exists('featured_func')) {
   
  function featured_func($atts,$featcontent) {

          extract(shortcode_atts(array(
		'site' => '',
		'feattitle' => 'Featured Site',
		'tag' => ''
	), $atts));

	
	$loop = new WP_Query( array( 'post_type' => 'casino', 'posts_per_page' => -1 ) ); 
	$posts = array();
	$all = array();
	foreach ($loop->posts as $p) {			
		if (get_post_meta($p->ID, '_as_roomname', true) == $site && $site!="")
			$posts[] = $p;
			
		$all[] = $p;
	}
	
	if (count($posts)==0) $posts = $all;	
	shuffle($posts);
	
	$p = $posts[0];

$junk=$feattitle;
	
ob_start();
$ret = apply_filters('featured', array($p));
if (is_array($ret) || $ret =="" || $ret == " ") {
	$ret = ob_get_contents();
}
ob_end_clean();

if (!is_array($ret) && $ret !="") {
} else {
  
 
$ret= '
<h2>'. $feattitle .'</h2>
<div class="featured">
     <div class="left"> <a href="' . get_permalink($p->ID) . '"><img src="'.get_post_meta($p->ID, "_as_roomlogo",true).'" alt="'.get_post_meta($p->ID, "_as_roomname",true).'" width="120" /></a>

          <p>'. $featcontent .'</p>
    </div><!--End of left-->
    <div class="right">
      <ul> ';
			
     $features=get_post_meta($p->ID, '_as_features', true); 
      $feat = explode("|", $features);
      for($i = 0; $i < count($feat); $i++){ 
        $ret .= '<li>'. $feat[$i] .'</li>';
           } 
      $ret .=	 '</ul>

      <a '. (get_theme_option('redirect-new-window')!="" ? "target=\"_blank\"" : "") .' href="'. get_bloginfo('url') .'/visit/'. get_post_meta($p->ID,"_as_redirectkey",true)  .'" class="visit">

' . (get_gambling_option("featured-visitchange")!="" ? get_gambling_option("featured-visitchange") : "Visit Broker") .'
</a> 
    </div><!--End of Right-->
</div><!--End of Featured-->

';
}

return $ret;
}
add_shortcode('featured', 'featured_func');

   
}

function excerptlist_func($atts) {
	extract(shortcode_atts(array(
		'titleonly' => 'n',
		'cat' => '',
		'num' => 5,
	), $atts));
	
	$args = array('posts_per_page' => $num);
	$id = get_cat_id($cat);
	$args['cat'] = $id;
	
	$loop = new WP_Query( $args ); 
	global $post;
	$opost = $post;
	ob_start();  ?>
<div class="excerptlist"> 
<?php foreach ($loop->posts as $post) {
		setup_postdata($post);

		?>
  <div class="articleexcerpt">
      
   <?php if (strtolower($titleonly)!="y") { ?>


<?php if ( has_post_thumbnail() ) { ?>
	<a href="<?php the_permalink(); ?>">      
        <?php the_post_thumbnail(array(150,100)); ?>
        </a>
 <?php } else if (get_theme_option('art-thumb')) { ?>
       <a href="<?php the_permalink(); ?>">      
        <img src="<?php echo get_theme_option('art-thumb'); ?>" alt="<?php the_title(); ?>" width="100" height="100" />
        </a>
 <?php } ?>


	<h3 class="title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

	 <div class="bylines2">
          <?php if (!get_theme_option('bylines-hide-date')) { the_time('F j, Y'); } 
   if (!get_theme_option('bylines-hide-author')) { ?> by <?php the_author_posts_link(); } ?> <?php if (!get_theme_option('bylines-hide-category')) { ?> posted in <?php the_category(', '); } ?> &bull;  <a href="<?php the_permalink(); ?>#comments">   <?php comments_number(); ?></a>  
   <br /><?php  edit_post_link(' (Edit)', '', ''); ?>

         </div> <!-- End of Bylines -->
				
         <?php the_excerpt();?>
		
 </div><!-- End of articleexcerpt  -->
 
		<?php } else { ?>

  <h3 class="title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

</div><!-- End of articleexcerpt  -->


<?php } } ?>

 <div class="more"> <?php if (get_gambling_option('ex-more')) { echo get_gambling_option('ex-more'); } else { ?>More<?php } ?> <?php the_category(', '); ?>  <?php if (get_gambling_option('ex-topics')) { echo get_gambling_option('ex-topics'); } else { ?>Topics<?php } ?></div>
 </div><!-- End of excerptlist  -->
 
    <?php 

    $content = ob_get_contents();
	ob_end_clean();
	
	$post = $opost;
	setup_postdata($post);
	
 
 return apply_filters('excerptlist_shortcode', $content);
}

add_shortcode('excerptlist', 'excerptlist_func');

?>