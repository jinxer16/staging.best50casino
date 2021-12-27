<?php global $wpalchemy_media_access;?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


<div class="d-flex flex-wrap form-table">
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Table Layout</h4>
        <?php $layout = [
            'boxes' => 'Boxes',
            'rows' => 'Rows',];?>
        <p class="mb-0">
            <?php $mb->the_field('layout'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="layout">
                <?php foreach ($layout as $key=>$value){ ?>
                    <option value="<?=$key?>" <?php $mb->the_select_state($key); ?>><?=$value?></option>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Type of Posts </h4>
        <?php $layout = [
            'any' => 'Any',
            'guides' => 'Guides',
            'page' => 'Pages',
            'news' => 'News',
            'payments' => 'Payment Methods',
            'softwares' => 'Providers'];
        ?>
        <p class="mb-0">
            <?php $mb->the_field('type'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="type">
                <?php foreach ($layout as $key=>$value){ ?>
                    <option value="<?=$key?>" <?php $mb->the_select_state($key); ?>><?=$value?></option>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">Limit</h4>
        <p class="mb-0">
            <?php $mb->the_field('limit'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" data-attribute="limit"/>
        </p>
    </div>
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Shortcode Title</h4>
        <p class="mb-0">
            <?php $mb->the_field('title'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" data-attribute="title"/>
        </p>
    </div>

    <div class="col-12 p-3 " id="myGroup">
        <h4 class="text-white bg-primary p-1" >Choose specific posts</h4>
        <div class="d-flex flex-wrap justify-content-between w-100">
            <div class="col-4">
                <a class="p-5p  bg-dark w-100 border-success border text-center text-white align-items-center d-flex flex-column collapsbtn" aria-expanded="false" data-toggle="collapse" href="#news">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                   Show News
                </a>
            </div>
            <div class="col-4">
                <a class="p-5p bg-dark w-100 border-success border text-center text-white align-items-center d-flex flex-column collapsbtn" aria-expanded="false" data-toggle="collapse" href="#guides">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    Show Guides
                </a>
            </div>
            <div class="col-4 mt-5p">
                <a class="p-5p bg-dark w-100 border-success border text-center text-white align-items-center d-flex flex-column collapsbtn" aria-expanded="false" data-toggle="collapse" href="#pages">
                    <i class="fa fa-file" aria-hidden="true"></i>
                    Show Pages
                </a>
            </div>
            <div class="col-4 mt-5p">
                <a class="p-5p bg-dark w-100 border-success border text-center text-white align-items-center d-flex flex-column collapsbtn" aria-expanded="false" data-toggle="collapse" href="#payments">
                    <i class="fa fa-money" aria-hidden="true"></i>
                    Show  Payments
                </a>
            </div>
            <div class="col-4 mt-5p">
                <a class="p-5p w-100 bg-dark border-success border text-center text-white align-items-center d-flex flex-column collapsbtn" aria-expanded="false" data-toggle="collapse" href="#softwares">
                    <i class="fa fa-grav" aria-hidden="true"></i>
                    Show Softwares
                </a>
            </div>
            <div class="col-4 mt-5p">
                <a class="p-5p w-100 bg-dark border-success border text-center text-white align-items-center d-flex flex-column collapsbtn" aria-expanded="false" data-toggle="collapse" href="#offers">
                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                    Show Offers
                </a>
            </div>
        </div>

        <div class="multicheck" id="" data-attribute="post_id">
            <div class="panel-collapse collapse w-100" id="news">
            <span class="bg-dark text-white pt-10p pb-10p mt-10p mb-10p font-weight-bold pl-10p w-100 d-block">News</span>
            <?php $mb->the_field('post_id', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <div class="d-flex flex-wrap ">
                <?php
                $payments= get_all_published(['kss_news']);
                foreach ($payments as $bm) { ?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?=get_the_title($bm)?></label>
                    </p>
                <?php } ?>
            </div>
            </div>
            <div class="panel-collapse collapse w-100" id="guides">
                <span class="bg-dark text-white pt-10p pb-10p mt-10p mb-10p font-weight-bold pl-10p w-100 d-block">Guides</span>
                <div class="d-flex flex-wrap ">
                    <?php
                    $payments= get_all_published(['kss_guides']);
                    foreach ($payments as $bm) { ?>
                        <p class="mb-1 d-flex mr-1" style="width:12%">
                            <input type="checkbox" name="<?php $mb->the_name(); ?>"
                                   value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?=get_the_title($bm)?></label>
                        </p>
                    <?php } ?>
                </div>
            </div>

            <div class="panel-collapse collapse w-100" id="pages">
                <span class="bg-dark text-white pt-10p pb-10p mt-10p mb-10p font-weight-bold pl-10p w-100 d-block">Pages</span>
                <div class="d-flex flex-wrap ">
                    <?php
                    $payments= get_all_published(['page']);
                    foreach ($payments as $bm) { ?>
                        <p class="mb-1 d-flex mr-1" style="width:12%">
                            <input type="checkbox" name="<?php $mb->the_name(); ?>"
                                   value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?=get_the_title($bm)?></label>
                        </p>
                    <?php } ?>
                </div>
            </div>


            <div class="panel-collapse collapse w-100" id="payments">
                <span class="bg-dark text-white pt-10p pb-10p mt-10p mb-10p font-weight-bold pl-10p w-100 d-block">Payments</span>
                <div class="d-flex flex-wrap ">
                    <?php
                    $payments= get_all_published(['kss_transactions']);
                    foreach ($payments as $bm) { ?>
                        <p class="mb-1 d-flex mr-1" style="width:12%">
                            <input type="checkbox" name="<?php $mb->the_name(); ?>"
                                   value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?=get_the_title($bm)?></label>
                        </p>
                    <?php } ?>
                </div>
            </div>


            <div class="panel-collapse collapse w-100" id="softwares">
                <span class="bg-dark text-white pt-10p pb-10p mt-10p mb-10p font-weight-bold pl-10p w-100 d-block">Softwares</span>
                <div class="d-flex flex-wrap ">
                    <?php
                    $payments= get_all_published(['kss_softwares']);
                    foreach ($payments as $bm) { ?>
                        <p class="mb-1 d-flex mr-1" style="width:12%">
                            <input type="checkbox" name="<?php $mb->the_name(); ?>"
                                   value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?=get_the_title($bm)?></label>
                        </p>
                    <?php } ?>
                </div>
            </div>


            <div class="panel-collapse collapse w-100" id="offers">
                <span class="bg-dark text-white pt-10p pb-10p mt-10p mb-10p font-weight-bold pl-10p w-100 d-block">Offers</span>
                <div class="d-flex flex-wrap ">
                    <?php
                    $payments= get_all_published(['bc_offers']);
                    foreach ($payments as $bm) { ?>
                        <p class="mb-1 d-flex mr-1" style="width:12%">
                            <input type="checkbox" name="<?php $mb->the_name(); ?>"
                                   value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?=get_the_title($bm)?></label>
                        </p>
                    <?php } ?>
                </div>
            </div>
        </div>



    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(".collapsbtn").click(function() {  //use a class, since your ID gets mangled
        if( jQuery(this).attr('aria-expanded') === 'false'){
            jQuery(this).addClass("bg-primary");      //add the class to the clicked element
            jQuery(this).removeClass("bg-dark");      //add the class to the clicked element
            }else{
                jQuery(this).addClass("bg-dark");      //add the class to the clicked element
                jQuery(this).removeClass("bg-primary");      //add the class to the clicked element
            }
    });
    });
</script>