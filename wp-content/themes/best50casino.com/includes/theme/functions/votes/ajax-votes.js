function setVote(casinoID, v) {
    // var ajaxVotes = {"ajax_url":"\/wp-admin\/admin-ajax.php"};
    var ajaxVotes = {"ajax_url":"https://\/www.best50casino.com\/wp-admin\/admin-ajax.php"};
    // var ajaxVotes = {"ajax_url":"https://\/dev.best50casino.com\/wp-admin\/admin-ajax.php"};
    // var ajaxVotes = {"ajax_url": "https://\/localhost/dev.best50casino.com/\/wp-admin\/admin-ajax.php"};
    $("#ajaxLoader").show();
    // var ajaxVotes = {"ajax_url":"\/www.best50casino.com\/wp-admin\/admin-ajax.php"};
    jQuery.ajax({
        type: 'POST',
        url: ajaxVotes.ajax_url,
        data: {action: 'addVote', post_id: casinoID, value: v},
        dataType: 'json',
        success: function (data) {
            if($('.star-voting').hasClass('voting-game')) {
                $('.star-voting-wrap .vote-text').text(data.totalvotes+' Player\'s Reviews');
                $("#ajaxLoader").hide();
            }else {
                $('.star-voting-wrap .vote-text').text('Thank you for your vote');
                $('.star-voting-wrap .vote-stats-1').text(data.totalvotes+' Reviews');
                $('.star-voting-wrap .vote-stats-2').text(data.v);
                $("#ajaxLoader").hide();
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function () {
        }
    });
}
function round(value, precision) {
    var multiplier = Math.pow(10, precision || 0);
    return Math.round(value * multiplier) / multiplier;
}
function vote(vote,id) {
    setVote(id, vote);
}
// $('.star-voting').each(function (i, obj) {
//     // console.log($(this).attr('id'));
//     vote($(this).attr('id'));
// });
$('.star-voting.hoverable .star-wrap').on('click',function (i, obj) {

    var currStarId = $(this).attr('id').replace("star-", "");
    var box = $(this).closest('.star-voting');
    for (var j = 1; j <= currStarId; j++) {
        $(box).find(".star-" + j + " > div").addClass("mousedone");
    }
    var x,y;
    var offset = $(this).parent().offset();
    x = event.pageX- offset.left;
    x = normalizationVote(x);

    if($(this).parent().hasClass('hoverable')){
        $(this).parent().removeClass('hoverable');
        $(this).parent().attr('data-votes',x);
        if ($("body").hasClass("single-kss_casino") || $("body").hasClass("single-bc_bonus_page")){

        }else{
            vote(x, $(this).parent().attr('data-post'));
        }
    }
});
$('.star-voting.hoverable .star-wrap').mouseover(function(){
    if($(this).parent().hasClass('hoverable')) {
        var currStarId = $(this).attr('id').replace("star-", "");
        var box = $(this).closest('.star-voting');
        for (var j = 1; j <= currStarId; j++) {
            $(box).find(".star-" + j + " > div").addClass("mousevote");
        }
    }
});
$('.star-voting.hoverable .star-wrap').mouseout(function(){
    if($(this).parent().hasClass('hoverable')) {
        var box = $(this).closest('.star-voting');
        var currStarId = $(this).attr('id').replace("star-", "");
        for (var j = 1; j <= currStarId; j++) {
            $(box).find(".star-" + j + " > div").removeClass("mousevote");
        }
    }
});
$(".star-voting.hoverable").on({mouseenter:showStarRating,mouseleave:hideStarRating,mousemove:countX});
function hideStarRating(){
    var box=$(this).closest('.star-voting');
    $(box).find('.star-wrap').removeClass('star-temp');
    var x,y;
    var defaultVote=$(this).attr('data-votes');
    $('.vote-stats-2').html(defaultVote);
}
function showStarRating(){
    if($(this).hasClass('hoverable')) {
        var box = $(this).closest('.star-voting');
        $(box).find('.star-wrap').addClass('star-temp');
    }
}
function countX() {
    if($(this).hasClass('hoverable')){
        var x,y;
        var offset = $(this).offset();
        x = event.pageX- offset.left;
        // y = event.pageY- offset.top;
        x = normalizationVote(x);
        $(".vote-stats-2").html(x);
    }
}
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
function normalizationVote(x){
    var dimensions = windowDimensions();
    if($('.star-voting').hasClass('voting-game') || $('.star-voting').hasClass('voting-casino')) {
        if(dimensions.width< 576 && $('.star-voting').hasClass('voting-game')){
            x=(130/100)*x;
        }else{
            x=(67/100)*x;
        }
    }else {
        x=(103/80)*x;
    }
    x=(x/10).toFixed(1);
    if(x>10)x=10;
    return x;
}
