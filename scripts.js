const params = new URLSearchParams(window.location.search); //Get query string
var pageType = (params.get('page'));



if (pageType == 'scroller') {
    var scrollToggleButton  = document.getElementById('scroll-toggle-button');
    var stateLabel          = document.getElementById('state-label');
    var speedUp             = document.getElementById('speed-up');
    var speedDown           = document.getElementById('speed-down');
    var speedCurrent        = document.getElementById('speed');
    var fontBigger          = document.getElementById('font-bigger');
    var fontSmaller         = document.getElementById('font-smaller');
    var songParts           = document.getElementsByClassName('song-part');
    var fontSize            = window.getComputedStyle(songParts[0]).fontSize;
    fontSize                = parseInt(fontSize.substring(0, fontSize.length - 2));
    var fontSizeIncrements  = 5;
    var fontSizeMax         = 90;
    var fontSizeMin         = 10;
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
        if (scrollToggleButton.innerText == 'play_circle') {
            scrollToggleButton.innerText = 'stop_circle';
            stateLabel.innerText = 'stop'
            scrollToggle('start', speed);
            console.log('Started');
        } else {
            scrollToggleButton.innerText = 'play_circle';
            stateLabel.innerText = 'play'
            scrollToggle('stop');
            console.log('Stopped');
        }
    });

    fontBigger.addEventListener('click', ()=> {
        if (fontSize < fontSizeMax) {
            fontSize += fontSizeIncrements;
            console.log("Font Size: " + fontSize);
            for (var i = 0; i < songParts.length; i++) {
                songParts[i].style.fontSize = fontSize + 'px';
            }
        }
    });

    fontSmaller.addEventListener('click', ()=> {
        if (fontSize > fontSizeMin) {
            fontSize -= fontSizeIncrements;
            console.log("Font Size: " + fontSize);
            for (var i = 0; i < songParts.length; i++) {
                songParts[i].style.fontSize = fontSize + 'px';
            }
        }
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
    speedCurrent.innerText  = speedIndex;
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