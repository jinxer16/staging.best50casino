function getAjax(){
    let ajax = { "ajax_url" : "https://\/www.best50casino.com\/wp-admin\/admin-ajax.php" };
    if (window.location.hostname === 'localhost') {
        ajax["ajax_url"] = "https://\/localhost/dev.best50casino.com/\/wp-admin\/admin-ajax.php";
    }
    // console.log(ajax["ajax_url"]);
    return ajax;
}

jQuery(document).ready(function($) {
    let ajax = getAjax();

    if ( $(".calendar-dates li.calendar-item").length > 0 ) {
        $(".calendar-dates li.calendar-item").on("click", function(e){
            e.preventDefault();
            $(".calendar-dates").find(".active").removeClass("active");
            $(this).addClass("active");
            const date = $(this).data('date');
            const casino = $(this).data('casino');
            const categories = $(this).data('cat');
            const exclusive = $(this).data('exclusive');
            // const offersBtn = $(this).parents('#prosfores-kazino-calendar').find('.offers-btn');
            const limit = $(this).parents('.calendar').siblings('#offers-pool').children('.prosfores-list').data('limit');
            $(".ajaxload").show();
            jQuery.ajax({
                type: 'POST',
                url: ajax.ajax_url,
                data: {action: "loadOffers", date:date,casino:casino,categories:categories,exclusive:exclusive, limit: limit },
                dataType: 'html',
                success: function (data) {
                    $(".ajaxload").hide();
                    data = JSON.parse(data);
                    $("#offers-pool .prosfores-list .offer-box-calendar").remove();
                    $("#offers-pool .prosfores-list .offers-btn").before(data['content']);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                },
                complete: function (data) {
                    $('.countdown').each(function() {
                        var $this = $(this), finalDate = $(this).attr('data-time');
                        //var $lalalala = '<span class="offer-time">D</span><span class="offer-time">m</span><span class="offer-time">s</span>';
                        var $lalalala = '<span class="offer-time-data">H</span><span class="offer-time-data">m</span><span class="offer-time-data">s</span>';
                        $this.countdown(finalDate, function(event) {
                            if (event.strftime('%D %H:%M:%S') == '00 00:00:00'){
                                $this.css("color", "red");
                                $this.html("<b>Missed it!</b>");
                            }else{
                                if (event.strftime('%D') == 1) {
                                    //$this.css({"color":"green","font-weight":"bold" });
                                    //$this.html('<span class="offer-days">' + event.strftime('%D Day') + '</span>' + '<span class="offer-time">' + event.strftime('%H') + '<b>H</b></span>' + '<span class="offer-time">' + event.strftime('%M') + '<b>m</b></span>' + '<span class="offer-time">' + event.strftime('%S') + '<b>s</b></span>')
                                    $this.html('<span class="offer-time">' + event.strftime('%D Day'))
                                }else{
                                    if (event.strftime('%D') > 1) {
                                        var asd = parseInt(event.strftime('%D')) + 1 ;
                                        //$this.css({"color":"green","font-weight":"bold" });
                                        //$this.html('<span class="offer-days">' + event.strftime('%D Days') + '</span>' + '<span class="offer-time">' + event.strftime('%H') + '<b>H</b></span>' + '<span class="offer-time">' + event.strftime('%M') + '<b>m</b></span>' + '<span class="offer-time">' + event.strftime('%S') + '<b>s</b></span>')
                                        $this.html('<span class="offer-time">' +  asd + ' Days')
                                    }else if (event.strftime('%D') < 1) {
                                        //$this.css({"color":"orange","font-weight":"bold"});
                                        $this.html('<span class="offer-time">' + event.strftime('%H') + '<b>H</b></span>' + '<span class="offer-time">' + event.strftime('%M') + '<b>m</b></span>')
                                    }
                                }
                            }

                        })
                            .on('finish.countdown', function() {
                                $this.html("<b>Missed it!</b>");
                            });
                    });
                }
            });
        });
    }

});