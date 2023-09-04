<?php
$song = $_SESSION['song_object'];

$setlist_index = $_SESSION['setlist_index'];
$setlist_ids = $_SESSION['setlist_ids'];

if (!$_SESSION['draft']) {
    if (isset($setlist_ids[$setlist_index - 1])) {
        $previous_song_id = $setlist_ids[$setlist_index - 1];
        $previous_setlist_index = $setlist_index - 1;
        echo "<a id='previous-song' href='./?page=get_song&song_id={$previous_song_id}&setlist_index={$previous_setlist_index}'><div class='next-prev-song-section left-screen'><div>&lt;</div></div></a>";
    }

    if (isset($setlist_ids[$setlist_index + 1])) {
        $next_song_id = $setlist_ids[$setlist_index + 1];
        $next_setlist_index = $setlist_index + 1;
        echo "<a id='next-song' href='./?page=get_song&song_id={$next_song_id}&setlist_index={$next_setlist_index}'><div class='next-prev-song-section right-screen'><div>&gt;</div></div></a>";
    }
}

// echo 'this is the name of the current setlist';




if (isset($_SESSION['draft'])) {
    if ($_SESSION['draft']) {
        echo "<form action='./?page=save_to_your_songs' method='post'>";
        echo "<input type='submit' id='save-to-your-songs' value='Save to Your Songs'>";
        echo "</form>";
    }
}

// echo " Song #{$setlist_index}";
echo lyrics_formatter($song);
// echo make_compliant($song);

?>

