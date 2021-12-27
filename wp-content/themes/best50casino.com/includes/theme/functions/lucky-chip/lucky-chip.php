<?php
function luckyChip(){
    ob_start();
    ?>

    <div class="giftwrap" style="z-index: 999;">
        <a class="showletter d-inline-block" style="text-decoration: none;" data-toggle="collapse" href="#chiplucky" role="button" aria-expanded="false" aria-controls="chiplucky">
            <?php
            if (!wp_is_mobile()){
                ?>
                <span class="old-ribbon" style="z-index: 0;">Flip me</span>
                <?php
            }
            ?>
            <img class="position-relative" width="65" height="65" src="<?php echo get_stylesheet_directory_uri()?>/includes/theme/functions/lucky-chip/assets/images/chipone.svg"/>
        </a>
    </div>

    <div id="chiplucky" class="collapse fowheel">
        <a class="position-absolute closewheel" style="right: 0;  border-radius: 50%;top: -6%; padding: 5px;padding-left: 6px;line-height: 1; width: 25px;background: #e5b800;height: 25px;" data-toggle="collapse" href="#chiplucky" role="button" aria-expanded="false" aria-controls="chiplucky"><i class="fa fa-close text-dark"></i></a>
        <style type="text/css"><?php include  get_template_directory().'/includes/theme/functions/lucky-chip/assets/css/lucky-chip.css'; ?></style>

        <div id="allchips" class="position-relative d-flex flex-wrap justify-content-center">
            <div id="fireworks" class="position-relative">
            <div class="title">Congratulations 🎉</div>
            <div class="firework-1"></div>
            <div class="firework-2"></div>
            <div class="firework-3"></div>
            <div class="firework-4"></div>
            <div class="firework-5"></div>
            <div class="firework-6"></div>
            <div class="firework-7"></div>
            <div class="firework-8"></div>
            <div class="firework-9"></div>
            <div class="firework-10"></div>
            <div class="firework-11"></div>
            <div class="firework-12"></div>
            <div class="firework-13"></div>
            <div class="firework-14"></div>
            <div class="firework-15"></div>
            </div>

            <span class="place-offer w-100" id="placeoffer"></span>

            <div class="d-flex flex-wrap content-chip w-100" id="chipchoose">
            <span class="w-100 font-weight-bold d-block mb-20p text-center text-white" style="font-size: 25px;"> CHOOSE THE CORRECT <span class="text-secondary">CHIP</span> AND WIN</span>
            <a class="chips w-30 m-10p" data-offer="Testing" data-link="https://localhost/dev.best50casino.com/">
                <img class="" id="" src="<?php echo get_stylesheet_directory_uri()?>/includes/theme/functions/lucky-chip/assets/images/chiptwo.svg"/>
            </a>
            <a class="chips w-30 m-10p" data-offer="Testing" data-link="https://localhost/dev.best50casino.com/">
                <img class="" id="" src="<?php echo get_stylesheet_directory_uri()?>/includes/theme/functions/lucky-chip/assets/images/chipone.svg"/>
            </a>
            <a class="chips w-30 m-10p" data-offer="Testing" data-link="https://localhost/dev.best50casino.com/">
                <img class="img-fluid" id="" src="<?php echo get_stylesheet_directory_uri()?>/includes/theme/functions/lucky-chip/assets/images/chipthree.svg"/>
            </a>
            </div>


        </div>

    </div>


    <script defer type="text/javascript" src="<?php echo get_template_directory_uri();  ?>/includes/theme/functions/lucky-chip/assets/js/lucky-chip.js?v=0.5"></script>
    <?php
    return ob_get_clean();
}
