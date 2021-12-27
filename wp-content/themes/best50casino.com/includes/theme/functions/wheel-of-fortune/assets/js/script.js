// global variables
const confetti = document.getElementById('confetti');
const confettiCtx = confetti.getContext('2d');
let container, confettiElements = [], clickPosition;

// helper
rand = (min, max) => Math.random() * (max - min) + min;

// params to play with
const confettiParams = {
    // number of confetti per "explosion"
    number: 70,
    // min and max size for each rectangle
    size: { x: [5, 20], y: [10, 18] },
    // power of explosion
    initSpeed: 25,
    // defines how fast particles go down after blast-off
    gravity: 0.65,
    // how wide is explosion
    drag: 0.08,
    // how slow particles are falling
    terminalVelocity: 6,
    // how fast particles are rotating around themselves
    flipSpeed: 0.017,
};
const colors = [
    { front : '#3B870A', back: '#235106' },
    { front : '#B96300', back: '#6f3b00' },
    { front : '#E23D34', back: '#88251f' },
    { front : '#CD3168', back: '#7b1d3e' },
    { front : '#664E8B', back: '#3d2f53' },
    { front : '#394F78', back: '#222f48' },
    { front : '#008A8A', back: '#005353' },
];


// confetti.addEventListener('click', addConfetti);
window.addEventListener('resize', () => {
    setupCanvas();
    hideConfetti();
});

// Confetti constructor
function Conf() {
    this.randomModifier = rand(-1, 1);
    this.colorPair = colors[Math.floor(rand(0, colors.length))];
    this.dimensions = {
        x: rand(confettiParams.size.x[0], confettiParams.size.x[1]),
        y: rand(confettiParams.size.y[0], confettiParams.size.y[1]),
    };
    this.position = {
        x: clickPosition[0],
        y: clickPosition[1]
    };
    this.rotation = rand(0, 2 * Math.PI);
    this.scale = { x: 1, y: 1 };
    this.velocity = {
        x: rand(-confettiParams.initSpeed, confettiParams.initSpeed) * 0.4,
        y: rand(-confettiParams.initSpeed, confettiParams.initSpeed)
    };
    this.flipSpeed = rand(0.2, 1.5) * confettiParams.flipSpeed;

    if (this.position.y <= container.h) {
        this.velocity.y = -Math.abs(this.velocity.y);
    }

    this.terminalVelocity = rand(1, 1.5) * confettiParams.terminalVelocity;

    this.update = function () {
        this.velocity.x *= 0.98;
        this.position.x += this.velocity.x;

        this.velocity.y += (this.randomModifier * confettiParams.drag);
        this.velocity.y += confettiParams.gravity;
        this.velocity.y = Math.min(this.velocity.y, this.terminalVelocity);
        this.position.y += this.velocity.y;

        this.scale.y = Math.cos((this.position.y + this.randomModifier) * this.flipSpeed);
        this.color = this.scale.y > 0 ? this.colorPair.front : this.colorPair.back;
    }
}

function updateConfetti () {
    confettiCtx.clearRect(0, 0, container.w, container.h);

    confettiElements.forEach((c) => {
        c.update();
        confettiCtx.translate(c.position.x, c.position.y);
        confettiCtx.rotate(c.rotation);
        const width = (c.dimensions.x * c.scale.x);
        const height = (c.dimensions.y * c.scale.y);
        confettiCtx.fillStyle = c.color;
        confettiCtx.fillRect(-0.5 * width, -0.5 * height, width, height);
        confettiCtx.setTransform(1, 0, 0, 1, 0, 0)
    });

    confettiElements.forEach((c, idx) => {
        if (c.position.y > container.h ||
            c.position.x < -0.5 * container.x ||
            c.position.x > 1.5 * container.x) {
            confettiElements.splice(idx, 1)
        }
    });
    window.requestAnimationFrame(updateConfetti);
}

