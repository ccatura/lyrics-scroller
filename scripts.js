const params = new URLSearchParams(window.location.search); //Get query string
var pageType    = (params.get('page'));
var createType  = (params.get('create_type'));

var menuToggle           = document.getElementById('menu-toggle');
var menu                 = document.getElementById('menu');
var menuCloseBtn         = document.getElementById('close-menu');

getScreenWidth();

// Open and close the dropdown menu
menuToggle.addEventListener('click', ()=> {
    menu.style.display = 'flex';
});
menuCloseBtn.addEventListener('click', ()=> {
    menuClose();
});

if (pageType == 'setlist') {
    // Handle dropdowns for adding song to setlist from setlist page
    var dropdowns = document.getElementsByClassName('dropdown');
    for (var i = 0; i < dropdowns.length; i++) {
        dropdowns[i].addEventListener('change', (e)=> {
            var selectionValue      = e.target.value; // Contains setlist id and song id in format: setlist_id-song_id. Example: 21-12
            var setlistID           = selectionValue.split('-')[0];
            var songID              = selectionValue.split('-')[1];
            var setlistName         = e.target.getAttribute('setlist_title');
            var songName            = e.target.options[e.target.selectedIndex].innerText;
            var queryString         = `INSERT INTO setlist_links (\`user_name\`, \`setlist_id\`, \`song_id\`) VALUES ('ccatura', '${setlistID}', '${songID}');`;
            // var message             = `'${songName}' added to setlist '${setlistName}'.`;
            var message             = ``;
            var queryStringArray    = `{"sql" : "${queryString}", "message" : "${message}"}`;
            e.target.selectedIndex  = 0; // Reset select option after choice made
            doAjax(queryStringArray, './run_query.php');
            location.reload();
        });
    }
}

if (pageType == 'setlists') {
    // Creates setlist
    var setlistTitle  = document.getElementById('setlist-title');
    var setlistAction = document.getElementById('setlist-action');
    setlistTitle.addEventListener('input', ()=> {
        setlistAction.action = './?page=create_setlist&setlist_title=' + setlistTitle.value;
    });
}




















if (pageType == 'create_edit_song') {

    var songParts = document.querySelectorAll('[type="song-part"]');
    if (createType == 'new') {
        insertSongPartTemplate();
    } else if (createType == 'current') {
        importSong();
    }

    function insertSongPartTemplate(addAfter, elementToClone) {
        if (!elementToClone) {
            elementToClone  = document.getElementById("song-part-template");
        }
        const clone             = elementToClone.cloneNode(true);
        var randomNumber        = Math.floor(Math.random() * Math.pow(10, 16));
        clone.style.display     = 'flex';
        clone.setAttribute("id", randomNumber);
        clone.setAttribute("part-label", "part-label");
        
        if (!addAfter) {
            var addAfter = document.getElementById('create-song-all-parts-contatiner');
            addAfter.appendChild(clone);
        } else {
            addAfter.parentNode.insertBefore(clone, addAfter.nextSibling);
        }
        return randomNumber;
    }

    function deleteSongPart(element) {
        if (songPartCount() > 2) { // Don't let deletion if 2 part remain: 1 part to edit and the hidden 'template' part
            var partToDelete = getParentSongPartElement(element);
            partToDelete.remove();
        }
    }

    function addSongPart(element) {
        var addAfter = getParentSongPartElement(element);
        // console.log(addAfter);
        insertSongPartTemplate(addAfter);
    }

    function duplicateSongPart(element) {
        var addAfter = getParentSongPartElement(element);
        var element  = getParentSongPartElement(element);
        // console.log(element);
        insertSongPartTemplate(addAfter, element);
    }

    function getParentSongPartElement(element) {
        // console.log(element.closest('[type]'));
        return element.parentNode.closest('[type]');
    }

    function songPartCount() {
        return document.querySelectorAll('[type="song-part"]').length;
    }

    function saveSong() {
        var songParts       = document.querySelectorAll('[type="song-part"]');
        var songTitle       = document.getElementById('create-song-title').value.replace("'", "`");
        var songSubTitle    = document.getElementById('create-song-sub-title').value.replace("'", "`");
        var songID          = document.getElementById('create-song-id').value;
        var userName        = document.getElementById('user-name').value;
        var message         = "Song saved to Your Songs!";
        var songString      = '';

        console.log('Title: ' + songTitle + '\nSub-Title: ' + songSubTitle + '\nID: ' + songID + '\n');

        for (i = 1; i < songParts.length; i++) { // Start at 1 to skip over the hidden template part
            songString += '[' + songParts[i].querySelector("[part_id='song-part-label']").value + ']\n';
            songString += songParts[i].querySelector("[part_id='lyrics']").value + '\n[!!end_part!!]\n';
        }

        songString = songString.replace(/\n/g, '\\n');
        songString = songString.replace("'", "`");
        songString = songString.replace('"', "");
        var queryStringArray = `{"id" : "${songID}", "user_name" : "${userName}", "title" : "${songTitle}", "sub_title" : "${songSubTitle}", "lyrics" : "${songString}", "message" : "${message}"}`;

        // console.log(queryStringArray);

        doAjax(queryStringArray, './save_song.php');


    }

    function importSong() {
        var rawLyrics = document.getElementById('raw-lyrics').innerText;
        var lyricsJSON = JSON.parse(rawLyrics);

        for (i = 0; i < lyricsJSON.length; i++) {
            console.log(lyricsJSON[i][1]);
            var newID = insertSongPartTemplate();
            var newSongPartElement = document.getElementById(newID);
            var lyricsTextArea = newSongPartElement.querySelector("[part_id='lyrics']");
            lyricsTextArea.innerHTML = lyricsJSON[i][1];
        }



    }
}


























