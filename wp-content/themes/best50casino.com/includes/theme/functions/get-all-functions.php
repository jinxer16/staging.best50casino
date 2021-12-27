<?php
/**
 * Created by PhpStorm.
 * User: Panos
 * Date: 31/7/2019
 * Time: 12:00 μμ
 */

function get_allpayment(){
    $payment = array(
        'visa'=>'VISA',
        'visaelectron'=>'Visa Electron',
        'mastercard'=>'Mastercard',
        'maestro'=>'Maestro',
        'delta'=>'Delta',
        'solo'=>'Solo ',
        'switch'=>'Switch',
        'laser'=>'Laser',
        'diners'=>'Diners',
        'amex'=>'AMEX',
        'bank'=>'Bank Transfer',
        'fbank'=>'Fast Bank Transfer',
        'cheque'=>'Cheque (US)',
        'trustly'=>'Trustly',
        'eurocard'=>'Eurocard',
        'entercash'=>'Entercash',
        'idebit'=>'iDebit',
        'neteller'=>'Neteller',
        'neteller_de'=>'Neteller DE',
        'skrill'=>'Skrill',
        'skrill1tap'=>'Skrill 1-Tap',
        'skrill_de'=>'Skrill DE',
        'paypal'=>'Paypal',
        'quickteller'=>'Quickteller',
        'click2pay'=>'Click2Pay',
        'clickandbuy'=>'Clickandbuy',
        'entropay'=>'Entropay',
        'ecopayz'=>'Ecopayz',
        'moneta'=>'Moneta',
        'euteller'=>'Euteller',
        'astropay'=>'Astropay Card',
        'e-payments'=>'e-Payments',
        'sofort'=>'Sofort',
        'molpay'=>'Molpay',
        'lobanet'=>'Lobanet',
        'instadebit'=>'Instadebit',
        'yandex'=>'Yandex',
        'payeer'=>'Payeer',
        'paysec'=>'Paysec',
        'paykwik'=>'PayKwik',
        'trustpay'=>'Trustpay',
        'alipay'=>'Alipay',
        'walletone'=>'Walletone',
        'paymenticon'=>'Paymenticon',
        'ukash'=>'Ukash',
        'paysafe'=>'Paysafecard',
        'wunion'=>'Western Union',
        'moneygram'=>'MoneyGram',
        'bettingshops'=>'Betting Shops',
        'neosurf'=>'Neosurf',
        'ticketpremium'=>'Ticket Premium',
        'ecovoucher'=>'Ecovoucher',
        'cashlib'=>'Cashlib',
        'poli'=>'Poli','dankort'=>'Dankort','webmoney'=>'Webmoney','giropay_'=>'Giropay','postepay'=>'Postepay','ewire'=>'EWire','eps'=>'EPS','firepay'=>'Firepay','ideal'=>'iDeal','qiwi'=>'QIWI','bitcoin'=>'Bitcoin','telegraphictransfer'=>'Telegraphic Transfer','bpay'=>'bpay','boku'=>'Boku','paybox'=>'Paybox','litecoin'=>'Litecoin','dogecoin'=>'Dogecoin','flexepin'=>'Flexepin', 'muchbetter'=>'Muchbetter','avtalegiro'=>'AvtaleGiro', 'bankaxept'=>'BankAxept','interac'=>'Interac','p2p'=>'Player to Player','ethereum'=>'Ethereum','dash'=>'Dash',
        'viva'=>'VIVA', 'vivaspot'=>'Viva Spot', 'beecashpay'=>'BeeCashPay', 'upay'=>'Upaycard', 'unistream'=>'Unistream', 'moneysafe'=>'Moneysafe', 'platba24'=>'Platba 24', 'przelewy24'=>'Przelewy24', 'epaybg'=>'Epay.bg', 'dotpay'=>'Dotpay', 'cashu'=>'CashU', 'ekonto'=>'eKonto', 'enets'=>'eNets', 'paykasa'=>'Paykasa', 'ecard'=>'Ecard', 'boleto'=>'Boleto','itau'=>'Itau','mobifoneprepaidcard'=>'Mobifone','chinaunionpay'=>'UnionPay','bradesco'=>'Bradesco','halcash'=>'Halcash','gscash'=>'Gs cash','epaycode'=>'Epaycode','cashixir'=>'Cashixir','faktura'=>'Faktura','teleingreso'=>'Teleingreso','dineromail'=>'Dineromail','banklink'=>'Banklink','paymaster'=>'Paymaster','utel'=>'Utel','svyaznoy'=>'Svyaznoy','abaqoos'=>'Abaqoos','okPay'=>'OkPay','perfectmoney'=>'Perfect Money','megafon'=>'Megafon','toditocash'=>'Toditocash','servipag'=>'Servipag','redpagos'=>'Redpagos','rapipago'=>'Rapi Pago','pagofacil'=>'Pago Facil','efecty'=>'Efecty','postepay'=>'Postepay','cartasi'=>'CartaSi','rapidtransfer'=>'Rapid Transfer','zimpler'=>'Zimpler','multibanco'=>'Multibanco', 'hipay'=>'HiPay', 'jeton'=>'Jeton','gt_collections'=>'GT Collections','nibbs'=>'NIBBS','etranzact'=>'eTranzact'
    );
    asort($payment);
    return $payment;
}