function setupCanvas() {
    container = {
        w: confetti.clientWidth,
        h: confetti.clientHeight
    };
    confetti.width = container.w;
    confetti.height = container.h;
}

function addConfetti(e) {

    const canvasBox = confetti.getBoundingClientRect();
    if (e) {
        clickPosition = [
            e.clientX - canvasBox.left,
            e.clientY - canvasBox.top
        ];
    } else {
        clickPosition = [
            canvasBox.width * Math.random(),
            canvasBox.height * Math.random()
        ];
    }
    for (let i = 0; i < confettiParams.number; i++) {
        confettiElements.push(new Conf())
    }
}

function hideConfetti() {
    confettiElements = [];
    window.cancelAnimationFrame(updateConfetti)
}

function rand(min, max) {
    return Math.random() * (max - min) + min;
}

const logos = document.getElementById("arrayGifts").value;
const label = logos.split(",");

var images = [];

function loadImages(paths,whenLoaded){
    var imgs=[];
    paths.forEach(function(path){
        var img = new Image;
        img.onload = function(){
            imgs.push(img);
            if (imgs.length === paths.length) whenLoaded(imgs);
        }
        img.src = path;
    });
}

label.forEach(function(name){
    image = new Image();   // create image
    image.src =  name;      // set the src from the first server
    images.push(image);    // push it onto the image array
});

const colours = document.getElementById("arrayColor").value;
const color = colours.split(",");

const slices = color.length;
const sliceDeg = 360/slices;

var deg = 270;
// var deg = 227.5;
// var deg = rand(0, 360);
var speed = 0;
var slowDownRand = 0;
var ctx = canvas.getContext('2d');
var width = canvas.width; // size
var center = width/2;      // center
var isStopped = false;
var lock = false;

function deg2rad(deg) {
    return deg * Math.PI/180;
}

function drawSlice(deg, color) {
    ctx.beginPath();
    ctx.shadowColor = '#000';
    ctx.shadowBlur = 3;
    ctx.shadowOffsetX = 2;
    ctx.shadowOffsetY = 2;
    ctx.fillStyle = color;
    ctx.moveTo(center, center);
    ctx.arc(center, center, width/2, deg2rad(deg), deg2rad(deg+sliceDeg));
    ctx.lineTo(center, center);
    ctx.fill();
    ctx.stroke();
}

function drawRotated(degrees,image){
    ctx.save();
    // move to the center of the canvas
    ctx.translate(center,center);
    // rotate the canvas to the specified degrees
    ctx.rotate(deg2rad(degrees));
    // draw the image
    // since the context is rotated, the image will be rotated also
    ctx.drawImage(image, 88, -35, 150, 150 * image.height / image.width);
    // we’re done with the rotating so restore the unrotated context
    ctx.restore();
}

// function drawText(deg, text) {
//     ctx.save();
//     ctx.translate(center, center);
//     ctx.rotate(deg2rad(deg));
//     ctx.textAlign = "right";
//     ctx.fillStyle = "#fff";
//     ctx.font = 'bold 15px sans-serif';
//     ctx.fillText(text, 245, 10);
//     ctx.restore();
// }


function drawknob() {
    const getContext = () => document.getElementById('canvas').getContext('2d');
// It's better to use async image loading.
    const loadImage = url => {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.onload = () => resolve(img);
            img.onerror = () => reject(new Error(`load ${url} fail`));
            img.src = url;
        });
    };
// Here, I created a function to draw image.
    const depict = options => {
        const ctx = getContext();
        // And this is the key to this solution
        // Always remember to make a copy of original object, then it just works :)
        const myOptions = Object.assign({}, options);
        return loadImage(myOptions.uri).then(img => {
            ctx.drawImage(img, myOptions.x, myOptions.y, myOptions.sw, myOptions.sh);
        });
    };

    const imgs = [
        { uri: 'https://www.best50casino.com/wp-content/themes/best50casino.com/includes/theme/functions/wheel-of-fortune/assets/images/outlinewowo.png', x: 0, y:  0, sw: 550, sh: 550 },
    ];

    imgs.forEach(depict);
}


