<?php
$song = $_SESSION['song_object'];
$user_name = $_SESSION['user_name'];
unset($_SESSION['setlist_index']);
unset($_SESSION['setlist_ids']);

$title      = str_replace("'", "`", $song->title);
$sub_title  = str_replace("'", "`", $song->sub_title);
$lyrics     = str_replace("'", "`", $song->lyrics);



$result = mysqli_query($conn, "REPLACE INTO `songs`(`user_name`, `title`, `sub_title`, `lyrics`) VALUES ('{$user_name}', '{$title}', '{$sub_title}', '{$lyrics}');");

$_SESSION['draft'] = false;



$song_id = get_last_song_id_from_title($title);


header("Location: ./?page=get_song&song_id={$song_id}");
echo "<script>window.location.replace('./?page=get_song'&song_id={$song_id}');</script>";
