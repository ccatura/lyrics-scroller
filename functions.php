<?php

function lyrics_formatter($song) {
    $lyrics_raw = $song->lyrics;    
    $title      = $song->title;
    $sub_title  = $song->sub_title;
    $id         = $song->id;

    $lyrics_string = $lyrics_raw;
    // echo $title;
    
    if (check_format($lyrics_raw)) {

        // $lyrics_array = explode(PHP_EOL, $lyrics_raw); // Delete if not needed in a year
        $lyrics_array = preg_split('/\n|\r\n?/', $lyrics_raw);

        $lyrics_string = '';
        $temp_array = [];
        foreach ($lyrics_array as $key => $value) {
            preg_match('#\[(.*?)\]#', $value, $part_title);

            if ($part_title[0] && $part_title[1] != 'end_part') {
                if ($part_title[1] == 'untitled') {
                    $part_title[1] = '';
                }
                $lyrics_string .= "<div class='song-part'>
                                    <span class='song-part-title'>{$part_title[1]}</span>
                                    <span class='song-part-content'>";
            } elseif ($part_title[0] && $part_title[1] == 'end_part') {
                $lyrics_string .= "</span>
                                </div>";
            } else {
                $lyrics_string .= $value . '<br>';
            }

        }
        array_push($temp_array, $lyrics_string); // Adds final text block to array
    }


        // Put together the part titles and lyrics into the HTML
        $final_lyrics = "<div class='song-section'>
                            <div class='song-header'>
                            <span class='song-title'>{$title} ({$id})</span>
                            <span class='song-sub-title'>{$sub_title}</span>
                        </div>
                        {$lyrics_string}";

    return $final_lyrics;



}

function check_format($lyrics_raw) {

    if (str_contains($lyrics_raw, 'end_part')) { 
        return true;
    } else {
        return false;
    }


    return false;
}

function song_create_edit($song_id = 'no song') {
    echo $song_id;
}

function menu() {
    $output =  "<div class='menu'>
                    <a href='./' class='menu-item'>Home</a>
                    <a href='./?page=song_list' class='menu-item'>Song List</a>
                    <a href='./?page=song_search' class='menu-item'>Song Search</a>
                    <hr style='width:100%'>
                    <a href='./?page=create_edit' class='menu-item'>Create New Song</a>";

    if ($_GET['page'] == 'scroller') {
        $output .= "<a href='./index.php' class='menu-item'>Edit Current Song</a>
                    <a href='./index.php' class='menu-item'>Song Settings</a>";
    }

    $output .=     "<hr style='width:100%'>
                    <a href='./index.php' class='menu-item'>Global Settings</a>
                    <a href='./index.php' class='menu-item'>Logout</a>
                </div>";

    return $output;
}