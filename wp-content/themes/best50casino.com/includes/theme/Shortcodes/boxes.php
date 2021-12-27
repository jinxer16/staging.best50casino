<?php
function shortcode_box( $atts, $content = null ) {
    @extract($atts);
    $align = $align ?? '';
    $class = $class ?? '';
    $width = $width ?? '';

    $type =  ($type)  ? ' '.$type  :' shadow' ;
    $align = ($align) ? ' '.$align : ' center';
    $class = ($class) ? ' '.$class : '';
    $width = ($width) ? ' '.'w-'.$width.'':' w-100 w-sm-100';

    if ($atts['type'] == 'note'){
        if ( strpos($_SERVER['REQUEST_URI'], '/?amp' ) !=false ) {
            $img = '<amp-img class="img-fluid float-left"
                     src="/wp-content/themes/best50casino.com/assets/images/info-box.png"  width=\'60\' height=\'60\'></amp-img>';
        }else{
            $img =  '<img class="img-fluid d-block mx-auto"
                     src="/wp-content/themes/best50casino.com/assets/images/info-box.png" loading="lazy">';
        }

    }
    if ( strpos($_SERVER['REQUEST_URI'], '/?amp' ) !=false ) {
        $out = '<div class="box'.$type.$class.$align.$width.' w-sm-100 rounded-5 pt-10p pr-5p pb-15p pl-5p" style="word-wrap: break-word;border: 1px solid #FFF;">
        
            <div class="box-inner-block d-flex flex-wrap w-100">
            <div class="w-100 boxy align-self-center">
            <span class="float-left text-left">
                 '.$img.'   
            	' .do_shortcode($content). '
            	</span>
            </div>
			</div>
			</div>';
    }else{
        if (wp_is_mobile()){
            $out = '<div class="box'.$type.$class.$align.$width.' w-sm-100 rounded-5 pt-10p pr-5p pb-15p pl-5p" style="word-wrap: break-word;border: 1px solid #FFF;">
        
            <div class="box-inner-block d-flex flex-wrap w-100">
            <div class="w-100 boxy align-self-center">
            <span class="float-left text-left">
                 '.$img.'   
            	' .do_shortcode($content). '
            	</span>
            </div>
			</div>
			</div>';
        }else{
            $out = '<div class="box'.$type.$class.$align.$width.' w-sm-100 rounded-5 pt-10p pr-10p pb-25p pl-10p" style="word-wrap: break-word;border: 1px solid #FFF;">
        
            <div class="box-inner-block d-flex flex-wrap w-100">
            <div class="w-10 d-block m-auto">
              '.$img.'
            </div>
            <div class="w-80 boxy align-self-center pt-15p">
            	' .do_shortcode($content). '
            </div>
			</div>
			</div>';
        }

    }

    return $out;
}
add_shortcode('box', 'shortcode_box');


