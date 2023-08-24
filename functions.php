<?php

function lyrics_formatter($song) {
    $lyrics_raw = $song->lyrics;    
    $title      = $song->title;
    $sub_title  = $song->sub_title;
    $id         = $song->id;

    $lyrics_array = explode(PHP_EOL, $lyrics_raw);

    // echo 'exploded lyrics<br>';

    // foreach ($lyrics_array as $key => $value) {
    //     echo 'key: ' . $key . ': ' . $value . '<br>';
    // }

    // echo '<br><br><br><br>';


    // Breaks down lyrics into parts based on part tag [verse], [chorus], etc, or blank line.
    $temp_string = '';
    $temp_array = [];
    foreach ($lyrics_array as $key => $value) {
        preg_match('#\[(.*?)\]#', $value, $part);
        if (!empty($part) && !empty($value)) { // Pushes the part name into the temp array
            if (!empty($temp_string)) {
                array_push($temp_array, $temp_string);
                $temp_string = '';
            }
            array_push($temp_array, $value);
        } elseif (empty($part) && !empty($value)) { // If no blank line or no tag, adds remaining lines to temp string to be pushed later into the temp
            $temp_string .= $value . '<br>';
        } elseif (empty($part) && empty($value)) { // Pushes the lyric block in the temp array
            array_push($temp_array, $temp_string);
            $temp_string = '';
        }








        // echo "part: $part[0] empty part? " . empty($part) . " - ";
        // echo "empty value? " . empty($value) . ": $value<br>";
    }
    array_push($temp_array, $temp_string); // Adds final text block to array

    // echo '<br><br><br>';
    // foreach ($temp_array as $key => $value) {
    //     echo 'key: ' . $key . ': ' . $value . '<br>';
    // }


    // We put together the part titles and lyrics into the HTML
    $final_lyrics = "<div class='song-section'>
                        <div class='song-header'>
                        <span class='song-title'>{$title} ({$id})</span>
                        <span class='song-sub-title'>{$sub_title}</span>
                     </div>";

    foreach ($temp_array as $key => $value) {
        // $final_lyrics .=   "<div class='song-part'>";
        if (preg_match('#\[(.*?)\]#', $value, $part)) {
            $final_lyrics .= "<div class='song-part'>
                                <span class='song-part-title'>{$part[1]}</span>";
        } elseif (empty($value)) {
            $final_lyrics .= "<div class='song-part'><span class='song-part-content'>{$value}</span></div>";
        } else {
            $final_lyrics .= "<span class='song-part-content'>{$value}</span></div>";
        }
    }

    return $final_lyrics;



}





function lyrics_formatterOLD($song) {
    $lyrics_raw = $song->lyrics;    
    $title      = $song->title;
    $sub_title  = $song->sub_title;
    $id         = $song->id;

    $lyrics_array = explode(PHP_EOL, $lyrics_raw);
    array_push($lyrics_array, ""); // Adds extra index to array, because

    // Parsing the lyrics to format for HTML
    $string = '';
    $lyrics_no_empty_lines = [];
    foreach ($lyrics_array as $key => $value) {
        if (!preg_match('/\S/', $value)) { // Checks for non-white space character, most likely is empty
            array_push($lyrics_no_empty_lines, $string); // When we find a empty space, we push the previous section to the lyrics_no_empty_lines array
            $string = '';
        } else {
            $string .= $value . '<br>';
        }
    }

    $a = implode($lyrics_no_empty_lines);

    // $final_lyrics = "<div class='song-section'>
    //                     <div class='song-header'>
    //                     <span class='song-title'>{$title} ({$id})</span>
    //                     <span class='song-sub-title'>{$sub_title}</span>
    //                  </div>";
    // foreach ($lyrics_no_empty_lines as $key => $value) {
    //     $final_lyrics .=   "<div class='song-part'>";
    //     preg_match('#\[(.*?)\]#', $value, $part);
    //     $stripped_lyrics = preg_replace('#\[(.*?)\](\s)?#', '', $value); // Removes first bracketed tag
        
        
    //     $final_lyrics .=   "    <span class='song-part-title'>{$part[1]}</span>
    //                             <span class='song-part-content'>{$stripped_lyrics}</span>
    //                         </div>";
    // }
    // $final_lyrics .= "</div>";

    return $a;



}

function song_create_edit($song_id = 'no song') {

    echo $song_id;


}
