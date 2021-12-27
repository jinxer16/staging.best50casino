<?php 
function call_to_act_shortcode($atts){
	$atts = shortcode_atts( 
	array(
        'cta_text' => '',
        'cta_url' => '',
    ), $atts, 'cta' ) ;
	ob_start();
	?>
        <div class="w-100 mt-15p mb-15p text-center">
            <a rel="nofollow" target="_blank" href="<?php echo esc_html( $atts['cta_url'] ); ?>" class="mx-auto rounder-5 text-decoration-none btn btn-sm btn-yellow font-weight-bold text-dark">
                <?php echo esc_html( $atts['cta_text'] ); ?>
            </a>
        </div>
    <?php
	return ob_get_clean();
}
	
	add_shortcode('cta','call_to_act_shortcode');

function cta_premium_payment($atts){
    $atts = shortcode_atts(
        array(
            'cta_text' => '',
            'cta_url' => '',
        ), $atts, 'cta' ) ;
    ob_start();

    $countriISO = $GLOBALS['countryISO'];
    $localIso =  $GLOBALS['visitorsISO'];
    $payments = WordPressSettings::getPremiumPayments($countriISO);
    $pieces = explode(",", (string)$payments);
    $casino = get_post_meta($pieces[0],$countriISO.'transactions_custom_meta_main_casino',true);
    $image = get_post_meta($casino,'casino_custom_meta_sidebar_icon',true);
    $imagepayment = get_post_meta($pieces[0],'casino_custom_meta_sidebar_icon',true);
    $afflink = get_post_meta($casino,'casino_custom_meta_affiliate_link',true);
    $flagISO = $localIso != 'nl' ? $localIso : 'eu';
    $flaf = get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;'));
    ?>
    <div class="mt-10p w-sm-100 w-80 d-block mx-auto mb-10p" style="box-shadow: 0 6px 4px -4px black;">
        <div class="cta-banner w-100 cta-flip d-flex flex-wrap" style="background: linear-gradient(90deg, #00777a 0%, #00777a 35%, #343434 100%); min-height: 80px; padding-left: 5px;">
            <div class="col-lg-2  align-self-center col-sm-3 col-3 col-xl-2 col-md-3">
                <a href="<?php echo get_the_permalink($casino); ?>">
                    <img class="img-fluid"  src="<?= $image;?>" loading="lazy">
                </a>
            </div>

            <div class="col-lg-7 col-xl-7 col-md-6 col-sm-6 d-none d-sm-block pt-1 d-md-block d-lg-block d-xl-block align-self-center">
                <div class="text-white fontsm font-weight-bold text-center align-self-center">
                    <a class="text-white font-weight-bold d-flex flex-column text-decoration-none align-items-center" target="_blank" href="<?php echo $afflink; ?>" rel="nofollow">
                     <span> Choose <span class="font-weight-bold text-secondary"><?=get_the_title($pieces[0]);?></span>, the most popular payment method in <?=$flaf?></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-9 col-xl-3 col-md-3  align-self-center d-flex flex-column f-right">
                <div class="text-white fontsm font-weight-bold text-center align-self-center d-block d-md-none d-lg-none mb-1 mt-1 mt-xl-0 mt-lg-0 mt-md-0 d-xl-none">
                    <a class="text-white font-weight-bold d-flex flex-column text-decoration-none align-items-center" target="_blank" href="<?php echo $afflink; ?>" rel="nofollow">
                        <span> Choose <span class="font-weight-bold text-secondary"><?=get_the_title($pieces[0]);?></span>, the most popular payment method in <?=$flaf?></span>
                    </a>
                </div>
                    <a class="btn bumper btn-shake text-17 text-sm-13 d-block p-7p p-sm-5p w-100 w-sm-60 mb-1 bg-secondary mx-auto text-dark btn_large text-decoration-none font-weight-bold"  rel="noopener nofollow" href="<?=$afflink;?>"  target="_blank"  data-casinoid="<?=$casino?>" data-country="<?=$countriISO?>">
                    <span><?=$atts['cta_text'];?></span>
                    </a>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('premium-payment','cta_premium_payment');

?>
