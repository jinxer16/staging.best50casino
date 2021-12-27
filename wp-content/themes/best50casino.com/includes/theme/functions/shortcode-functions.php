<?php
/************************ CASINO SHORTCODE FUNCTS *****************************/
function create_cta_button($casino_id, $cta_choice, $restr = false, $countryISO = '',$bonustype='')
{
    if ($bonustype == 56){
        $btnLink = $restr ? 'javascript:void(0)' : get_post_meta($casino_id, 'casino_custom_meta_affiliate_link_free_spins', true);
    }elseif ($bonustype == 48){
        $btnLink = $restr ? 'javascript:void(0)' : get_post_meta($casino_id, 'casino_custom_meta_affiliate_link_no_depo', true);
    }else{
        $btnLink = $restr ? 'javascript:void(0)' : get_post_meta($casino_id, 'casino_custom_meta_affiliate_link', true);
    }

    switch ($cta_choice) {
        case 'sign_up':
            return '<a target="_blank" rel="nofollow" href="' . $btnLink . '" class="btn btn_yellow text-decoration-none btn_large bumper" data-casinoid="' . $casino_id . '" data-country="' . $countryISO . '" ' . $restr . '>Sign Up</a>';
            break;
        case 'visit':
            return '<a target="_blank" rel="nofollow" href="' . $btnLink . '" class="btn btn_yellow text-decoration-none btn_large bumper" data-casinoid="' . $casino_id . '" data-country="' . $countryISO . '" ' . $restr . '>Visit</a>';
            break;
        case 'play_now':
            if ($GLOBALS['countryISO'] === 'gb') {
                return '<a target="_blank" rel="nofollow" href="' . $btnLink . '" class="btn btn_yellow text-decoration-none btn_large bumper" data-casinoid="' . $casino_id . '" data-country="' . $countryISO . '" ' . $restr . '>Play</a>';
            } elseif ($GLOBALS['countryISO'] !== 'gb') {
                return '<a target="_blank" rel="nofollow" href="' . $btnLink . '" class="btn btn_yellow text-decoration-none btn_large bumper" data-casinoid="' . $casino_id . '" data-country="' . $countryISO . '" ' . $restr . '>Play Now</a>';
            }

            break;
        case 'review':
            $cta_btn = 'Review';
            return '<a href="' . get_the_permalink($casino_id) . '" class="btn btn_black text-decoration-none play_button btn_large"><i class="fa fa-star"></i>Review</a>';
            break;
        case 'bonus':
            return '<a target="_blank" rel="nofollow" href="' . $btnLink . '" class="btn btn_yellow text-decoration-none btn_large bumper" data-casinoid="' . $casino_id . '" data-country="' . $countryISO . '" ' . $restr . '>Get Bonus</a>';
            break;
    }
}

