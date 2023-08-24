const params = new URLSearchParams(window.location.search); //Get query string
var pageType = (params.get('page'));



if (pageType == 'scroller') {
    var scrollToggleButton  = document.getElementById('scroll-toggle-button');
    var speedUp             = document.getElementById('speed-up');
    var speedDown           = document.getElementById('speed-down');
    var speedCurrent        = document.getElementById('speed');
    var fontSize            = window.getComputedStyle(document.getElementsByClassName('song-part')[0]).fontSize;
    // console.log(fontSize + 2);
    var speedIndex          = 5; // To start. Will probably be replaced by an individual song speed setting
    var isScrolling         = false;
    var scrolling;
    const speedPresets = {
        10: 8,
        9:  12,
        8:  15,
        7:  20,
        6:  30,
        5:  40,
        4:  60,
        3:  80,
        2:  100,
        1:  150
    };
    var topSpeed            = Object.keys(speedPresets).length;
    var speed               = speedPresets[speedIndex];

    updateDisplays();
    
    speedUp.addEventListener('click', ()=> {
        if (speedIndex < topSpeed) {
            speedIndex++;
            speed = speedPresets[speedIndex];
            console.log('Speed: ' + speedIndex);
            if (isScrolling) scrollToggle('start', speed)
            updateDisplays();
        }
    });

    speedDown.addEventListener('click', ()=> {
        if (speedIndex > 1) {
            speedIndex--;
            speed = speedPresets[speedIndex];
            console.log('Speed: ' + speedIndex);
            if (isScrolling) scrollToggle('start', speed)
            updateDisplays();
        }
    });

    scrollToggleButton.addEventListener('click', ()=> {
        if (scrollToggleButton.innerText == 'START') {
            scrollToggleButton.innerText = 'STOP';
            scrollToggle('start', speed);
        } else {
            scrollToggleButton.innerText = 'START';
            scrollToggle('stop');
        }
    });

    speedUp.addEventListener('click', ()=> {

    });




}







function moveScroll() {
    window.scrollBy(0, 1);
}



function scrollToggle(state, speed) {
    if (state == 'start') {
        if (isScrolling) clearInterval(scrolling);
        scrolling = setInterval(() => {
            moveScroll();
        }, speed);
        isScrolling = true;
        // console.log('Scrolling');
    } else if (state == 'stop') {
        clearInterval(scrolling);
        isScrolling = false;
        // console.log('Stopped scrolling');
    }
}

function updateDisplays() {
    speedCurrent.innerText  = '(' + speedIndex + ')';
}












// var closeButton         = document.getElementById('close');
// var popupBlackout       = document.getElementById('popup-blackout');
// var popupYesButton      = document.getElementById('popup-yes');
// var popupNoButton       = document.getElementById('popup-no');

// closeButton.addEventListener('click', function() {
//     popupClose();
// })

// // Logout button
// var logoutButton = document.getElementById('logout');
// logoutButton.addEventListener('click', function() {
//     var title = 'Logout';
//     var message = 'Are you sure you want to logout of your account?';
//     var location  = './?session=false';
//     popup(title, message, location);
// })











// function popupClose() {
//     popupBlackout.style.display = "none";
// }

// function popup(title, message, location) {
//     var popupTitle = document.getElementById('popup-title');
//     var popupMessage = document.getElementById('popup-message');
//     popupTitle.innerText = title;
//     popupMessage.innerText = message;
//     popupBlackout.style.display = "flex";

//     popupYesButton.onclick = function() {
//         window.location = location;
//     }

//     popupNoButton.onclick = function() {
//         popupClose();
//     }
// }