function drawImg() {
    ctx.clearRect(0, 0, width, width);
    for (var i = 0; i < slices; i++) {
        drawSlice(deg, color[i]);
        drawRotated(deg + sliceDeg / 2,  images[i]);
        drawknob();
        deg += sliceDeg;
    }
}

loadImages(label,function(){
      drawImg();
});


const pin = document.querySelector('.pinwheel');
var wheel = document.getElementById('canvas');
const startButton = document.querySelector('.button');

function animA(){

    function addAnim() {
        $('.pinwheel').toggleClass("pinanimation");
     }
    var i=0;
    var timer = setInterval(function() {
        addAnim();
        ++i;
         if (i === 45) clearInterval(timer);
    }, 120);

    setTimeout(function(){
        var b=0;
        var timertwo = setInterval(function() {
            addAnim();
            ++b;
            if (b === 8) clearInterval(timertwo);
           }, 220);
        }, 5400);

    setTimeout(function(){
        var d=0;
        var timertwo = setInterval(function() {
            addAnim();
            ++d;
            if (d === 5) clearInterval(timertwo);
        }, 350);
    }, 7160);

    setTimeout(function(){
        var c=0;
        var timertwo = setInterval(function() {
            addAnim();
               ++c;
            if (c === 1){
                clearInterval(timertwo);
                $('.pinwheel').removeClass("pinanimation");
            }
        }, 1000);
    }, 8900);

}

startButton.addEventListener('click', () => {
    // Disable button during spin
    startButton.style.pointerEvents = 'none';
    // Calculate a new rotation between 5000 and 10 000
    dege = Math.floor(1200 + Math.random() * 1200);

    // Set the transition on the wheel
    wheel.style.transition = 'all 10s ease-out';
    // Rotate the wheel
    wheel.style.transform = `rotate(${dege}deg)`;

    animA();

    setupCanvas();
    updateConfetti();

    new Audio('https://www.best50casino.com/wp-content/themes/best50casino.com/includes/theme/functions/wheel-of-fortune/test.mp3').play();
    var after24 = new Date().addHours(24).getTime();
    localStorage.setItem('DayBestFortune', after24);

});



const Arraurl = document.getElementById("arraUrl").value;
const urls = Arraurl.split(",");

canvas.addEventListener('transitionend', () => {
    // Enable button when spin is over
    startButton.style.pointerEvents = 'auto';
    wheel.style.transition = 'none';
    const actualDeg = dege % 360;
    // Set the real rotation instantly without animation
    wheel.style.transform = `rotate(${actualDeg}deg)`;

    addConfetti();

    if (actualDeg > 0 && actualDeg <= 45) {
        setTimeout(function() {
            window.location.href = urls[7];
        }, 2000);
    }else if(actualDeg > 45 && actualDeg <= 90) {
        setTimeout(function() {
            window.location.href = urls[6];
        }, 2000);
    }else if(actualDeg > 90 && actualDeg <= 135) {
        setTimeout(function() {
            window.location.href = urls[5];
        }, 2000);
    }
    else if(actualDeg > 135 && actualDeg <= 180) {
        setTimeout(function() {
            window.location.href = urls[4];
        }, 2000);
    }
    else if(actualDeg > 180 && actualDeg <= 225) {
        setTimeout(function() {
            window.location.href = urls[3];
        }, 2000);
    }
    else if(actualDeg > 225 && actualDeg <= 270) {
        setTimeout(function() {
            window.location.href = urls[2];
        }, 2000);
    }else if(actualDeg > 270 && actualDeg <= 315) {
        setTimeout(function() {
            window.location.href = urls[1];
        }, 2000);
    }else{
        setTimeout(function() {
            window.location.href = urls[0];
        }, 2000);
    }
});



