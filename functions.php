<?php

function lyrics_formatter($song) {
    $lyrics_raw = $song->lyrics;    
    $title      = $song->title;
    $sub_title  = $song->sub_title;
    $id         = $song->id;

    $temp_lyrics = explode(PHP_EOL, $lyrics_raw);
    array_push($temp_lyrics, ""); // Adds extra index to array, because

    // Parsing the lyrics to format for HTML
    $string = '';
    $new_lyrics = [];
    foreach ($temp_lyrics as $key => $value) {
        if (!preg_match('/\S/', $value)) { // Checks for non-white space character, most likely is empty
            array_push($new_lyrics, $string); // When we find a empty space, we push the previous section to the new_lyrics array
            $string = '';
        } else {
            $string .= $value . '<br>';
        }
    }


    $final_lyrics = "<div class='song-section'>
                        <div class='song-header'>
                        <span class='song-title'>{$title} ({$id})</span>
                        <span class='song-sub-title'>{$sub_title}</span>
                     </div>";
    foreach ($new_lyrics as $key => $value) {
        $final_lyrics .=   "<div class='song-part'>";
        preg_match('#\[(.*?)\]#', $value, $part);
        $stripped_lyrics = preg_replace('#\[(.*?)\](\s)?#', '', $value); // Removes first bracketed tag
        
        
        $final_lyrics .=   "    <span class='song-part-title'>{$part[1]}</span>
                                <span class='song-part-content'>{$stripped_lyrics}</span>
                            </div>";
    }
    $final_lyrics .= "</div>";

    return $final_lyrics;



}

function song_create_edit($song_id = 'no song') {

    echo $song_id;


}