function create_column($casino_id = "", $txt_choice = "", $icon_choice = "", $countryISO = '', $prioFilter = '')
{
    switch ($txt_choice) {
        case 'rtp':
            $ret1 = '<span class="d-none d-lg-block  d-xl-block">Games Payout: ' . get_post_meta($casino_id, 'casino_custom_meta_payout', true).'</span>';
            $aff = get_post_meta($casino_id, 'casino_custom_meta_affiliate_link', true);
            $ret1 .= '<a class="text-decoration-none d-xl-none d-lg-none d-md-none d-block" style="font-size:15px;" href="' . $aff . '" target="_blank" rel="nofollow" class="">' . get_the_title($casino_id) . '</a>';
            break;
        case 'fast_payout':
            $eWalletsSpeed = get_post_meta($casino_id, 'casino_custom_meta_wallets_transfer_time', true);
            $cardSpeed = get_post_meta($casino_id, 'casino_custom_meta_cards_transfer_time', true);
            $BankSpeed = get_post_meta($casino_id, 'casino_custom_meta_bank_transfer_time', true);
            $ret1 = '<div class="text-left d-flex flex-row justify-content-around w-100 flex-xl-column flex-md-column flex-lg-column">';
            $ret1.= '<div style="display:flex;"><span class="shortcode-icon ewallet" data-toggle="tooltip" title="eWallet Speed"></span>' . $eWalletsSpeed . '</div>';
            $ret1 .= '<div style="display:flex;"><span class="shortcode-icon cardtransfer" data-toggle="tooltip" title="Credit/Debit Card Speed"></span>' . $cardSpeed . '</div>';
            $ret1 .= '<div style="display:flex;"><span class="shortcode-icon banktransfer" data-toggle="tooltip" title="Bank Wire Speed"></span>' . $BankSpeed . '</div>';
            $ret1 .= '</div>';
            break;
        case 'year':
            $ret1 = '<span class="d-none d-lg-block  d-xl-block">Founded: ' . get_post_meta($casino_id, 'casino_custom_meta_com_estab', true).'</span>';
            $aff = get_post_meta($casino_id, 'casino_custom_meta_affiliate_link', true);
            $ret1 .= '<a class="text-decoration-none d-xl-none d-lg-none d-md-none d-block" style="font-size:15px;" href="' . $aff . '" target="_blank" rel="nofollow" class="">' . get_the_title($casino_id) . '</a>';
            break;
        case 'launched':
            $ret1 = '<span class="d-none d-lg-block  d-xl-block">Launched: ' . get_the_date('m/Y',$casino_id).'</span>';;
            $aff = get_post_meta($casino_id, 'casino_custom_meta_affiliate_link', true);
            $ret1 .= '<a class="text-decoration-none d-xl-none d-lg-none d-md-none d-block" style="font-size:15px;" href="' . $aff . '" target="_blank" rel="nofollow" class="">' . get_the_title($casino_id) . '</a>';
            break;
        case 'license':
            $ret1 = '';
            foreach (get_post_meta($casino_id, 'casino_custom_meta_license_country') as $option) {
                if ($option) {
                    $i = 0;
                    $len = count($option);
                    foreach ($option as $licenseid){
                        if ($licenseid == '13975'){
                            $title = 'Sweden';
                        }else{
                            $title = get_the_title($licenseid);
                        }
                        if (count($option) > 1){

                            if(++$i === $len) {
                                $ret1.= $title;
                            }else{
                                $ret1.= $title .", ";
                            }

                        }else{
                            $ret1.= $title ;
                        }

                    }
                }
            }
            break;
        case 'url':
            $url = str_replace(array('https://', 'http://'), "", get_post_meta($casino_id, 'casino_custom_meta_com_url', true));
            $aff = get_post_meta($casino_id, 'casino_custom_meta_affiliate_link', true);
            $ret1 = '<a class="text-decoration-none d-none d-lg-block d-xl-block d-md-block" href="' . $aff . '" target="_blank" rel="nofollow" class="">' . $url . '</a>';
            $ret1 .= '<a class="text-decoration-none d-xl-none d-lg-none d-md-none d-block" style="font-size:15px;" href="' . $aff . '" target="_blank" rel="nofollow" class="">' . get_the_title($casino_id) . '</a>';
            break;
        case 'cs':
            $ret = array();
            if (get_post_meta($casino_id, 'casino_custom_meta_email_option', true)) {
                $ret[] = 'E-mail';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_phone_option', true)) {
                $ret[] = 'Phone';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_callback_option', true)) {
                $ret[] = 'Callback';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_skype_option', true)) {
                $ret[] = 'Skype';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_viber_option', true)) {
                $ret[] = 'Viber';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_live_chat_option', true)) {
                $ret[] = 'Live Chat';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_video_chat_option', true)) {
                $ret[] = 'Video Chat';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_web_message_option', true)) {
                $ret[] = 'Web Message';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_twitter_option', true)) {
                $ret[] = 'Twitter';
            }
            if (count($ret) > 2) {
                $retFirst = array_slice($ret, 0, 2);
                $retRest = array_slice($ret, 2);
                $retFirst = implode(", ", $retFirst);
                $retRest = implode(", ", $retRest);
                $ret1 = $retFirst . '<i class="fa fa-plus expand-cs" data-id="' . $casino_id . count($ret) . array_sum(str_split($casino_id)) . '"></i><span class="cs-hidden" id="' . $casino_id . count($ret) . array_sum(str_split($casino_id)) . '">' . $retRest . '</span>';
            } else {
                $ret1 = implode(", ", $ret);
            }

            break;
        case 'live':
            $preferedOrder = explode(",", $prioFilter);
            $liveGames = get_post_meta($casino_id, 'casino_custom_meta_live_games', true);
            if(is_array($liveGames)) {
                $res = array_intersect($preferedOrder, $liveGames);
                $correctOrder = array_unique(array_merge($res, $liveGames));
                if (count($correctOrder) > 1) {
                    $liveGamesFirst = array_slice($correctOrder, 0, 2);
                    $liveGamesRest = array_slice($correctOrder, 2);
                    $liveGamesFirst = implode(", ", $liveGamesFirst);
                    $liveGamesRest = implode(", ", $liveGamesRest);
                    $ret1 = $liveGamesFirst . '<i class="fa fa-plus expand-cs" data-id="' . $casino_id . count($correctOrder) . array_sum(str_split($casino_id)) . '"></i><span class="cs-hidden" id="' . $casino_id . count($correctOrder) . array_sum(str_split($casino_id)) . '">' . $liveGamesRest . '</span>';
                } else {
                    $ret1 = implode(",", get_post_meta($casino_id, 'casino_custom_meta_live_games', true));
                }
            }
            break;
    }
    $ret1 = $txt_choice == 'fast_payout' ? '<span class="column-text withdrawals w-100">' . $ret1 . '</span>' : '<span class="column-text ">' . $ret1 . '</span>';
    $ret2 ='';
    switch ($icon_choice) {
        case 'safe':
            $auditing = get_post_meta($casino_id, 'casino_custom_meta_auditing', true);
            $ecogra = 'disabled';
            $tst = 'disabled';
            $gli = 'disabled';
            $iTech = 'disabled';
            if(is_array($auditing)) {
                $ecogra = '';
                $tst = '';
                $gli = '';
                $iTech = '';
            }
            $ret2 = '<div class="text-left d-flex"><span class="shortcode-icon ecogra ' . $ecogra . '" data-toggle="tooltip" title="eCogra Audit"></span>';
            $ret2 .= '<span class="shortcode-icon tst ' . $tst . '" data-toggle="tooltip" title="TST Audit"></span>';
            $ret2 .= '<span class="shortcode-icon gli ' . $gli . '" data-toggle="tooltip" title="GLI Audit"></span>';
            $ret2 .= '<span class="shortcode-icon itech-labs ' . $iTech . '" data-toggle="tooltip" title="iTech Labs Audit"></span></div>';
            break;
        case 'apps':
            $appPlatforms = get_post_meta($casino_id, 'casino_custom_meta_platforms', true);
            if(is_array($appPlatforms)){
                $android = in_array('android', $appPlatforms) ? '' : 'disabled';
                $windows = in_array('windows', $appPlatforms) ? '' : 'disabled';
                $apple = in_array('apple', $appPlatforms) ? '' : 'disabled';
            }else{
                $android = 'disabled';
                $windows = 'disabled';
                $apple = 'disabled';
            }
            $ret2 = '<div class="text-center d-flex"><span class="shortcode-icon android ' . $android . '"></span>';
            $ret2 .= '<span class="shortcode-icon windows ' . $windows . '"></span>';
            $ret2 .= '<span class="shortcode-icon apple ' . $apple . '"></span></div>';
            break;
        case 'dep':
            $ret2 = '<div class="d-flex w-sm-50 w-100 flex-column">';
            $ret2 .= '<ul class="inline-list cards-list column-icons pl-0 mb-0 mt-sm-0 mt-10p">';
            if ($prioFilter != null) {
                $paymentOrder['ids'] = str_replace(" ", "",$prioFilter);
            } else {
                $paymentOrder['ids'] = WordPressSettings::getPremiumPayments($countryISO);
            }
            $paymentOrder['ids'] == !empty( $paymentOrder['ids']) ?  $paymentOrder['ids'] : WordPressSettings::getPremiumPayments('glb');
            $order = explode(",", $paymentOrder['ids']);

            $availableMeans = get_post_meta($casino_id, 'casino_custom_meta_dep_options', true);
            if($countryISO == 'de'){
                $availableMeansstrict = get_post_meta($casino_id, 'casino_custom_meta_dep_options_strict', true);
                $tags = array_diff($availableMeans, $availableMeansstrict);
                $res = array_intersect($order, $tags);
                $correctOrder = array_unique(array_merge($res, $tags));
            }else{
                $res = array_intersect($order, $availableMeans);
                $correctOrder = array_unique(array_merge($res, $availableMeans));
            }
//
//            $res = array_intersect($order, $availableMeans);
//            $correctOrder = array_unique(array_merge($res, $availableMeans));
            $depArrayFirst = array_slice($correctOrder, 0, 3);
            $depArrayRest = array_slice($correctOrder, 3);
            $offset = count($depArrayRest);
            $tooltipRet = '';
            foreach ($depArrayRest as $rest){
                $tooltipRet .= get_the_title($rest).', ';
            }
            $tooltipRet = substr($tooltipRet, 0, -1);
            foreach ($depArrayFirst as $option) {

                $image_id = get_post_meta($option, 'casino_custom_meta_sidebar_icon', true);
                $ret2 .= '<li><img class="img-fluid" src="' . $image_id . '" loading="lazy" width="30" height="30"
                                 alt="' . get_the_title($option) . '" data-toggle="tooltip"
                                 title="' . ucwords(get_the_title($option)) . '"/></li>';
            }
            if ($tooltipRet) {
                $ret2 .= '<li class="plus" data-toggle="tooltip"
                             title="' . $tooltipRet . '"> +' . $offset . '</li>';
            }
            $ret2 .= '</ul>';
            $ret2 .= '</div>';
            break;
        case 'wit':

            if ($prioFilter != null) {
                $paymentOrder['ids'] = str_replace(" ", "",$prioFilter);
            } else {
                $paymentOrder['ids'] = WordPressSettings::getPremiumPayments($countryISO);
            }
            $paymentOrder['ids'] == !empty( $paymentOrder['ids']) ?  $paymentOrder['ids'] : WordPressSettings::getPremiumPayments('glb');
            $order = explode(",", $paymentOrder['ids']);
            $availableMeans = get_post_meta($casino_id, 'casino_custom_meta_withd_options', true);
            if (is_array($availableMeans)){

                if($countryISO == 'de'){
                    $availableMeansstrict = get_post_meta($casino_id, 'casino_custom_meta_with_options_strict', true);
                    $tags = array_diff($availableMeans, $availableMeansstrict);
                    $res = array_intersect($order, $tags);
                    $correctOrder = array_unique(array_merge($res, $tags));
                }else{
                    $res = array_intersect($order, $availableMeans);
                    $correctOrder = array_unique(array_merge($res, $availableMeans));
                }
//            $res = array_intersect($order, $availableMeans);
//            $correctOrder = array_unique(array_merge($res, $availableMeans));
//
            $ret2 = '<div class="d-flex w-sm-50 w-100 flex-column">';
            $ret2 .= '<ul class="inline-list cards-list column-icons pl-0 mb-0 mt-sm-0 mt-10p">';
            $depArray = get_post_meta($casino_id, 'casino_custom_meta_withd_options', true);
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
                $ret2 .= '<li><img class="img-fluid" src="' . $image[0] . '" loading="lazy" width="30" height="30"
                                 alt="' . get_the_title($option) . '" data-toggle="tooltip"
                                 title="' . ucwords(get_the_title($option)) . '"/></li>';
            }
            if ($tooltipRet) {
                $ret2 .= '<li class="plus" data-toggle="tooltip"
                                 title="' . $tooltipRet . '"> +' . $offset . '</li>';
            }
            $ret2 .= '</ul>';
            $ret2 .= '</div>';
            }
            break;
        case 'prov':
            $ret2 = '<div class="d-flex w-sm-50 w-100 flex-column">';
            $preferedOrder = array("Novomatic", "Netent", "EGT", "Playtech", "Microgaming", "Evolution Gaming", "ΝΥΧ Gaming", "Play\'n Go", "IGΤ", "Betsoft", "iSoftbet", "Aristocrat");
            $availableMeans = get_post_meta($casino_id, 'casino_custom_meta_softwares', true);
            if (is_array($availableMeans)){
            $res = array_intersect($preferedOrder, $availableMeans);
            //
            $rest = array_diff($availableMeans,$res);
            $correctOrder = array_merge($res, $rest);
            //
//            $correctOrder = array_unique(array_merge($res, $availableMeans));
            $j = 0;
            $ret2 .= '<ul class="inline-list cards-list column-icons pl-0 mb-0 mt-sm-0 mt-10p">';
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
                $ret2 .= '<li><img class="img-fluid" loading="lazy" src="' . $image[0] . '"  width="30" height="30"
                         alt="' . get_the_title($option) . '" data-toggle="tooltip"
                         title="' . ucwords(get_the_title($option)) . '"/></li>';
            }
            if ($tooltipRet) {
                $ret2 .= '<li class="plus" data-toggle="tooltip"
                                 title="' . $tooltipRet . '"> +' . $offset . '</li>';
            }
            $ret2 .= '</ul>';
            }
            break;
        case 'lv_prov':
            $availableMeans = get_post_meta($casino_id, 'casino_custom_meta_live_softwares', true);
            $ret2 = '<ul class="inline-list cards-list column-icons pl-0 mb-0 mt-sm-0 mt-10p">';
            if(is_array($availableMeans)) {
                $depArrayFirst = array_slice($availableMeans, 0, 3);
                $depArrayRest = array_slice($availableMeans, 3);
                $offset = count($depArrayRest);
                $tooltipRet = '';
                foreach ($depArrayRest as $rest) {
                    $tooltipRet .= get_the_title($rest) . ', ';
                }
                $tooltipRet = substr($tooltipRet, 0, -1);
                $j = 0;
                foreach ($depArrayFirst as $option) {
                    $j += 1;
                    $image_id = get_post_meta($option, 'casino_custom_meta_sidebar_icon', true);
                    $ret2 .= '<li><img class="img-fluid" loading="lazy" src="' . $image_id . '"  width="30" height="30"
                         alt="' . get_the_title($option) . '" data-toggle="tooltip"
                         title="' . ucwords(get_the_title($option)) . '"/></li>';
                }
                if ($tooltipRet) {
                    $ret2 .= '<li class="plus" data-toggle="tooltip"
                                 title="' . $tooltipRet . '"> +' . $offset . '</li>';
                }
            }else{
                $ret2.='no live software';
            }
            $ret2 .= '</ul></div>';
            break;
        case 'lang':
            $ret2 .= get_flags($casino_id, 'site');
            break;
    }
    return $ret1 . $ret2;
}

