jQuery(document).ready(function ($) {
    //Search field auto complete
    jQuery(".searchField").on("keyup focus", function() {
        var value = jQuery(this).val().toLowerCase(); // value to search
        var target = jQuery(this).attr('data-targetID');
        // var fitlers = jQuery(this).attr('data-filter').toLowerCase();
        jQuery(target).filter(function() {
            jQuery(this).toggle($(this).data("filter").toLowerCase().indexOf(value) > -1);
        });
    });

})
function createColorPalette(percent){

    var perc = percent/10;
    perc = Math.round(perc);
    var final=[];
    var colorPallete=[
        '#88b1cf',
        '#75a7ca',
        '#6d92ac',
        '#5d86a2',
        '#50728d',
        '#486577',
        '#415b6c',
        '#334350',
        '#1a303d',
        '#142733',]
    for(i = 0; i < perc; i++){
        final.push(colorPallete[i]);
    }
    var restColors = final.length;
    for(j = 0; j < 10-final.length; j++){
        final.push('#d4dbd4');
    }
    return final;
}
function drawCircle(canvas){
    percent = +canvas.data('completeness'),
        ctx     = canvas.get(0).getContext('2d');
    ctx.lineWidth = 12;
    var colorPallete = createColorPalette(percent);
    var gap = 2;
    var rad = 35;
    var endAngle = (Math.PI * percent * 2 / 100);

    for (i = 0; i < 10; i++) {
        var startAngle = (Math.PI / 180) * ((-90+(i*34)+(i*2)));
        var endAngle = (Math.PI / 180 )* (-90+((i+1)*34)+(i*2));
        ctx.strokeStyle = colorPallete[i];
        ctx.lineWidth = 12;
        ctx.beginPath();
        ctx.arc(50, 50, rad, startAngle,endAngle, false);
        ctx.stroke();
    }
    ctx.font = "bold 13px Arial";
    var perc = percent/10;
    perc = perc.toFixed(1)
    ctx.fillText(perc, 41, 55);

}
window.onload = function() {
    canvas  = $('.rating-circle').each(function(){
        drawCircle($(this));
    });
}
function placeCasinoInComparison(casinoID,position){
    // var ajax = {"ajax_url": "https://\/www.best50casino.com\/wp-admin\/admin-ajax.php"};
var ajax = {"ajax_url": "https://\/localhost/dev.best50casino.com\/wp-admin\/admin-ajax.php"};
    var spinner = '<div class="d-flex w-100 justify-content-center p-10p"><div class="spinner-grow text-primary" role="status">\n' +
        '  <span class="sr-only">Loading...</span>\n' +
        '</div></div>';
    $(position).html(spinner);
    $.ajax({
        type: 'GET',
        url: ajax.ajax_url,
        data: {
            action: "placeCasinoInComparison",
            casino: casinoID,
        },
        dataType: 'html',
        success: function (data) {
            $(position).html(data);
            $(position).data('filled',true);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function () {
            drawCircle($(position+' canvas'));
        }

    });
}
function placeHere($this){
    var casinoID = $($this).attr('data-filterid');
    var position = $($this).attr('data-position');
    placeCasinoInComparison(casinoID,position);
    $('.helping-hand').hide('slow');
}
function placeOrChoose($this){
    if($('.comparison-position-2').data('filled')===false){
        return '.comparison-position-2';
    }else if($('.comparison-position-3').data('filled')===false){
        return '.comparison-position-3';
    }else{
        $('.comparison-position-2').addClass('position-relative');
        var casinoName1 = $('.comparison-position-2').find(">:first-child").data('name');
        var casinoid1 = $($this).data('filterid');
        $('.comparison-position-2').append('<div class="position-absolute p-10p bg-dark text-white best50-buzz-out helping-hand cursor-point rounded-circle text-12 text-center" style="width:60px;height:60px;top:-10px;right:-10px;" onclick="placeHere(this)" data-position=".comparison-position-2" data-filterid="'+casinoid1+'">Replace this</div>');
        $('.comparison-position-3').addClass('position-relative');
        var casinoName2 = $('.comparison-position-3').find(">:first-child").data('name');
        var casinoid2 = $($this).data('filterid');
        $('.comparison-position-3').append('<div class="position-absolute p-10p bg-dark text-white best50-buzz-out helping-hand cursor-point rounded-circle text-12 text-center" style="width:60px;height:60px;top:-10px;right:-10px;" onclick="placeHere(this)" data-position=".comparison-position-3" data-filterid="'+casinoid2+'">Replace this</div>');
            setInterval(function(){
                $('.best50-buzz-out').css('animation-name' , "best50-buzz-out .75s linear");
                $('.best50-buzz-out').css('-webkit-animation' , "best50-buzz-out .75s linear")
            },3000);
    }
}

jQuery(function() {
    jQuery(".pickme").click(function(){
        var casinoID = $(this).data('filterid');
        var position = placeOrChoose($(this));
        placeCasinoInComparison(casinoID,position);
    })
})
