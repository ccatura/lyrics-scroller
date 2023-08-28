<?php

function lyrics_formatter($song) {
    $lyrics_raw = $song->lyrics;
    $title      = $song->title;
    $sub_title  = $song->sub_title;
    $id         = $song->id;

    // $lyrics_string = $lyrics_raw; // this is temporary for incoming APIs until i can reformat them automatically
    
    if (check_format($lyrics_raw)) {
        $lyrics_string = addHTMLtoFormattedLyrics($lyrics_raw);
    } else {
        $lyrics_string = addHTMLtoUnformattedLyrics($lyrics_raw);
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

function addHTMLtoFormattedLyrics($lyrics_raw) {
    $lyrics_array = preg_split('/\n|\r\n?/', $lyrics_raw); // Splits by the end of lines
    $lyrics_string = '';
    foreach ($lyrics_array as $key => $value) {
        preg_match('#\[(.*?)\]#', $value, $part_title);

        if ($part_title[0] && $part_title[1] != '!!end_part!!') {
            if ($part_title[1] == 'untitled') {
                $part_title[1] = '';
            }
            if (str_contains(strtolower($part_title[1]), 'chorus')) {
                $chorus = 'chorus';
            } else {
                $chorus = '';
            }
            $lyrics_string .= "<div class='song-part-outer {$chorus}'><div class='song-part'>
                                <span class='song-part-title'>{$part_title[1]}</span>
                                <span class='song-part-content'>";
        } elseif ($part_title[0] && $part_title[1] == '!!end_part!!') {
            $lyrics_string .= "</span>
                            </div></div>";
        } else {
            $lyrics_string .= $value . '<br>';
        }
    }
    return $lyrics_string;
}

function addHTMLtoUnformattedLyrics($lyrics_raw) {
    $lyrics_array = preg_split('/\n|\r\n?/', $lyrics_raw); // Splits by the end of lines
    $lyrics_string = '';
    $in_part = false;


    foreach ($lyrics_array as $key => $value) {
        preg_match('#\[(.*?)\]#', $value, $part_title);
        
        if ($part_title[0] && !$in_part) {
            // echo $part_title[1].'<br>';
            $in_part = true;
            if ($part_title[1] == 'untitled') {
                $part_title[1] = '';
            }
            if (str_contains(strtolower($part_title[1]), 'chorus')) {
                $chorus = 'chorus';
            } else {
                $chorus = '';
            }
            $lyrics_string .= "<div class='song-part-outer {$chorus}'><div class='song-part'>
                                <span class='song-part-title'>{$part_title[1]}</span>
                                <span class='song-part-content'>";
        } elseif ($part_title[0] && $in_part) {
            $lyrics_string .= "</span>
                            </div></div>";
                            $lyrics_string .= "<div class='song-part-outer {$chorus}'><div class='song-part'>
                            <span class='song-part-title'>{$part_title[1]}</span>
                            <span class='song-part-content'>";
        } else {
            $lyrics_string .= $value;
        }
    }
    // echo $lyrics_raw;
    return $lyrics_string;


    // return $lyrics_raw;
}

// Checks if lyrics have the correct format
function check_format($lyrics_raw) {

    if (strpos($lyrics_raw, '!!end_part!!')) { 
        return true;
    } else {
        return false;
    }


    return false;
}

function song_create_edit($song_id = 'no song') {
    echo $song_id;
}

// Gets RapidAPI Results
function getResults($query_string) {
	include('./rapidapi_key.php');
	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => $query_string,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"X-RapidAPI-Host: genius-song-lyrics1.p.rapidapi.com",
			"X-RapidAPI-Key: " . $key
		],
	]);
	
	return $curl;
}

function get_song_settings($song_id, $setting, $platform) {
    $conn = $_SESSION['conn'];
    $user_name = $_SESSION['user_name'];

    $result = mysqli_query($conn,  "SELECT `setting`, `value`, `platform` FROM `song_settings`
                                    WHERE `user_name` = '{$user_name}'
                                    AND `song_id` = '{$song_id}'
                                    AND `platform` = '{$platform}'
                                    AND `setting` = '{$setting}'");

    $output = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= $row['value'];
    }

    if ($setting == 'speed' && $output == '') {
        $output = 5;
    } else if ($setting == 'size' && $output == '') {
        $output = 20;
    } else if ($setting == 'auto_scroll') {
        // echo $output;
        if ($output == '') {
            $output = '0';
        }
    }
    // echo "{$row['setting']} $output";

    // $_SESSION[$setting] = $output;
    return $output;
}

// function save_song_settings($song_id, $settings_array, $platform) {
//     $conn       = $_SESSION['conn'];
//     $user_name  = $_SESSION['user_name'];
//     $song_id    = $_SESSION['song_object']->id;

//     echo 'user_name: ' . $user_name.'<br>';
//     echo 'id: ' . $song_id . '<br><br>';
//     foreach($settings_array as $setting => $value) {
//         echo $setting . " : " . $value;
//         echo "<br>";
//         $result = mysqli_query($conn,  "REPLACE INTO `song_settings` (`user_name`, `song_id`, `platform`, `setting`, `value`) VALUES ('{$user_name}','{$song_id}','{$platform}','{$setting}','{$value}');");
//     }


//     if ($result) {
//         header('Location: ./?page=scroller');
//         echo 'good';
//     } else {
//         echo 'no';
//     }
// }