function create_casino_table_column($casino_id, $col_choice, $custon_coice, $shortcode_type)
{
    switch ($col_choice) {
        // General
        case 'why_play_col':
            $i = 0;
            $casino_why_play = explode(',', get_post_meta($casino_id, 'casino_custom_meta_why_play', true));
            $ret = '	<ul class="check-list">';
            foreach ($casino_why_play as $pros) {
                $i = $i + 1;
                $ret .= '			<li>' . $pros . ' </li>';
                if ($i == 3 && $shortcode_type == 'horizontal') {
                    break;
                } elseif ($i == 4 && $shortcode_type != 'horizontal') {
                    break;
                }
            }
            $ret .= '	</ul>';
            return $ret;
            break;
        case 'software':
            $i = 0;
            $no_help = get_post_meta($casino_id, 'casino_custom_meta_softwares');
            $no = count($no_help[0]) - 5;
            $preferedOrder = array("Novomatic", "Netent", "EGT", "Playtech", "Microgaming", "Evolution Gaming", "ΝΥΧ Gaming", "Play\'n Go", "IGΤ", "Betsoft", "iSoftbet", "Aristocrat");
            $availableMeans = get_post_meta($casino_id, 'casino_custom_meta_softwares', true);
            $res = array_intersect($preferedOrder, $availableMeans);
            $correctOrder = array_unique(array_merge($res, $availableMeans));
            $ret = '<ul class="casino_details">';
            foreach ($correctOrder as $option) {
                $i = $i + 1;
//                $page = get_page_by_title($option, OBJECT, 'kss_softwares');
                if ($i <= 5) {
                    $ret .= '		<li><img class="img-fluid" loading="lazy" src="' . get_post_meta($option, 'casino_custom_meta_sidebar_icon', true) . '" width="40" height="40" alt="' . ucwords(get_the_title($option)) . '" data-toggle="tooltip" title="' . ucwords(get_the_title($option)) . '"/></li>';

                    //$ret .= '		<li><img src="'.get_the_post_thumbnail_url($page->ID, 'shortcode-small').'" width="40" height="25" alt="'.ucwords($page->post_name).'" data-toggle="tooltip" title="'.ucwords($page->post_name).'"/></li>';
                } else {
                    $remain .= ucwords(get_the_title($option)) . ', ';
                }
            }
            if (count($no_help[0]) > 5) {
                $ret .= '<li><i class="fa fa-plus" aria-hidden="true" data-toggle="tooltip" title="' . rtrim($remain, ', ') . '"></i>' . $no . '</li>';
            }
            $ret .= '</ul>';
            return $ret;
            break;
        case 'live_software':
            $i = 0;
            $no_help = get_post_meta($casino_id, 'casino_custom_meta_live_softwares');
            $no = count($no_help[0]) - 5;
            $ret = '<ul class="casino_details">';
            foreach (get_post_meta($casino_id, 'casino_custom_meta_live_softwares', true) as $option) {
                $i = $i + 1;
//                $page = get_page_by_title($option, OBJECT, 'kss_softwares');
                if ($i <= 5) {
                    $ret .= '		<li><img   data-src="' . get_post_meta($option, 'casino_custom_meta_sidebar_icon', true) . '" width="40" height="40" alt="' . ucwords(get_the_title($option)) . '" data-toggle="tooltip" title="' . ucwords(get_the_title($option)) . '"/></li>';
                } else {
                    $remain .= ucwords(get_the_title($option)) . ', ';
                }
            }
            if (count($no_help[0]) > 5) {
                $ret .= '<li><i class="fa fa-plus" aria-hidden="true" data-toggle="tooltip" title="' . rtrim($remain, ', ') . '"></i>' . $no . '</li>';
            }
            $ret .= '</ul>';
            return $ret;
            break;
        // Με Slot /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        case 'slot_nbr':
            $casino = get_the_title($casino_id);
            $deps_atts = array( // A QUERY that initializes the default (all) IDS
                'post_type' => array('kss_slots'),
                'post_status' => array('publish'),
                'posts_per_page' => -1,
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'slot_custom_meta_slot_main_casino',
                        'value' => $casino,
                        'compare' => 'LIKE',
                    ),
                ),
            );
            $deps = new WP_Query($deps_atts);

            return '<span class="rat-nbr">' . $deps->found_posts . '</span><br><span>Slots</span>';
            break;
        case 'slot_rating':
            return '<span class="rat-nbr">' . get_post_meta($casino_id, 'casino_custom_meta_slots_rating', true) . '/5</span><br><div class="ratings"><div class="star-rating"><span style="width: ' . get_post_meta($casino_id, 'casino_custom_meta_slots_rating', true) . 'px;"></span></div></div>';
            break;
        // Κειμενάκια //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        case 'text_col':
            return get_post_meta($casino_id, 'casino_custom_meta_promo_text', true);
            break;
        case 'promo_services':
            return get_post_meta($casino_id, 'casino_custom_meta_promo_service', true);
            break;
        case 'mini_review':
            return get_post_meta($casino_id, 'casino_custom_meta_mini_review', true);
            break;
        case 'slot_games':
            return get_post_meta($casino_id, 'casino_custom_meta_games_slots', true);
            break;
        case 'live_cas_txt':
            return get_post_meta($casino_id, 'casino_custom_meta_live_casino_promo', true);
            break;
        // Με βαθμολογία //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        case 'license_rat':
            $score = get_post_meta($casino_id, 'casino_custom_meta_license_rating', true) * 10;
            $scores = $score / 20;
            $ret = '<span class="rat-nbr">' . $scores . '/5</span><br><div class="ratings">';
            $ret .= '	<div class="star-rating"><span style="width: ' . $score . 'px;"></span></div>';
            $ret .= '</div>';
            return $ret;
            break;
        case 'withd_rat':
            $score = get_post_meta($casino_id, 'casino_custom_meta_withdrawal_rating', true) * 10;
            $scores = $score / 20;
            $ret = '<span class="rat-nbr">' . $scores . '/5</span><br><div class="ratings">';
            $ret .= '	<div class="star-rating"><span style="width: ' . $score . 'px;"></span></div>';
            $ret .= '</div>';
            return $ret;
            break;
        case 'offers_rat':
            $score = get_post_meta($casino_id, 'casino_custom_meta_offers_rating', true) * 10;
            $scores = $score / 20;
            $ret = '<span class="rat-nbr">' . $scores . '/5</span><br><div class="ratings">';
            $ret .= '	<div class="star-rating"><span style="width: ' . $score . 'px;"></span></div>';
            $ret .= '</div>';
            return $ret;
            break;
        case 'site_rat':
            $score = get_post_meta($casino_id, 'casino_custom_meta_site_rating', true) * 10;
            $scores = $score / 20;
            $ret = '<span class="rat-nbr">' . $scores . '/5</span><br><div class="ratings">';
            $ret .= '	<div class="star-rating"><span style="width: ' . $score . 'px;"></span></div>';
            $ret .= '</div>';
            return $ret;
            break;
        case 'games_rat':
            $score = get_post_meta($casino_id, 'casino_custom_meta_games_rating', true) * 10;
            $scores = $score / 20;
            $ret = '<span class="rat-nbr">' . $scores . '/5</span><br><div class="ratings">';
            $ret .= '	<div class="star-rating"><span style="width: ' . $score . 'px;"></span></div>';
            $ret .= '</div>';
            return $ret;
            break;
        case 'total':
            $score = get_post_meta($casino_id, 'casino_custom_meta_sum_rating', true) * 10;
            $scores = $score / 20;
            $ret = '<span class="visible-xs" style="font-size:15px;margin-top: 11px;">' . get_the_title($casino_id) . ' Casino</span>';
            $ret .= '<span class="rat-nbr hidden-xs">' . $scores . '/5</span><br><div class="ratings hidden-xs"><div class="star-rating"><span style="width: ' . $score . 'px;"></span></div></div>';
            $ret .= '<div class="ratings visible-xs" style="margin-top: -19px;"><div class="star-rating"><span style="width: ' . $score . 'px;"></span></div></div>';
            return $ret;
            break;
        // Συναλλαγές //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        case 'min_dep':
            return '<span class="visible-xs">Ελάχιστη κατάθεση</span><span class="rat-nbr">' . get_post_meta($casino_id, 'casino_custom_meta_min_dep', true) . '</span>';
            break;
        case 'dep_charge':
            return '<span class="rat-nbr">' . get_post_meta($casino_id, 'casino_custom_meta_dep_charges', true) . '</span>';
            break;
        case 'min_withd':
            return '<span class="rat-nbr">' . get_post_meta($casino_id, 'casino_custom_meta_min_withd', true) . '</span>';
            break;
        case 'dep_means':
            $i = 0;
            $no_help = get_post_meta($casino_id, 'casino_custom_meta_dep_options');
            $no = count($no_help[0]) - 5;
            $ret = '<ul class="casino_details">';
            $preferedOrder = array("Visa", "Τραπεζική μεταφορά", "Paysafe", "Viva", "Skrill", "Neteller", "mastercard", "Entropay", "ecoPayz", "Unistream", "Bitcoin", "Astropay");
            $availableMeans = get_post_meta($casino_id, 'casino_custom_meta_dep_options', true);
            $res = array_intersect($preferedOrder, $availableMeans);
            $correctOrder = array_unique(array_merge($res, $availableMeans));
            foreach ($correctOrder as $option) {
                $i = $i + 1;
//                $page = get_page_by_title($option, OBJECT, 'kss_transactions');
                if ($i <= 5) {
                    //$ret .= '		<li><img src="'.get_the_post_thumbnail_url($page->ID, 'shortcode-small').'" width="40" height="25" alt="'.ucwords($page->post_name).'" data-toggle="tooltip" title="'.ucwords($page->post_name).'"/></li>';
                    $ret .= '		<li><img class="img-fluid" loading="lazy" src="' . get_post_meta($option, "casino_custom_meta_sidebar_icon", true) . '"  width="40" height="40" alt="' . ucwords(get_the_title($option)) . '" data-placement="top" data-toggle="tooltip" title="' . ucwords(get_the_title($option)) . '"/></li>';
                } else {
                    $remain .= ucwords(get_the_title($option)) . ', ';
                }
            }
            if (count($no_help[0]) > 5) {
                $ret .= '<li><i class="fa fa-plus" aria-hidden="true" data-placement="top" data-toggle="tooltip" title="' . rtrim($remain, ', ') . '"></i>' . $no . '</li>';
            }
            $ret .= '</ul>';
            return $ret;
            break;
        case 'withd_means':
            $i = 0;
            $no_help = get_post_meta($casino_id, 'casino_custom_meta_withd_options');
            $no = count($no_help[0]) - 5;
            $ret = '<ul class="casino_details">';
            foreach (get_post_meta($casino_id, 'casino_custom_meta_withd_options', true) as $option) {
                $i = $i + 1;
//                $page = get_page_by_title($option, OBJECT, 'kss_transactions');
                if ($i <= 5) {
                    $ret .= '<li><img class="img-fluid" loading="lazy" src="' . get_the_post_thumbnail_url($option, 'shortcode-small') . '" width="40" height="25" alt="' . ucwords(get_the_title($option)) . '" data-toggle="tooltip" title="' . ucwords(get_the_title($option)) . '"/></li>';
                } else {
                    $remain .= ucwords(get_the_title($option)) . ', ';
                }
            }
            if (count($no_help[0]) > 5) {
                $ret .= '<li><i class="fa fa-plus" aria-hidden="true" data-toggle="tooltip" title="' . rtrim($remain, ', ') . '"></i>' . $no . '</li>';
            }
            $ret .= '</ul>';
            return $ret;
            break;
        case 'wallets':
            return get_post_meta($casino_id, 'casino_custom_meta_wallets_transfer_time', true);
            break;
        case 'cards':
            return get_post_meta($casino_id, 'casino_custom_meta_cards_transfer_time', true);
            break;
        case 'transfers':
            return get_post_meta($casino_id, 'casino_custom_meta_bank_transfer_time', true);
            break;
        // Custom με εικονίδια //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        case 'custom_icons':
            $translation_table = array(
                'Loyalty' => '<span class="icon-loyalty" data-toggle="tooltip" title="Loyalty"></span>',
                'VIP' => '<span class="icon-crown" data-toggle="tooltip" title="VIP"></span>',
                'Mobile Casino' => '<i class="fa fa-mobile" aria-hidden="true" data-toggle="tooltip" title="Mobile Casino"></i>',
                'Live Casino' => '<span class="icon-rocket" data-toggle="tooltip" title="Live Casino"></span>',///////////////////
                'Progressive Jackpot' => '<span class="icon-jackpot lazy-background" data-toggle="tooltip" title="Progressive Jackpot"></span>',
                'BlackJack' => '<span class="icon-BLACKJACK" data-toggle="tooltip" title="BlackJack"></span>',
                'Caribbean Stud Poker' => '<span class="icon-caribbean" data-toggle="tooltip" title="Caribbean Stud Poker"></span>',
                'Casino HoldEm' => '<span class="icon-holdem" data-toggle="tooltip" title="Casino HoldEm"></span>',
                'Baccarat' => '<span class="icon-baccarat" data-toggle="tooltip" title="Baccarat"></span>',
                'Punto Banco' => '<span class="icon-punto" data-toggle="tooltip" title="Punto Banco"></span>',
                'Sic Bo' => '<span class="icon-sicbo" data-toggle="tooltip" title="Sic Bo"></span>',
                'Video Poker' => '<span class="icon-video-camera lazy-background" data-toggle="tooltip" title="Video Poker"></span>',
                'Craps' => '<span class="icon-dice2" data-toggle="tooltip" title="Craps"></span>',
                'Keno' => '<span class="icon-kino" data-toggle="tooltip" title="Keno"></span>',
                'Lottery' => '<span class="icon-money-bag" data-toggle="tooltip" title="Lottery"></span>',
                'Bingo' => '<span class="icon-bingo" data-toggle="tooltip" title="Bingo"></span>',
                'Roulette' => '<span class="icon-rullete" data-toggle="tooltip" title="Roulette"></span>',
                'Slots' => '<span class="icon-slot" data-toggle="tooltip" title="Slots"></span>',
                'Poker' => '<span class="icon-poker" data-toggle="tooltip" title="Poker"></span>',
                'Scratch Cards' => '<span class="icon-scratch" data-toggle="tooltip" title="Scratch Cards"></span>',
                'Backgammon' => '<span class="icon-dice2"  style="color:grey;" data-toggle="tooltip" title="Backgammon"></span>',
                'Live Roulette' => '<span class="icon-rullete" style="color:red;" data-toggle="tooltip" title="Live Roulette"></span>',
                'Live Blackjack' => '<span class="icon-BLACKJACK" style="color:red;" data-toggle="tooltip" title="Live Blackjack"></span>',
                'Live Baccarat' => '<span class="icon-baccarat" style="color:red;" data-toggle="tooltip" title="Live Baccarat"></span>',
                'Live Poker' => '<span class="icon-poker" style="color:red;" data-toggle="tooltip" title="Live Poker"></span>',
                'Τable Games' => '<span class="icon-dice" data-toggle="tooltip" title="Τable Games"></span>',
                'Card Games' => '<span class="icon-cards" data-toggle="tooltip" title="Card Games"></span>',
                'Other games' => '<span class="icon-rocket" data-toggle="tooltip" title="Other Games"></span>',
            );
            $casi_stats = get_post_meta($casino_id, 'casino_custom_meta_games', true);
            if (get_post_meta($casino_id, 'casino_custom_meta_live_casino', true)) {
                $casi_stats[] = 'Live Casino';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_loyalty', true)) {
                $casi_stats[] = 'Loyalty';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_mobile_casino', true)) {
                $casi_stats[] = 'Mobile Casino';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_prog_jackpot', true)) {
                $casi_stats[] = 'Progressive Jackpot';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_vip', true)) {
                $casi_stats[] = 'VIP';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_gr_deal', true)) {
                $casi_stats[] = 'Έλληνες Dealers';
            }
            foreach ($custon_coice as $choice) {
                if (in_array($choice, $casi_stats)) { /*/*/
                    $ret .= $translation_table[$choice];
                }
            }
            return $ret;
            break;
        // Custom με κείμενο //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        case 'custom_text':
            $casi_stats = get_post_meta($casino_id, 'casino_custom_meta_games', true);
            if (get_post_meta($casino_id, 'casino_custom_meta_live_casino', true)) {
                $casi_stats[] = 'Live Casino';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_loyalty', true)) {
                $casi_stats[] = 'Loyalty';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_mobile_casino', true)) {
                $casi_stats[] = 'Mobile Casino';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_prog_jackpot', true)) {
                $casi_stats[] = 'Progressive Jackpot';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_vip', true)) {
                $casi_stats[] = 'VIP';
            }
            if (get_post_meta($casino_id, 'casino_custom_meta_gr_deal', true)) {
                $casi_stats[] = 'Έλληνες Dealers';
            }
            foreach ($custon_coice as $choice) {
                if (in_array($choice, $casi_stats)) { /*/*/
                    $ret .= $choice . ', ';
                }
            }
            return rtrim($ret, ', ');
            break;
        // Taytothta //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        case 'off_site':
            return '<a class="text-decoration-none" href="' . get_post_meta($casino_id, 'casino_custom_meta_affiliate_link', true) . '" target="_blank" rel="nofollow">' . get_post_meta($casino_id, 'casino_custom_meta_com_url', true) . '</a>';
            break;
        case 'year_est':
            return get_post_meta($casino_id, 'casino_custom_meta_com_estab', true);
            break;
        case 'off_name':
            return get_post_meta($casino_id, 'casino_custom_meta_com_off_name', true);
            break;
        case 'license':
            $country = get_post_meta($casino_id, 'casino_custom_meta_license_country');
            $flags_table = array(
                'Malta' => 'Malta - <span class="flag-icon flag-icon-mt"></span>',
                'Montenegro' => 'Montenegro - <span class="flag-icon flag-icon-me"></span>',
                'Givraltar' => 'Givraltar - <span class="flag-icon flag-icon-gl"></span>',
                'UK' => 'UK - <span class="flag-icon flag-icon-gb"></span>',
                'Isle of Man' => 'Isle of Man - <span class="flag-icon flag-icon-im"></span>',
                'Costa Rica' => 'Costa Rica - <span class="flag-icon flag-icon-cr"></span>',
                'Curacao' => 'Curacao - <span class="flag-icon flag-icon-cw"></span>',
                'Tasmania' => 'Tasmania - <span class="flag-icon"><img src="https://www.best50casino.com/wp-content/uploads/2017/05/1200px-Flag_of_Tasmania.svg_.png" height="16"></span>',
                'Antigua' => 'Antigua - <span class="flag-icon flag-icon-ag"></span>',
                'Panama' => 'Panama - <span class="flag-icon flag-icon-pa"></span>',
                'Philippines (Cagayan)' => 'Philippines (Cagayan) - <span class="flag-icon flag-icon-ph"></span>',
                'Austria' => 'Austria - <span class="flag-icon flag-icon-at"></span>',
                'Belize' => 'Belize - <span class="flag-icon flag-icon-bz"></span>',
                'Kahnawake (Canada)' => 'Kahnawake (Canada) - <span class="flag-icon flag-icon-ca"></span>',
                'Alderney' => 'Alderney - <span class="flag-icon"><img src="https://www.best50casino.com/wp-content/uploads/2017/05/1000px-Flag_of_Alderney.svg_.png" height="16"></span>',
                'Estonia' => 'Estonia - <span class="flag-icon flag-icon-ee"></span>',
                'Other' => 'Other - <i class="fa fa-flag" aria-hidden="true"></i>',
            );

            foreach (get_post_meta($casino_id, 'casino_custom_meta_license_country', true) as $option) {
                if ($option) {
                    $ret .= $flags_table[$option] . '<br>';
                }
            }
            /* switch ($country[0]){
                case 'Μάλτα':
                    $ret = 'Μάλτα - <span class="flag-icon flag-icon-mt"></span>';
                break;
                case 'Μαυροβούνιο':
                    $ret = 'Μαυροβούνιο - <span class="flag-icon flag-icon-me"></span>';
                break;
                case 'Γιβραλταρ':
                    $ret = 'Γιβραλταρ - <span class="flag-icon flag-icon-gl"></span>';
                break;
                case 'Ηνωμένο Βασίλειο':
                    $ret = 'Ηνωμένο Βασίλειο - <span class="flag-icon flag-icon-gb"></span>';
                break;
                case 'Isle of Man':
                    $ret = 'ΓιβρIsle of Manαλταρ - <span class="flag-icon flag-icon-im"></span>';
                break;
                case 'Κόστα Ρίκα':
                    $ret = 'Κόστα Ρίκα - <span class="flag-icon flag-icon-cr"></span>';
                break;
                case 'Κουρασάο':
                    $ret = 'Κουρασάο - <span class="flag-icon flag-icon-cw"></span>';
                break;
                case 'Ταζμανία':
                    $ret = 'Ταζμανία - <span class="flag-icon"><img src="http://www.bestcasino.gr/wp-content/uploads/2017/05/1200px-Flag_of_Tasmania.svg_.png" height="16"></span>';
                break;
                case 'Αντίγκουα':
                    $ret = 'Αντίγκουα - <span class="flag-icon flag-icon-ag"></span>';
                break;
                case 'Παναμάς':
                    $ret = 'Παναμάς - <span class="flag-icon flag-icon-pa"></span>';
                break;
                case 'Φιλιππίνες (Cagayan)':
                    $ret = 'Φιλιππίνες (Cagayan) - <span class="flag-icon flag-icon-ph"></span>';
                break;
                case 'Αυστρία':
                    $ret = 'Αυστρία - <span class="flag-icon flag-icon-at"></span>';
                break;
                case 'Μπελίζ':
                    $ret = 'Μπελίζ - <span class="flag-icon flag-icon-bz"></span>';
                break;
                case 'Kahnawake (Καναδάς)':
                    $ret = 'Kahnawake (Καναδάς) - <span class="flag-icon flag-icon-ca"></span>';
                break;
                case 'Alderney':
                    $ret = 'Alderney - <span class="flag-icon"><img src="http://www.bestcasino.gr/wp-content/uploads/2017/05/1000px-Flag_of_Alderney.svg_.png" height="16"></span>';
                break;
                case 'Εσθονία':
                    $ret = 'Εσθονία - <span class="flag-icon flag-icon-ee"></span>';
                break;
                case 'Other':
                    $ret = 'Άλλη - <i class="fa fa-flag" aria-hidden="true"></i>';
                break;
            } */
            return $ret;
            break;
        case 'com_hq':
            return get_post_meta($casino_id, 'casino_custom_meta_com_head', true);
            break;
        case 'com_means':
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_email_option', true) ? '<i class="fa fa-envelope-o" aria-hidden="true" data-toggle="tooltip" title="E-mail"></i>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_Phone', true) ? '<i class="fa fa-phone" aria-hidden="true" data-toggle="tooltip" title="Phone"></i>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_callback_option', true) ? '<i class="fa fa-volume-control-phone" aria-hidden="true" data-toggle="tooltip" title="Callback"></i>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_skype_option', true) ? '<i class="fa fa-skype" aria-hidden="true" data-toggle="tooltip" title="Skype"></i>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_viber_option', true) ? '<span class="icon-viber" data-toggle="tooltip" title="Viber"></span>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_live_chat_option', true) ? '<i class="fa fa-comments-o" aria-hidden="true" data-toggle="tooltip" title="Live Chat"></i>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_video_chat_option', true) ? '<i class="fa fa-commenting-o" aria-hidden="true" data-toggle="tooltip" title="Video Chat"></i>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_Web_Message_option', true) ? '<i class="fa fa-reply" aria-hidden="true" data-toggle="tooltip" title="Web Message"></i>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_twitter_option', true) ? '<i class="fa fa-twitter" aria-hidden="true" data-toggle="tooltip" title="Twitter"></i>' : '';
            return $ret;
            break;
        case 'com_hours':
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_email_option', true) ? '<i class="fa fa-envelope-o" aria-hidden="true" data-toggle="tooltip" title="E-mail"></i>' . get_post_meta($casino_id, 'casino_custom_meta_emailoption_det', true) . '<br>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_Phone', true) ? '<i class="fa fa-phone" aria-hidden="true" data-toggle="tooltip" title="Phone"></i>' . get_post_meta($casino_id, 'casino_custom_meta_Τηλέφωνοoption_det', true) . '<br>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_callback_option', true) ? '<i class="fa fa-volume-control-phone" aria-hidden="true" data-toggle="tooltip" title="Callback"></i>' . get_post_meta($casino_id, 'casino_custom_meta_callbackoption_det', true) . '<br>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_skype_option', true) ? '<i class="fa fa-skype" aria-hidden="true" data-toggle="tooltip" title="Skype"></i>' . get_post_meta($casino_id, 'casino_custom_meta_skypeoption_det', true) . '<br>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_viber_option', true) ? '<span class="icon-viber" data-toggle="tooltip" title="Viber"></span>' . get_post_meta($casino_id, 'casino_custom_meta_viberoption_det', true) . '<br>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_live_chat_option', true) ? '<i class="fa fa-comments-o" aria-hidden="true" data-toggle="tooltip" title="Live Chat"></i>' . get_post_meta($casino_id, 'casino_custom_meta_live_chatoption_det', true) . '<br>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_video_chat_option', true) ? '<i class="fa fa-commenting-o" aria-hidden="true" data-toggle="tooltip" title="Video Chat"></i>' . get_post_meta($casino_id, 'casino_custom_meta_video_chatoption_det', true) . '<br>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_Web_Message_option', true) ? '<i class="fa fa-reply" aria-hidden="true" data-toggle="tooltip" title="Web Message"></i>' . get_post_meta($casino_id, 'casino_custom_meta_Web_Message_det', true) . '<br>' : '';
            $ret .= get_post_meta($casino_id, 'casino_custom_meta_twitter_option', true) ? '<i class="fa fa-twitter" aria-hidden="true" data-toggle="tooltip" title="Twitter"></i>' . get_post_meta($casino_id, 'casino_custom_meta_twitteroption_det', true) . '<br>' : '';
            return $ret;
            break;
        case 'com_tel':
            return get_post_meta($casino_id, 'casino_custom_meta_comum_tel', true);
            break;
        case 'com_mail':
            return get_post_meta($casino_id, 'casino_custom_meta_comun_email', true);
            break;
        case 'name':
            return get_the_title($casino_id) . ' Casino';
            break;
        case 'payout':
            return get_post_meta($casino_id, 'casino_custom_meta_payout', true);
            break;
    }
}