<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<input type='text' placeholder='Search' id='term' />
<button id='submit'>Search</button>

<script>
	var submit = document.getElementById('submit');
	submit.addEventListener('click', ()=> {
		var term = document.getElementById('term').value;
		term = term.replace(/\s+/g, '-').toLowerCase();
		window.location.href = `./?page=song_search&term=${term}`;
	});

</script>

<?php

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



// the string for the particular song lyrics
// https://genius-song-lyrics1.p.rapidapi.com/song/lyrics/?id=HERE

if (isset($_GET['term'])) {
	$term = $_GET['term'];
} else {
	$term = "phil-collins";
}

$curl = getResults("https://genius-song-lyrics1.p.rapidapi.com/search/?q={$term}&per_page=50&page=1");
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$result_decoded = json_decode($response, true);



if ($err) {
	echo "cURL Error #:" . $err;
} elseif (count($result_decoded['hits']) > 0) {
	foreach($result_decoded as $a_key => $a_value) {
		echo count($a_value) . ' results for term: ' . $term . '.<br><br>';
		foreach($a_value as $b_key => $b_value) {
			$song_id 		= $a_value[$b_key]['result']['id'];
			$artist_names 	= $a_value[$b_key]['result']['artist_names'];
			$song_title 	= $a_value[$b_key]['result']['title'];
			$song_url 		= $a_value[$b_key]['result']['url'];
			$song_thumbnail = $a_value[$b_key]['result']['song_art_image_thumbnail_url'];

			echo 'Artist Names: ' . $artist_names . '<br>';
			echo 'Song Title: ' . $song_title . '<br>';
			echo 'URL: ' . $song_url . '<br>';
			echo 'Song ID: ' . $song_id . '<br>';
			echo "<a href='./?page=song_lyrics_results&song_id={$song_id}'><img src='" . $song_thumbnail . "'></a>";
			echo '<br><br><br>';
		}
	}
} else {
	echo 'Nothing Found.';
}



?>






</body>
</html>