<?php

function lyrics_formatter($song) {
    $lyrics_raw = $song->lyrics;    
    $title      = $song->title;
    $sub_title  = $song->sub_title;
    $id         = $song->id;

    // $lyrics_array = explode(PHP_EOL, $lyrics_raw); // Delete if not needed in a year
    $lyrics_array = preg_split('/\n|\r\n?/', $lyrics_raw);

    // foreach ($lyrics_array as $key => $value) {
    //     echo 'key: ' . $key . ': ' . $value . '<br>';
    // }

    $temp_string = '';
    $temp_array = [];
    foreach ($lyrics_array as $key => $value) {
        preg_match('#\[(.*?)\]#', $value, $part_title);

        if ($part_title[0] && $part_title[1] != 'end_part') {
            if ($part_title[1] == 'untitled') {
                $part_title[1] = '';
            }
            $temp_string .= "<div class='song-part'>
                                <span class='song-part-title'>{$part_title[1]}</span>
                                <span class='song-part-content'>";
        } elseif ($part_title[0] && $part_title[1] == 'end_part') {
            $temp_string .= "</span>
                             </div>";
        } else {
            $temp_string .= $value . '<br>';
        }

    }
    // array_push($temp_array, $value);
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
                     </div>
                     {$temp_string}";
    

    // foreach ($temp_array as $key => $value) {
        // if (preg_match('#\[(.*?)\]#', $value, $part_title)) { // HAS PART TITLE
        //     $final_lyrics .= "<div class='song-part'>
        //                         <span class='song-part-title'>{$part_title[1]}</span>";





        // } elseif (empty($value)) {
        //     $final_lyrics .= "<div class='song-part'>charlie
        //                         <span class='song-part-content'>{$value}</span>
        //                       </div>";
        // } else {
        //     $final_lyrics .= "<span class='song-part-content'>{$value}</span>
        //                     </div>charlie";
        // }

        // echo $temp_string;
    // }

    echo $final_lyrics;


    // return $final_lyrics;



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
    //     preg_match('#\[(.*?)\]#', $value, $part_title);
    //     $stripped_lyrics = preg_replace('#\[(.*?)\](\s)?#', '', $value); // Removes first bracketed tag
        
        
    //     $final_lyrics .=   "    <span class='song-part-title'>{$part_title[1]}</span>
    //                             <span class='song-part-content'>{$stripped_lyrics}</span>
    //                         </div>";
    // }
    // $final_lyrics .= "</div>";

    return $a;



}

function song_create_edit($song_id = 'no song') {

    echo $song_id;


}

function menu() {
    $output =  "<div class='menu'>
                    <a href='./' class='menu-item'>Home</a>
                    <a href='./?page=song_list' class='menu-item'>Song List</a>
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