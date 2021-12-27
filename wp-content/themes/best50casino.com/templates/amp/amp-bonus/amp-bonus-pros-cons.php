<div class="widget2 mt-0 mb-0">
    <div class="d-flex flex-wrap bg-dark ">
        <span class="w-70 text-left font-weight-bold text-whitte p-10p">Pros</span>
        <span class="w-30 d-flex" style="background-color:#1f8e23;clip-path: polygon(39% 0, 100% 0, 100% 100%, 0% 100%);">
              <i class="fa fa-plus m-auto text-dark pl-15p text-center"></i>
            </span>
    </div>
    <div class="widget2-body p-10p">
        <ul class="billboard-list list-typenone text-dark w-80 mx-auto p-0 position-relative mt-5p mb-5p">
            <?php foreach ($casino_pros as $pros) { ?>
                <li style="border-bottom: 1px solid #7d7b7b8c;" class="font-weight-bold"><i class="fa fa-plus text-success pr-5p text-center"></i><?php echo $pros; ?></li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="widget2 mt-0 mb-0">
    <div class="d-flex flex-wrap bg-dark ">
        <span class="w-70 font-weight-bold text-left text-whitte p-10p">Cons</span>
        <span class="w-30 d-flex" style="background-color:#b50255;clip-path: polygon(39% 0, 100% 0, 100% 100%, 0% 100%);">
              <i class="fa fa-minus m-auto text-whitte pl-15p text-center"></i>
            </span>
    </div>
    <div class="widget2-body p-10p">
        <ul class="cons-list list-typenone text-dark w-80 mx-auto p-0 position-relative mt-5p mb-5p">
            <?php foreach ($casino_cons as $pros) { ?>
                <li style="border-bottom: 1px solid #7d7b7b8c;" class="font-weight-bold"><i class="fa fa-minus text-danger pr-5p text-center"></i><?php echo $pros; ?></li>
            <?php } ?>
        </ul>
    </div>
</div>
<amp-list  height="60" layout="fixed-height" credentials="include" src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $bookieid; ?>" binding="no">
    <template type="amp-mustache">
<div class="p-10p w-100 bg-dark">
    <a class="btn bumper btn btn bg-yellow text-17 w-70 text-decoration-none d-block text-center mx-auto p-7p btn_large text-dark roundbutton font-weight-bold bumper" style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"  data-casinoid="<?php echo $post->ID; ?>" data-country="{{0.ISO}}"  href="{{0.aff_bo}}" rel="nofollow" target="_blank">
       <span>Visit</span>
    </a>
</div>
    </template>
</amp-list>