function get_allpayment_cards(){
    $payment = array(
        'visa'=>'Visa',
        'visaelectron'=>'Visa Electron',
        'mastercard'=>'Mastercard',
        'maestro'=>'Maestro',
        'delta'=>'Delta',
        'solo'=>'Solo',
        'switch'=>'Switch',
        'laser'=>'Laser',
        'diners'=>'Diners',
        'amex'=>'American Express',
        'bank'=>'Bank Transfer',
        'fbank'=>'Fast Bank Transfer',
        'cheque'=>'Cheque (US)',
        'trustly'=>'Trustly',
        'eurocard'=>'Eurocard',
        'entercash'=>'Entercash',
        'idebit'=>'iDebit',
    );
    asort($payment);
    return $payment;
}

function get_allpayment_ewallets(){
    $payment = array(
        'neteller'=>'Neteller',
        'neteller_de'=>'Neteller (de)',
        'skrill'=>'Skrill',
        'skrill1tap'=>'Skrill 1-Tap',
        'skrill_de'=>'Skrill (de)',
        'paypal'=>'Paypal',
        'quickteller'=>'Quickteller',
        'click2pay'=>'Click2Pay',
        'clickandbuy'=>'Clickandbuy',
        'entropay'=>'Entropay',
        'ecopayz'=>'Ecopayz',
        'moneta'=>'Moneta',
        'euteller'=>'Euteller',
        'astropay'=>'Astropay',
        'e-payments'=>'e-Payments',
        'sofort'=>'Sofort',
        'molpay'=>'Molpay',
        'lobanet'=>'Lobanet',
        'instadebit'=>'Instadebit',
        'yandex'=>'Yandex',
        'payeer'=>'Payeer',
        'paysec'=>'Paysec',
        'paykwik'=>'PayKwik',
        'trustpay'=>'Trustpay',
        'alipay'=>'Alipay',
        'walletone'=>'Walletone',
        'paymenticon'=>'Paymenticon',
    );
    asort($payment);
    return $payment;
}

function get_allpayment_vouchers(){
    $payment = array(
        'ukash'=>'Ukash',
        'paysafe'=>'Paysafecard',
        'wunion'=>'Western Union',
        'moneygram'=>'Moneygram',
        'bettingshops'=>'Betting Shops',
        'neosurf'=>'Neosurf',
        'ticketpremium'=>'Ticket Premium',
        'ecovoucher'=>'Ecovoucher',
        'cashlib'=>'Cashlib',
    );
    asort($payment);
    return $payment;
}

