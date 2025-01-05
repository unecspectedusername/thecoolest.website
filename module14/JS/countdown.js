const firstVisitTime = document.cookie
.split("; ")
.find((row) => row.startsWith("firstVisitTime="))
.split("=")[1];
console.log(firstVisitTime);

const currentTime = Math.floor(new Date().getTime() / 1000);

let timeRemaining = 86400 - (currentTime - firstVisitTime);

const domBlock = document.querySelector('.countdown');
const domHours = document.querySelector('#hours');
const domMinutes = document.querySelector('#minutes');
const domSeconds = document.querySelector('#seconds');

function showFormattedTime(time) {
var h = Math.floor(time / 3600);
var m = Math.floor(time % 3600 / 60);
var s = Math.floor(time % 3600 % 60);
domHours.innerHTML = h;
domMinutes.innerHTML = m;
domSeconds.innerHTML = s;
}

if (timeRemaining > 0) {
showFormattedTime(timeRemaining)
domBlock.style.display = 'block';
setInterval(function () {
    if (timeRemaining > 0) {
        showFormattedTime(timeRemaining--);
    } else {
        domBlock.style.display = 'none';
        return;
    }
}, 1000);
}