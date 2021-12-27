<?php
function SubscribePoup(){
    ob_start();
?>

<style>
    .modalsubscribe {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 2000; /* Sit on top */
        transform: translate(-50%, -50%);
        overflow: visible;
        background: linear-gradient(90deg, #212d33 0%, #212d33 35%, #03898f 100%);
    }
    .imgagef{
        text-align: center;
        position: absolute;
        left: 48%;
        top: -13%;
        z-index: 3000;
        color: white;
    }
    .modalsubscribe .close {
        float: right;
        font-weight: bold;
        position: absolute;
        opacity: 1 !important;
    }
    .modalsubscribe .close:hover,
    .modalsubscribe .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    @media screen and (min-width: 1400px) {
        #customCheck1,#NoWant{
            width: 20px;
            height: 18px;
        }
        .modalsubscribe .close{
            font-size: 28px;
            right: 3px;
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

    @media screen and (min-width: 1280px) and (max-width: 1366px)  {
        #customCheck1,#NoWant{
            width: 20px;
            height: 18px;
        }

        .modalsubscribe .close{
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
        .modalsubscribe .close{
            font-size: 20px;
            right: 7px;
            top: -1px;
        }
        .modalsubscribe{
            width: 87%;
            left: 49%;
            min-height: 215px;
            top: 50%;
            padding: 19px;
        }

    }

    @media screen and (max-width: 420px) {
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
       .modalsubscribe .close{
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
 <div class="btn-border br-5 border-secondary p-10p mt-30p mb-20p modalsubscribe" id="modalsubscribe">
     <span class="close text-white" id="closeModal">&times;</span>
       <div class="imgagef">
            <img loading="lazy" src="<?=get_template_directory_uri()?>/assets/images/favicon.png" class="" width="50" style="background:#03898f;border-radius:50%;">
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
<script>
        function loadSideAd(){
            var currentTime = new Date().getTime();
            Date.prototype.addHours = function(h) {
                this.setTime(this.getTime() + (h*60*60*1000));
                return this;
            };
            //Get time after 24 hours
            var after24 = new Date().addHours(24).getTime();
            var CurrentYear = new Date();
            //Hide div click

            // Get the modal
            var modal = document.getElementById("modalsubscribe");
            // Get the <span> element that closes the modal
            var span = document.getElementById("closeModal");


            // When the user clicks on <span> (x), close the modal
            if(span){
                span.onclick = function() {
                    modal.style.display = "none";
                    modal.classList.add("slide-out");
                    modal.classList.remove("slide-in");
                    localStorage.setItem('desiredTimeModal', after24);
                }
            }

            if (localStorage.getItem('yearAfterBest') != null) {
                var x = Date.parse(localStorage.getItem('yearAfterBest'));
                var y = Date.parse(CurrentYear);
                if (x>y) {
                    console.log('year');
                    modal.style.display = "none";
                    modal.classList.add("slide-out");
                }
            } else if (localStorage.getItem('desiredTimeWeek') >= currentTime) {
                console.log('week');
                modal.style.display = "none";
                modal.classList.add("slide-out");
            } else if(localStorage.getItem('desiredTimeModal') >= currentTime) {
                console.log('time');
                modal.style.display = "none";
                modal.classList.add("slide-out");
            } else {
                modal.style.display = "block";
                modal.classList.add("slide-in");
            }


            var checkBox = document.getElementById("customCheck1");
            if (typeof (checkBox) != 'undefined' && checkBox != null) {
                if (checkBox.checked === false) {
                    document.getElementById("SubButton").disabled = true;
                }
            }

            return true;
        }
        window.onload = setTimeout(loadSideAd, 15000);

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
                    obj.closest('#modalsubscribe').style.display = "none";
                    obj.closest('#modalsubscribe').classList.add("slide-out");
                    obj.closest('#modalsubscribe').classList.remove("slide-in");
                    localStorage.setItem('desiredTimeWeek',afterweek);
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
