<?php
function ShowOfferPopup(){
    ob_start();
    ?>
    <style>
        #modalOffer .font-weight-bold{
            font-weight: bold;
        }
        #modalOffer .align-items-center{
            align-items: center;
        }
        .text-12{
            font-size: 12px;
        }
        .pl-10p{
            padding-left: 10px;
        }
        .pl-5p{
            padding-left: 5px;
        }
        .mt-5p{
            margin-top: 5px;
        }
        .pt-2p{
            padding-top: 2px;
        }
        .pt-7p{
            padding-top: 7px;
        }
        .w-40{
            width: 40%;
        }
        .w-60{
            width: 60%;
        }
        .pr-5p{
            padding-right: 5px;
        }
        .mb-15p{
            margin-bottom: 15px;
        }
        #modalOffer .justify-content-center{
            justify-content: center;
        }
        .mt-10p{margin-top: 10px;}
        .pr-20p{
            padding-right: 20px;
        }
        #modalOffer .flex-column{
            flex-direction: column;
        }
        #modalOffer .img-fluid{
            max-width: 100%;
            height: auto;
        }
        #modalOffer .d-block{
            display: block;
        }
        #modalOffer .mx-auto{
            margin-left: auto;
            margin-right: auto;
        }
        #modalOffer .d-flex{
            display: flex;
        }
        #modalOffer .flex-wrap{
            flex-flow: wrap;
        }
        #modalOffer .position-relative{
            position: relative;
        }
        #modalOffer .text-white{
            color: white;
        }
        .modaloffer{
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 2000; /* Sit on top */
            transform: translate(-50%, -50%);
            overflow: visible;
            border-radius: 15px;
        }

        #modalOffer .close {
            float: right;
            font-weight: bold;
            position: absolute;
            opacity: 1 !important;
        }
        #modalOffer .close:hover,
        #modalOffer .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        @media screen and (min-width: 1400px) {
            .mx-lg-0,.mx-xl-0,.mx-md-0{
                margin-left: 0 !important;
                margin-right: 0 !important;
            }
            .w-25{
                width: 25%;
            }
            .text-lg-left,.text-xl-left{
                text-align: left !important;
            }
            .d-lg-none,.d-xl-none{
                display: none !important;
            }
            #modalOffer #customCheck1{
                width: 27px;
                height: 19px;
            }
            #modalOffer .imgagef {
                text-align: center;
                position: absolute;
                left: 48%;
                /* top: 14%; */
                bottom: -27px;
                z-index: 3000;
                /* background: #9c7f49; */
                padding: 10px;
                border-radius: 50%;
                color: white;
            }

            .headingcont{
                font-size: 27px;
            }
            #modalOffer .close{
                font-size: 31px;
                right: 1px;
                top: -13px;
            }
            .modaloffer{
                left: 50%;
                min-height: 220px;
                top: 50%;
            }
            #modalOffer .modal-heading-left::after{
                content: "";
                display: block;
                /* margin: 0 auto; */
                width: 60%;
                padding-top: 8px;
                border-bottom: 3px solid #B21705;
            }
        }

        @media screen and (min-width: 1280px) and (max-width: 1366px){
            .mx-lg-0,.mx-xl-0,.mx-md-0{
                margin-left: 0 !important;
                margin-right: 0 !important;
            }
            .w-25{
                width: 25%;
            }
            .text-lg-left,.text-xl-left{
                text-align: left !important;
            }
            .d-lg-none,.d-xl-none{
                display: none !important;
            }
            #modalOffer  #customCheck1{
                width: 29px;
                height: 20px;
            }
            #NoWant {
                width: 19px;
                height: 16px;
            }
            #modalOffer .modal-heading-left::after{
                content: "";
                display: block;
                /* margin: 0 auto; */
                width: 60%;
                padding-top: 8px;
                border-bottom: 3px solid #B21705;
            }
            #modalOffer .imgagef {
                text-align: center;
                position: absolute;
                left: 46%;
                /* top: 20px; */
                bottom: -23px !important;
                z-index: 3000;
                /* background: #9c7f49; */
                padding: 8px;
                border-radius: 50%;
                color: white;
            }
            #modalOffer .imgagef img{
                height: 70px !important;
                width: 70px !important;
            }
            #modalOffer .headingcont{
                font-size: 24px;
            }
            #modalOffer .close{
                font-size: 33px;
                right: 3px;
                top: -13px;
            }

            .modaloffer{
                left: 46.3%;
                min-height: 220px;
                top: 50%;
            }
        }

        @media screen and (min-width: 421px) and (max-width: 950px)  {
            .text-md-left{
                text-align: left !important;
            }
            .d-md-none{
                display: none !important;
            }
            .email-box__input{
                width: 90%;
                height: 40px;
            }

            .headingcont{
                font-size: 24px;
            }

            .close{
                font-size: 33px;
                right: 7px;
                top: -1px;
            }
            .modaloffer{
                left: 49%;
                min-height: 220px;
                top: 50%;
            }
            .modalsubscribe{
                width: 87% !important;
                left: 49%;
                min-height: 215px;
                top: 50%;
                padding: 19px;
            }

        }

        @media screen and (max-width: 420px) {
            .w-sm-70{
                width: 70% !important;
            }
            .w-sm-100{
                width: 100% !important;
            }
            .d-none{
                display: none !important;
            }
            #customCheck1{
                width: 45px;
                height: 18px;
            }
            .modal-heading-left::after{
                content: "";
                display: block;
                margin: 0 auto;
                width: 50%;
                padding-top: 8px;
                border-bottom: 3px solid #B21705;
            }
            .imgagef{
                text-align: center;
                position: absolute;
                left: 40%;
                bottom: -17px !important;
                z-index: 3000;
                /* background: #9c7f49; */
                color: white;
                padding: 7px;
                border-radius: 50%;
            }
            .imgagef img{
                height: 60px !important;
                width: 60px !important;
            }


            .headingcont{
                font-size: 18px;
            }
            .modaloffer{
                width: 99% !important;
                top: 50%;
                min-height: 215px;
                left: 50%;
                font-size: 12px;
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

        .modal-heading::after{
            content: "";
            display: block;
            margin: 0 auto;
            width: 48%;
            padding-top: 8px;
            border-bottom: 3px solid #B21705;
        }

        #customCheck1,#NoWant {
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
        #customCheck1::before,#NoWant::before{
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

        .shiny-btn{
            position: relative;
            padding: 12px;
        }
        .shiny-btn i {
            position: absolute;
            opacity: 0;
            top: 0;
            left: 0;
            background: -moz-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.03) 1%, rgba(255, 255, 255, 0.6) 30%, rgba(255, 255, 255, 0.85) 50%, rgba(255, 255, 255, 0.85) 70%, rgba(255, 255, 255, 0.85) 71%, rgba(255, 255, 255, 0) 100%);
            background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(1%, rgba(255, 255, 255, 0.03)), color-stop(30%, rgba(255, 255, 255, 0.85)), color-stop(50%, rgba(255, 255, 255, 0.85)), color-stop(70%, rgba(255, 255, 255, 0.85)), color-stop(71%, rgba(255, 255, 255, 0.85)), color-stop(100%, rgba(255, 255, 255, 0)));
            background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.03) 1%, rgba(255, 255, 255, 0.6) 30%, rgba(255, 255, 255, 0.85) 50%, rgba(255, 255, 255, 0.85) 70%, rgba(255, 255, 255, 0.85) 71%, rgba(255, 255, 255, 0) 100%);
            background: -o-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.03) 1%, rgba(255, 255, 255, 0.6) 30%, rgba(255, 255, 255, 0.85) 50%, rgba(255, 255, 255, 0.85) 70%, rgba(255, 255, 255, 0.85) 71%, rgba(255, 255, 255, 0) 100%);
            background: -ms-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.03) 1%, rgba(255, 255, 255, 0.6) 30%, rgba(255, 255, 255, 0.85) 50%, rgba(255, 255, 255, 0.85) 70%, rgba(255, 255, 255, 0.85) 71%, rgba(255, 255, 255, 0) 100%);
            background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.03) 1%, rgba(255, 255, 255, 0.6) 30%, rgba(255, 255, 255, 0.85) 50%, rgba(255, 255, 255, 0.85) 70%, rgba(255, 255, 255, 0.85) 71%, rgba(255, 255, 255, 0) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#00ffffff", endColorstr="#00ffffff", GradientType=1);
            width: 15%;
            height: 100%;
            transform: skew(-10deg, 0deg);
            -webkit-transform: skew(-10deg, 0deg);
            -moz-transform: skew(-10deg, 0deg);
            -ms-transform: skew(-10deg, 0deg);
            -o-transform: skew(-10deg, 0deg);
            animation: myflash 3s;
            animation-iteration-count: infinite;
            animation-delay: 3s;
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
                'key'       => 'pop_state',
                'value'     => 'on',
            )
        )
    );

    $pop = get_posts($query_args);

    foreach ($pop as $popID){

        $title=get_post_meta($popID,'titleNewsle',true);
        $type = get_post_meta($popID,'pop_type',true);
        $seconds=get_post_meta($popID,'seconds_pop',true);
        $width =get_post_meta($popID,'width_pop',true);
        $btn_text =get_post_meta($popID,'btn_text',true);
        $urlbtn =get_post_meta($popID,'btn_url',true);
        $rel =get_post_meta($popID,'btn_rel',true);
        $align =get_post_meta($popID,'align_img',true);
        $img = get_post_meta($popID,'imageNewsle',true);
        $text = get_post_meta($popID,'textNews',true);
        $color = get_post_meta($popID,'bg_color_news',true);

            if ($align == 'left'){
                ?>
                <div class="btn-border br-5 border-secondary p-10p mt-30p mb-20p modalPop modaloffer text-white" style="background: <?=$color?>; width:<?=$width?>px" data-id="<?=$popID?>" id="modalOffer">
                    <input type="hidden" class="seconds" id="seconds" value="<?=$seconds?>000">
                    <span class="close closeModal text-white" id="closeModal">&times;</span>
                    <div class="position-relative w-100">
                        <div class="imgagef">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/favicon.png';?>" style="height: 80px; width: 80px;" class=" img-fluid" loading="lazy">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap w-100">
                        <div class="w-40 d-xl-block d-lg-block d-md-block d-none m-auto pr-20p">
                            <img src="<?=$img?>" class="d-block mx-auto img-fluid" loading="lazy">
                        </div>
                        <div class="w-60 w-sm-100 d-flex flex-column text-white align-self-center">
                            <div class="font-weight-bolder d-block text-center text-xl-left text-md-left text-lg-left headingcont mt-10p modal-heading-left">
                                <span class="pt-7p"><?=$title?></span>
                            </div>
                            <img src="<?=$img?>" class="d-block mx-auto  d-md-none d-xl-none d-lg-none img-fluid mt-5p" loading="lazy">
                            <div class="pt-7p pl-5p pr-5p"><?=$text?></div>
                            <a href="<?=$urlbtn?>" target="_blank" rel="<?=$rel;?>" class="btn shiny-btn btn-primary offerbtn w-40 w-sm-70 mt-10p text-left d-block mx-auto mx-lg-0 mx-xl-0 mx-md-0  mt-sm-1 mb-15p font-weight-bold">
                                <?=$btn_text?>
                                <i></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
            elseif ($align == 'center'){
                ?>
                <div class="btn-border br-5 border-secondary modalPop text-white" style="background: <?=$color?>; width:<?=$width?>px" data-id="<?=$popID?>" id="modalOffer">
                    <input type="hidden" class="seconds" id="seconds" value="<?=$seconds?>000">
                    <span class="close closeModal text-white" id="closeModal">&times;</span>
                    <div class="position-relative w-100">
                        <div class="imgagef" style="bottom: -27px;">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/favicon.png';?>" style="height: 80px; width: 80px;" class=" img-fluid" loading="lazy">
                        </div>
                    </div>
                    <div class="w-100 d-flex flex-column align-items-center text-center">
                        <img src="<?=$img?>" class="d-block mx-auto w-100  img-fluid" style="max-height: 400px;" loading="lazy">
                        <div class="font-weight-bolder d-flex mt-10p headingcont">
                            <span class="pt-7p modal-heading"><?=$title?></span>
                        </div>
                        <div class="pt-7p pl-5p pr-5p"><?=$text?></div>
                        <a href="<?=$urlbtn?>" rel="<?=$rel;?>" target="_blank" class="btn shiny-btn btn-primary offerbtn w-25 w-sm-70 mt-10p text-center d-block mx-auto  mt-sm-1 mb-15p font-weight-bold">
                            <?=$btn_text?>
                            <i></i>
                        </a>
                    </div>

                </div>
                <?php
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

                var seconds = getseconds.item(i).value;

                // When the user clicks on <span> (x), close the modal
                span.item(i).onclick = function () {
                    this.closest('.modalPop').style.display = "none";
                    this.closest('.modalPop').classList.add("slide-out");
                    this.closest('.modalPop').classList.remove("slide-in");
                    var idmodal =  this.closest('.modalPop').getAttribute("data-id");
                    localStorage.setItem('desiredTimeBet'+idmodal, after24);
                }

                if (typeof (offerbtn) != 'undefined' && offerbtn != null) {
                    offerbtn.onclick = function () {
                        this.closest('.modalPop').style.display = "none";
                        this.closest('.modalPop').classList.add("slide-out");
                        this.closest('.modalPop').classList.remove("slide-in");
                        var idmodal =  this.closest('.modalPop').getAttribute("data-id");
                        localStorage.setItem('desiredTimeBet' + idmodal, after24);
                    }
                }

                if (localStorage.getItem('yearAfterBet') != null) {
                    var x = Date.parse(localStorage.getItem('yearAfterBet'));
                    var y = Date.parse(CurrentYear);
                    if (x>y) {
                        console.log('year');
                        modal.item(i).style.display = "none";
                        modal.item(i).classList.add("slide-out");
                    }
                } else if (localStorage.getItem('desiredTimeBet'+ idmodal) >= currentTime) {
                    console.log('time');
                    modal.item(i).style.display = "none";
                    modal.item(i).classList.add("slide-out");
                }else if (localStorage.getItem('desiredTimeWeek'+idmodal) >= currentTime) {
                    console.log('week');
                    modal.item(i).style.display = "none";
                    modal.item(i).classList.add("slide-out");
                } else {
                    var Pop = modal.item(i);
                    general(seconds,Pop);
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


        function general(time,modal){
            function DisplayModal(modal){
                modal.style.display = "block";
                modal.classList.add("slide-in");
            }
            setTimeout(function() { DisplayModal(modal); }, time);
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


    </script>

    <?php
    return ob_get_clean();
}