function get_allpayment_locals(){
    $payment = array('viva'=>'Viva Wallet', 'vivaspot'=>'Viva Spot', 'beecashpay'=>'BeeCashPay', 'upay'=>'U-Pay', 'unistream'=>'Unistream', 'moneysafe'=>'Moneysafe', 'platba24'=>'Platba 24', 'przelewy24'=>'Przelewy24', 'epaybg'=>'ePay.bg', 'dotpay'=>'Dotpay', 'cashu'=>'cashU', 'ekonto'=>'eKonto', 'enets'=>'eNets', 'paykasa'=>'Paykasa', 'ecard'=>'Ecard', 'boleto'=>'Boleto','itau'=>'Itau','mobifoneprepaidcard'=>'Mobifone','chinaunionpay'=>'China union pay','bradesco'=>'Bradesco','halcash'=>'Halcash','gscash'=>'Gs cash','epaycode'=>'Epaycode','cashixir'=>'Cashixir','faktura'=>'Faktura','teleingreso'=>'Teleingreso','dineromail'=>'Dineromail','banklink'=>'Banklink','paymaster'=>'Paymaster','utel'=>'Utel','svyaznoy'=>'Svyaznoy','abaqoos'=>'Abaqoos','okPay'=>'OkPay','perfectmoney'=>'Perfectmoney','megafon'=>'Megafon','toditocash'=>'Toditocash','servipag'=>'Servipag','redpagos'=>'Redpagos','rapipago'=>'Rapi Pago','pagofacil'=>'Pago Facil','efecty'=>'Efecty','postepay'=>'Postepay','cartasi'=>'CartaSi','rapidtransfer'=>'Rapid transfer','zimpler'=>'Zimpler','multibanco'=>'Multibanco', 'hipay'=>'HiPay', 'jeton'=>'Jeton','gt_collections'=>'GT Collections','nibbs'=>'NIBBS','etranzact'=>'eTranzact');
    asort($payment);
    return $payment;
}

function get_allpayment_services(){
    $payment = array('poli'=>'Polii','dankort'=>'Dankort','webmoney'=>'Webmoney','giropay_'=>'Giropay','postepay'=>'Postepay','ewire'=>'EWire','eps'=>'EPS','firepay'=>'Firepay','ideal'=>'iDeal','qiwi'=>'QIWI','bitcoin'=>'Bitcoin','telegraphictransfer'=>'Telegraphic Transfer','bpay'=>'bpay','boku'=>'Boku','paybox'=>'Paybox','litecoin'=>'Litecoin','dogecoin'=>'Dogecoin','flexepin'=>'Flexepin', 'muchbetter'=>'Muchbetter','avtalegiro'=>'AvtaleGiro', 'bankaxept'=>'BankAxept','interac'=>'Interac','p2p'=>'P2P (Players to player)','ethereum'=>'Ethereum','dash'=>'Dash');
    asort($payment);
    return $payment;
}

function get_allcurrencies(){
    $currencies = array('ALL'=>'Albanian Lek','ARS'=>'Argentine Peso', 'AUD'=>'Australian Dollar', 'BGN'=>'Bulgarian Lev', 'BRL'=>'Brazilian Real', 'BRY'=>'Belarusian Ruble', 'CAD'=>'Canadian Dollar', 'CHF'=>'Swiss Franc', 'CNY'=>'Chinese Yuan', 'CZK'=>'Czech Koruna', 'DKK'=>'Danish Krone', 'EUR'=>'Euro', 'GBP'=>'British Pound', 'HKD'=>'Hong Kong Dollar', 'HUF'=>'Hungarina Forint', 'HRK'=>'Croatian Kuna', 'IDR'=>'Indonesian Rupiah', 'INR'=>'Indian Rupee', 'IQD'=>'Iraqi Dinar', 'IRR'=>'Iranian Rial', 'ISK'=>'Icelandic Krona', 'JPY'=>'Japanese Yen', 'KRW'=>'South Korean Won', 'MKD'=>'FYROM Denar', 'MXN'=>'Mexican Peso', 'NGN'=>'Nigerian Naira', 'NOK'=>'Norwegian Krone', 'PLN'=>'Polish Zloty', 'RON'=>'Romanian New Leu', 'RUB'=>'Russian Ruble', 'RSD'=>'Serbian Dinar', 'SEK'=>'Swedish Krona', 'TND'=>'Tunisian Dinar', 'TRY'=>'Turkish Lira', 'UAH'=>'Ukrainian Hryvnia', 'USD'=>'US Dollar', 'XBT'=>'Bitcoin', 'KRW' => 'Korean Won', 'MYR' => 'Malysian Ringgit', 'NZD' => 'New Zealand Dollar', 'SGD' => 'Singaporean Dollars', 'THB' => 'Thai Baht', 'HRK' => 'Kroatian Kuna', 'ZAR' => 'South African Rand', 'TWD' => 'New Taiwan Dollar','KZT'=>'Kazakhstani','KGS'=>'Kyrgyzstani','MDL'=>'Moldovan Leu','GEL'=>'Georgian Lari','TMT'=>'Turkmenistani Manat','TJS'=>'Tajikistani Somoni','RUP'=>'Transnistria','COP'=>'Colombian Peso','CLP'=>'Chilean Peso','PYG'=>'Guarani Paraguay','PEN'=>'New sol Peru','AMD'=>'Armenian Dram','KGS'=>'Kirgystan Som','AZN'=>'Azarbaijani Manat','UZS'=>'Uzbekistan Som','KZT'=>'Kazakhstan Tenge','CFA'=>'Central Africa Franc', 'KES'=>'Kenyan Shilling');
    asort($currencies);
    return $currencies;
}

