const params = new URLSearchParams(window.location.search); //Get query string
var pageType = (params.get('page'));

var menuToggle          = document.getElementById('menu-toggle');
var menu                = document.getElementById('menu');
var menuCloseBtn        = document.getElementById('close-menu');

menuToggle.addEventListener('click', ()=> {
    menu.style.display = 'flex';
});

menuCloseBtn.addEventListener('click', ()=> {
    menuClose();
});



if (pageType == 'scroller') {
    var body                    = document.getElementsByTagName("BODY")[0];
    var saveSongSettingsMobile  = document.getElementById('save-song-settings-mobile');
    var saveSongSettingsDesktop = document.getElementById('save-song-settings-desktop');

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
        12: 6,
        11: 8,
        10: 12,
        9:  15,
        8:  20,
        7:  30,
        6:  40,
        5:  60,
        4:  80,
        3:  100,
        2:  150,
        1:  100
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
            if (autoScrollProperties.innerHTML == 'circle') {
                autoScrollProperties.innerHTML = 'check_circle';
            } else {
                autoScrollProperties.innerHTML = 'circle';
            }
            saveAutoScrollSettings('mobile'); // THIS NEEDS TO BE SPECIFIC TO THE LAYOUT CURRENTLY BEING VIEWED
        });
    } catch (e) {}

    // Detect when scrolled to bottom of page and stop
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
        saveSongSettingsMobile.addEventListener('click', ()=>{
            saveSongSettings('mobile');
            
        });

        saveSongSettingsDesktop.addEventListener('click', ()=>{
            saveSongSettings('desktop');
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
            scrollPlayLabel.classList.remove('red');
            scrollToggle('stop');
            console.log('Stopped');
}

function saveSongSettings(platform) {
    if (autoScrollProperties.innerText == 'circle') {
        var autoScrollx = '0'
    } else {
        var autoScrollx = '1'
    }
    var queryStringArray = `{"size" : "${size.innerText}", "speed" : "${speedCurrent.innerText}", "auto_scroll" : "${autoScrollx}", "platform" : "${platform}"}`;
    doAjax(queryStringArray, './save_song_settings.php');
    menuClose();
}

function saveAutoScrollSettings(platform) {
    if (autoScrollProperties.innerText == 'circle') {
        var autoScrollx = '0'
    } else {
        var autoScrollx = '1'
    }
    var queryStringArray = `{"auto_scroll" : "${autoScrollx}", "platform" : "${platform}"}`;
    console.log(queryStringArray);
    doAjax(queryStringArray, './save_song_settings.php');
}

function menuClose() {
    menu.style.display = 'none';
}

function popupAlert(title, message) {
    var popupAlertELement   = document.getElementById('popup-dark-screen');
    var popupTitle          = document.getElementById('popup-title');
    var popupMessage        = document.getElementById('popup-message');
    var popupNoButton       = document.getElementById('popup-no');

    popupTitle.innerText = title;
    popupMessage.innerText = message;

    popupAlertELement.style.display = 'block';
    setTimeout(() => {
        popupAlertELement.style.opacity = '1';
    }, 500);

    // popupYesButton.onclick = function() {
    //     window.location = location;
    // }

    popupNoButton.onclick = function() {
        popupClose(popupAlertELement);
    }
}

function popupClose(popupAlertELement) {
    popupAlertELement.style.opacity = '0';
    setTimeout(() => {
        popupAlertELement.style.display = 'none';
    }, 500);
}

function doAjax(data, script) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", script);
    xhr.onload = function () {
        console.log(this.response);
        popupAlert('Message', this.response);
    };
    xhr.send(JSON.stringify(data));
}








// var closeButton         = document.getElementById('close');
// var popupBlackout       = document.getElementById('popup-blackout');
// var popupYesButton      = document.getElementById('popup-yes');

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














