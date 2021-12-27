jQuery(document).ready(function() {
    /**** SCROLL TO TOP ****/
    // scroll to top show/hide
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
    /**** MOBILE NAV BAR EFFECT ****/
    $('.myNavbar , a.closebtn').click(function() {
        if ($('#lasssNavbar, #mynavbar-2').hasClass('right-in')) {
            $('#lasssNavbar, #mynavbar-2').removeClass('right-in');
            $('body').removeClass('no-scroll go-right');
            $('#lasssNavbar').css("left", -260);
        } else {
            $('#lasssNavbar, #mynavbar-2').addClass('right-in');
            $('body').addClass('no-scroll go-right');
            $('#lasssNavbar').css("left", 0);
        }
    });
    $('#body, .gadgets-cont ').click(function() {
        if ($('#lasssNavbar, #mynavbar-2').hasClass('right-in')) {
            $('#lasssNavbar, #mynavbar-2').removeClass('right-in');
            $('body').removeClass('no-scroll go-right');
            $('#lasssNavbar').css("left", -260);
        }
    });
    // initialize tooltip
    $('[data-toggle="tooltip"]').tooltip();
    // progressbar review
    $('.progress-bar').each(function(){
        each_bar_width = $(this).attr('aria-valuenow');
        $(this).width(each_bar_width + '%');
    });
});