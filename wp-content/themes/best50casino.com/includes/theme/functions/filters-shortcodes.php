<?php
function customShift($array, $id,$currentPostID){
    foreach($array as $key => $val){
        $url = parse_url($val['url']);
        // loop all elements
        if($url['path'] == $id || in_array($currentPostID,$val['mySubFields'])){
            // check for id $id
            unset($array[$key]);         // unset the $array with id $id
            array_unshift($array, $val); // unshift the array with $val to push in the beginning of array
            return $array;               // return new $array
        }
    }
}

function filters_shortcodes ($tabsID,$atts,$postid,$containerid) {
    ob_start();
    $width_fisrt_filters='';
    $padding_first_filter='';
    $width_second_filters='';
    $padding_second_filter='';

    $uri =  $_SERVER['REQUEST_URI'];
    global $post;


    if (!get_post_meta($postid, 'posts_no_sidebar' ,true)){
        $width_fisrt_filters = 'w-22 side-on-filter filters';
        $width_second_filters = 'side-on-second-filter filters';
    }else{
        $width_fisrt_filters = 'w-17 w-sm-25 no-side-filters filters';
        $width_second_filters = 'no-side-second-filters filters';
    }
    $tabsID = $tabsID ? $tabsID : 14344;
    $mainTabsID = get_post_meta($tabsID,'_tabs_info_fields',true);
    foreach($mainTabsID as $mainTabID){
        $mySubfieldsIDS=[];
        $taboula = get_post_meta($tabsID,$mainTabID,true);
        foreach ($taboula['subfields'] as $tsaboulakia){

            $mySubfieldsIDS[]=$tsaboulakia["page"];
        }
        $tabsArray[]=[
            'imgs' => $taboula['icon'],
            'text' => $taboula['title'],
            'url' => get_the_permalink($taboula['page']),
            'filters' => $taboula['subfields'],
            'ids' => $taboula['page'],
            'mySubFields'=>$mySubfieldsIDS
        ];
    }
    if ( is_front_page()) {
        $new = $tabsArray;
    }else{
        $new = customShift($tabsArray,$uri,$post->ID);
    }
    $shortCodeAtts = '';
    foreach(array_filter($atts) as $key=>$value){
        $shortCodeAtts .= 'data-'.$key.'="'.$value.'"';
    }
    ?>
<div class="w-100 d-flex flex-wrap justify-content-space-between mb-5p" id="filterTabsID">
    <?php
    if(!empty($new)){
         $supply = $new;
    }else{
         $supply = $tabsArray;
    }
    foreach ($supply as $row) {
        if ($row['ids'] == $post->ID || in_array($post->ID,$row['mySubFields'])){
            $classactive =' bg-active-filter';
        }else{
            $classactive =' non-active-filter';
        }
        ?>
        <a href="<?=$row['url']?>" class="<?=$width_fisrt_filters.$classactive?> d-flex rounded-10 flex-column cursor-point text-decoration-none align-items-center text-center filters-shadow">
            <img class="img-fluid d-block mx-auto" loading="lazy" width="40" height="40" style="width: 40px;" src="<?=$row['imgs']?>">
            <span class="text-16 text-sm-11 font-weight-bold" style="color: #5e5e5e;">
                    <?=$row['text']?>
                </span>
        </a>
        <?php

    }
    ?>
</div>
    <?php
    if(!empty($new)){
        $single = array_slice($new, 0, 1);
    }else{
        $single = array_slice($tabsArray, 0, 1);
    }
    foreach ($single as $seconfilters){
        $anchors = $seconfilters['filters'];
    }
    if (!empty($anchors)){
    ?>
<div class="w-100 p-10p p-sm-5p filter-two d-flex flex-xl-row flex-lg-row flex-wrap flex-sm-wrap">
            <div class="align-self-center findby d-none d-lg-block d-xl-block">
                 <span class="font-weight-bold align-self-center w-sm-100 pr-12p pr-sm-0p">
                Find Casino by:
            </span>
            </div>
            <div class="box-filters w-sm-100">
                <div class="d-flex flex-wrap w-100 align-items-center justify-content-sm-center justify-content-center justify-content-lg-start justify-content-xl-start">
                    <?php
                    foreach ($single as $seconfilters){
                        $anchors = $seconfilters['filters'];
                        foreach ($anchors as $filters){
                            ?>
                            <div class="ml-5p mr-5p d-flex sorting-buttons" style="">
                                <?php if(isset($filters['page'])){
                                    $url = parse_url(get_the_permalink($filters['page']));
                                    if ($uri == $url['path']){
                                        $class='bg-active-filter';
                                    }else{
                                        $class='bg-white';
                                    }
                                    ?>
                                <a href="<?=get_the_permalink($filters['page'])?>" class="<?=$class?> white-no-wrap anchor-tab rounded-20 tabaki cursor-point pl-3p pr-3p pt-10p pb-10p font-weight-bold text-center <?=$width_second_filters?>  text-decoration-none text-muted  shadow-pills">
                                    <?=$filters['title'];?>
                                </a>
                                <?php }else{ ?>
                                    <p class="white-no-wrap bg-white rounded-20 cursor-point pl-5p pr-5p pt-10p pb-10p mb-0p tabaki font-weight-bold text-center <?=$width_second_filters?> text-decoration-none text-muted shadow-pills"
                                       onclick="sortTableBy(this,'<?=$filters['sort']?>','<?=$GLOBALS['countryISO']?>')" <?=$shortCodeAtts?> data-contid="<?=$containerid?>" data-sortorder="DESC">
                                        <?=$filters['title'];?>
                                    </p>
                                    <i class="fas fa-sort d-lg-inline-block d-none d-xl-inline-block cursor-point text-muted pl-7p align-self-center arroow"
                                        <?=$shortCodeAtts?> onclick="sortTableBy(this,'<?=$filters['sort']?>','<?=$GLOBALS['countryISO']?>')" data-contid="<?=$containerid?>" data-sortorder="DESC"></i>
                                <?php } ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
            </div>
          </div>
 </div>
        <?php
    }
    ?>

<?php
    return ob_get_clean();
}
?>