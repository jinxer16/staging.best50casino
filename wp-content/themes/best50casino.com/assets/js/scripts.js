// var ajax = {"ajax_url": "https://\/dev.best50casino.com\/wp-admin\/admin-ajax.php"};
var ajax = {"ajax_url": "https://\/www.best50casino.com\/wp-admin\/admin-ajax.php"};
// var ajax = {"ajax_url": "https://\/localhost/dev.best50casino.com\/wp-admin\/admin-ajax.php"};

function windowDimensions (){
    var w = window,
        d = document,
        e = d.documentElement,
        g = d.getElementsByTagName('body')[0],
        x = w.innerWidth || e.clientWidth || g.clientWidth,
        y = w.innerHeight|| e.clientHeight|| g.clientHeight;
    // console.log(x);
    return {width: x, height:  y};
}
$(document).on('click', '#exclusive-bonus', function() {
    var dimensions = windowDimensions();
    var tableID = $(this).parents('.star.shortcode-star').next('div.table-responsive').find('.table').attr('id');
    var rowCount = $('#'+tableID+' tr').length;
    var shownex = $(this).attr('data-shownex');
    // alert(shownex);
    if (rowCount < 15) {
        $(".not-exclusive").toggle();

    }else {
        if(shownex == 'off'){
            $(this).attr('data-shownex', 'on');
            if(dimensions.width <=576){
                $('#'+tableID+" tr.not-hidden.exclusive").css("display","flex");
                $('#'+tableID+" tr.not-exclusive").css("display","none");
            }else{
                $('#'+tableID+" tr.not-hidden.exclusive").css("display","table-row");
                $('#'+tableID+" tr.not-exclusive").css("display","none");
            }
        }else{
            $(this).attr('data-shownex', 'off');
            if($('.show-more-rows').attr('data-showr') =="off"){
                if(dimensions.width <=576){
                    $('#'+tableID+" tr.exclusive").css("display","flex");
                    $('#'+tableID+" tr.not-exclusive").css("display","flex");

                }else{
                    $('#'+tableID+" tr.exclusive").css("display","table-row");
                    $('#'+tableID+" tr.not-exclusive").css("display","table-row");
                }
                $('#'+tableID+" tr.hidden-row.not-exclusive").css("display","none");
                $('#'+tableID+" tr.hidden-row.exclusive").css("display","none");
            }else{
                if(dimensions.width <=576){
                    $('#'+tableID+" tr.exclusive").css("display","flex");
                    $('#'+tableID+" tr.not-exclusive").css("display","flex");
                }else{
                    $('#'+tableID+" tr.exclusive").css("display","table-row");
                    $('#'+tableID+" tr.not-exclusive").css("display","table-row");
                }
            }

        }
    }
    $(this).parents('.star.shortcode-star').next('div.table-responsive').each(function () {
        $(this).find('tr:visible:even').css('background-color', '#ffffff')
        $(this).find('tr:visible:odd').css('background-color', '#eeeeee')
    })
});

