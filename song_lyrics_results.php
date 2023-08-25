<?php

$id = $_GET['song_id'];

$curl = getResults("https://genius-song-lyrics1.p.rapidapi.com/song/lyrics/?id={$id}");
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$result_decoded = json_decode($response, true);

// var_dump($result_decoded);


if ($err) {
	echo "cURL Error #:" . $err;
} else {
    $lyrics 		= $result_decoded['lyrics']['lyrics']['body']['html'];
    $lyrics    		= strip_tags($lyrics, '<br><p><div>'); // strips html tags, except <br>
    $title 			= $result_decoded['lyrics']['tracking_data']['title'];
    $sub_title	 	= $result_decoded['lyrics']['tracking_data']['primary_artist'] . ' ' . $result_decoded['lyrics']['tracking_data']['primary_album'];

	$song = new Song();
	$song->set_title($title);
	$song->set_sub_title($sub_title);
	$song->set_lyrics($lyrics);
	$song->set_id($id);


	$_SESSION['song_object'] = $song;


	$_SESSION['draft'] = true;

	header("Location: ./?page=scroller");



}













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