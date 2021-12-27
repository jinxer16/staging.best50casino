<?php
function MiniRoulette(){
    ob_start();
    ?>
    <div class="giftwrap" style="z-index: 999;">
        <a class="showletter d-inline-block" style="text-decoration: none;" data-toggle="collapse" href="#fortwheel" role="button" aria-expanded="false" aria-controls="fortwheel">
            <?php
            if (!wp_is_mobile()){
                ?>
                <span class="old-ribbon" style="z-index: 0;">Spin to win</span>
                <?php
            }
            ?>
            <svg id="Capa_1" class="position-relative wheeldemo" style="z-index: 4;" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 297.5 297.62" width="75" height="75">
                <defs><style>.cls-1{fill:#ffcd00;}.cls-2{fill:#333;}.cls-3{fill:#ffd33f;}.cls-4{fill:#3d454d;}.cls-5{fill:#faa41b;}.cls-6{fill:#eab42d;}.cls-7{fill:#f7c800;}.cls-8{fill:#f08015;}.cls-9{fill:#f4c500;}.cls-10{fill:#30373d;}.cls-11{fill:#282f35;}</style></defs>
                <title>luck</title>
                <path class="cls-1" d="M193.2,354.1h89.2l14.9,29.7H178.4Z" transform="translate(-89.1 -91.18)"/>
                <circle class="cls-2" cx="148.7" cy="139.02" r="133.8"/><path class="cls-2" d="M310.5,117.8a133.78,133.78,0,0,1-185,185,133.81,133.81,0,1,0,185-185Z" transform="translate(-89.1 -91.18)"/><circle class="cls-3" cx="148.7" cy="139.02" r="114"/><path class="cls-4" d="M281.4,124.8a113.85,113.85,0,0,0-87.3,0l43.6,105.3Z" transform="translate(-89.1 -91.18)"/><path class="cls-5" d="M194.2,124.8a114.42,114.42,0,0,0-61.7,61.7l105.3,43.6Z" transform="translate(-89.1 -91.18)"/><path class="cls-1" d="M132.5,186.6a113.85,113.85,0,0,0,0,87.3l105.3-43.6Z" transform="translate(-89.1 -91.18)"/><path class="cls-4" d="M94.1,195.5v69.4l54.5-34.7Z" transform="translate(-89.1 -91.18)"/><path class="cls-1" d="M343.2,186.6,237.9,230.2l105.3,43.6a114.51,114.51,0,0,0,0-87.2Z" transform="translate(-89.1 -91.18)"/><path class="cls-6" d="M343.2,186.6,332,191.2a133.12,133.12,0,0,1-20,69.7l31.2,12.9a114.51,114.51,0,0,0,0-87.2Z" transform="translate(-89.1 -91.18)"/><path class="cls-7" d="M343.2,186.6a114.42,114.42,0,0,0-61.7-61.7L237.9,230.2Z" transform="translate(-89.1 -91.18)"/><path class="cls-8" d="M343.2,186.6a112.72,112.72,0,0,0-14.3-24.7,131.41,131.41,0,0,1,3.1,28.7v.6Z" transform="translate(-89.1 -91.18)"/><path class="cls-1" d="M194.2,335.5a113.85,113.85,0,0,0,87.3,0L237.9,230.2Z" transform="translate(-89.1 -91.18)"/><path class="cls-9" d="M198.8,324.3l-4.6,11.2a113.85,113.85,0,0,0,87.3,0l-12.9-31.2a132.55,132.55,0,0,1-69.8,20Z" transform="translate(-89.1 -91.18)"/><path class="cls-4" d="M281.4,335.5a114.42,114.42,0,0,0,61.7-61.7L237.8,230.2Z" transform="translate(-89.1 -91.18)"/><path class="cls-10" d="M312,260.9a134.3,134.3,0,0,1-43.4,43.4l12.9,31.2a114.42,114.42,0,0,0,61.7-61.7Z" transform="translate(-89.1 -91.18)"/><path class="cls-4" d="M132.5,273.8a114.42,114.42,0,0,0,61.7,61.7l43.6-105.3Z" transform="translate(-89.1 -91.18)"/><path class="cls-11" d="M198.2,324.3a132.08,132.08,0,0,1-28.7-3.1,112.72,112.72,0,0,0,24.7,14.3l4.6-11.2Z" transform="translate(-89.1 -91.18)"/><path d="M237.8,91.4A139.16,139.16,0,0,0,103.5,195.6l-6.8-4.3a4.81,4.81,0,0,0-6.8,1.6,5,5,0,0,0-.8,2.6v69.4a5,5,0,0,0,5,5,5.3,5.3,0,0,0,2.7-.8l6.8-4.3a139.23,139.23,0,0,0,81.9,93.8l-11.6,23.1a5,5,0,0,0,2.2,6.6,5.45,5.45,0,0,0,2.2.5H297.2a5,5,0,0,0,5-4.9,5.45,5.45,0,0,0-.5-2.2l-11.5-23A138.8,138.8,0,0,0,237.8,91.4ZM99.1,204.5l40.3,25.7L99.1,255.9Zm129.6,34.8-37.1,89.5a110.18,110.18,0,0,1-52.4-52.4Zm9.1,3.8,37.1,89.6a108.15,108.15,0,0,1-74.2-.1Zm46.3,85.8L247,239.3l89.6,37.1a110.16,110.16,0,0,1-52.5,52.5Zm56.3-61.6-89.6-37.1,89.6-37.1a109.92,109.92,0,0,1,0,74.2ZM247,221l37.1-89.6a110.16,110.16,0,0,1,52.5,52.5Zm-9.2-3.8-37.1-89.5a108.15,108.15,0,0,1,74.2-.1Zm-46.2-85.7L228.7,221l-89.5-37.1A110.18,110.18,0,0,1,191.6,131.5Zm-56.2,61.6,89.5,37.1-89.5,37.1a109.72,109.72,0,0,1-5.1-19.5l21-13.4a4.89,4.89,0,0,0,1.5-6.8,5.36,5.36,0,0,0-1.5-1.5l-21-13.4a108.57,108.57,0,0,1,5.1-19.6ZM289.3,378.9H186.4l8.5-16.9a137,137,0,0,0,86.1.1ZM237.8,359a129.16,129.16,0,0,1-125.5-99.9l8.9-5.7a118.94,118.94,0,1,0,0-46.5l-8.9-5.7A128.81,128.81,0,1,1,237.8,359Z" transform="translate(-89.1 -91.18)"/></svg>

            <?php
            if (wp_is_mobile()){
                ?>
                <div class="GiftButton_arrows__3rabW">
                    <div class="Icon_root__1cMWI GiftButton_doubleArrows__31PkK">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 37 29" class="Icon_icon__2Th0s"><path d="M20.596.568a2.08 2.08 0 012.876 0l12.942 12.54a1.927 1.927 0 010 2.786L23.472 28.433a2.08 2.08 0 01-2.876 0 1.927 1.927 0 010-2.787L32.1 14.5 20.596 3.355a1.927 1.927 0 010-2.787zm-20 0a2.08 2.08 0 012.876 0l12.942 12.54a1.927 1.927 0 010 2.786L3.472 28.433a2.08 2.08 0 01-2.876 0 1.927 1.927 0 010-2.787L12.1 14.5.596 3.355a1.927 1.927 0 010-2.787z"></path></svg>
                    </div>
                </div>
                <?php
            }
            ?>
        </a>
    </div>

    <div id="fortwheel" class="collapse fowheel">
        <a class="position-absolute closewheel" style="right: 0;  border-radius: 50%;top: -6%; padding: 5px;padding-left: 6px;line-height: 1; width: 25px;background: #e5b800;height: 25px;" data-toggle="collapse" href="#fortwheel" role="button" aria-expanded="false" aria-controls="fortwheel"><i class="fa fa-close text-dark"></i></a>
        <style type="text/css"><?php include get_template_directory().'/includes/theme/functions/mini-roulette/css/roulette.css'; ?></style>
        <div id="wheel" class="w-100 position-relative">
            <div class="position-relative">
                <div class="pinwheel">
                    <img class="" id="pin" src="<?php echo get_stylesheet_directory_uri()?>/includes/theme/functions/wheel-of-fortune/assets/images/pin.svg"/>
                </div>
                <div class="circle-center-wheel"></div>
                <canvas id="canvas" class="m-auto d-block" width="550" height="550"></canvas>
            </div>
        </div>

    </div>

    <script defer type="text/javascript" src="<?php echo get_template_directory_uri();  ?>/includes/theme/functions/mini-roulette/js/roulette.js?v=0.1"></script>

    <?php
    return ob_get_clean();
}