$(document).on('click', '.show-more-rows', function() {
    var tableID = $(this).closest(".table-responsive").find('.table').attr('id');
    var showRows = $(this).attr('data-showr');
    var dimensions = windowDimensions();
    var exclusive;
    if( $('#exclusive-bonus').length && document.getElementById('exclusive-bonus').checked){
        exclusive ='excluon';
    }
    if(showRows === 'off'){
        $(this).attr('data-showr', 'on');
        if(dimensions.width <=576){
            if (exclusive === 'excluon'){
                $('#'+tableID+" tr.hidden-row.exclusive").css("display","flex");
            }else{
                $('#'+tableID+" tr.hidden-row").css("display","flex");
            }
        }else{
            if (exclusive === 'excluon'){
                $('#'+tableID+" tr.hidden-row.exclusive").css("display","table-row");
            }else{
                $('#'+tableID+" tr.hidden-row").css("display","table-row");
            }
        }

        $(this).text("Hide Casinos");
    }else{
        $(this).attr('data-showr', 'off');
        $('#'+tableID+" tr.hidden-row").css("display","none");
        $(this).text("Show More Casinos");
    }
});
function addServ(){
    //desktop-large: 1460px
    //desktop-medium: 1200px
    //desktop-small: 1024px
    //desktop-xsmall: 768px
    //desktop-xxsmall: 320px
    var dimensions = windowDimensions();
    switch (true){
        case (dimensions.width >=  1460 ):
            $('div.widget_banner.desktop-large').each( function() {
                var banner = $(this).children().attr('data-banner');
                if(banner.indexOf("script") < 0) $(this).children().html(banner);
            });
            break;
        case (dimensions.width >=  1200 ):
            $('div.widget_banner.desktop-large').each( function() {
                $(this).children().html('');
            });
            $('div.widget_banner.desktop-medium').each( function() {
                var banner = $(this).children().attr('data-banner');
                if(banner.indexOf("script") < 0) $(this).children().html(banner);
            });
            break;
        case (dimensions.width >=  1024 ):
            $('div.widget_banner.desktop-large , div.widget_banner.desktop-medium').each( function() {
                $(this).children().html('');
            });
            $('div.widget_banner.desktop-small').each( function() {
                var banner = $(this).children().attr('data-banner');
                if(banner.indexOf("script") < 0) $(this).children().html(banner);
            });
            break;
        case (dimensions.width >=  768 ):
            $('div.widget_banner.desktop-large , div.widget_banner.desktop-medium, div.widget_banner.desktop-small').each( function() {
                $(this).children().html('');
            });
            $('div.widget_banner.desktop-xsmall').each( function() {
                var banner = $(this).children().attr('data-banner');
                if(banner.indexOf("script") < 0) $(this).children().html(banner);
            });
            break;
        case (dimensions.width >=  320 ):
            $('div.widget_banner.desktop-large , div.widget_banner.desktop-medium, div.widget_banner.desktop-small , div.widget_banner.desktop-xsmall').each( function() {
                $(this).children().html('');
            });
            $('div.widget_banner.desktop-xxsmall').each( function() {
                var banner = $(this).children().attr('data-banner');
                if(banner.indexOf("script") < 0) $(this).children().html(banner);
            });
            break;
    }
}
$( window ).on('load', function () {
    setTimeout(function () {
        addServ();
    }, 5000);
} );

window.addEventListener( "resize", function(){
    addServ();
});

