const params = new URLSearchParams(window.location.search); //Get query string
var pageType = (params.get('page'));

var menuToggle          = document.getElementById('menu-toggle');
var menu                = document.getElementById('menu');
var menuClose           = document.getElementById('close-menu');

menuToggle.addEventListener('click', ()=> {
    menu.style.display = 'flex';
});

menuClose.addEventListener('click', ()=> {
    menu.style.display = 'none';
});



if (pageType == 'scroller') {
    var body                = document.getElementsByTagName("BODY")[0];
    var saveSongSettingsBtn = document.getElementById('save-song-settings');

    try { // Autoscroll should not work on a song that is not in the user's DB
        var autoScroll           = document.getElementById('auto-scroll');
        var autoScrollProperties = document.getElementById('auto-scroll-properties');
    } catch (e) {}

    var scrollToggleButton  = document.getElementById('scroll-toggle-button');
    var scrollPlayLabel     = document.getElementById('play');
    var stateLabel          = document.getElementById('state-label');

    var speedUpButton       = document.getElementById('speed-up');
    var speedDownButton     = document.getElementById('speed-down');
    var speedCurrent        = document.getElementById('speed');
    var speedIndex          = speedCurrent.innerText;

    var fontBigger          = document.getElementById('font-bigger');
    var fontSmaller         = document.getElementById('font-smaller');
    var size                = document.getElementById('size');
    var fontSize            = size.innerText;
    var fontSizeIncrements  = 5;
    var fontSizeMax         = 90;
    var fontSizeMin         = 10;

    var previousSongButton  = document.getElementById('previous-song');
    var nextSongButton      = document.getElementById('next-song');

    // var fullscreenButton    = document.getElementById('fullscreen');
    // var fullscreenLabel     = document.getElementById('fullscreen-label');

    var songParts           = document.getElementsByClassName('song-part');
    var isScrolling         = false;
    var scrolling;
    var speedPresets = {
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

    document.onkeyup = function(e) {
        if (e.which == 39) {
            nextSong();
        } else if (e.which == 37) {
            previousSong();
        } else if (e.which == 38) {
            speedUp();
        } else if (e.which == 40) {
            speedDown();
        } 
      };

    try { // Autoscroll should not work on a song that is not in the user's DB
        autoScroll.addEventListener('click', ()=> {
            if (autoScrollProperties.innerHTML == '') {
                autoScrollProperties.innerHTML = '&#9679;';
            } else {
                autoScrollProperties.innerHTML = '';
            }
        });
    } catch (e) {}

    window.onscroll = function(ev) {
        if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
            stopScrollingAction();
        }
    };

    speedUpButton.addEventListener('click', ()=> {
        speedUp();
    });

    speedDownButton.addEventListener('click', ()=> {
        speedDown();
    });

    previousSongButton.addEventListener('click', ()=> {
        previousSong();
    });

    nextSongButton.addEventListener('click', ()=> {
        nextSong();
    });

    scrollToggleButton.addEventListener('click', ()=> {
        if (scrollPlayLabel.innerText == 'play_circle') {
            startScrollingAction();
        } else {
            stopScrollingAction();
        }
    });

    fontBigger.addEventListener('click', ()=> {
        if (fontSize < fontSizeMax) {
            fontSize = parseInt(fontSize) + parseInt(fontSizeIncrements);
            console.log("Font Size: " + fontSize);
        }
        updateDisplays();
    });

    fontSmaller.addEventListener('click', ()=> {
        if (fontSize > fontSizeMin) {
            fontSize = parseInt(fontSize) - parseInt(fontSizeIncrements);
            console.log("Font Size: " + fontSize);
        }
        updateDisplays();
    });

    // fullscreenButton.addEventListener('click', ()=> {
    //     openFullscreen(body);
    // })

    try { // Save-settings should not work on a song that is not in the user's DB
        saveSongSettingsBtn.addEventListener('click', ()=>{
            // alert(autoScrollProperties.innerText);
            if (autoScrollProperties.innerText == '') {
                var autoScrollx = '0'
            } else {
                var autoScrollx = '1'
            }
            var queryString = `&speed=${speedCurrent.innerText}&size=${size.innerText}&auto_scroll=${autoScrollx}`;
            window.location.href = `./?page=temp${queryString}`;
        });
    } catch (e) {}


}





if (pageType == 'song_search') {
	var submit = document.getElementById('submit');
    
	submit.addEventListener('click', ()=> {
		var term = document.getElementById('term').value;
		term = term.replace(/\s+/g, '-').toLowerCase();
		window.location.href = `./?page=song_search&term=${term}`;
	});


}




function moveScroll() {
    window.scrollBy(0, 1);
}

function speedUp() {
    if (speedIndex < topSpeed) {
        speedIndex++;
        speed = speedPresets[speedIndex];
        console.log('Speed: ' + speedIndex);
        if (isScrolling) scrollToggle('start', speed)
        updateDisplays();
    }
}

function speedDown() {
    if (speedIndex > 1) {
        speedIndex--;
        speed = speedPresets[speedIndex];
        console.log('Speed: ' + speedIndex);
        if (isScrolling) scrollToggle('start', speed)
        updateDisplays();
    }
}

function nextSong() {
    console.log('Next');
}

function previousSong() {
    console.log('Previous');
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
function resizeFont() {
    for (var i = 0; i < songParts.length; i++) {
        songParts[i].style.fontSize = fontSize + 'px';
    }
}

function updateDisplays() {
    speedCurrent.innerText  = speedIndex;
    size.innerText = fontSize;
    resizeFont();
}

// function openFullscreen(elem) {
//   if (elem.requestFullscreen) {
//     elem.requestFullscreen();
//   } else if (elem.webkitRequestFullscreen) { /* Safari */
//     elem.webkitRequestFullscreen();
//   } else if (elem.msRequestFullscreen) { /* IE11 */
//     elem.msRequestFullscreen();
//   }
// }

function startScrollingAction() {
            scrollPlayLabel.innerText = 'stop_circle';
            stateLabel.innerText = 'stop'
            scrollPlayLabel.classList.toggle('red');
            scrollToggle('start', speed);
            console.log('Started');
}

function stopScrollingAction() {
            scrollPlayLabel.innerText = 'play_circle';
            stateLabel.innerText = 'play'
            scrollPlayLabel.classList.toggle('red');
            scrollToggle('stop');
            console.log('Stopped');
}

// function doAjax() {
//             // AJAX CALL - Sends data to be autosaved
//             var xhr = new XMLHttpRequest();
//             xhr.open("POST", "./database-commit.php");
//             xhr.onload = function () {
//                 console.log(this.response);
//             };
//             xhr.send(JSON.stringify(data));
//             clearInterval(x);
//             var fadeIn = setTimeout(() => {
//                 header.style.opacity = 0;
//                 var resetHeader = setTimeout(() => {
//                     // clearTimeout(fadeIn);
//                     headerInner.innerText = 'AutoSave';
//                     autosave.innerHTML = '&nbsp;Enabled';
//                     // clearTimeout(resetHeader);
//                 }, 1000);
//             }, 2000);
//         }
//     }, 1000);}








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
