<?php

$song = $_SESSION['song_object'];
// $_SESSION['draft'] = false;
if (isset($_SESSION['draft'])) {
    if ($_SESSION['draft']) {
        echo "<input type='button' value='Save Draft and Continue'> <input type='button' value='Edit Draft'>";
    }
}



echo lyrics_formatter($song);
