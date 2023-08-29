<?php
$song = $_SESSION['song_object'];

$setlist_index = $_SESSION['setlist_index'];
$setlist_ids = $_SESSION['setlist_ids'];

if (!$_SESSION['draft']) {
    if (isset($setlist_ids[$setlist_index - 1])) {
        $previous_song_id = $setlist_ids[$setlist_index - 1];
        $previous_setlist_index = $setlist_index - 1;
        echo "<a href='./?page=get_song&song_id={$previous_song_id}&setlist_index={$previous_setlist_index}'><div class='next-prev-song-section left-screen' id='previous-song'><div>&lt;</div></div></a>";
    }

    if (isset($setlist_ids[$setlist_index + 1])) {
        $next_song_id = $setlist_ids[$setlist_index + 1];
        $next_setlist_index = $setlist_index + 1;
        echo "<a href='./?page=get_song&song_id={$next_song_id}&setlist_index={$next_setlist_index}'><div class='next-prev-song-section right-screen' id='next-song'><div>&gt;</div></div></a>";
    }
}

echo 'this is the name of the current setlist';




if (isset($_SESSION['draft'])) {
    if ($_SESSION['draft']) {
        echo "<input type='button' value='Save Draft and Continue'> <input type='button' value='Edit Draft'>";
    }
}


echo lyrics_formatter($song);

?>