function get_allcountries(){
    $countries = array('se'=>'Sweden','al'=>'Albania', 'ar'=>'Argentina', 'au'=>'Australia', 'ba'=>'Bosnia', 'br'=>'Brazil', 'cl'=>'Chile', 'co'=>'Colombia', 'cr'=>'Costa Rica', 'cz'=>'Czech', 'ec'=>'Ecuador', 'sv'=>'El Salvador', 'eg'=>'Egypt', 'ee'=>'Estonia', 'fi'=>'Finland', 'hn'=>'Honduras', 'is'=>'Iceland', 'ie'=>'Ireland', 'kz'=>'Kazakhstan', 'ke'=>'Kenya', 'me'=>'Montenegro', 'nz'=>'New Zealand', 'pa'=>'Panama', 'py'=>'Paraguay', 'pe'=>'Peru', 'sk'=>'Slovakia', 'kr'=>'South Korea', 'tn'=>'Tunisia', 'af'=>'Afghanistan', 'dz'=>'Algeria', 'as'=>'American Samoa', 'ao'=>'Angola', 'ai'=>'Anguilla', 'am'=>'Armenia', 'at'=>'Austria', 'ro'=>'Romania', 'bh'=>'Bahrain', 'bd'=>'Bangladesh', 'by'=>'Belarus', 'bz'=>'Belize', 'bj'=>'Benin', 'bes'=>'Bonaire', 'bw'=>'Botswana', 'bg'=>'Bulgaria', 'bf'=>'Burkina Faso', 'bi'=>'Burundi', 'kh'=>'Cambodia', 'cm'=>'Cameroon', 'ca'=>'Canada', 'cv'=>'Cape Verde', 'cf'=>'Central African Republic', 'td'=>'Chad', 'cn'=>'China', 'hr'=>'Croatia', 'cu'=>'Cuba', 'cuv'=>'Curacao', 'cy'=>'Cyprus', 'dk'=>'Denmark', 'dj'=>'Djibouti', 'cd'=>'DR Congo', 'gq'=>'Equatorial Guinea', 'er'=>'Eritrea', 'et'=>'Ethiopia', 'fr'=>'France', 'mk'=>'FYROM', 'ga'=>'Gabon', 'gm'=>'Gambia', 'ge'=>'Georgia', 'de'=>'Germany', 'gr'=>'Greece', 'gl'=>'Greenland', 'gp'=>'Guadeloupe', 'gu'=>'Guam', 'gn'=>'Guinea', 'gw'=>'Guinea-Bissau', 'gy'=>'Guyana', 'ht'=>'Haiti', 'hk'=>'Hong Kong', 'hu'=>'Hungary', 'in'=>'India', 'id'=>'Indonesia', 'ir'=>'Iran', 'iq'=>'Iraq', 'il'=>'Israel', 'it'=>'Italy', 'ci'=>'Ivory Coast', 'jo'=>'Jordan', 'kw'=>'Kuwait', 'la'=>'Laos', 'lv'=>'Latvia', 'ls'=>'Lesotho', 'lr'=>'Liberia', 'ly'=>'Libya', 'mo'=>'Macao', 'mg'=>'Madagascar', 'mw'=>'Malawi', 'my'=>'Malaysia', 'mv'=>'Maldives', 'ml'=>'Mali', 'mr'=>'Mauritania', 'mx'=>'Mexico', 'fm'=>'Micronesia', 'md'=>'Moldova', 'mc'=>'Monaco', 'mn'=>'Mongolia', 'ms'=>'Montserrat', 'ma'=>'Morocco', 'mz'=>'Mozambique', 'mm'=>'Myanmar', 'np'=>'Nepal', 'nl'=>'Netherlands', 'ne'=>'Niger', 'ng'=>'Nigeria', 'kp'=>'North Korea', 'no'=>'Norway', 'pk'=>'Pakistan', 'ph'=>'Philippines', 'pl'=>'Poland', 'pr'=>'Puerto Rico', 'ru'=>'Russia', 'rw'=>'Rwanda', 'ws'=>'Samoa', 'sa'=>'Saudi Arabia', 'rs'=>'Serbia', 'sg'=>'Singapore', 'si'=>'Slovenia', 'so'=>'Somali', 'za'=>'South Africa', 'es'=>'Spain', 'sd'=>'Sudan', 'sr'=>'Suriname', 'sz'=>'Swaziland', 'ch'=>'Switzerland', 'sy'=>'Syria', 'tw'=>'Taiwan', 'tj'=>'Tajikistan', 'th'=>'Thailand', 'tg'=>'Togo', 'to'=>'Tonga', 'tr'=>'Turkey', 'tm'=>'Turkmenistan', 'ae'=>'UAE', 'ug'=>'Uganda', 'gb'=>'UK', 'ua'=>'Ukraine', 'uy'=>'Uruguay', 'us'=>'USA', 'uz'=>'Uzbekistan', 'vu'=>'Vanuatu', 've'=>'Venezuela', 'ye'=>'Yemen', 'zw'=>'Zimbabwe', 'be'=>'Belgium', 'jp'=>'Japan', 'lb'=>'Lebanon', 'pt'=>'Portugal', 'gf'=>'French Guiana', 'pf'=>'French Polynesia', 'tf'=>'French Southern Territories', 'mq'=>'Martinique', 'yt'=>'Mayotte', 'mp'=>'Northern Mariana Islands', 're'=>'Reunion', 'so'=>'Somalia', 'pm'=>'St Pierre et Miquelon',
        'um'=>'United States Minor Outlying Islands', 'vi'=>'US Virgin Island', 'lt'=>'Lithuania','gh'=>'Ghana');
    asort($countries);
    return $countries;
}

