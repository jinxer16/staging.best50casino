<?php
global $wpalchemy_media_access;
?>

<div class="col-12 p-3 " id="myGroup">
    <div class="d-flex flex-wrap mb-10p w-100 ">
        <h4 class="bg-primary font-weight-bold w-100 text-white p-5p">Title above posts</h4>
        <?php $mb->the_field('title_related'); ?>
        <input type="text"  name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>

    <div class="d-flex flex-wrap mb-10p">
        <label class="bg-primary text-white p-5p">Ids of post you choose this input will be automaticly populated</label>
        <?php $mb->the_field('related_posts'); ?>
        <input type="text" readonly="readonly" id="related_posts" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>

    <h4 class="text-white bg-primary p-1" >Choose specific posts</h4>
    <div class="d-flex flex-wrap justify-content-between w-100">
        <div class="col-4">
            <a class="p-5p  bg-dark w-100 h-100 border-success border text-center text-white align-items-center d-flex flex-column collapsbtn" data-toggle="collapse" aria-expanded="false" href="#news">
                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                Show News
            </a>
        </div>
        <div class="col-4">
            <a class="p-5p bg-dark w-100 h-100 border-success border text-center text-white align-items-center d-flex flex-column collapsbtn" data-toggle="collapse" aria-expanded="false" href="#guides">
                <i class="fa fa-book" aria-hidden="true"></i>
                Show Guides
            </a>
        </div>
        <div class="col-4 mt-5p">
            <a class="p-5p bg-dark w-100 h-100 border-success border text-center text-white align-items-center d-flex flex-column collapsbtn" data-toggle="collapse" aria-expanded="false" href="#pages">
                <i class="fa fa-file" aria-hidden="true"></i>
                Show Pages
            </a>
        </div>
        <div class="col-4 mt-5p">
            <a class="p-5p bg-dark w-100 h-100 border-success border text-center text-white align-items-center d-flex flex-column collapsbtn" data-toggle="collapse" aria-expanded="false" href="#payments">
                <i class="fa fa-money" aria-hidden="true"></i>
                Show  Payments
            </a>
        </div>
        <div class="col-4 mt-5p">
            <a class="p-5p w-100 bg-dark h-100 border-success border text-center text-white align-items-center d-flex flex-column collapsbtn" data-toggle="collapse" aria-expanded="false" href="#softwares">
                <i class="fa fa-grav" aria-hidden="true"></i>
                Show Softwares
            </a>
        </div>
        <div class="col-4 mt-5p">
            <a class="p-5p w-100 bg-dark h-100 border-success border text-center text-white align-items-center d-flex flex-column collapsbtn" data-toggle="collapse" aria-expanded="false" href="#offers">
                <i class="fa fa-credit-card" aria-hidden="true"></i>
                Show Offers
            </a>
        </div>
    </div>

    <div class="multicheck" id="" data-attribute="post_id">
        <div class="panel-collapse collapse w-100" id="news">
            <span class="bg-primary text-white pt-10p pb-10p mt-10p mb-10p font-weight-bold pl-10p w-100 d-block">News</span>
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
            <span class="bg-primary text-white pt-10p pb-10p mt-10p mb-10p font-weight-bold pl-10p w-100 d-block">Guides</span>
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
            <span class="bg-primary text-white pt-10p pb-10p mt-10p mb-10p font-weight-bold pl-10p w-100 d-block">Pages</span>
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
            <span class="bg-primary text-white pt-10p pb-10p mt-10p mb-10p font-weight-bold pl-10p w-100 d-block">Payments</span>
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
            <span class="bg-primary text-white pt-10p pb-10p mt-10p mb-10p font-weight-bold pl-10p w-100 d-block">Softwares</span>
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
            <span class="bg-primary text-white pt-10p pb-10p mt-10p mb-10p font-weight-bold pl-10p w-100 d-block">Offers</span>
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

        updateCustomShortcode = function(id=''){
            var attrs = '';
            jQuery('#myGroup .multicheck').each(function(){
                mVal = jQuery(this).find('input[type="checkbox"]:checked').map(function () {return this.value;}).get().join(",");
                if(mVal !== '') attrs = attrs + mVal;
            });
            jQuery('input#related_posts').val(attrs);
        }

        jQuery('#myGroup input[type="checkbox"]').change(updateCustomShortcode);
        updateCustomShortcode();
    });

</script>