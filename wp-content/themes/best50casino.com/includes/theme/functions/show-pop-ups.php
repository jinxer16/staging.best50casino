<?php
function ShowPopups(){
    ob_start();
    ?>
    <style>
        .email-box__input {
            color: #000000;
            display: block;
            border-radius: 5px;
            border: 1px solid #FFF;
            font-size: 17px;
            padding: 10px;
        }
        .modaloffer{
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 2000; /* Sit on top */
            transform: translate(-50%, -50%);
            overflow: visible;
            border-radius: 10px;
        }
        .modalsubscribe {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 2000; /* Sit on top */
            transform: translate(-50%, -50%);
            overflow: visible;
            background: linear-gradient(90deg, #212d33 0%, #212d33 35%, #03898f 100%);
        }
        .modalsubscribe .close,.modaloffer .close {
            float: right;
            font-weight: bold;
            position: absolute;
            opacity: 1 !important;
        }

        .modalsubscribe .close:hover,.modaloffer .close:hover,
        .modalsubscribe .close:focus,.modaloffer .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-heading-left{
            display: inline-block;
            line-height: 1.1;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            background: rgba(0,0,0,0.0001);
            position: relative;
            text-align: left;
            height: auto;
            font-weight: 600 !important;
            border-style: solid;
            border-width: 3px;
            -webkit-border-image: -webkit-linear-gradient(to left, rgba(255,255,255,0) 1%, #ff7e2d 100%) 0 0 100% 0/0 0 3px 0 stretch;
            -moz-border-image: -moz-linear-gradient(to left, rgba(255,255,255,0) 1%, #ff7e2d 100%) 0 0 100% 0/0 0 3px 0 stretch;
            -o-border-image: -o-linear-gradient(to left, rgba(255,255,255,0) 1%, #ff7e2d 100%) 0 0 100% 0/0 0 3px 0 stretch;
            border-image: linear-gradient(to left, rgba(255,255,255,0) 1%, #ff7e2d 100%) 0 0 100% 0/0 0 3px 0 stretch;
        }

        @media screen and (min-width: 1400px) {
            #customCheck1,#NoWant{
                width: 20px;
                height: 18px;
            }
            .modaloffer .imgagef{
                left: 44% !important;
            }
            .imgagef {
                text-align: center;
                position: absolute;
                left: 48%;
                /* top: 14%; */
                bottom: -5px;
                z-index: 3000;
                padding: 10px;
                color: white;
            }

            .email-box__input{
                width: 50%;
                height: 50px;
            }
            .headingcont{
                font-size: 27px;
            }
            .modaloffer .close{
                font-size: 33px;
                right: 8px;
                top: 0;
            }
            .modaloffer{
                left: 50%;
                min-height: 220px;
                top: 50%;
            }
            .modalsubscribe .close,.modaloffer .close {
                font-size: 28px;
                right: 6px;
                top: -4px;
            }
            .modalsubscribe{
                width: 50%;
                left: 50%;
                min-height: 215px;
                top: 50%;
                padding: 16px;
            }
        }

        @media screen and (min-width: 1280px) and (max-width: 1366px){
            #customCheck1,#NoWant{
                width: 20px;
                height: 18px;
            }
            .email-box__input{
                width: 60%;
                height: 45px;
            }
            .imgagef {
                text-align: center;
                position: absolute;
                left: 48%;
                /* top: 20px; */
                bottom: -12px !important;
                z-index: 3000;
                padding: 8px;
                color: white;
            }
            .imgagef img{
                height: 54px !important;
                width: 40px !important;
            }
            .headingcont{
                font-size: 24px;
            }
            .modaloffer .close{
                font-size: 27px;
                right: 4px;
                top: -2px;
            }

            .modaloffer{
                left: 50%;
                min-height: 220px;
                top: 53%;
            }

            .modalsubscribe .close,.modaloffer .close {
                font-size: 28px;
                right: 3px;
                top: -4px;
            }
            .modalsubscribe{
                width: 62%;
                left: 50%;
                min-height: 215px;
                top: 50%;
                padding: 15px;
            }
        }

        @media screen and (min-width: 421px) and (max-width: 950px)  {
            .email-box__input{
                width: 90%;
                height: 40px;
            }

            .headingcont{
                font-size: 24px;
            }

            .modaloffer .close{
                font-size: 33px;
                right: 9px;
                top: -1px;
            }
            .modaloffer{
                left: 49%;
                top: 50%;
            }
            #customCheck1{
                width: 37px;
                height: 18px;
            }
            #NoWant{
                width: 20px;
                height: 18px;
            }
            .text-mobile-16{
                font-size: 17px !important;
            }
            .textmobilete{
                font-size: 10px !important;
            }
            .modalsubscribe{
                width: 96%;
                left: 50%;
                min-height: 215px;
                top: 50%;
                font-size: 12px;
            }
            .imgagef{
                left: 45% !important;
                top: -13% !important;
            }
            .modalsubscribe .close,.modaloffer .close {
                font-size: 20px;
                right: 7px;
                top: -1px;
            }
        }

        @media screen and (max-width: 420px) {
            #customCheck1{
                width: 37px;
                height: 18px;
            }
            #NoWant{
                width: 18px;
                height: 18px;
            }

            .imgagef{
                text-align: center;
                position: absolute;
                left: 44%;
                bottom: -10px !important;
                z-index: 3000;
                color: white;
                padding: 7px;
            }
            .imgagef img{
                height: 41px !important;
                width: 30px !important;
            }

            .email-box__input{
                width: 100%;
                height: 40px;
            }
            .headingcont{
                font-size: 18px;
            }
            .text-mobile-16{
                font-size: 17px !important;
            }
            .textmobilete{
                font-size: 10px !important;
            }
            .modaloffer{
                width: 99% !important;
                top: 50%;
                left: 50%;
                font-size: 12px;
            }
            .modalsubscribe{
                width: 99% !important;
                left: 50%;
                min-height: 215px;
                top: 50%;
                font-size: 12px;
            }
            .close{
                font-size: 20px;
                right: 7px;
                top: -1px;
            }
        }
        .slide-in {
            animation: slide-in 0.5s forwards;
            -webkit-animation: slide-in 0.5s forwards;
        }

        .slide-out {
            animation: slide-out 0.5s forwards;
            -webkit-animation: slide-out 0.5s forwards;
        }

        @keyframes slide-in {
            0%      { opacity: .5; transform: translateY(100px); }
            100% { opacity: 1; transform: translateY(0%)); }
        }

        @-webkit-keyframes slide-in {
            0%      { opacity: .5; -webkit-transform: translateY(100px); }
            100% { opacity: 1; -webkit-transform: translateY(0%)); }
        }

        @keyframes slide-out {
            0%      { opacity: 1; transform: translateY(0%); }
            100% { opacity: .5; transform: translateY(100px) }
        }

        @-webkit-keyframes slide-out {
            0%      { opacity: 1; -webkit-transform: translateY(0%); }
            100% { opacity: .5; -webkit-transform: translateY(100px) }
        }

        .modal-heading{
            display: inline-block;
            line-height: 1.1;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            background: rgba(0,0,0,0.0001);
            position: relative;
            text-align: center;
            height: auto;
            font-weight: 600 !important;
            border-style: solid;
            border-width: 3px;
            -webkit-border-image: -webkit-linear-gradient(to left, rgba(255,255,255,0) 1%, #ff7e2d 100%) 0 0 100% 0/0 0 3px 0 stretch;
            -moz-border-image: -moz-linear-gradient(to left, rgba(255,255,255,0) 1%, #ff7e2d 100%) 0 0 100% 0/0 0 3px 0 stretch;
            -o-border-image: -o-linear-gradient(to left, rgba(255,255,255,0) 1%, #ff7e2d 100%) 0 0 100% 0/0 0 3px 0 stretch;
            border-image: linear-gradient(to left, rgba(255,255,255,0) 1%, #ff7e2d 100%) 0 0 100% 0/0 0 3px 0 stretch;
        }


        #customCheck1,#NoWant{
            position: relative;
            background: white;
            color: black;
            border: 1px solid gray;
            border-radius: 4px;
            appearance: none;
            outline: 0;
            cursor: pointer;
            transition: background 175ms cubic-bezier(0.1, 0.1, 0.25, 1);
        }
        #customCheck1::before,#NoWant::before {
            position: absolute;
            content: '';
            display: block;
            top: 0;
            left: 5px;
            width: 8px;
            height: 14px;
            border-style: solid;
            border-color: white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
            opacity: 0;
        }
        #customCheck1:checked,#NoWant:checked {
            color: #ffffff;
            border-color: green;
            background: green;

        }
        #customCheck1::before,#NoWant::before{
            opacity: 1;
        }

    </style>
    <?php

    $query_args = array(
        'post_type' => 'pop_ups',
        'post_status' => 'publish',
        'fields'      => 'ids',
        'posts_per_page' => -1,
        'meta_query'    => array(
            array(
                'key'       => 'pop_custom_meta_pop_state',
                'value'     => 'on',
            )
        )
    );

    $pop = get_posts($query_args);

    foreach ($pop as $popID){

        $visitorsCountryISO = $GLOBALS['visitorsISO'];
        if (!empty(get_post_meta($popID, 'pop_custom_meta_contries_filled', true))) {
            $hasLocalBonus = in_array($visitorsCountryISO, get_post_meta($popID, 'pop_custom_meta_contries_filled', true)) ? true : false;
        }else{
            $hasLocalBonus = false;
        }
        $activeglb = get_post_meta($popID, 'pop_custom_meta_pop_state_glb', true);

        $type = get_post_meta($popID,'pop_custom_meta_pop_type',true);
        $seconds=get_post_meta($popID,'pop_custom_meta_seconds_pop',true);

        $iso='';
        $shown ='';

        if ($hasLocalBonus === true){
            $iso = $visitorsCountryISO;
            $shown = 'yes';
        }else {
            if ($activeglb === 'on'){
                $shown = 'yes';
                $iso = "glb";
            }else{
                $shown = 'no';
            }
        }

        if ($shown !== 'no'){

            $title=get_post_meta($popID,$iso.'pop_custom_meta_titleNewsle',true);
            $width =get_post_meta($popID,$iso.'pop_custom_meta_width_pop',true);
            $btn_text =get_post_meta($popID,$iso.'pop_custom_meta_btn_text',true);
            $urlbtn =get_post_meta($popID,$iso.'pop_custom_meta_btn_url',true);
            $rel =get_post_meta($popID,$iso.'pop_custom_meta_btn_rel',true);
            $align =get_post_meta($popID,$iso.'pop_custom_meta_align_img',true);
            $img = get_post_meta($popID,$iso.'pop_custom_meta_imageNewsle',true);
            $text = get_post_meta($popID,$iso.'pop_custom_meta_textNews',true);
            $color = get_post_meta($popID,$iso.'pop_custom_meta_bg_color_news',true);
            $img_url = get_post_meta($popID,$iso.'pop_custom_meta_img_url',true);

            if ($type === 'newsletter'){
                if (!empty($img) && $align == 'center'){
                    if (is_user_logged_in()) {
                        ?>
                        <div class="btn-border br-5 border-secondary p-10p mt-30p mb-20p modalsubscribe modalPop d-none" style="background: <?=$color?>; width:<?=$width?>px" >
                        <?php
                    }else{
                        ?>
                        <div class="btn-border br-5 border-secondary p-10p mt-30p mb-20p modalsubscribe modalPop" data-id="<?=$popID?>" style="background: <?=$color?>; width:<?=$width?>px" >
                        <?php
                    }?>
                    <input type="hidden" class="seconds" id="seconds" value="<?=$seconds?>000">
                    <span class="close text-white closeModal" id="closeModal">&times;</span>
                    <div class="position-relative w-100">
                        <div class="imgagef">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/favicon.png';?>" style="height: 50px; width: 50px;" class=" img-fluid" loading="lazy">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap w-100 position-relative">
                        <div class="w-100 d-flex flex-column align-items-center text-center">
                            <div class="font-weight-bolder d-block text-center headingcont">
                                <span class="pt-7p modal-heading"><?=$title?></span>
                            </div>
                            <img src="<?=$img?>" class="d-block mx-auto mt-10p img-fluid" loading="lazy">
                            <div class="pt-7p"><?=$text?></div>
                            <div class="d-block w-100 text-warning" id="reslutEmail">
                                <form method="post"  class="w-100" id="sendin-sub-form" action="javascript:void(0);" target="_blank">
                                    <div class="email-box d-flex justify-content-center position-relative">
                                        <input type="email" name="sendin-email"  id="send-in-email" required  class="email-box__input " placeholder="Fill in your email"/>
                                        <input type="button" id="SubButton" onclick="SubscirbeEmail(event,this);" value="Subscribe" class="btn text-white bg-gold-gradient font-weight-bold"/>
                                    </div>
                                </form>
                            </div>

                            <span class="text-warning text-12 text-center mt-3p text-12 d-block mx-auto emailError"></span>
                            <div class="mt-3p SuccessMsg d-block mx-auto text-12"></div>

                            <div class="d-flex w-100 justify-content-center mt-5p mb-2p text-12 textmobilete">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" onclick="EnableButton();">
                                <label for="customCheck1" class="text-white pt-2p pl-5p text-12 textmobilete mb-0 text-center">*Yes, I have read the <a href="/privacy-policy/" target="_blank">Terms & Conditions</a> and I consent to receiving emails from Best50Casino.com regarding casino promotions.</label>
                            </div>
                            <div class="d-flex w-100 justify-content-center mt-5p text-12 textmobilete">
                                <input type="checkbox" class="custom-control-input" id="NoWant" onclick="Weekof(this);">
                                <label class="text-white pl-5p pt-2p text-center" for="NoWant">No, I don’t want to subscribe to the Newsletter</label>
                            </div>

                        </div>
                    </div>
                    </div>
                    <?php
                }elseif(!empty($img) && $align == 'left'){
                    if (is_user_logged_in()) {
                        ?>
                        <div class="btn-border br-5 border-secondary p-10p mt-30p mb-20p modalsubscribe d-none modalPop" style="background: <?=$color?>; width:<?=$width?>px" >
                        <?php
                    }else{
                        ?>
                        <div class="btn-border br-5 border-secondary p-10p mt-30p mb-20p modalsubscribe modalPop" data-id="<?=$popID?>"  style="background: <?=$color?>; width:<?=$width?>px">
                        <?php
                    }?>
                    <input type="hidden" class="seconds" id="seconds" value="<?=$seconds?>000">
                    <span class="close text-white closeModal" id="closeModal">&times;</span>
                    <div class="position-relative w-100">
                        <div class="imgagef">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/favicon.png';?>" style="height: 50px; width: 50px;" class=" img-fluid" loading="lazy">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap w-100">
                        <div class="w-40 d-xl-block d-lg-block d-md-block d-none m-auto pr-20p">
                            <img src="<?=$img?>" class="d-block mx-auto img-fluid" loading="lazy">
                        </div>
                        <div class="w-60 w-sm-100 d-flex flex-column text-white align-self-center">
                            <div class="font-weight-bolder d-block text-center text-xl-left text-md-left text-lg-left headingcont">
                                <span class="pt-7p modal-heading-left"><?=$title?></span>
                            </div>
                            <img src="<?=$img?>" class="d-block mx-auto  d-md-none d-xl-none d-lg-none img-fluid mt-5p" loading="lazy">
                            <div class="pt-7p"><?=$text?></div>
                            <div class="d-block w-100 text-warning" id="reslutEmail">
                                <form method="post"  class="w-100" id="sendin-sub-form" action="javascript:void(0);" target="_blank">
                                    <div class="email-box d-flex position-relative">
                                        <input type="email" name="sendin-email"  id="send-in-email" required  class="email-box__input " placeholder="Fill in your email"/>
                                        <input type="button" id="SubButton" onclick="SubscirbeEmail(event,this);" value="Subscribe" class="btn text-white bg-gold-gradient font-weight-bold"/>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <span class="text-warning text-12 text-center mt-3p text-12 d-block mx-auto emailError"></span>
                        <div class="mt-3p SuccessMsg d-block mx-auto text-12"></div>

                        <div class="d-flex w-100 justify-content-center mt-5p mb-2p text-12 textmobilete">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" onclick="EnableButton();">
                            <label for="customCheck1" class="text-white pt-2p pl-5p text-12 textmobilete mb-0 text-center">*Yes, I have read the <a href="/privacy-policy/" target="_blank">Terms & Conditions</a> and I consent to receiving emails from Best50Casino.com regarding casino promotions.</label>
                        </div>
                        <div class="d-flex w-100 justify-content-center mt-5p text-12 textmobilete">
                            <input type="checkbox" class="custom-control-input" id="NoWant" onclick="Weekof(this);">
                            <label class="text-white pl-5p pt-2p text-center" for="NoWant">No, I don’t want to subscribe to the Newsletter</label>
                        </div>

                    </div>
                    </div>
                    <?php
                }elseif(!empty($img) && $align == 'right'){
                    if (is_user_logged_in()) {
                        ?>
                        <div class="btn-border br-5 border-secondary p-10p mt-30p mb-20p modalsubscribe d-none modalPop" style="background: <?=$color?>; width:<?=$width?>px" >
                        <?php
                    }else{
                        ?>
                        <div class="btn-border br-5 border-secondary p-10p mt-30p mb-20p modalsubscribe modalPop" data-id="<?=$popID?>"  style="background: <?=$color?>; width:<?=$width?>px">
                        <?php
                    }?>
                    <input type="hidden" class="seconds" id="seconds" value="<?=$seconds?>000">
                    <span class="close text-white closeModal" id="closeModal">&times;</span>
                    <div class="position-relative w-100">
                        <div class="imgagef">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/favicon.png';?>" style="height: 50px; width: 50px;" class=" img-fluid" loading="lazy">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap w-100">
                        <div class="w-60 w-sm-100 d-flex flex-column text-white align-self-center">
                            <div class="font-weight-bolder d-block text-center text-xl-left text-md-left text-lg-left headingcont">
                                <span class="pt-7p modal-heading-left"><?=$title?></span>
                            </div>
                            <img src="<?=$img?>" class="d-block mx-auto  d-md-none d-xl-none d-lg-none img-fluid mt-5p" loading="lazy">
                            <div class="pt-7p"><?=$text?></div>
                            <div class="d-block w-100 text-warning" id="reslutEmail">
                                <form method="post"  class="w-100" id="sendin-sub-form" action="javascript:void(0);" target="_blank">
                                    <div class="email-box d-flex position-relative">
                                        <input type="email" name="sendin-email"  id="send-in-email" required  class="email-box__input " placeholder="Fill in your email"/>
                                        <input type="button" id="SubButton" onclick="SubscirbeEmail(event,this);" value="Subscribe" class="btn text-white bg-gold-gradient font-weight-bold"/>
                                    </div>
                                </form>
                                <span class="text-warning mt-3p emailError d-block text-12"></span>
                            </div>
                        </div>

                        <div class="w-40 d-xl-block d-lg-block d-md-block d-none m-auto pl-20p">
                            <img src="<?=$img?>" class="d-block mx-auto img-fluid" loading="lazy">
                        </div>

                        <span class="text-warning text-12 text-center mt-3p text-12 d-block mx-auto emailError"></span>
                        <div class="mt-3p SuccessMsg d-block mx-auto text-12"></div>

                        <div class="d-flex w-100 justify-content-center mt-5p mb-2p text-12 textmobilete">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" onclick="EnableButton();">
                            <label for="customCheck1" class="text-white pt-2p pl-5p text-12 textmobilete mb-0 text-center">*Yes, I have read the <a href="/privacy-policy/" target="_blank">Terms & Conditions</a> and I consent to receiving emails from Best50Casino.com regarding casino promotions.</label>
                        </div>
                        <div class="d-flex w-100 justify-content-center mt-5p text-12 textmobilete">
                            <input type="checkbox" class="custom-control-input" id="NoWant" onclick="Weekof(this);">
                            <label class="text-white pl-5p pt-2p text-center" for="NoWant">No, I don’t want to subscribe to the Newsletter</label>
                        </div>
                    </div>
                    </div>
                    <?php
                }else{
                    if (is_user_logged_in()) {
                        ?>
                        <div class="btn-border br-5 border-secondary p-10p mt-30p mb-20p modalsubscribe modalPop d-none" style="width:<?=$width?>px">
                        <?php
                    }else{
                        ?>
                        <div class="btn-border br-5 border-secondary p-10p mt-30p mb-20p modalsubscribe modalPop" data-id="<?=$popID?>"  style="width:<?=$width?>px">
                        <?php
                    }?>
                    <input type="hidden" class="seconds" id="seconds" value="<?=$seconds?>000">
                    <span class="close text-white closeModal" id="closeModal">&times;</span>
                    <div class="position-relative w-100">
                        <div class="imgagef">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/favicon.png';?>" style="height: 50px; width: 50px;" class=" img-fluid" loading="lazy">
                        </div>
                    </div>
                    <div class="mt-5p mb-5p text-center text-white text-bolder text-20 text-mobile-16">Join and grab <span class="text-secondary font-weight-bold">exclusive bonuses, no deposit offers & free spins!</span></div>
                    <p class="text-center text-white mb-15p mt-10p">Lay hands on exclusive daily bonuses for members only. These promos are limited and are not advertised on the website. </p>

                    <form id="ms-sub-form">
                        <div class="d-flex justify-content-center mb-10p align-items-center">
                            <input placeholder="Enter Your Email Here" type="email" name="sendin-email" id="send-in-email" required  class="sub-placeholder form-control w-30 w-sm-70 p-7p border-primary bor-1 "/>
                            <input type="button" id="SubButton" onclick="SubscirbeEmail(event,this);" value="Subscribe" class="btn btn_yellow font-weight-bold"/>
                        </div>
                    </form>
                    <span class="text-warning text-12 text-center mt-3p text-12 d-block mx-auto emailError"></span>
                    <div class="mt-3p SuccessMsg d-block mx-auto text-12"></div>
                    <div class="d-flex w-100 justify-content-center mt-5p mb-2p text-12 textmobilete">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" onclick="EnableButton();">
                        <label for="customCheck1" class="text-white pt-2p pl-5p text-12 textmobilete mb-0 text-center">*Yes, I have read the <a href="/privacy-policy/" target="_blank">Terms & Conditions</a> and I consent to receiving emails from Best50Casino.com regarding casino promotions.</label>
                    </div>
                    <div class="d-flex w-100 justify-content-center mt-5p text-12 textmobilete">
                        <input type="checkbox" class="custom-control-input" id="NoWant" onclick="Weekof(this);">
                        <label class="text-white pl-5p pt-2p text-center" for="NoWant">No, I don’t want to subscribe to the Newsletter</label>
                    </div>
                    </div>
                    <?php
                }
            } else {
                if ($align == 'left'){
                    ?>
                    <div class="btn-border br-5 border-secondary p-10p mt-30p mb-20p modalsubscribe modalPop" data-id="<?=$popID?>"  style="background: <?=$color?>; width:<?=$width?>px" >
                        <input type="hidden" class="seconds" id="seconds" value="<?=$seconds?>000">
                        <span class="close text-white closeModal" id="closeModal">&times;</span>
                        <div class="position-relative w-100">
                            <div class="imgagef">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/favicon.png';?>" style="height: 50px; width: 50px;" class=" img-fluid" loading="lazy">
                            </div>
                        </div>
                        <div class="d-flex flex-wrap w-100">
                            <div class="w-40 d-xl-block d-lg-block d-md-block d-none m-auto pr-20p">
                                <?php
                                if (!empty($img_url)){
                                    ?>
                                    <a class="w-100 imgbtn" href="<?=$img_url?>">
                                        <img src="<?=$img?>" class="d-block mx-auto img-fluid" loading="lazy">
                                    </a>
                                    <?php
                                }else{
                                    ?>
                                    <img src="<?=$img?>" class="d-block mx-auto img-fluid" loading="lazy">
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="w-60 w-sm-100 d-flex flex-column text-white align-self-center">
                                <div class="font-weight-bolder d-block text-center text-xl-left text-md-left text-lg-left headingcont ">
                                    <span class="pt-7p modal-heading-left"><?=$title?></span>
                                </div>
                                <?php
                                if (!empty($img_url)){
                                    ?>
                                    <a class="w-100 imgbtn" href="<?=$img_url?>">
                                        <img src="<?=$img?>" class="d-block mx-auto  d-md-none d-xl-none d-lg-none img-fluid mt-5p" loading="lazy">
                                    </a>
                                    <?php
                                }else{
                                    ?>
                                    <img src="<?=$img?>" class="d-block mx-auto  d-md-none d-xl-none d-lg-none img-fluid mt-5p" loading="lazy">
                                    <?php
                                }
                                ?>
                                <div class="pt-7p pl-5p pr-5p"><?=$text?></div>
                                <a href="<?=$urlbtn?>" rel="<?=$rel;?>" target="_blank" style="background: linear-gradient(90deg, #ff6539 0%, #ff7a2f 35%, #ff822c 100%);" id="offerbtn" class="btn offerbtn shiny-btn text-white text-center d-block mx-auto mx-lg-0 mx-xl-0 mx-md-0  mt-sm-1 mb-15p font-weight-bold">
                                    <?=$btn_text?>
                                    <i></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                elseif ($align == 'right'){
                    ?>
                    <div class="btn-border br-5 border-secondary p-10p mt-30p mb-20p modalsubscribe modalPop" data-id="<?=$popID?>"  style="background: <?=$color?>; width:<?=$width?>px" >
                        <input type="hidden" class="seconds" id="seconds" value="<?=$seconds?>000">
                        <span class="close text-white closeModal" id="closeModal">&times;</span>
                        <div class="position-relative w-100">
                            <div class="imgagef">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/favicon.png';?>" style="height: 50px; width: 50px;" class=" img-fluid" loading="lazy">
                            </div>
                        </div>
                        <div class="d-flex flex-wrap w-100">
                            <div class="w-60 w-sm-100 d-flex flex-column text-white align-self-center">
                                <?php if (!empty($title)){?>
                                    <div class="font-weight-bolder d-block text-center text-xl-left text-md-left text-lg-left headingcont ">
                                        <span class="pt-7p modal-heading-left"><?=$title?></span>
                                    </div>
                                    <?php
                                }
                                if (!empty($img_url)){
                                    ?>
                                    <a class="w-100" href="<?=$img_url?>">
                                        <img src="<?=$img?>" class="d-block mx-auto  d-md-none d-xl-none d-lg-none img-fluid mt-5p" loading="lazy">
                                    </a>
                                    <?php
                                }else{
                                    ?>
                                    <img src="<?=$img?>" class="d-block mx-auto  d-md-none d-xl-none d-lg-none img-fluid mt-5p" loading="lazy">
                                    <?php
                                }
                                if (!empty($btn_text)){
                                    ?>
                                    <div class="pt-7p pl-5p pr-5p"><?=$text?></div>
                                    <a href="<?=$urlbtn?>" rel="<?=$rel;?>" target="_blank" style="background: linear-gradient(90deg, #ff6539 0%, #ff7a2f 35%, #ff822c 100%);" id="offerbtn" class="btn offerbtn shiny-btn text-white text-center d-block mx-auto mx-lg-0 mx-xl-0 mx-md-0  mt-sm-1 mb-15p font-weight-bold">
                                        <?=$btn_text?>
                                        <i></i>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="w-40 d-xl-block d-lg-block d-md-block d-none m-auto pl-20p">
                                <?php
                                if (!empty($img_url)){
                                    ?>
                                    <a class="w-100 imgbtn" href="<?=$img_url?>">
                                        <img src="<?=$img?>" class="d-block mx-auto img-fluid" loading="lazy">
                                    </a>
                                    <?php
                                }else{
                                    ?>
                                    <img src="<?=$img?>" class="d-block mx-auto img-fluid" loading="lazy">
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="btn-border br-5 border-secondary modaloffer modalPop" data-id="<?=$popID?>"  style="background: <?=$color?>; width:<?=$width?>px" >
                        <input type="hidden" class="seconds" id="seconds" value="<?=$seconds?>000">
                        <span class="close text-white closeModal" id="closeModal">&times;</span>
                        <div class="position-relative w-100">
                            <div class="imgagef" style="bottom: -27px;">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/favicon.png';?>" style="height: 50px; width: 50px;" class=" img-fluid" loading="lazy">
                            </div>
                        </div>
                        <div class="w-100 d-flex flex-column align-items-center text-center">
                            <?php
                            if (!empty($img_url)){
                                ?>
                                <a class="w-100 br-5 imgbtn" href="<?=$img_url?>">
                                    <img src="<?=$img?>" class="d-block br-5 mx-auto w-100  img-fluid"  loading="lazy">
                                </a>
                                <?php
                            }else{
                                ?>
                                <img src="<?=$img?>" class="d-block mx-auto br-5 w-100  img-fluid"  loading="lazy">
                                <?php
                            }
                            if (!empty($title)){
                                ?>
                                <div class="font-weight-bolder d-flex mt-10p headingcont">
                                    <span class="pt-7p modal-heading"><?=$title?></span>
                                </div>
                                <?php
                            }
                    if (!empty($text)){
                            ?>
                            <div class="pt-7p pl-5p text-white pr-5p"><?=$text?></div>
                            <?php
                    }
                            if (!empty($btn_text)){ ?>
                                <a href="<?=$urlbtn?>" target="_blank" rel="<?=$rel;?>" style="background: linear-gradient(90deg, #ff6539 0%, #ff7a2f 35%, #ff822c 100%);" id="offerbtn" class="btn offerbtn shiny-btn text-white  text-center d-block mx-aut  mt-sm-1 mb-15p  font-weight-bold">
                                    <?=$btn_text?>
                                    <i></i>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
        }
    }
    ?>

    <script type="text/javascript">

        function loadSideAd() {
            var currentTime = new Date().getTime();
            Date.prototype.addHours = function (h) {
                this.setTime(this.getTime() + (h * 60 * 60 * 1000));
                return this;
            };

            //Get time after 24 hours
            var after24 = new Date().addHours(24).getTime();
            var CurrentYear = new Date();
            //Hide div click

            // Get the modal
            var modal = document.getElementsByClassName("modalPop");

            for (var i = 0; i < modal.length; i++) {
                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("closeModal");
                var idmodal = modal.item(i).getAttribute("data-id");
                var offerbtn = document.getElementsByClassName("offerbtn");
                var getseconds = document.getElementsByClassName('seconds');
                var imgbtn = document.getElementsByClassName('imgbtn');
                var seconds = getseconds.item(i).value;

                // When the user clicks on <span> (x), close the modal
                span.item(i).onclick = function () {
                    this.closest('.modalPop').style.display = "none";
                    this.closest('.modalPop').classList.add("slide-out");
                    this.closest('.modalPop').classList.remove("slide-in");
                    var idmodal =  this.closest('.modalPop').getAttribute("data-id");
                    if (idmodal === '18027'){
                        document.getElementById("overlaysite").style.display = "none";
                    }
                    localStorage.setItem('desiredTime'+idmodal, after24);
                }

                if (offerbtn.length > 0) {
                    for (var c = 0; c < offerbtn.length; c++) {
                        offerbtn.item(c).onclick = function () {
                            this.closest('.modalPop').style.display = "none";
                            this.closest('.modalPop').classList.add("slide-out");
                            this.closest('.modalPop').classList.remove("slide-in");
                            var idmodal = this.closest('.modalPop').getAttribute("data-id");
                            if (idmodal === '18027'){
                                document.getElementById("overlaysite").style.display = "none";
                            }
                            localStorage.setItem('desiredTime'+idmodal, after24);
                        }
                    }
                }
                if (imgbtn.length > 0) {
                    for (var j = 0; j < imgbtn.length; j++) {
                        imgbtn.item(j).onclick = function () {
                            this.closest('.modalPop').style.display = "none";
                            this.closest('.modalPop').classList.add("slide-out");
                            this.closest('.modalPop').classList.remove("slide-in");
                            var idmodal = this.closest('.modalPop').getAttribute("data-id");
                            if (idmodal === '18027'){
                                document.getElementById("overlaysite").style.display = "none";
                            }
                            localStorage.setItem('desiredTime'+idmodal, after24);
                        }
                    }
                }
                if (localStorage.getItem('yearAfterBest') != null) {
                    var x = Date.parse(localStorage.getItem('yearAfterBest'));
                    var y = Date.parse(CurrentYear);
                    if (x>y) {
                        console.log('year');
                        modal.item(i).style.display = "none";
                        modal.item(i).classList.add("slide-out");
                    }
                } else if (localStorage.getItem('desiredTime'+idmodal) >= currentTime) {
                    console.log('time');
                    modal.item(i).style.display = "none";
                    modal.item(i).classList.add("slide-out");
                } else if (localStorage.getItem('desiredTimeWeek'+idmodal) >= currentTime) {
                    console.log('week');
                    modal.item(i).style.display = "none";
                    modal.item(i).classList.add("slide-out");
                }
                else {
                    var Pop = modal.item(i);
                    var idmod = modal.item(i).getAttribute("data-id");
                    general(seconds,Pop,idmod);
                }
                var checkBox = document.getElementById("customCheck1");
                if (typeof (checkBox) != 'undefined' && checkBox != null) {
                    if (checkBox.checked === false) {
                        document.getElementById("SubButton").disabled = true;
                    }
                }
            }

            return true;
        }


        function general(time,modal,idmod){
            function DisplayModal(modal,idmod){
                if (idmod === '18027'){
                    document.getElementById("overlaysite").style.display = "block";
                }
                modal.style.display = "block";
                modal.classList.add("slide-in");
            }
            setTimeout(function() { DisplayModal(modal,idmod); }, time);
        }

        window.onload = loadSideAd();

        function EnableButton() {
            var checkBox = document.getElementById("customCheck1");
            if (typeof (checkBox) != 'undefined' && checkBox != null) {
                if (checkBox.checked === true) {
                    document.getElementById("SubButton").disabled = false;
                } else {
                    document.getElementById("SubButton").disabled = true;
                }
            }
        }

        function Weekof(obj) {
            Date.prototype.addHours = function (h) {
                this.setTime(this.getTime() + (h * 60 * 60 * 1000));
                return this;
            };
            var afterweek = new Date().addHours(168).getTime();

            if (typeof (obj) != 'undefined' && obj != null) {
                if (obj.checked === true) {
                    obj.closest('.modalPop').style.display = "none";
                    obj.closest('.modalPop').classList.add("slide-out");
                    obj.closest('.modalPop').classList.remove("slide-in");
                    var idmodal = obj.closest('.modalPop').getAttribute("data-id");
                    localStorage.setItem('desiredTimeWeek'+idmodal,afterweek);
                }
            }
        }

        function emailIsValid(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
        }

        function SubscirbeEmail(e,$this) {

            // var ajax = {"ajax_url": "https://\/dev.best50casino.com\/wp-admin\/admin-ajax.php"};
            var ajax = {"ajax_url": "https://\/www.best50casino.com\/wp-admin\/admin-ajax.php"};
            // var ajax = {"ajax_url": "https://\/localhost/dev.best50casino.com\/wp-admin\/admin-ajax.php"};

            var email = $('#send-in-email').val();


            var yearafter = new Date(new Date().setFullYear(new Date().getFullYear() + 1));

            if (emailIsValid(email) === true) {
                jQuery.ajax({
                    type: 'POST',
                    url: ajax.ajax_url,
                    data: {action: "subscribe_contact", email: email},
                    dataType: 'html',
                    beforeSend: function () {
                    },
                    success: function (data) {
                        $(".SuccessMsg").html(data);
                        localStorage.setItem('yearAfterBest', yearafter);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                    },
                    complete: function (data) {
                    }
                });
            } else {
                $(".emailError").text('Not a valid email address');
            }

        }

    </script>

    <?php
    return ob_get_clean();
}

