<?php
$song = $_SESSION['song_object'];



if (!$_SESSION['draft']) {
    echo "<div class='next-prev-song-section left-screen' id='previous-song'><div>&lt;</div></div>";
    echo "<div class='next-prev-song-section right-screen' id='next-song'><div>&gt;</div></div>";
}

if (isset($_SESSION['draft'])) {
    if ($_SESSION['draft']) {
        echo "<input type='button' value='Save Draft and Continue'> <input type='button' value='Edit Draft'>";
    }
}
echo lyrics_formatter($song);

?>