function box_list($atts)
{
$atts = shortcode_atts(
    array(
        'first'=> false,
        'second' => false,
        'third' => false,
        'fourth' => false,
        'fifth' => false,
        'cta' => '',
        'id' => '',
    ), $atts, 'box-list');


ob_start();

$firstli = $atts['first'] ;
$secondli = $atts['second'] ;
$thirdli = $atts['third'] ;
$fourthli = $atts['fourth'] ;
$fifthli = $atts['fifth'] ;
$id = $atts['id'] ;
    $bookieid = get_post_meta($id, 'bonus_custom_meta_bookie_offer', true);
   $ctalink = get_post_meta($id, 'casino_custom_meta_affiliate_link_bonus', true);
    if ( strpos($_SERVER['REQUEST_URI'], '/?amp' ) !=false ) {

      ?>
        <div class="w-100 bg-gray-light d-flex flex-wrap p-5p mb-10p" style="border:1px solid black; border-radius: 15px;">
            <div class="w-100 p-5p d-flex flex-column">
                <ul class="list-typenone text-dark w-100 mx-auto p-0 position-relative">
                    <?php if ($firstli!=false){?>
                        <li class="font-weight-bold text-sm-13"><i class="fa fa-check mr-5p" style="color: #8cd221" aria-hidden="true"></i><?php echo $firstli; ?></li>
                        <?php
                    }
                    ?>
                    <?php if ($secondli!=false){?>
                        <li class="font-weight-bold text-sm-13"><i class="fa fa-check mr-5p" style="color: #8cd221" aria-hidden="true"></i><?php echo $secondli ;?></li>
                        <?php
                    }
                    ?>
                    <?php if ($thirdli!=false){?>
                        <li class="font-weight-bold text-sm-13"><i class="fa fa-check mr-5p" style="color: #8cd221" aria-hidden="true"></i><?php echo $thirdli; ?></li>
                        <?php
                    }
                    ?>
                    <?php if ($fourthli!=false){?>
                        <li class="font-weight-bold text-sm-13"><i class="fa fa-check mr-5p" style="color: #8cd221" aria-hidden="true"></i><?php echo $fourthli; ?></li>
                        <?php
                    }
                    ?>
                    <?php if ($fifthli!=false){?>
                        <li class="font-weight-bold text-sm-13"><i class="fa fa-check mr-5p" style="color: #8cd221" aria-hidden="true"></i><?php echo $fifthli; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="w-100 align-self-center">
                <amp-list  height="60" layout="fixed-height" credentials="include" src="/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $bookieid; ?>" binding="no">
                    <template type="amp-mustache">
                        <a class="bumper btn bg-yellow text-15 w-70 mr-10p text-center mt-5p mb-5p text-decoration-none d-block mx-auto p-7p btn_large text-black roundbutton font-weight-bold bumper" style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"  data-casinoid="<?php echo $id; ?>" data-country="{{0.ISO}}"  href="{{0.aff_bo}}" rel="nofollow" target="_blank">
                            <span> Get this Bonus <i class="fa fa-angle-right"></i></span>
                    </template>
                </amp-list>
            </div>

        </div>
        <?php
    }else{
        ?>

        <div class="w-100 bg-gray-light d-flex flex-wrap p-10p mb-10p" style="border:1px solid black; border-radius: 15px;">
            <div class="w-70 w-sm-100 p-10p d-flex flex-column">
                <ul class="list-typenone text-dark w-100 mx-auto p-0 position-relative">
                    <?php if ($firstli!=false){?>
                        <li class="font-weight-bold text-sm-13"><i class="fa fa-check mr-5p" style="color: #8cd221" aria-hidden="true"></i><?php echo $firstli; ?></li>
                        <?php
                    }
                    ?>
                    <?php if ($secondli!=false){?>
                        <li class="font-weight-bold text-sm-13"><i class="fa fa-check mr-5p" style="color: #8cd221" aria-hidden="true"></i><?php echo $secondli ;?></li>
                        <?php
                    }
                    ?>
                    <?php if ($thirdli!=false){?>
                        <li class="font-weight-bold text-sm-13"><i class="fa fa-check mr-5p" style="color: #8cd221" aria-hidden="true"></i><?php echo $thirdli; ?></li>
                        <?php
                    }
                    ?>
                    <?php if ($fourthli!=false){?>
                        <li class="font-weight-bold text-sm-13"><i class="fa fa-check mr-5p" style="color: #8cd221" aria-hidden="true"></i><?php echo $fourthli; ?></li>
                        <?php
                    }
                    ?>
                    <?php if ($fifthli!=false){?>
                        <li class="font-weight-bold text-sm-13"><i class="fa fa-check mr-5p" style="color: #8cd221" aria-hidden="true"></i><?php echo $fifthli; ?></li>
                        <?php
                    }
                    ?>
                </ul>

            </div>
            <?php $restricted =  @array_flip(get_post_meta($bookieid, 'casino_custom_meta_rest_countries', true));
            if(isset($restricted[$GLOBALS['visitorsISO']])){
                $btnClass='disabled';
            }else{
                $btnClass='';
            }?>
            <div class="w-30 w-sm-100 align-self-center">
                <a class="btn bg-yellow text-17 w-70 d-block p-7p text-decoration-none mx-xl-0 mx-auto mx-lg-0 mx-md-0 btn_large text-dark roundbutton font-weight-bold bumper" <?=$btnClass?>
                   style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);" href="<?=$ctalink?>"   rel="nofollow" target="_blank">
                    <span><?=$atts['cta']?> <i class="fa fa-angle-right"></i></span>
                </a>
            </div>

        </div>
        <?php
    }
?>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode('box-list','box_list');



function tie_color_box( $atts, $content = null ) {
    @extract($atts);
    $align = $align ?? '';
    $class = $class ?? '';
    $width = $width ?? '';
    $type =  ($type)  ? ' '.$type  :' info' ;
    $align = ($align) ? ' '.$align : ' center';
    $class = ($class) ? ' '.$class : ' ';
    $width = ($width) ? ' '.'w-'.$width.'':' w-100 w-sm-100';

    $out = '<div class="boxy'.$type.$class.$align.$width.' w-sm-100"><div class="boxy-inner-block">
			' .do_shortcode($content). '
			</div>
			</div>';
    return $out;
}

add_shortcode('color-box', 'tie_color_box');


function box_custom( $atts, $content = null ) {
    @extract($atts);
    $align = $align ?? '';
    $text = $text ?? '';
    $width = $width ?? '';

    $bgcolor =  ($bgcolor)  ? ' '.$bgcolor  :' #ffffff';
    $align = ($align) ? ' '.$align : ' center';
    $text = ($text) ? ' '.'text-'.$text.'':' text-dark';
    $width = ($width) ? ' '.'w-'.$width.'':' w-100 w-sm-100';

    $out = '<div class="custom-box'.$text.$align.$width.' w-sm-100 p-10p mb-15p mt-15p" style="background:'.$bgcolor.'">  
            <div class="box-inner-block w-100">
			' .do_shortcode($content). '
			</div>
			</div>';
    return $out;
}
add_shortcode('box-custom', 'box_custom');


function button_short_cta( $atts, $content = null ) {

    $atts = shortcode_atts(
        array(
            'align'=> '',
            'type' => '',
            'text' => '',
            'bgcolor' => '',
            'link' => '',
            'rel' => '',
            'casID' => '',

        ), $atts, 'button_short_cta');

    $countryISO = $GLOBALS['countryISO'];
    $bgcolor =  ($atts['bgcolor'])  ? ' '.$atts['bgcolor']  :' #ffffff';
    $type =  ($atts['type'])  ? ' '.$atts['type']  :'default';
    $align = ($atts['align']) ? ' '.$atts['align'] : ' center';
    $text = ($atts['text']) ? ' '.'text-'.$atts['text'].'':' text-white';
    $rel = ($atts['rel']) ? ' '.'rel="'.$atts['rel'].'"':'';
    $casinoID = ($atts['casID']) ? ' '.'data-casinoid="'.$atts['casID'].'"':'';

    $out='';

    if($atts['type'] === 'shine'){
        $out= '<div class="button-short-cta-wrapper'.$text.$align.$type.' w-sm-100  mb-10p mt-10p">  
            <a class="button-short-cta text-decoration-none bumper text-center roundbutton text-17 d-block p-7p btn_large font-weight-bold shiny-btn '.$text.'" href="'.$atts['link'].'" target="_blank" style="background:'.$bgcolor.'" '.$rel.' '.$casinoID.' data-country="'.$countryISO.'">
			<span>' .do_shortcode($content). '</span>
			<i></i>
			</a>
			</div>';
    }elseif($atts['type'] === 'glow'){
        $out= '<div class="button-short-cta-wrapper '.$text.$align.$type.' w-sm-100 text-center border-0 mb-10p mt-10p" style="background:'.$bgcolor.'">  
            <a class="button-short-cta font-weight-bold text-decoration-none '.$text.'" href="'.$atts['link'].'"  target="_blank"  '.$rel.' '.$casinoID.' data-country="'.$countryISO.'">
			<span>' .do_shortcode($content). '</span>
			</a>
			</div>';
    }elseif ($atts['type'] === 'borderanimation'){
        $out= '<div class="button-short-cta-wrapper '.$text.$align.$type.' w-sm-100  mb-10p mt-10p">  
            <a class="button-short-cta font-weight-bold  bumper" href="'.$atts['link'].'" target="_blank" style="background:'.$bgcolor.'" '.$rel.' '.$casinoID.' data-country="'.$countryISO.'">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
				<span>' .do_shortcode($content). '</span>
			</a>
			</div>';
    }else{
            $out= '<div class="button-short-cta-wrapper'.$text.$align.' default w-sm-100 mb-10p mt-10p">  
            <a class="button-short-cta btn bumper roundbutton text-17 d-block p-7p btn_large text-decoration-none font-weight-bold '.$text.'" href="'.$atts['link'].'" target="_blank" style="background:'.$bgcolor.'" '.$rel.' '.$casinoID.' data-country="'.$countryISO.'">
			<span>' .do_shortcode($content). '</span>
			</a>
			</div>';
    }
    return $out;
}
add_shortcode('button_short_cta', 'button_short_cta');


