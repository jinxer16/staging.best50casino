<?php function scam_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'title' => '',
        ), $atts, 'scam');


    $scamArray = array(
        'Planet 7 Casino' => array('BTK Ltd Casinos','SO15 2DB Southampton,2a / 3a Bedford Place,UK'),
        'OrientXpress Casino' => array('Equinox Dynamic N.V.','E-Commerce Park, Vredenberg, Curacao'),
        '21Grand Casino' => array('Cyberrock Entertainment N.V. ','5 Avraam Antoniou, St. George Court, 2103, Aglantzia, Nicosia, Cyprus'),
        'Burnbet Casino' => array('Yucatan Gaming N.V.','E-Commerce Park Vredenberg, Curacao'),
        'Futuriti Casino' => array('CyberData N.V. Casinos','Landhuis Groot Kwartier Groot Kwartierweg 12 Curaçao'),
        'BetDNA' => array('Operia Corp Limited (UK)','Office 3 Unit R Penfold Works Imperial Way Watford, Herts WD24 4YY UK'),
        '1bet2bet' => array('CyberData N.V. Casinos','Landhuis Groot Kwartier Groot Kwartierweg 12 Curaçao'),
        'Hera Casino' => array('Arm Securities ltd','Arm Securities ltd, Dr.M.J: Hugenholtzweg Z/N, UTS Gebouw, Curacao'),
        'Twist Casino' => array('Global Tech Software','Belize, Suite 102, Ground Floor, Blake Building'),
        'VegasCasino.io' => array('Vegas Royal S.A','Obelisk Plaza 1 km west of the Forum Santa Ana, San José Costa Rica '),
        'VIP Golden Club' => array('Digital Entertainment Services','Imperial Court, 2 Exchange Quay, Manchester, United Kingdom, M5 3EB'),
        'Crystal Spin Casino' => array('Invicta Networks N.V. Casinos','Landhuis Groot Kwartier 12 E-Commerce Park Vredenberg Curacao'),
        'Silver Oak Casino' => array('BTK Ltd Casinos','SO15 2DB Southampton, 2a / 3a Bedford Place, UK'),
        'EuroMoon Casino' => array('Equinox Dynamic N.V.','E-Commerce Park, Vredenberg, Curacao'),
        'Vulkan Casino' => array('CyberData N.V. Casinos','Landhuis Groot Kwartier Groot Kwartierweg 12 Curaçao'),
    );
    $ret = '<style>table#scambookmakerentries_table thead{display: table-header-group !important;}table#scambookmakerentries_table tr {
    display: table-row;
}.newbookmakerentries_table_wrapper table > tbody > tr > td {-webkit-box-shadow: 0 -2px rgba(0,0,0,.075);box-shadow: 0 -2px rgba(0,0,0,.075);border: 0.5px solid #ddd;}.newbookmakerentries_table_wrapper th {
            background-color: #03898f;color: #fff;}.newbookmakerentries_table_wrapper tbody td {padding: 10px 5px !important;}.newbookmakerentries_table_wrapper table  tr  td{text-align:left;}</style>';
    $ret .= '<div class="more_games">';
    $title = $atts['title'] ? $atts['title'] : 'Scam online casinos' ;
    $ret .= '<span class="star shortcode-star text-18">'.$title.'</span>';
    $ret .= '    <div id="avoid" class="dataTables_wrapper no-footer newbookmakerentries_table_wrapper table-responsive tab-pane fade show in active">';
    $ret .= '        <table class="table table-striped text-black table-condensed table-hover  reviewsp dataTable no-footer" id="scambookmakerentries_table" role="grid">';
    $ret .= '            <thead>';
    $ret .= '            <tr role="row">';
    $ret .= '                <th style="width: 60px; padding-left: 8px;" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Bookmaker"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Casino</th>';
    $ret .= '                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Owner" style="width: 55px;"><i class="fa fa-users" aria-hidden="true"></i> Owner</th>';
    $ret .= '                <th class="hidden-xs d-none d-lg-table-cell d-xl-table-cell sorting_disabled" style="width: 200px;" rowspan="1" colspan="1" aria-label="License"><i class="fa fa-map-marker" aria-hidden="true"></i> Address</th>';
    $ret .= '            </tr>';
    $ret .= '            </thead>';
    $ret .= '            <tbody>';
    foreach ($scamArray as $scamName => $scamDetails){
        $ret .= '<tr role="row" class="odd">';
        $ret .= '    <td>'.$scamName.'</td>';
        $ret .= '    <td class=""><div class="year_circle">'.$scamDetails[0].'</div></td>';
        $ret .= '    <td class="hidden-xs d-none d-xl-table-cell d-lg-table-cell ">'.$scamDetails[1].'</td>';
        $ret .= '</tr>';
    }
    $ret .= '            </tbody>';
    $ret .= '        </table>';
    $ret .= '    </div>';
    $ret .= '</div>';
    return $ret;
}

add_shortcode('scam','scam_shortcode'); ?>