<?php $casino_pros = explode(',', get_post_meta($post->ID, 'casino_custom_meta_pros', true));
$casino_cons = explode(',', get_post_meta($post->ID, 'casino_custom_meta_why_not_play', true));?>
<div class="widget2 mt-0 mb-0">
    <div class="d-flex flex-wrap bg-dark ">
        <span class="w-75 text-left text-whitte p-10p font-weight-bold">Pros</span>
        <span class="w-25 d-flex" style="background-color:#1f8e23;clip-path: polygon(39% 0, 100% 0, 100% 100%, 0% 100%);">
              <i class="fa fa-plus m-auto text-dark pl-15p text-center"></i>
            </span>
    </div>
    <div class="widget2-body p-10p">
        <ul class="billboard-list list-typenone text-dark w-80 mx-auto p-0 position-relative mt-5p mb-5p">
            <?php foreach ($casino_pros as $pros) { ?>
                <li style="border-bottom: 1px solid #7d7b7b8c;" class="font-weight-bold"><i class="fa fa-plus text-success pr-5p text-center"></i> <?=$pros?></li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="widget2 mt-0 mb-0">
    <div class="d-flex flex-wrap bg-dark ">
        <span class="w-75 text-left text-whitte p-10p font-weight-bold">Cons</span>
        <span class="w-25 d-flex" style="background-color:#b50255;clip-path: polygon(39% 0, 100% 0, 100% 100%, 0% 100%);">
              <i class="fa fa-minus m-auto text-whitte pl-15p text-center"></i>
            </span>
    </div>
    <div class="widget2-body p-10p">
        <ul class="cons-list list-typenone text-dark w-80 mx-auto p-0 position-relative mt-5p mb-5p">
            <?php foreach ($casino_cons as $pros) { ?>
                <li style="border-bottom: 1px solid #7d7b7b8c;" class="font-weight-bold"><i class="fa fa-minus text-danger pr-5p text-center"></i> <?=$pros?></li>
            <?php } ?>
        </ul>
    </div>
</div>