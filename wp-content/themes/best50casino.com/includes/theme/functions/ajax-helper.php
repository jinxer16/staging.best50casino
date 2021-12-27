<?php
add_action('wp_ajax_nopriv_load_slots', 'load_slots');
add_action('wp_ajax_load_slots', 'load_slots');
function load_slots()
{
    $countryISO = $GLOBALS['countryISO'];
    $themeSettings = get_option('countries_enable_options');
    $isCountryEnabled = in_array($countryISO, $themeSettings['enabled_countries_iso'][0]) ? true : false;
    $localIso = $isCountryEnabled ? $countryISO : 'glb';
    $query_slot = array( // A QUERY that initializes the default (all) IDS
        'post_type' => array('kss_slots'),
        'post_status' => array('publish'),
        'no_found_rows' => true,
        'fields' => 'ids',
        'update_post_term_cache' => false,
        'posts_per_page' => 500,
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $cache_key = 'slot_all';
    if (false === ($query_slots = wp_cache_get($cache_key))) {
        $query_slots = get_posts($query_slot);
        wp_cache_set($cache_key, $query_slots, 'slot_all', DAY_IN_SECONDS);
    }
    $ret = "";
    foreach ($query_slots as $slotsID) {
        $score = get_post_meta($slotsID, 'slot_custom_meta_slot_value', true) / 20;
        $casinoID = get_post_meta($slotsID, 'slot_custom_meta_slot_main_casino', true);
        $rtp = get_post_meta($slotsID, 'slot_custom_meta_rtp_perc', true);
        $rtpFilter = (int)str_replace("%", "", $rtp) >= 95 ? 'bestRTP' : '';
        if (get_post_meta($slotsID, 'slot_custom_meta_label', true)) {
            $meta_label = implode(" ", get_post_meta($slotsID, 'slot_custom_meta_label', true));
        }
        $jackpot_option = get_post_meta($slotsID, 'slot_custom_meta_jackpot_option', true) ? 'Jackpot' : '';
        $vid_clas_option = get_post_meta($slotsID, 'slot_custom_meta_classic_video', true);
        $three_d_option = get_post_meta($slotsID, 'slot_custom_meta_3d_option', true) ? '3D' : '';
        if (get_post_meta($slotsID, 'slot_custom_meta_slot_theme', true)) {
            $theme = implode(" ", get_post_meta($slotsID, 'slot_custom_meta_slot_theme', true));
        }
        $ret .= '<div class="element-item m-2p ' . $meta_label . ' ' . $rtpFilter . ' ' . str_replace(" ", "-", get_the_title(get_post_meta($slotsID, 'slot_custom_meta_slot_software', true))) . ' ' . $jackpot_option . ' ' . $vid_clas_option . ' ' . $three_d_option . ' ' . $theme . '" data-filter="' . str_replace(" ", "-", get_the_title(get_post_meta($slotsID, 'slot_custom_meta_slot_software', true))) . ' ' . $meta_label . ' ' . $rtpFilter . ' ' . $jackpot_option . ' ' . $vid_clas_option . ' ' . $three_d_option . ' ' . $theme . '" data-category="transition">';
        $ret .= '        		<section class="containerz">';
        $ret .= '					<div class="card">';
        $ret .= '						<div class="front">';
        $ret .= '			<a href="' . get_the_permalink($slotsID) . '">';
        $ret .= '				<figure class="m-0">';
        $ret .= '								<img  src="' . get_the_post_thumbnail_url($slotsID) . '" loading="lazy" alt="' . get_the_title($slotsID) . '">';
        if (get_post_meta($slotsID, 'slot_custom_meta_label', true)) {
            if (in_array('LEGEND', get_post_meta($slotsID, 'slot_custom_meta_label', true))) {
                $ret .= '						<div class="ribbon hot"><span>Legend</span></div>';
            } elseif (in_array('BEST', get_post_meta($slotsID, 'slot_custom_meta_label', true))) {
                $ret .= '						<div class="ribbon premium"><span>Best</span></div>';
            } elseif (in_array('NEW', get_post_meta($slotsID, 'slot_custom_meta_label', true))) {
                $ret .= '						<div class="ribbon new"><span>New</span></div>';
            }
        }
        $page = get_post_meta($slotsID, 'slot_custom_meta_slot_software', true);
        // $imge_id = get_image_id_by_link(get_post_meta($page->ID, 'casino_custom_meta_sidebar_icon', true));
        $imge_url = get_post_meta($page, 'casino_custom_meta_sidebar_icon', true);
        // $ret .= '				<span class="software">'. wp_get_attachment_image($imge_id, 'sidebar-medium', "", array("alt"=>get_the_title($page->ID))).'</span>';
        $ret .= '				<span class="software"><img src="' . $imge_url . '" loading="lazy" class="attachment-sidebar-medium size-sidebar-medium" width="30" height="30" alt="' . get_the_title($page) . '"></span>';
        //$ret .= '					<span class="software">'.get_the_post_thumbnail($page->ID, 'sidebar-medium').'</span>';
        $ret .= '				</figure>';
        $ret .= '				<span class="name">' . get_the_title($slotsID) . '</span>';
        $ret .= '							<span class="rating">';
        $ret .= '								<span class="star-rating">' . $score . '</span>';
        $ret .= '							</span>';
        $ret .= '							</a>';
        $ret .= '						</div>';
        $ret .= '						<div class="back">';
        $ret .= '							<table>';
        $ret .= '										<tr>';
        $ret .= '											<td>Wheels:</td><td>' . get_post_meta($slotsID, 'slot_custom_meta_slot_wheels', true) . '</td>';
        $ret .= '										</tr>';
        $ret .= '										<tr>';
        $ret .= '											<td>Slot Type:</td><td class="d-flex">';
        if ('Video' == get_post_meta($slotsID, 'slot_custom_meta_classic_video', true)) {
            $ret .= '												<span class="icon-video-camera lazy-background tooltip-span" data-toggle="tooltip" title="Video"></span>';
        } else {
            $ret .= '												<span class="icon-slots lazy-background tooltip-span" data-toggle="tooltip" title="Classic"></span>';
        };
        if (get_post_meta($slotsID, 'slot_custom_meta_jackpot_option', true)) {
            $ret .= '														, <span class="icon-jackpot lazy-background tooltip-span" data-toggle="tooltip" title="Jackpot"></span>';
        } else {
            $ret .= '';
        };
        if (get_post_meta($slotsID, 'slot_custom_meta_3d_option', true)) {
            $ret .= '														, <span class="icon-3d_rotation  tooltip-span" data-toggle="tooltip" title="3D Slot"></span>';
        } else {
            $ret .= '';
        };
        $ret .= '													</td>';
        $ret .= '										</tr>';
        $ret .= '										<tr>';
        $ret .= '											<td>Paylines:</td><td>' . get_post_meta($slotsID, 'slot_custom_meta_slot_paylines', true) . '</td>';
        $ret .= '										</tr>';
        $ret .= '										<tr>';
        $ret .= '											<td>RTP:</td><td>' . $rtp . '</td>';
        $ret .= '										</tr>';
        $ret .= '										<tr>';
        $ret .= '											<td>Free Spins:</td><td>';
        if (get_post_meta($slotsID, 'slot_custom_meta_free_spins_option', true)) {
            $ret .= '														Yes';
        } else {
            $ret .= '														No';
        };
        $ret .= '										</td></tr>';
        $ret .= '										<tr>';
        $ret .= '											<td>Bonus Rounds:</td><td>';
        if (get_post_meta($slotsID, 'slot_custom_meta_bonus_rounds_option', true)) {
            $ret .= 'Yes';
        } else {
            $ret .= 'No';
        };
        $ret .= '										</td></tr>';
        $ret .= '									</table>';
        $ret .= '									<a href="' . get_post_meta($casinoID, 'casino_custom_meta_affiliate_link', true) . '" rel="nofollow" class="btn btn_tiny text-decoration-none btn_yellow d-block cta play_button bumper font-weight-bold" data-casinoid="' . $casinoID . '" data-country="' . $localIso . '">Play in Casino</a>';
        $ret .= '								</div>';
        $ret .= '							</div>';
        $ret .= '						</section>';
        $ret .= '						<span class="offer-info" onclick="flip()"><i class="fa fa-info"></i><i class="fa fa-times"></i></span>';
        $ret .= '			</div>';
    }
    echo $ret;
    wp_reset_postdata();
    die();
}


add_action('wp_ajax_nopriv_send_email', 'send_email');
add_action('wp_ajax_send_email', 'send_email');
function send_email()
{

    $userName = $_POST['userNickName'];
    $message = $_POST['message'];
    $userEmail = $_POST['userEmail'];
    $Typeof = $_POST['Typeof'];
    $subject = $_POST['subject'];

//    $userName = 'Panagiotis';

//    $subject = $subject';
    $headers[] = 'Content-type: text/html; charset=UTF-8';
    $headers[]   = 'Reply-To: '.$userName.' <'.$userEmail.'>';
    ob_start(); ?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
          xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <title><?=$subject?></title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
        <meta name="viewport" content="initial-scale=1.0">
    </head>
    <body>
        <div style="max-width:600px;font-family:Roboto,Arial,Helvetica,sans-serif;width:100%;">
           <p> About : <?=$Typeof?></p>
            <?= $message ?>
            <p>--</p>
            <p>This e-mail was sent from a contact form on Best Casino (http://www.best50casino.com)</p>
         </div>
    </body>
    </html>

    <?php $body = ob_get_clean();

    $mailSent = wp_mail('info@best50casino.com',"Best Casino ('".$subject."')", $body, $headers);
    echo $mailSent ? "Mail sent to info@best50casino.com" : "Mail failed to go to info@best50casino.com" ;
    die();
}

add_action('wp_ajax_nopriv_compared_casinos', 'compared_casinos');
add_action('wp_ajax_compared_casinos', 'compared_casinos');
function compared_casinos()
{
    $firstid = $_GET['firstcasino'];
    $secondid = $_GET['secondcasino'];

    $countryISO = $GLOBALS['countryISO'];
    $localIso =  $GLOBALS['visitorsISO']; //Αν η χωρα ειναι ενεργοποιημενη
    ob_start(); ?>

    <div class="col-6">
        <img class="img-fluid d-block mx-auto" src="<?= get_the_post_thumbnail_url($firstid)?>" style="max-width: 200px; max-height: 140px;">
        <p class="text-center text-14 text-muted mb-2p mt-2p">Founded <?php echo get_post_meta($firstid, 'casino_custom_meta_com_estab', true); ?></p>

    </div>
    <div class="col-6">
        <img class="img-fluid d-block mx-auto" src="<?= get_the_post_thumbnail_url($secondid)?>" style="max-width: 200px; max-height: 140px;">
        <p class="text-center text-muted text-14 mb-2p mt-2p">Founded <?php echo get_post_meta($secondid, 'casino_custom_meta_com_estab', true); ?></p>
    </div>

    <div class="d-flex flex-wrap col-12">
        <div class="col-12 d-flex  justify-content-center pt-5p">
            <p class="font-weight-bold text-18 mb-0">Fairness</p>
        </div>

        <div class="col-6 d-flex flex-column">
            <?php $value = get_post_meta($firstid, 'casino_custom_meta_license_rating', true);?>
            <?php $value = $value ? $value : 0?>
            <?php $wit_rat = $value * 10; ?>
            <span class="font-weight-bold float-left d-block text-17"><?=$value?></span>
            <div class="progress rounded">
                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="<?php echo $wit_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
        </div>
        <div class="col-6 d-flex flex-column">
            <?php $value = get_post_meta($secondid, 'casino_custom_meta_license_rating', true);?>
            <?php $value = $value ? $value : 0?>
            <span class="font-weight-bold float-right d-block text-17 text-right"><?=$value?></span>
            <div class="progress d-block rounded">
                <div class="progress-bar bg-blue d-block float-right" role="progressbar" aria-valuenow="<?php echo $wit_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
        </div>

        <div class="col-12 d-flex  justify-content-center pt-5p">
            <p class="font-weight-bold text-18 pb-0 mb-0 ">Payout Speed</p>
        </div>
        <small class="col-12 text-center">Withdrawal options</small>
        <div class="col-6 d-flex flex-column">
            <?php $value = get_post_meta($firstid, 'casino_custom_meta_withdrawal_rating', true);?>
            <?php $value = $value ? $value : 0?>
            <?php $wit_rat = $value * 10; ?>
            <span class="font-weight-bold float-left d-block text-17"><?=$value?></span>
            <div class="progress rounded">
                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="<?php echo $wit_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            <div class="d-block float-left">
            <?php
            $availableMeans = get_post_meta($firstid, 'casino_custom_meta_withd_options', true);

            if (is_array($availableMeans)){
                $paymentOrder['ids'] == !empty( $paymentOrder['ids']) ?  $paymentOrder['ids'] : WordPressSettings::getPremiumPayments('glb');
                $order = explode(",", $paymentOrder['ids']);
                $res = array_intersect($order, $availableMeans);
                $correctOrder = array_unique(array_merge($res, $availableMeans));

                $ret2 = '<ul class="inline-list cards-list column-icons pl-0 mb-0">';
                $depArray = get_post_meta($firstid, 'casino_custom_meta_withd_options', true);
                $depArrayFirst = array_slice($correctOrder, 0, 3);
                $depArrayRest = array_slice($correctOrder, 3);
                $offset = count($depArrayRest);
                $tooltipRet = '';
                foreach ($depArrayRest as $rest){
                    $tooltipRet .= get_the_title($rest).', ';
                }
                $tooltipRet = substr($tooltipRet, 0, -1);
                foreach ($depArrayFirst as $option) {

//                $page = get_page_by_title($option, OBJECT, 'kss_transactions');
                    $image_id = getImageId(get_post_meta($option, 'casino_custom_meta_sidebar_icon', true));
                    $image = wp_get_attachment_image_src($image_id, 'sidebar-small', true);
                    $ret2 .= '<li><img class="img-fluid"  src="' . $image[0] . '" width="30" height="30"
                                 alt="' . get_the_title($option) . '" data-toggle="tooltip"
                                 title="' . ucwords(get_the_title($option)) . '"/></li>';
                }
                if ($tooltipRet) {
                    $ret2 .= '<li class="plus" data-toggle="tooltip"
                                 title="' . $tooltipRet . '"> +' . $offset . '</li>';
                }
                $ret2 .= '</ul>';
                echo $ret2;
            }
            ?>

        </div>
        </div>
        <div class="col-6 d-flex flex-column">
            <?php $value = get_post_meta($secondid, 'casino_custom_meta_withdrawal_rating', true);?>
            <?php $value = $value ? $value : 0?>
            <?php $wit_rat = $value * 10; ?>
            <span class="font-weight-bold float-right d-block text-17 text-right"><?=$value?></span>
            <div class="progress d-block rounded">
                <div class="progress-bar bg-blue d-block float-right" role="progressbar" aria-valuenow="<?php echo $wit_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            <div class="d-block  text-right">
                <?php
                $availableMeans = get_post_meta($secondid, 'casino_custom_meta_withd_options', true);

                if (is_array($availableMeans)){
                    $paymentOrder['ids'] == !empty( $paymentOrder['ids']) ?  $paymentOrder['ids'] : WordPressSettings::getPremiumPayments('glb');
                    $order = explode(",", $paymentOrder['ids']);
                    $res = array_intersect($order, $availableMeans);
                    $correctOrder = array_unique(array_merge($res, $availableMeans));

                    $ret2 = '<ul class="inline-list cards-list column-icons pl-0 mb-0">';
                    $depArray = get_post_meta($secondid, 'casino_custom_meta_withd_options', true);
                    $depArrayFirst = array_slice($correctOrder, 0, 3);
                    $depArrayRest = array_slice($correctOrder, 3);
                    $offset = count($depArrayRest);
                    $tooltipRet = '';
                    foreach ($depArrayRest as $rest){
                        $tooltipRet .= get_the_title($rest).', ';
                    }
                    $tooltipRet = substr($tooltipRet, 0, -1);
                    foreach ($depArrayFirst as $option) {

//                $page = get_page_by_title($option, OBJECT, 'kss_transactions');
                        $image_id = getImageId(get_post_meta($option, 'casino_custom_meta_sidebar_icon', true));
                        $image = wp_get_attachment_image_src($image_id, 'sidebar-small', true);
                        $ret2 .= '<li><img class="img-fluid"  src="' . $image[0] . '" width="30" height="30"
                                 alt="' . get_the_title($option) . '" data-toggle="tooltip"
                                 title="' . ucwords(get_the_title($option)) . '"/></li>';
                    }
                    if ($tooltipRet) {
                        $ret2 .= '<li class="plus" data-toggle="tooltip"
                                 title="' . $tooltipRet . '"> +' . $offset . '</li>';
                    }
                    $ret2 .= '</ul>';
                    echo $ret2;
                }
                ?>

            </div>
        </div>
        <div class="col-12 d-flex  justify-content-center pt-5p">
            <p class="font-weight-bold text-18 mb-0">Bonuses</p>
        </div>
        <div class="col-6 d-flex flex-column">
            <?php $value = get_post_meta($firstid, 'casino_custom_meta_offers_rating', true);?>
            <?php $value = $value ? $value : 0?>
            <?php $wit_rat = $value * 10; ?>
            <span class="font-weight-bold float-left d-block text-17"><?=$value?></span>
            <div class="progress rounded">
                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="<?php echo $wit_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            <div class="d-block">
                <?php
                $casinoBonusPage = get_post_meta($firstid, 'casino_custom_meta_bonus_page', true);
                $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
                $bonusISO = get_bonus_iso($casinoBonusPage);
                echo get_post_meta($bonusName, $bonusISO . "bs_custom_meta_cta_for_top", true);
                ?>
            </div>
        </div>
        <div class="col-6 d-flex flex-column">
            <?php $value = get_post_meta($secondid, 'casino_custom_meta_offers_rating', true);?>
            <?php $value = $value ? $value : 0?>
            <?php $wit_rat = $value * 10; ?>
            <span class="font-weight-bold float-right d-block text-17 text-right"><?=$value?></span>
            <div class="progress d-block rounded">
                <div class="progress-bar bg-blue d-block float-right" role="progressbar" aria-valuenow="<?php echo $wit_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            <div class="d-block text-right">
                <?php
                $casinoBonusPage = get_post_meta($secondid, 'casino_custom_meta_bonus_page', true);
                $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
                $bonusISO = get_bonus_iso($casinoBonusPage);
                echo get_post_meta($bonusName, $bonusISO . "bs_custom_meta_cta_for_top", true);
                ?>
            </div>
        </div>
        <div class="col-12 d-flex  justify-content-center pt-5p">
            <p class="font-weight-bold text-18 mb-0">Software</p>
        </div>
        <div class="col-6 d-flex flex-column">
            <?php $value = get_post_meta($firstid, 'casino_custom_meta_site_rating', true);?>
            <?php $value = $value ? $value : 0?>
            <?php $wit_rat = $value * 10; ?>
            <span class="font-weight-bold float-left d-block text-17"><?=$value?></span>
            <div class="progress rounded">
                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="<?php echo $wit_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            <div class="d-block">
                <?php
                $preferedOrder = array("Novomatic", "Netent", "EGT", "Playtech", "Microgaming", "Evolution Gaming", "ΝΥΧ Gaming", "Play\'n Go", "IGΤ", "Betsoft", "iSoftbet", "Aristocrat");
                $availableMeans = get_post_meta($firstid, 'casino_custom_meta_softwares', true);
                if (is_array($availableMeans)){
                $res = array_intersect($preferedOrder, $availableMeans);
                //
                $rest = array_diff($availableMeans,$res);
                $correctOrder = array_merge($res, $rest);
                //
                //            $correctOrder = array_unique(array_merge($res, $availableMeans));
                $j = 0;
                $ret2 = '<ul class="inline-list cards-list column-icons pl-0 mb-0">';
                    $depArrayFirst = array_slice($correctOrder, 0, 3);
                    $depArrayRest = array_slice($correctOrder, 3);
                    $offset = count($depArrayRest);
                    $tooltipRet = '';
                    foreach ($depArrayRest as $rest){
                    $tooltipRet .= get_the_title($rest).', ';
                    }
                    $tooltipRet = substr($tooltipRet, 0, -1);
                    foreach ($depArrayFirst as $option) {
                    $j += 1;
                    //                $page = get_page_by_title($option, OBJECT, 'kss_softwares');
                    $image_id = getImageId(get_post_meta($option, 'casino_custom_meta_sidebar_icon', true));
                    $image = wp_get_attachment_image_src($image_id, 'sidebar-small', true);
                    $ret2 .= '<li><img class="img-fluid" src="' . $image[0] . '" loading="lazy" width="30" height="30"
                                       alt="' . get_the_title($option) . '" data-toggle="tooltip"
                                       title="' . ucwords(get_the_title($option)) . '"/></li>';
                    }
                    if ($tooltipRet) {
                    $ret2 .= '<li class="plus" data-toggle="tooltip"
                                  title="' . $tooltipRet . '"> +' . $offset . '</li>';
                    }
                    $ret2 .= '</ul>';
                }
                echo $ret2;
                ?>
            </div>
        </div>
        <div class="col-6 d-flex flex-column">
            <?php $value = get_post_meta($secondid, 'casino_custom_meta_site_rating', true);?>
            <?php $value = $value ? $value : 0?>
            <?php $wit_rat = $value * 10; ?>
            <span class="font-weight-bold float-right d-block text-17 text-right"><?=$value?></span>
            <div class="progress d-block rounded">
                <div class="progress-bar bg-blue d-block float-right" role="progressbar" aria-valuenow="<?php echo $wit_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            <div class="d-block text-right">
                <?php
                $preferedOrder = array("Novomatic", "Netent", "EGT", "Playtech", "Microgaming", "Evolution Gaming", "ΝΥΧ Gaming", "Play\'n Go", "IGΤ", "Betsoft", "iSoftbet", "Aristocrat");
                $availableMeans = get_post_meta($secondid, 'casino_custom_meta_softwares', true);
                if (is_array($availableMeans)){
                    $res = array_intersect($preferedOrder, $availableMeans);
                    //
                    $rest = array_diff($availableMeans,$res);
                    $correctOrder = array_merge($res, $rest);
                    //
                    //            $correctOrder = array_unique(array_merge($res, $availableMeans));
                    $j = 0;
                    $ret2 = '<ul class="inline-list cards-list column-icons pl-0 mb-0">';
                    $depArrayFirst = array_slice($correctOrder, 0, 3);
                    $depArrayRest = array_slice($correctOrder, 3);
                    $offset = count($depArrayRest);
                    $tooltipRet = '';
                    foreach ($depArrayRest as $rest){
                        $tooltipRet .= get_the_title($rest).', ';
                    }
                    $tooltipRet = substr($tooltipRet, 0, -1);
                    foreach ($depArrayFirst as $option) {
                        $j += 1;
                        //                $page = get_page_by_title($option, OBJECT, 'kss_softwares');
                        $image_id = getImageId(get_post_meta($option, 'casino_custom_meta_sidebar_icon', true));
                        $image = wp_get_attachment_image_src($image_id, 'sidebar-small', true);
                        $ret2 .= '<li><img class="img-fluid" src="' . $image[0] . '" loading="lazy" width="30" height="30"
                                       alt="' . get_the_title($option) . '" data-toggle="tooltip"
                                       title="' . ucwords(get_the_title($option)) . '"/></li>';
                    }
                    if ($tooltipRet) {
                        $ret2 .= '<li class="plus" data-toggle="tooltip"
                                  title="' . $tooltipRet . '"> +' . $offset . '</li>';
                    }
                    $ret2 .= '</ul>';
                }
                echo $ret2;
                ?>
            </div>
        </div>
        <div class="col-12 d-flex  justify-content-center pt-5p">
            <p class="font-weight-bold text-18 mb-0">B50 Quality</p>
        </div>
        <div class="col-6 d-flex flex-column">
            <?php $value = get_post_meta($firstid, 'casino_custom_meta_games_rating', true);?>
            <?php $value = $value ? $value : 0?>
            <?php $wit_rat = $value * 10; ?>
            <span class="font-weight-bold float-left d-block text-17"><?=$value?></span>
            <div class="progress rounded">
                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="<?php echo $wit_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
        </div>
        <div class="col-6 d-flex flex-column">
            <?php $value = get_post_meta($secondid, 'casino_custom_meta_games_rating', true);?>
            <?php $value = $value ? $value : 0?>
            <?php $wit_rat = $value * 10; ?>
            <span class="font-weight-bold float-right d-block text-17 text-right"><?=$value?></span>
            <div class="progress d-block rounded">
                <div class="progress-bar bg-blue d-block float-right" role="progressbar" aria-valuenow="<?php echo $wit_rat; ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
        </div>

        <div class="col-6 text-center">
            <div class="bg-blue p-20p text-21 mx-auto text-white d-inline-block font-weight-bold rounded">
                <?php echo $value = get_post_meta($firstid, 'casino_custom_meta_sum_rating', true); ?>
            </div>
            <?php $ctaLink = get_post_meta($firstid, 'casino_custom_meta_affiliate_link_review', true);?>
            <div class="col-8 m-auto mt-10p mb-10p"><a class="btn bumper btn btn btn_yellow text-17 w-sm-100 d-block p-5p btn_large font-weight-bold bumper"  data-casinoid="<?php echo $firstid; ?>" data-country="<?php echo $countryISO; ?>" href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">Play Now</a></div>
            </div>
        
        <div class="col-6 text-center">
            <div class="bg-blue text-21 text-white p-20p mx-auto d-inline-block font-weight-bold rounded">
                <?php echo $value = get_post_meta($secondid, 'casino_custom_meta_sum_rating', true); ?>
            </div>
            <?php $ctaLink = get_post_meta($secondid, 'casino_custom_meta_affiliate_link_review', true);?>
            <div class="col-8 m-auto mt-10p mb-10p"><a class="btn bumper btn btn btn_yellow text-17 w-sm-100 d-block p-5p btn_large font-weight-bold bumper"  data-casinoid="<?php echo $secondid; ?>" data-country="<?php echo $countryISO; ?>" href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">Play Now</a></div>
        </div>

    </div>


    <?php
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
    die();
}


add_action('wp_ajax_filter_payments_shortcode', 'filter_payments_shortcode');
add_action('wp_ajax_nopriv_filter_payments_shortcode', 'filter_payments_shortcode');
function filter_payments_shortcode()
{
    $id = $_GET['idpayments'];
    $title = $_GET['title'];

    echo do_shortcode("[table layout=\"payments\" cat_in=\"48\" sort_by=\"premium\" 2nd_column_list=\"bonus\" cta=\"sign_up\" title=\"Top Casinos By Payments Methods\" 2nd_col_title=\"Bonus\" 3rd_col_title=\"Rating\" deposit=\"$id\"]");
    ?>

    <?php

    die();
}

add_action('wp_ajax_filter_providers_shortcode', 'filter_providers_shortcode');
add_action('wp_ajax_nopriv_filter_providers_shortcode', 'filter_providers_shortcode');
function filter_providers_shortcode()
{
    $id = $_GET['idproviders'];
    $title = $_GET['title'];
    if ( get_post_status ( $id ) == 'publish' ) {
        $limit = 10;
    }else{
        $limit = 40;
    }
    echo do_shortcode("[table layout=\"providers\" sort_by=\"premium\" 2nd_column_list=\"bonus\" limit=\"$limit\" cta=\"sign_up\" title=\"Top Casinos By Provider\" 2nd_col_title=\"Bonus\" 3rd_col_title=\"Rating\" software=\"$id\"]");

    die();
}



add_action('wp_ajax_filter_amp_comment_submit', 'amp_comment_submit');
add_action('wp_ajax_nopriv_amp_comment_submit', 'amp_comment_submit');
function amp_comment_submit()
{
    $casinoID = $post->ID;
    $userID = get_current_user_id();
    $user = get_user_meta( $userID, 'user_nicename' ,true ) ?? 'stranger';
    $name = isset($_POST['submitcomment']) ? $_POST['submitcomment'] : '' ;
    $output = [
        'submitcomment' => $name
    ];
    header("Content-type: application/json");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Origin: *.ampproject.org");
    header("AMP-Access-Control-Allow-Source-Origin: https://www.best50casino.com/");
    header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");
    $postarr = [
        'post_title'=>get_the_title($casinoID).'-'.$name,
        'post_type'=>'player_review',
        'post_author'=>$user,
        'post_status'=>'pending',
        'post_content'=>$comment];
    $postID = wp_insert_post( $postarr,  false );
    update_post_meta($postID,'_review_details_fields',['review_casino','review_hidden','validat','fox_answer']);
    update_post_meta($postID,'review_casino',$casinoID);

    $output_message = 'Thanks, Your review was submitted successfully.';
    $output = ['output_message' => $output_message];
    echo json_encode( $output );
    die();
}

add_action('wp_ajax_filter_guides_category', 'filter_guides_category');
add_action('wp_ajax_nopriv_filter_guides_category', 'filter_guides_category');
function filter_guides_category(){

$tax_id = $_POST['tax_id'];
if ($tax_id == 'all'){
    $query_args = array(
        'post_type' => array('kss_guides','page'),
        'post_status' => 'publish',
        'posts_per_page' => 999,
        'fields' => 'ids',
        'tax_query' => array(
            array(
                'taxonomy' => 'cat-guides',
                'operator' => 'EXISTS',
            )
        )
    );
}else{
    $query_args = array(
        'post_type' => array('kss_guides','page'),
        'post_status' => 'publish',
        'posts_per_page' => 999,
        'fields' => 'ids',
        'tax_query' => array(
            array(
                'taxonomy' => 'cat-guides',
                'field' => 'term_id',
                'terms' => $tax_id,
            )
        )
    );
}

$guides = get_posts($query_args);
foreach ($guides as $guide){
?>
    <div class="col-12 d-flex flex-row col-md-6 col-lg-4 col-xl-4 post-offer text-dark text-center d-flex text-15 pt-xl-2 pt-lg-2" style="background-color: #efefef;">
        <div class="post-offer-content overflow-hidden bg-white">
            <div class="thumbnail-image ">
                <img class="" src="<?php echo get_the_post_thumbnail_url($guide);?>">
            </div>
            <div class="entry-title bg-white p-10p d-flex align-items-center justify-content-center">
                <div class="offer-title">
                    <a class="align-self-center pl-1 pl-xl-0 text-decoration-none"  style="color: black;" id="title-blog" href="<?php echo get_the_permalink($guide); ?>">
                        <?php echo  wp_trim_words(get_the_title($guide), 6);?>
                    </a>
                </div>
                <div class="button d-inline-block">
                    <a class="d-block text-12 pt-5p pr-10p pb-5p pl-10p text-dark text-decoration-none w-70 m-0 position-absolute" href="<?php echo get_the_permalink($guide); ?>">
                        Read Guide </a> <!--<span class="fa fa-arrow-circle-right"></span>-->
                </div>
            </div>
        </div>
    </div>
<?php
}
wp_reset_postdata();
die();
}
add_action('wp_ajax_tabsShortcodes', 'tabsShortcodes');
add_action('wp_ajax_nopriv_tabsShortcodes', 'tabsShortcodes');
function tabsShortcodes(){

    $sorting = $_POST['sorting'];
    $sortorder = $_POST['SortOrder'];
    $ShortcodeAtts =  stripslashes ($_POST['shortcodeAtts']);

    $cleanData = json_decode( html_entity_decode( $ShortcodeAtts  ) );
    $array = (array)$cleanData;

    $string ='';

    foreach($array as $key => $value) {
        if($key=='tabs_id' || $key == 'sort_by' || $key == 'sortorder' || $key == 'contid')continue;
        if($key=='3rd_column' && $value=='year' && $sorting=='launch'){
            $value = 'launched';
        }
        $string .= ' '.$key.'="'.$value.'"';
    }
    
    echo do_shortcode("[table $string sortorder=\"$sortorder\" sort_by=\"$sorting\" extra_row=\"$sorting\" aj=\"1\"]");

  die();

}



add_action('wp_ajax_subscribe_contact', 'subscribe_contact');
add_action('wp_ajax_nopriv_subscribe_contact', 'subscribe_contact');
function subscribe_contact()
{
    $curl = curl_init();

    $iso = $GLOBALS['visitorsISO'];
    $mailinglistID = get_correct_mailing_list($GLOBALS['visitorsISO']);

    $emaildata = $_POST['email'];

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.sendinblue.com/v3/contacts",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"attributes\":{\"COUNTRY\":\"$iso\"},\"listIds\":[$mailinglistID],\"updateEnabled\":false,\"email\":\"$emaildata\"}",
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "api-key: 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",
            "content-type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    $someArray = json_decode($response, true);
    $text='';

    if ($someArray['message'] == 'Contact already exist'){

        $curl_two = curl_init();

        curl_setopt_array($curl_two, [
            CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/lists/$mailinglistID/contacts/add",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"attributes\":{\"COUNTRY\":\"$iso\"},\"email\":\"$emaildata\"}",
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "api-key: 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",
                "content-type: application/json"
            ],
        ]);

        $responsetwo = curl_exec($curl_two);
        $error = curl_error($curl_two);
        curl_close($curl);

        $some = json_decode($responsetwo, true);

        if ($some['message'] == 'Contact already in list and/or does not exist'){
            $text ='<span class="text-warning text-center d-block mx-auto">This email adress is already registred.</span>';
        }else{
            $text ='<span class="text-success text-center d-block mx-auto">Thank you for subscribing to our newsletter.</span>';
        }
        if ($error) {
            echo "Some error occured";
        }

    }else{
        $text ='<span class="text-success text-center d-block mx-auto">Thank you for subscribing to our newsletter.</span>';
    }


    if ($err) {
        echo "Some error occured";
    } else {
        echo $text;
    }
    die();
}



add_action('wp_ajax_loadOffers', 'loadOffers');
add_action('wp_ajax_nopriv_loadOffers', 'loadOffers');
function loadOffers()
{
    $date = $_POST['date'];
    $casino= $_POST['casino'];
    $categories = $_POST['categories'];
    $exclusive = $_POST['exclusive'];
    $timestamp = strtotime($date);
    $day = date('l', $timestamp);
    $limit = $_POST['limit'];
    if (!empty($exclusive) && $exclusive === 'on' ) {
        $data = json_encode(get_latest_offers($date, $day, false, false, $limit,'on',$casino,$categories));
    }else{
        $data = json_encode(get_latest_offers($date, $day, false, false, $limit,null,$casino,$categories));
    }
    echo $data;
    die();
}


add_action('wp_ajax_moreOffers', 'moreOffers');
add_action('wp_ajax_nopriv_moreOffers', 'moreOffers');
function moreOffers()
{
    $date = $_POST['date'];
    $timestamp = strtotime($date);
    $day = date('l', $timestamp);
    $pageNum = $_POST['page'];
    $limit = $_POST['limit'];

    echo json_encode(get_more_offers($pageNum, $day, $limit));
    die();
}
