<?php

function lyrics_formatter($song) {
    $lyrics_raw = $song->lyrics;
    $title      = $song->title;
    $sub_title  = $song->sub_title;
    $id         = $song->id;


    if (check_compliance($lyrics_raw)) {
        $lyrics_string = add_html_to_compliant_lyrics($lyrics_raw);
    } else {
        $lyrics_compliant   = make_compliant($lyrics_raw);
        $lyrics_string      = add_html_to_compliant_lyrics($lyrics_compliant);
        $song->set_lyrics($lyrics_compliant);
    }

    // Put together the part titles and lyrics into the HTML
    $final_lyrics = "<div class='song-section'>
                        <div class='song-header'>
                        <span class='song-title'><span id='song-page-title'>{$title}</span> ({$id})</span>
                        <span class='song-sub-title'>{$sub_title}</span>
                    </div>
                    {$lyrics_string}";
    return $final_lyrics;
    // var_dump($lyrics_string);
}

function add_html_to_compliant_lyrics($lyrics_raw) {
    $lyrics_array = preg_split('/\n|\r\n?/', $lyrics_raw); // Splits by the end of lines
    $lyrics_string = '';


    foreach ($lyrics_array as $key => $value) {
        preg_match('#\[(.*?)\]#', $value, $part_title);

        if ($part_title[0] && $part_title[1] != '!!end_part!!') {
            // $lyrics_string .='1st - ';
            if ($part_title[1] == 'untitled') {
                $part_title[1] = '';
            }
            if (str_contains(strtolower($part_title[1]), 'chorus') || str_contains(strtolower($part_title[1]), 'refrain')) {
                $chorus = 'chorus';
            } else {
                $chorus = '';
            }
            $lyrics_string .= "<div class='song-part-outer {$chorus}'><div class='song-part'>
                                <span class='song-part-title'>{$part_title[1]}</span>
                                <span class='song-part-content'>";
        } elseif ($part_title[0] && str_contains($part_title[1], '!!end_part!!')) {
            // $lyrics_string .='2nd - ';
            $lyrics_string .= "</span>
                            </div></div>";
        } else {
            // $lyrics_string .='3rd - ';
            $lyrics_string .= $value . '<br>';
        }
    }
    return $lyrics_string;
}

function add_html_to_non_compliant_lyrics($lyrics_raw) {
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
function check_compliance($lyrics_raw) {

    if (strpos($lyrics_raw, '!!end_part!!')) { 
        return true;
    } else {
        return false;
    }
    return false;
}

function make_compliant($lyrics_raw) {

    $lyrics_array = preg_split('/\n|\r\n?/', trim($lyrics_raw)); // Splits by the end of lines
    $just_ended_part = false;
    foreach ($lyrics_array as $key => $value) {

        preg_match('#\[(.*?)\]#', $value, $part_title);

        if ($part_title[0] && $part_title[1] != '!!end_part!!') {
            $lyrics_string .= strip_tags($value) . "\r\n";
            $just_ended_part = false;
        } elseif (strlen($value) < 5) {
            $lyrics_string .= "[!!end_part!!]\r\n";
            $just_ended_part = true;
        } else {
            if ($just_ended_part == true) {
                $lyrics_string .= '[untitled]\r\n';
                $just_ended_part = false;
            }
            $lyrics_string .= strip_tags($value) . "\r\n";
        }
    }
    return $lyrics_string;
}

function song_parts_to_json($lyrics) {
    $part_array_inner = array();
    $part_array_outer = array();
    // $song_output[0] = array("verse", $lyrics);
    $lyrics_array = preg_split('/\n|\r\n?/', $lyrics);
    $part_string = '';

    $in_part = false;
    $count = 0 ;
    foreach ($lyrics_array as $key => $value) {
        preg_match('#\[(.*?)\]#', $value, $part_title);

        if ($part_title[0] && $part_title[1] != '!!end_part!!') {
            array_push($part_array_inner, $value);
            $in_part = true;
        } elseif ($part_title[0] && str_contains($part_title[1], '!!end_part!!')) {
            $in_part = false;
            array_push($part_array_inner, trim($part_string));
            array_push($part_array_outer, $part_array_inner);
            $part_array_inner = array();
            $part_string = '';
            $count++;
        } else {
            $part_string .= $value . PHP_EOL;
            $in_part = true;
        }

    }


    // return $song_output;
    return json_encode($part_array_outer);
}



function get_last_id_from_title($title) {
    $conn       = $_SESSION['conn'];
    $user_name  = $_SESSION['user_name'];
    return mysqli_query($conn,"SELECT id FROM songs WHERE user_name = '{$user_name}' AND title = '{$title}' ORDER BY id DESC LIMIT 1;");
}









// function song_create_edit($song_id = 'no song') {
//     echo $song_id;
// }



// Gets RapidAPI Results
function get_search_results($query_string) {
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

function get_setlists($order_by = 'title') {
    $conn       = $_SESSION['conn'];
    $user_name  = $_SESSION['user_name'];
    return mysqli_query($conn,"SELECT `title`, `id` FROM `setlists` WHERE `user_name` = '{$user_name}' ORDER BY `$order_by` ");
}

function get_song_list() {
    $conn       = $_SESSION['conn'];
    $user_name  = $_SESSION['user_name'];
    return mysqli_query($conn,"SELECT `title`, `sub_title`, `id` FROM `songs` WHERE `user_name` = '{$user_name}' ORDER BY `title` ");
}

function set_list_song_count($setlist_id) {
    $conn       = $_SESSION['conn'];
    $user_name  = $_SESSION['user_name'];
    $result     = mysqli_query($conn,  "SELECT count(*) as 'count' FROM setlist_links
                                        WHERE setlist_id = $setlist_id;");

    while ($row = mysqli_fetch_assoc($result)) {
        $output = $row['count'];
    }

    return $output;
}

function get_last_song_id_from_title($title) {
    $conn       = $_SESSION['conn'];
    $user_name  = $_SESSION['user_name'];
    $result     = mysqli_query($conn,"SELECT `id` FROM `songs` WHERE `title` like '{$title}' AND `user_name` = '{$user_name}' ORDER BY id desc LIMIT 1");
    while ($row = mysqli_fetch_assoc($result)) {
        return $row['id'];
    }
}

function is_logged_in() {
    if (!isset($_SESSION['user_name'])) {
        header("Location: ./?page=login");
    }
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