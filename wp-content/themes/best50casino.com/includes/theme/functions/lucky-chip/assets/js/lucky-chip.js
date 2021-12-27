const container = document.getElementById("chipchoose");
const elementsArray = Array.prototype.slice.call(container.getElementsByClassName('chips'));
    elementsArray.forEach(function(element){
        container.removeChild(element);
    });
    shuffleArray(elementsArray);
    elementsArray.forEach(function(element){
        container.appendChild(element);
});

function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}

 if (document.addEventListener) {
     document.addEventListener("click", handleClick, false);
 }else if (document.attachEvent) {
     document.attachEvent("onclick", handleClick);
 }

 function handleClick(event) {
     event = event || window.event;
     event.target = event.target || event.srcElement;
     let element = event.target;
     // Climb up the document tree from the target of the event
     while (element) {
         if (element.nodeName === "A" && /chips/.test(element.className)) {
             doSomething(element);
             break;
         }
         element = element.parentNode;
     }
 }

 function doSomething(button) {

     const offer = button.getAttribute('data-offer');
     const href = button.getAttribute('data-link');

     let fireworks = document.getElementById('fireworks');
     let chips = document.getElementById('chipchoose');
     let offerspan = document.getElementById('placeoffer');

     setTimeout(function(){
         button.firstElementChild.style.animation = "spin-tails 5s forwards";
     }, 100);

     setTimeout(function(){
         offerspan.style.display = "block";
         fireworks.style.display = "block";
         chips.classList.remove("d-flex");
         chips.style.display= "none";
     }, 4500);

     setTimeout(function(){
         offerspan.innerHTML = offer;
         fireworks.style.opacity = '1';
         offerspan.style.opacity = '1';
     }, 5000);

     setTimeout(function(){
         window.location.href = href;
     }, 7500);

 }
