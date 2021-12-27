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
        '#142733',
        '#142733',]
    for(var i = 0; i < perc; i++){
        final.push(colorPallete[i]);
    }
    var restColors = final.length;
    for(var j = 0; j < 10-final.length; j++){
        final.push('#d4dbd4');
    }
    return final;
}
function drawCircle(canvas){
    var percent = +canvas.getAttribute('data-completeness'),
    ctx     = canvas.getContext('2d');
    ctx.lineWidth = 12;
    var colorPallete = createColorPalette(percent);
    var gap = 2;
    var rad = 35;
    var endAngle = (Math.PI * percent * 2 / 100);

    for (var i = 0; i < 10; i++) {
        var startAngle = (Math.PI / 180) * ((-90+(i*34)+(i*2)));
        var endAngle = (Math.PI / 180 )* (-90+((i+1)*34)+(i*2));
        canvas.parentNode.style.background = colorPallete[i];
        // ctx.strokeStyle = colorPallete[i];
        // ctx.lineWidth = 12;
        // ctx.beginPath();
        // ctx.arc(50, 50, rad, startAngle,endAngle, false);
        // ctx.stroke();
    }
    // ctx.font = "bold 13px Arial";
    // var perc = percent/10;
    // perc = perc.toFixed(1)
    // var ret = ctx.fillText(perc, 41, 55);
}
const canvas = document.getElementById('rating');
canvas.parentNode.style.background = 'red';
drawCircle(canvas);

// window.onload = function() {
// const canvas = document.getElementsByClassName("rating-circle");
    // canvas.parentNode.style.background = 'red';
    // drawCircle(canvas);
    // for (var i = 0; i < canvas.length; i++) {
    //
    //     drawCircle(canvas.item(i));
    //
    // }
// }