$(document).ready(function() {

    // var currentTime = new Date().getTime();
    // var fortune = $(".giftwrap");
    //
    // if (localStorage.getItem('DayBestFortune') !== null) {
    //     if (localStorage.getItem('DayBestFortune') >= currentTime) {
    //         console.log('DAY');
    //         fortune.hide();
    //     }else{
    //         fortune.show();
    //     }
    // }else{
    //     fortune.show();
    // }

     $(".fowheel").on('show.bs.collapse', function(){
            $("#overlaysite").show();
            $(".giftwrap").hide();
        }).on('hide.bs.collapse', function(){
            $("#overlaysite").hide();
            $(".giftwrap").show();
     });

    $("#btn-user-login").on("click", function(){
        //$("#modalRegister").css('display', 'none');
        $("#modalRegister").modal('hide');
        $("#modalSignIn").modal('show');
    });

    $("#btn-user-forgot").on("click", function(){
        //$("#modalRegister").css('display', 'none');
        $("#modalSignIn").modal('hide');
        $("#modalForgot").modal('show');
    });

    $("#btn-user-register").on("click", function(){
        //$("#modalRegister").css('display', 'none');
        $("#modalSignIn").modal('hide');
        $("#modalRegister").modal('show');
    });


    $('ul.review-anchors li a').on('click', function (e) {
        // target hash
        var target = this.hash,
            $target = $(target);
        // go to hash, animate it and add 100pixels
        $('html, body').stop().animate({ 'scrollTop': $target.offset().top-100 }, 100, 'swing', function () { });
        //console.log(window.location);
        return false;
    });

    $('.element-item span.offer-info').click(function(){
        $(this).parent().children().children().toggleClass('flipped');
        $(this).children().toggle();
    });
    $("#openpromo").click(function() {
        $(".promotion-notes").toggleClass("marginpromo");
        $("#big-promo").slideToggle("slow");
        $("#small-promo").toggleClass("d-none");
    });

    $("#closepromo").click(function() {
        $("#big-promo").slideToggle("slow");
    });

// do stuff when checkbox change
    $('button.menu-item[data-toggle*="-mobile"]').on('click', function (event) {
        var selector = $(this).data('toggle');
        if($('#'+selector).css('display') == 'none') {
            $('button.is-checked').removeClass('is-checked');
            $('button.menu-item[data-toggle*="-mobile"]').each(function () {
                var selector2 = $(this).data('toggle');
                $('#' + selector2).css('display', 'none');
            });
            $('#' + selector).css('display', 'flex');
        }

    });
    $('div#options2.mobile-filters button').on('click', function (event) {
        if(!$(this).hasClass('active')){

            $('div#options2.mobile-filters button').each(function(){
                $(this).removeClass('active');
            });
            $(this).addClass('active');
        }
    });
    $('div#options2.mobile-filters .menu-games-mobile a').on('click', function (event) {
        if(!$(this).hasClass('active')){
            $('div#options2.mobile-filters .menu-games-mobile a').each(function(){
                $(this).removeClass('active');
            });
            $(this).addClass('active');
        }
    });
    $('#options2').on( 'click', '.btn', function() {
        var filterValue = $(this).attr('data-filter');

            if($(this).hasClass('active')) {
                if (filterValue == "*"){
                    $(".container-slots .element-item").fadeIn("slow");
                }else{
                $(".container-slots .element-item:not([data-filter*='" + filterValue + "'])").fadeOut( "slow" );
                $(".container-slots .element-item[data-filter*='" + filterValue + "']").fadeIn("slow");
                }
        }
    });
    $('#options').on( 'change', function( event ) {
        var checkbox = event.target;
        var $checkbox = $( checkbox );
        var group = $checkbox.parents('.option-set').attr('data-group');
        var values = $checkbox.attr('id');
        if($checkbox.is(':checked')){
             $( ".container-slots .element-item[data-filter*='" +  values + "']").addClass('activefilter');
             $('.container-slots .element-item').not('.activefilter').fadeOut( "slow" );
             $('.container-slots .element-item.activefilter').fadeIn("slow");
        }else{
            $( ".container-slots .element-item[data-filter*='" +  values + "']").removeClass('activefilter');
            $('.container-slots .element-item').fadeIn("slow");
        }

    });
    $.ajax({
        type: 'GET',
        data: { action : 'load_slots'},
        url: ajax.ajax_url,
        dataType: 'html',
        success: function(data){
            $('.container-slots').html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function () {
            $('.element-item span.offer-info').click(function(){
                $(this).parent().children().children().toggleClass('flipped');
                $(this).children().toggle();
                //$(this).$('.fa.fa-times-circle').toggle();
            });
            var true_classes = [];
            $(".isotope .element-item").each(function( index ) {
                var temp = $(this).attr('data-filter').split(" ");
                var seen_array = [];
                temp.forEach(function(item) {
                    if ( true_classes.indexOf( item ) < 0 && item ){
                        true_classes.push(item);
                    }
                });
            });
            $(".option-set label").each(function( index, e ) {
                if (true_classes.indexOf( $(this).attr('for') ) < 0  ){
                    $(this).css('display', 'none');
                    $(this).next('input').css('display', 'none');
                }
            });
        }
    });
   $('#folder-collapse').on("click", function () {
        if(!$("#small-promo").hasClass("show") && !jQuery("#big-promo").hasClass("show")){
            $("#small-promo").css("display", "none");
            //alert('a');
		}
	});
    var buttonContent;
    $('#provider_collapsebtn').on("click", function () {
        if(buttonContent == null){
            buttonContent =  $('#provider_collapsebtn').html();
        }
        if($('tr.collapse').hasClass('show')){
            $(this).html(buttonContent);
        }
        else {
            $('#provider_collapsebtn').html('Close Providers');
        }

    });
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
});

function SendMailer($this,e){
    e.preventDefault();
    var userNickName = $($this).find('#nameInput').val();
    var message = $($this).find('#message').val();
    var Typeof = $($this).find('#Typeof').val();
    var userEmail = $($this).find('#inputEmail').val();
    var subject = $($this).find('#subject').val();
    var captchResponse = $('#g-recaptcha-response').val();

     if(captchResponse.length == 0 ){
         $(".captcha-error").html('Please verify the captcha it cannot be empty!');
    } else{
    $.ajax({
        type: 'POST',
        url: ajax.ajax_url,
        data: {
            action: "send_email",
            userNickName: userNickName,
            userEmail: userEmail,
            Typeof: Typeof,
            message: message,
            subject: subject,

        },
        dataType: 'html',
        success: function (data) {
            $(".contact-success").html('Thank you for leaving us a message!');
            console.log(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function () {
        }

    });
     }
}


function emailIsValid(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}


function SubscirbeEmail(e,$this) {
    // var ajax = {"ajax_url": "https://\/dev.best50casino.com\/wp-admin\/admin-ajax.php"};
    var ajax = {"ajax_url": "https://\/www.best50casino.com\/wp-admin\/admin-ajax.php"};
    // var ajax = {"ajax_url": "https://\/localhost/dev.best50casino.com\/wp-admin\/admin-ajax.php"};
    var email = jQuery('.email-box__input').val();

    var yearafter = new Date(new Date().setFullYear(new Date().getFullYear() + 1));

    if (emailIsValid(email) === true){
        jQuery.ajax({
            type: 'POST',
            url: ajax.ajax_url,
            data: {action: "subscribe_contact", email:email },
            dataType: 'html',
            beforeSend : function () {
            },
            success: function (data) {
                jQuery(".SuccessMsg").html(data);
                localStorage.setItem('yearAfterBest', yearafter);
                setTimeout(function() {
                    $('.giftwrap').fadeOut();
                }, 2500);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            },
            complete: function (data) {
            }
        });
    }else{
        jQuery(".emailError").text('Please fill in a valid email !');
    }
}


function addCustomComment($this,e,postID){
    e.preventDefault();
    var userNickName = $($this).find('#nameComment').val();
    var message = $($this).find('#commentText').val();
    var userEmail = $($this).find('#emailComment').val();
    var userGender = $($this).find('input[name=avatarradio]:checked').val();
    var user_ip = $($this).find('.sumbitComment').attr("data-userip");
    var agent =  $($this).find('.sumbitComment').attr("data-agent");
    var country =  $($this).find('.sumbitComment').attr("data-country");
    var captchResponse = $('#g-recaptcha-response').val();

    if(!userNickName ){
        $($this).find('#nameComment').append('<b class="text-12" style="color:red;">Please fill in your name.</b>');
        return false;
    }else if(!message){
        $($this).find('#commentText').after('<b class="text-12" style="color:red;">Please comment field cannot be empty.</b>');
        return false;
    }else if(!userEmail){
        $($this).find('#emailComment').after('<b class="text-12" style="color:red;">Please fill in your email.</b>');
        return false;
    } else if(!userGender){
        $($this).find('#chos').after('<b class="text-12" style="color:red;">Please choose a gender.</b>');
        return false;
    }

    if(captchResponse.length == 0 ){
        $(".captcha-error").html('Please verify the captcha it cannot be empty!');
    } else{
        $.ajax({
            type: 'POST',
            url: ajax.ajax_url,
            data: {
                action: "add_custom_comment",
                userNickName: userNickName,
                userEmail: userEmail,
                userGender: userGender,
                postID: postID,
                message: message,
                agent: agent,
                country: country,
                user_ip: user_ip,
            },
            dataType: 'html',
            success: function (data) {
                $(".contact-success").html('Thank you,your comment is being reviewed!');
                // $(".comment-list").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            },
            complete: function () {
            }

        });
    }
}

function filter_guides(e,$this) {
    var tax_id = $($this).val();
    $.ajax({
        type: 'POST',
        url: ajax.ajax_url,
        data: {
            action: "filter_guides_category",
            tax_id:tax_id
        },
        dataType: 'html',
        success: function (data) {
            $(".guides-result").html(data);
            $('.select-style option').filter(function(){
                return $(this).val() == tax_id;
            }).prop("selected", true);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function () {
        }
    });
}


function filter_payments(e,$this){
    var idpayments = jQuery($this).attr("data-id");
    var title = jQuery($this).attr("data-title");

    $.ajax({
        type: 'GET',
        url: ajax.ajax_url,
        data: {
            action: "filter_payments_shortcode",
            idpayments: idpayments,
            title: title,
        },
        dataType: 'html',
        success: function (data) {
            $('.pay-table-filter').html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function () {
            $.each($('img'), function() {
                if ( $(this).attr('data-src')) {
                    var source = $(this).data('src');
                    $(this).attr('src', source);
                    $(this).removeAttr('data-src');
                    $(this).removeClass('lazy');
                }
            });
        }

    });
}

function filter_providers(e,$this){
    var idproviders = jQuery($this).attr("data-id");
    var title = jQuery($this).attr("data-title");

    $.ajax({
        type: 'GET',
        url: ajax.ajax_url,
        data: {
            action: "filter_providers_shortcode",
            idproviders: idproviders,
            title: title,
        },
        dataType: 'html',
        success: function (data) {
            $('.providers-table-filter').html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function () {
            $.each($('img'), function() {
                if ( $(this).attr('data-src')) {
                    var source = $(this).data('src');
                    $(this).attr('src', source);
                    $(this).removeAttr('data-src');
                    $(this).removeClass('lazy');
                }
            });
        }

    });
}




$(document).ready(function() {
    var dimensions = windowDimensions();

    if (dimensions.width <=  576) {
        var originalHeight = $('.exp-me').height();
        $('.exp-me').height("105px");
        $('.expand-me').on("click", function () {
            $('.single-kss_slots .entry, .exp-me').toggleClass('entry-open');

            if ($('.single-kss_slots .entry, .exp-me').hasClass('entry-open')) {
                $('.exp-me').animate({height: originalHeight}, {duration: 500, easing: "linear"});
                $('span.expand-me.visible-xs').html('Show Less');
            } else {
                $('.exp-me').animate({height: "105px"}, {duration: 500, easing: "linear"});
                $('span.expand-me.visible-xs').html('Show More');
            }
        });

    }
    $('.switch').on("click", function () {
        var tableID = $(this).closest('table').attr('id');
        if ($('#' + tableID + ' .switch input').is(':checked')) {
            $('#' + tableID + ' div.rating-toggle').addClass("hide-me");
            $('#' + tableID + " div.bonus-toggle").addClass("show-me");
        } else {
            $('#' + tableID + ' div.rating-toggle').removeClass("hide-me");
            $('#' + tableID + " div.bonus-toggle").removeClass("show-me");
        }

    });
    $('ul.offer-anchors li a[href^="#"]').on('click',function (e) {
        e.preventDefault();
        var target = this.hash;
        var $trget = $(target);
        // Example: your header is 70px tall.
        var newTop = $trget.offset().top - 170;
        $('html, body').animate ({
            scrollTop: newTop
        }, 500, 'swing', function () {
            window.location.hash = target;
        });
    });
});

function percentageToDegrees(percentage) {
    return percentage / 100 * 360;
}
$(document).ready(function() {
    
    $('.curl-top-right').click(function(){
        var code = $('.curl-top-right').attr("data-reveal");
        $('.curl-top-right').html(code);
        $('.curl-top-right').removeClass('bg-primary text-white');
        $('.curl-top-right').addClass('border-dashed bg-white text-18 text-muted before-remove after-remove');
        //$(this).$('.fa.fa-times-circle').toggle();
    });

    $('.element-item span.offer-info').click(function(){
        $(this).parent().children().children().toggleClass('flipped');
        $(this).children().toggle();
        //$(this).$('.fa.fa-times-circle').toggle();
    });

    $(".circle-progress .progress").each(function () {
        var value = $(this).attr('data-total');
        var left = $(this).find('.progress-left .progress-bar');
        var right = $(this).find('.progress-right .progress-bar');

        if (value > 0) {
            if (value <= 50) {
                // right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)');

                     right.css( { transition: "transform 0.8s",
                    transform:  "rotate(" + percentageToDegrees(value) + "deg)" } );
            } else {
                right.css( { transition: "transform 0.8s"});
                right.css('transform', 'rotate(180deg)');
                right.bind( 'transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function() {
                    left.css( { transition: "transform 0.6s",
                    transform:  "rotate(" + percentageToDegrees(value - 50) + "deg)" } ); });
                // left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
            }
        }
        // setTimeout( function() { (right).css( { transition: "none" } ) }, 500 );
        // setTimeout( function() { (left).css( { transition: "none" } ) }, 500 );
    });

    $('.payout-rates .progress-bar').each(function(){
        each_bar_width = $(this).attr('aria-valuenow');
        $(this).width(each_bar_width + '%');
    });

    $('.bonus-ratings .progress-bar').each(function(){
        each_bar_width = $(this).attr('aria-valuenow');
        $(this).width(each_bar_width + '%');
    });
    // Add minus icon for collapse
    $(".collapse.show").each(function(){
        $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
    });

    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function(){
        $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
    }).on('hide.bs.collapse', function(){
        $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
    });
    // style accordion button
    $('#faqs button').on('click', function(){
        $('button').removeClass('selected');
        $(this).addClass('selected');
    });

    $('.table-depo-btn').click(function(){
        var $this = $(this);
        $this.toggleClass('table-depo-btn');
        if($this.hasClass('table-depo-btn')){
            $this.html('<i class="fas fa-sync-alt"></i>  View More Deposit Methods');
            $('.hidden-payments-wrapper').slideUp('slow', function(){
                $('.hidden-payments-wrapper').css('display', 'none');
            });
            $('html, body').animate({
                scrollTop: $("#depotab").offset().top
            }, 700);
        } else {
            $this.html('<i class="fas fa-sync-alt"></i>  Show Less Deposit Methods');
            $('.hidden-payments-wrapper').slideDown('slow', function(){
                $('.hidden-payments-wrapper').css('display', 'block');
            });
        }
    });


    $('.table-with-btn').click(function(){
        var $this = $(this);
        $this.toggleClass('table-with-btn');
        if($this.hasClass('table-with-btn')){
            $this.html('<i class="fas fa-sync-alt"></i>  View More Withdrawals Methods');
            $('.hidden-withdrawals-wrapper').slideUp('slow', function(){
                $('.hidden-withdrawals-wrapper').css('display', 'none');
            });
            $('html, body').animate({
                scrollTop: $("#withtab").offset().top
            }, 700);
        } else {
            $this.html('<i class="fas fa-sync-alt"></i>  Show Less Withdrawals Methods');
            $('.hidden-withdrawals-wrapper').slideDown('slow', function(){
                $('.hidden-withdrawals-wrapper').css('display', 'block');
            });
        }
    });

    // $('.table-depo-btn').click(function(){
    //     $('.table-depo tbody tr.hidden-pay').show();
    //     $(this).text('-Show less');
    //     //$(this).$('.fa.fa-times-circle').toggle();
    // });
    // $('.table-with-btn').click(function(){
    //     $('.table-with tbody tr.hidden-pay').show();
    //     $(this).text('- Show less');
    //     //$(this).$('.fa.fa-times-circle').toggle();
    // });

    $('#showcase .cycle-slideshow .showcase-slide .left').each(function( index ) {
        var slideSRC = $(this).find('img').attr('src');
        $(this).find('img').hide();
        $(this).css('background-image', 'url(' + slideSRC + ')');
    });

    // Set Images as Backgrounds
    $('img.bg-image, .bg-image > img').each(function() {
        var imageSRC = $(this).attr('src');
        $(this).hide();
        $(this).parent().css('background-image', 'url(' + imageSRC + ')');
    });

    // $('.element-item figure').each(function( index ) {
    //     var slideSRC = $(this).find('img.game-image').attr('src');
    //     $(this).find('img.game-image').hide();
    //     $(this).css('background-image', 'url(' + slideSRC + ')');
    // });

    $(function() {
        $('.intro_paragraph_content').delay(2000).slideUp(300);
        $(".intro_paragraph").delay(2000).addClass('active');
        $(".intro_paragraph").click(function() {
            $(this).children('.intro_paragraph_content').slideToggle(300);
            $(this).toggleClass('active');
            return false;
        });
    });

    $(".close-x").click(function(){
        var x =  $(this).attr('data-id');
        $('#'+x).addClass('d-none');
        $('#'+x).removeClass('d-flex');
        $('#'+x).removeClass('d-block');
        $('#'+x).removeClass('d-md-block');
        $("#premium-casinos").hide("slide", { direction: "down" }, 1000);
    });

    $(".expand-tcs").click(function(){
        var x = $(this).attr('data-id');
        $(this).toggleClass('fa-caret-up');
        $("#"+x).toggleClass('tcs-expanded');
    });
    $(".tcs").each(function( index ){
        var tcsID = $(this).attr('id');
        if ($(this).height() < 20 ){
            $('[data-id="'+tcsID+'"]').hide();
        }
    });
    $(".expand-cs").click(function(){
        var x = $(this).attr('data-id');
        $(this).toggleClass('fa-minus');
        $("span#"+x).toggleClass('cs-expanded');
    });
    $( "#premium-casinos" ).delay( 3000 ).fadeIn( 400 );

});

/********************************************************************** ANIMATE ON SCROLL ****************************************************************************/

$(function() {
    var dimensions = windowDimensions();
  var $window           = $(window),
      win_height_padded = $window.height() * 1.1;

  if (dimensions.width <=  576) { $('.revealOnScroll').addClass('animated'); }

  $window.on('scroll', revealOnScroll);

  function revealOnScroll() {
    var scrolled = $window.scrollTop(),
        win_height_padded = $window.height() * 1.1;

    // Showed...
    $(".revealOnScroll:not(.animated)").each(function () {
      var $this     = $(this),
          offsetTop = $this.offset().top;

      if (scrolled + win_height_padded > offsetTop) {
        if ($this.data('timeout')) {
          window.setTimeout(function(){
            $this.addClass('animated ' + $this.data('animation'));
          }, parseInt($this.data('timeout'),10));
        } else {
          $this.addClass('animated ' + $this.data('animation'));
        }
      }
    });
    // Hidden...
   $(".revealOnScroll.animated").each(function (index) {
      var $this     = $(this),
          offsetTop = $this.offset().top ;
      if (scrolled + win_height_padded- 100 < offsetTop) {
        $(this).removeClass('animated fadeInUp flipInX lightSpeedIn zoomInUp');
      }
    });
  }

  revealOnScroll();
});
/********************************************************************** CIIRCLE PROGRESS BAR ****************************************************************************/
(function($){
	$.fn.percentPie = function(options){

		var settings = $.extend({
			width: 100,
			trackColor: "EEEEEE",
			barColor: "777777",
			barWeight: 30,
			startPercent: 0,
			endPercent: 1,
			fps: 60
		}, options);

		this.css({
			width: settings.width,
			height: settings.width
		});

		var that = this,
			hoverPolice = false,
			canvasWidth = settings.width,
			canvasHeight = canvasWidth,
			id = $('canvas').length,
			canvasElement = $('<canvas id="'+ id +'" width="' + canvasWidth + '" height="' + canvasHeight + '"></canvas>'),
			canvas = canvasElement.get(0).getContext("2d"),
			centerX = canvasWidth/2,
			centerY = canvasHeight/2,
			radius = settings.width/2 - settings.barWeight/2;
			counterClockwise = false,
			fps = 1000 / settings.fps,
			update = .01;
			this.angle = settings.startPercent;

		this.drawArc = function(startAngle, percentFilled, color){
			var drawingArc = true;
			canvas.beginPath();
			canvas.arc(centerX, centerY, radius, (Math.PI/180)*(startAngle * 360 - 90), (Math.PI/180)*(percentFilled * 360 - 90), counterClockwise);
			canvas.strokeStyle = color;
			canvas.lineWidth = settings.barWeight;
			canvas.stroke();
			drawingArc = false;
		}

		this.fillChart = function(stop){
			var loop = setInterval(function(){
				hoverPolice = true;
				canvas.clearRect(0, 0, canvasWidth, canvasHeight);

				that.drawArc(0, 360, settings.trackColor);
				that.angle += update;
				that.drawArc(settings.startPercent, that.angle, settings.barColor);

				if(that.angle > stop){
					clearInterval(loop);
					hoverPolice = false;
				}
			}, fps);
		}

		/* this.mouseover(function(){
			if(hoverPolice == false){
				that.angle = settings.startPercent;
				that.fillChart(settings.endPercent);
			}
		}); */

		this.fillChart(settings.endPercent);
		this.append(canvasElement);
		return this;
	}
}(jQuery));
$(document).ready(function() {
  
	$('.casino-chart').percentPie({
		width: 70,
		trackColor: "#7d7d7d",
		barColor: "#ffbb00",
		barWeight: 5,
		endPercent: .9,
		fps: 60
	});
    
});

$(document).ready(function(){
/********************************************************************** LINE PROGRESS BAR ****************************************************************************/
	$('.progress-bar').each(function(){
		each_bar_width = $(this).attr('aria-valuenow');
		$(this).width(each_bar_width + '%');
	});
    jQuery( "#slider-range-max" ).slider({
        range: "max",
        min: 10,
        max: 100,
        value: 1,
        slide: function( event, ui ) {
            jQuery( "#amount" ).val( ui.value/10 );
        }
    });
    jQuery( "#amount" ).val( $( "#slider-range-max" ).slider( "value" )/10 );
});
$(document).ready(function(){
    /********************************************************************** MOBILE NAV BAR EFFECT ****************************************************************************/

    $('.myNavbar , a.closebtn').click(function() {
        if ($('#lasssNavbar, #mynavbar-2').hasClass('right-in')) {
            $('#lasssNavbar, #mynavbar-2').removeClass('right-in');
            $('body').removeClass('no-scroll go-right');
            $('#lasssNavbar').css("left", -260);
            // $('#nav1').css("left", 0);
            // $('#body').css("left", 0);
            // $('#footer').css("left", 0);
            // $('.gadgets-cont').css("left", 0);
        } else {
            $('#lasssNavbar, #mynavbar-2').addClass('right-in');
            $('body').addClass('no-scroll go-right');
            $('#lasssNavbar').css("left", 0);
            // $('#nav1').css("left", 250);
            // $('#body').css("left", 250);
            // $('#footer').css("left", 250);
            // $('.gadgets-cont').css("left", 250);
        }
    });
	$('#body, .gadgets-cont ').click(function() {
		if ($('#lasssNavbar, #mynavbar-2').hasClass('right-in')) {
			$('#lasssNavbar, #mynavbar-2').removeClass('right-in');
			$('body').removeClass('no-scroll go-right');
			$('#lasssNavbar').css("left", -260);
			// $('#nav1').css("left", 0);
			// $('#body').css("left", 0);
			// $('#footer').css("left", 0);
			// $('.gadgets-cont').css("left", 0);

		}
	});
});


/* $(function(){
  $('.star_rating').rating();
}); */

/**
 * Star module
 * jayjamero@propertyguru.com.sg
**/
/* $.fn.rating = function() {
	var val = 0, size = 0, stars = 5;
	return this.each(function(i,e){ val = parseFloat($(e).text()); size = ( $(e).width() / stars ); $(e).html($('<span/>').animate({ width: val * size }, 1000 ) ); });
}; */

 $(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	/*$(".tooltip-span").tooltip({
		placement: "top"
	});*/
});

/******************************** KSS GAMES & SLOTS TOGGLE PARAGRAPH HEIGHT *******************************************/

$(document).ready(function(){
    var dimensions = windowDimensions();
	if (dimensions.width <=  768) {
		$('div#options').removeClass("in");
        $(window).on("scroll", function(e) {
        	$pointHeight = $('.center-casino').offset().top + 80;
            if ($(window).scrollTop() > $pointHeight) {
                $(".mobile-footer-banner-bookie").css("position", "sticky");
            } else {
            //	alert($(window).scrollTop);
                $(".mobile-footer-banner-bookie").css("position", "initial");
            }

        });
	}
	if (dimensions.width <=  576) {
		$('div#options').removeClass("in");
		if ($('article').hasClass('post-3918') || $('article').hasClass('post-1081') || $('article').hasClass('post-482') || $('article').hasClass('post-1088') ){
			$('.su-note').css('display', 'none');
			$('.entry-content p:first-of-type').after('<span class="expand-me_2">more</span>');
			$('.entry-content p:first-of-type').toggleClass('entry-closed');
		}
		$('a.main-txt-link-2').html('<span style="color: #ff0000; text-decoration: underline;font-weight:600;">Κριτική Καζίνο</span>');
	}
	$('.expand-me_2').on( "click", function() {
		$( '.entry-content p:first-of-type' ).toggleClass('entry-closed');
		if ( $('.entry-content p:first-of-type').hasClass('entry-closed') ){
			$('.expand-me_2').html('more');
		}else{
			$('.expand-me_2').html('less');
		}
		
	});
});

$(window).scroll(function() {
    if ($(this).scrollTop() > 50 ) {
        $('.scrolltop:hidden').stop(true, true).fadeIn();
    } else {
        $('.scrolltop').stop(true, true).fadeOut();
    }
});
// scroll to top on click
$(function(){
    $(".scroll").click(function(){
        jQuery("html,body").animate({ scrollTop: jQuery("body").offset().top },"1000");
        return false;
    })
});

function sortTableBy($this,sortingCriteria,iso){
    var allTabs = $('.sorting-buttons');
    var closestArrow = $($this).closest('.sorting-buttons').find('.fas');
    var closestButton = $($this).closest('.sorting-buttons').find('.tabaki');
    allTabs.children().removeClass('bg-active-filter');
    closestButton.addClass('bg-active-filter');
    if(closestArrow.hasClass('fa-sort')){
        allTabs.find('.fa-sort-down').removeClass('fa-sort-down');
        allTabs.find('.fa-sort-up').removeClass('fa-sort-up');
        allTabs.find('.fas').addClass('fa-sort');
        closestArrow.removeClass('fa-sort');
        closestArrow.addClass('fa-sort-down');
    }else if(closestArrow.hasClass('fa-sort-down')){
        closestArrow.removeClass('fa-sort-down');
        closestArrow.addClass('fa-sort-up');
    }else if(closestArrow.hasClass('fa-sort-up')){
        closestArrow.removeClass('fa-sort-up');
        closestArrow.addClass('fa-sort-down');
    }
    var data = JSON.stringify($($this).data());
    var sortorder = $($this).attr("data-sortorder");
    var contaiclass = $($this).attr("data-contid");

    // var ajax = {"ajax_url": "https://\/localhost/dev.best50casino.com\/wp-admin\/admin-ajax.php"};

    $.ajax({
        type: 'POST',
        data: { action : 'tabsShortcodes', shortcodeAtts:data,sorting: sortingCriteria,SortOrder:sortorder},
        url: ajax.ajax_url,
        dataType: 'html',
        success: function(data){
            $('.'+contaiclass).html(data);

            var newsort = sortorder === "DESC" ? "ASC" : "DESC";
            $($this).attr("data-sortorder",newsort);

            if ($($this).hasClass('tabaki')){
                $($this).closest('.sorting-buttons').find('.arroow').attr("data-sortorder",newsort);
            }else if($($this).hasClass('arroow')){
                $($this).closest('.sorting-buttons').find('.tabaki').attr("data-sortorder",newsort);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function () {
            $.each($('img'), function() {
                if ( $(this).attr('data-src')) {
                    var source = $(this).data('src');
                    $(this).attr('src', source);
                    $(this).removeAttr('data-src');
                    $(this).removeClass('lazy');
                }
            });
        }
    });
}

jQuery('#subMenuWrapper').mouseleave(function(){
    toggleMenu('','out');
})
jQuery('.main-menu li:not(.menu-item-has-children)').mouseenter(function(){
    toggleMenu('','out');
})