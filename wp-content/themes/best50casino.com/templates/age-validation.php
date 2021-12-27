<div id="popup-modal" class="modal p-10p">
    <style>
        select.form-control {
            background: #00000063;
            color: white;
            border-radius: 5px !important;
            border: 1px solid wheat;
        }
        .modal-content.p-10 {
            background: none;
            width: 600px;
            height: 300px;
            overflow: hidden;
        }
        @media (max-width:600px){
            .modal-content.p-10{
                width: 100%;
            }
        }
    </style>
    <!-- Modal content -->
    <div class="modal-content p-10" style="background-image: url('/wp-content/themes/best50casino.com/assets/images/welcome.jpg')">
<!--        <img class="img-responsive" src="/wp-content/themes/best50casino/assets/images/welcome.jpg"-->
<!--             alt="Best50Casino.com" width="600" style="position: absolute;opacity: 0.9;">-->
        <img class="img-responsive"
             src="https://www.best50casino.com/wp-content/themes/best50casino.com/assets/images/best50casino-logo.svg"
             alt="Best50Casino.com" width="260" style="z-index: 9;">
        <div class="row  d-flex  flex-lg-wrap flex-xl-wrap flex-column justify-content-center align-items-center">
            <div class="col-4">
                <div class="input-group input-group-sm p-10p">
                    <select class="form-control" onchange="enableDayz(this)" id="yearsControl">
                        <?php
                        $time = strtotime("-6 years", time());
                        $date = date("Y", $time);
                        $years = range($date, 1940); ?>
                            <option value="" selected hidden>Year</option>
                            <?php foreach ($years as $year) {?>
                                <option value="<?=$year?>"><?=$year?></option>
                            <?php } ?>
                    </select>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-4 -->
            <div class="col-4">
                <div class="input-group input-group-sm p-10p">
                    <select class="form-control" id="monthControl" onchange="enableDayz(this)">
                        <option value="" selected hidden>Month</option>
                        <?php for($i=1;$i<13;$i++){?>
                            <option value="<?=$i?>"><?=date('F', mktime(0, 0, 0, $i, 10))?></option>
                        <?php } ?>
                    </select>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-4 -->
            <div class="col-4">
                <div class="input-group input-group-sm p-10p">
                    <select class="form-control" id="dayControl" disabled>
                        <option value="" disabled>Day</option>

                    </select>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <button class="btn btn-small btn-cta review" onclick="ageVerification(this,event)">Submit</button>
            </div>
        </div>
    </div>
    <script>
        // Get the modal
        var currentTime = new Date().getTime();
        if(localStorage.getItem('desiredTimeAd') < currentTime)
        {
            jQuery("#popup-modal").delay(1000).fadeIn(400);
        }

        function enableDayz($this){
            var combination = {'monthControl':'yearsControl','yearsControl':'monthControl'};
            var thisID = jQuery($this).attr('id');
            // if(jQuery($this).val() && jQuery(combination[$this]).val()){
            //     jQuery('dayControl').attr('disabled',false);
            //     console.log(jQuery($this).val());
            //     console.log(jQuery(combination.$this).val());
            // }
            if(jQuery($this).val() && jQuery("#"+combination[thisID]).val()){
                var i;
                var daySelect = jQuery('#dayControl');
                daySelect.attr('disabled',false);
                daySelect.html('<option value="" selected hidden>Day</option>');
                for(i = 1; i <= getDaysInMonth(jQuery("#monthControl").val(),jQuery("#yearsControl").val());i++){
                    jQuery('#dayControl').append('<option value="'+i+'">'+i+'</option>')
                }
            }

        }
        function ageVerification($this,e){
            e.preventDefault();
            let today = new Date();
            let past = new Date(jQuery("#yearsControl").val(),jQuery("#monthControl").val(),jQuery("#dayControl").val());
            var diff = Math.floor(today.getTime() - past.getTime());
            var day = 1000 * 60 * 60 * 24;
            var days = Math.floor(diff/day);
            if(days >= 6574){
                jQuery("#popup-modal").hide();
                Date.prototype.addHours = function(h) {
                    this.setTime(this.getTime() + (h*60*60*1000));
                    return this;
                }
                //Get time after 24 hours
                var after24 = new Date().addHours(6).getTime();
                localStorage.setItem('desiredTimeAd', after24);
            }else{
                jQuery("div.row:nth-of-type(2)").before('<div class="row"><div class="col-lg-12"><p class="text-red mb-3">You have to be over 18 to access this page!</p></div></div>');
            }
        }
        var getDaysInMonth = function(month,year) {
            // Here January is 1 based
            //Day 0 is the last day in the previous month
            return new Date(year, month, 0).getDate();
            // Here January is 0 based
            // return new Date(year, month+1, 0).getDate();
        };


    </script>