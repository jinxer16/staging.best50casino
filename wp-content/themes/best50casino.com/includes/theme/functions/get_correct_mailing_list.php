<?php
function get_correct_mailing_list($iso)
{
    switch ($iso) {
        case 'gb':
            return '4';
            break;
        case 'nl':
            return '6';
            break;
        case 'de':
            return '8';
            break;
        case 'at':
            return '11';
            break;
        case 'es':
            return '13';
            break;
        case 'be':
            return '17';
            break;
        case 'bg':
            return '19';
            break;
        case 'ch':
            return '23';
            break;
        case 'us':
            return '27';
            break;
        case 'cz':
            return '29';
            break;
        case 'cy':
            return '31';
            break;
        case 'fi':
            return '33';
            break;
        case 'fr':
            return '35';
            break;
        case 'ua':
            return '39';
            break;
        case 'sk':
            return '41';
            break;
        case 'pl':
            return '43';
            break;
        case 'se':
            return '55';
            break;
        case 'gr':
            return '61';
            break;
        case 'it':
            return '65';
            break;
        case 'dk':
            return '67';
            break;
        case 'hu':
            return '81';
            break;
        case 'no':
            return '83';
            break;
        case 'ie':
            return '85';
            break;
        case 'hr':
            return '91';
            break;
        case 'lv':
            return '93';
            break;
        case 'is':
            return '98';
            break;
        case 'il':
            return '100';
            break;
        case 'jo':
            return '95';
            break;
        case 'in':
            return '89';
            break;
        case 'mm':
            return '87';
            break;
        case 'gi':
            return '79';
            break;
        case 'eg':
            return '77';
            break;
        case 'cl':
            return '75';
            break;
        case 'bn':
            return '73';
            break;
        case 'bd':
            return '71';
            break;
        case 'qa':
            return '69';
            break;
        case 'ru':
            return '63';
            break;
        case 'id':
            return '59';
            break;
        case 'my':
            return '57';
            break;
        case 'sg':
            return '53';
            break;
        case 'th':
            return '51';
            break;
        case 'br':
            return '49';
            break;
        case 'tr':
            return '47';
            break;
        case 'nz':
            return '45';
            break;
        case 'za':
            return '25';
            break;
        case 'vn':
            return '37';
            break;
        case 'ca':
            return '21';
            break;
        case 'au':
            return '15';
            break;
        default:
            return '3';
    }
}