function get_allcountriesJSON(){
    $url = TEMPLATEPATH . '/includes/theme/Settings/countries.json';
    $request = file_get_contents( $url );
    $countries = json_decode( $request );
    foreach ($countries as $country){
        $ret[strtolower($country->Code)] = $country->Name;
    }
    asort($ret);
    return $ret;
}

function get_all_published($type = 'country'){
    $posts = get_posts(array('numberposts'=>-1,'fields' => 'ids', 'post_type' => $type, 'orderby'=>'title', 'order'=>'ASC', 'post_status' => array('publish')));
    return $posts;
}
function get_all_publishedWithNames($type = 'country'){
    $posts = get_posts(array('numberposts'=>-1,'fields' => 'ids', 'post_type' => $type, 'orderby'=>'title', 'order'=>'ASC', 'post_status' => array('publish')));
    foreach($posts as $postID){
        $postRet[$postID]=get_the_title($postID);
    }
    return $postRet;
}
function get_all_posts($type = 'kss_casino')
{
    if($type == 'offer'){
        $posts = get_posts(array('numberposts' => -1, 'fields' => 'ids', 'post_type' => $type, 'post_status' => array('publish', 'draft'),
            'orderby' => 'meta_value_num',
            'meta_key' => 'offer_ends',
            'order' => 'DESC',
        ));
    }else{
        $posts = get_posts(array('numberposts'=>-1,'fields' => 'ids', 'post_type' => $type, 'orderby'=>'title', 'order'=>'ASC', 'post_status' => array('publish','draft')));

    }
    return $posts;
}
function get_all_valid_casino($country = null,$status=null)
{
    $postStatus = $status==null ? ['publish']:['publish', 'draft'];
    $posts = get_posts(array('numberposts'=>-1,'fields' => 'ids', 'post_type' => 'kss_casino', 'orderby'=>'title', 'order'=>'ASC', 'post_status' => $postStatus));
        foreach ($posts as $key=>$postID){
            $current_status = get_post_status ( $postID );
            if(false === $current_status || $current_status == 'trash' || (get_post_meta((int)$postID, 'casino_custom_meta_hidden', true) || get_post_meta((int)$postID, 'casino_custom_meta_flaged', true)) || in_array($country, get_post_meta((int)$postID, 'casino_custom_meta_rest_countries', true))){
                unset($posts[$key]);
            }
        }
    return $posts;
}