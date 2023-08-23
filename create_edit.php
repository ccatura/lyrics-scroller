<?php

if (isset($_SESSION['song_object'])) {
    song_create_edit($_SESSION['song_object']); // Edits the current song object in the session
} else {
    if (isset($_GET['song_id'])) {
        song_create_edit($_GET['song_id']); // Edits the song that was sent over in the URL's query string
    } else {
        song_create_edit(); // Creates a blank song creation template
    }
}

