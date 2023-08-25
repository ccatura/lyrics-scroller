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
    // $song_album 	= $result_decoded['lyrics']['tracking_data']['primary_album'];


    echo $title . '<br>';
    // echo $song_artist . '<br>';
    // echo $song_album . '<br><br>';
    echo $lyrics . '<br>';

    echo '<br><br><br>';



	$song = new Song();
	$song->set_title($title);
	$song->set_sub_title($sub_title);
	$song->set_lyrics($lyrics);
	$song->set_id($id);


	$_SESSION['song_object'] = $song;


	header("Location: ./?page=scroller");



}













function getResults($query_string) {
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
			"X-RapidAPI-Key: 456000e0a5mshd9892438c3e7ef9p19b140jsnae262bb6c57f"
		],
	]);
	return $curl;
}