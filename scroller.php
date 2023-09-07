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
        $html   = "<form action='./?page=save_to_your_songs' method='post'>";
        
        $html  .=  "<div class='add-to-setlist fake-link' id='song_{$id}' song_title='{$title_stripped}'>Use setlist: 
                        <select class='dropdown' song_name='{$title_stripped}'><option value='null'>[Select Setlist]</option>";
                        $result_setlist = get_setlists();
                        while ($row = mysqli_fetch_assoc($result_setlist)) {
                            $setlist_title  = $row['title'];
                            $setlist_id     = $row['id'];
                        
                            $html .= "<option class='options' value='{$setlist_id}-{$id}'>{$setlist_title} ({$setlist_id})</option>";
                        }
                        $html .= "</select>
                    </div>";
        $html  .= "<input type='submit' id='save-to-your-songs' value='Save to Your Songs'>";

        echo $html;
        echo "</form>";
    }
}

// echo " Song #{$setlist_index}";
echo lyrics_formatter($song);
// echo make_compliant($song);

?>