if (pageType == 'song_list' || pageType == 'scroller') {
    // Handle dropdowns for adding to setlists
    var dropdowns = document.getElementsByClassName('dropdown');
    for (var i = 0; i < dropdowns.length; i++) {
        dropdowns[i].addEventListener('change', (e)=> {
            var selectionValue      = e.target.value; // Contains setlist id and song id in format: setlist_id-song_id. Example: 21-12
            var setlistID           = selectionValue.split('-')[0];
            var songID              = selectionValue.split('-')[1];
            var setlistName         = e.target.options[e.target.selectedIndex].innerText;
            var songName            = e.target.getAttribute('song_name');
            var queryString         = `INSERT INTO setlist_links (\`user_name\`, \`setlist_id\`, \`song_id\`) VALUES ('ccatura', '${setlistID}', '${songID}');`;
            var message             = `'${songName}' added to setlist '${setlistName}'.`;
            var queryStringArray    = `{"sql" : "${queryString}", "message" : "${message}"}`;
            e.target.selectedIndex = 0; // Reset select option after choice made
            doAjax(queryStringArray, './run_query.php');
            try {
                menuClose();
            } catch(e) {}
            // console.log(queryString);
        });
    }
}




// Only scroller page actions
if (pageType == 'scroller') {
    var body                     = document.getElementsByTagName("BODY")[0];

    try {
        var saveSongSettingsMobile   = document.getElementById('save-song-settings-mobile');
    } catch(e) {}

    try {
        var saveSongSettingsDesktop  = document.getElementById('save-song-settings-desktop');
    } catch(e) {}

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

    try {
        var previousSongButton  = document.getElementById('previous-song');
        var nextSongButton      = document.getElementById('next-song');
    } catch {}

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

    updateDisplays(); // Initially setup all displays. Ex: Size, Speed, Autoscroll

    // Keyboard shortcuts: LEFT = Previous Song
    document.onkeyup = function(e) {
        if (e.which == 39) {
            try {
                window.location.href = nextSongButton.href;
            } catch {};
            nextSong();
        } else if (e.which == 37) {
            try {
                window.location.href = previousSongButton.href;
            } catch {};
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

    try {
        previousSongButton.addEventListener('click', ()=> {
            previousSong();
        });

        nextSongButton.addEventListener('click', ()=> {
            nextSong();
        });
    } catch {}

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
    } catch (e) {}
    try { // Save-settings should not work on a song that is not in the user's DB
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

// For 'ok' and 'cancel' buttons, timing must be 0.
// For no buttons, timing must be > 0. Timing is in seconds: 1 = 1 second, etc.
function popupAlert(title, message, timing, action, element) {
    timing *= 1000;
    var popupAlertELement   = document.getElementById('popup-dark-screen');
    var popupTitle          = document.getElementById('popup-title');
    var popupMessage        = document.getElementById('popup-message');
    var popupButtonSection  = document.getElementById('popup-buttons');
    var popupOkButton       = document.getElementById('popup-ok');
    var popupCancelButton   = document.getElementById('popup-cancel');

    popupTitle.innerText = title;
    popupMessage.innerText = message;

    // Makes popup appear
    popupAlertELement.style.display = 'block';
    setTimeout(() => {
        popupAlertELement.style.opacity = '1';
    }, 500);

    // Makes popup disappear if timing is set
    if (timing > 0) {
        popupButtonSection.style.display = 'none';
        setTimeout(() => {
            popupClose(popupAlertELement);
        }, timing);
    }

    popupOkButton.onclick = function() {
        popupClose(popupAlertELement);
        if (action == 'deleteSetlist') {
            deleteSetlist(element);
        } else if (action == 'removeSongFromSetlist') {
            removeSongFromSetlist(element);
        } else if (action == 'deleteSong') {
            deleteSong(element);
        }
    }
    
    popupCancelButton.onclick = function() {
        popupClose(popupAlertELement);
    }
}

function popupClose(popupAlertELement) {
    popupAlertELement.style.opacity = '0';
    setTimeout(() => {
        popupAlertELement.style.display = 'none';
    }, 1000);
}

function doAjax(data, script) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", script);
    xhr.onload = function () {
        console.log(this.response);
        if (this.response) { // If message is blank, don't show popupalert
            popupAlert('Alert:', this.response, 2);
        }
    };
    xhr.send(JSON.stringify(data));
}

function deleteSetlist(element) {
    var setlistID           = element.getAttribute('setlist_id');
    var queryString1        = `DELETE FROM setlist_links WHERE user_name = 'ccatura' AND setlist_id = '${setlistID}';`; // Removes all songs from setlist first
    var queryString2        = `DELETE FROM setlists WHERE user_name = 'ccatura' AND id = '${setlistID}';`;
    var message             = ``;
    // If key has the word 'sql' in it, it will execute a separate sql query: sql1, sql2, sql3, etc
    var queryStringArray    = `{"sql1" : "${queryString1}", "sql2" : "${queryString2}", "message" : "${message}"}`;
    doAjax(queryStringArray, './run_query.php');
    document.getElementById(setlistID).outerHTML = ""; // Remove the item
    console.log('Deleted setlist');
}

function removeSongFromSetlist(element) {
    var setlistID           = element.getAttribute('setlist_id');
    var songOrder           = element.getAttribute('song_order');
    var queryString         = `DELETE FROM setlist_links WHERE user_name = 'ccatura' AND setlist_id = '${setlistID}' AND song_order = '${songOrder}';`;
    var message             = ``;
    var queryStringArray    = `{"sql" : "${queryString}", "message" : "${message}"}`;
    doAjax(queryStringArray, './run_query.php');
    document.getElementById(setlistID + '-' + songOrder).outerHTML = ""; // Remove the item
    // e.target.outerHTML = ""; // Removes the target text that was clicked on
    console.log(songOrder);
}

function deleteSong(element) {
    var songID              = element.getAttribute('song_id');
    var songCount           = document.getElementById('song-count');
    var queryString1        = `DELETE FROM song_settings WHERE user_name = 'ccatura' AND song_id = '${songID}';`;
    var queryString2        = `DELETE FROM setlist_links WHERE user_name = 'ccatura' AND song_id = '${songID}';`;
    var queryString3        = `DELETE FROM songs WHERE user_name = 'ccatura' AND id = '${songID}';`;
    var message             = ``;
    var queryStringArray    = `{"sql1" : "${queryString1}", "sql2" : "${queryString2}", "sql3" : "${queryString3}", "message" : "${message}"}`;
    doAjax(queryStringArray, './run_query.php');
    songCount.innerText = parseInt(songCount.innerText) - 1;
    document.getElementById(songID).outerHTML = ""; // Remove the item
    // console.log(songCount);
}

function getScreenWidth() {
    var screenWidth = document.getElementById('screen-width');
    // screenWidth.innerText = screen.width;
    doAjax(screen.width, './set_screen_width.php');
}












