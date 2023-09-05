<?php
$song = $_SESSION['song_object'];
$user_name = $_SESSION['user_name'];
unset($_SESSION['setlist_index']);
unset($_SESSION['setlist_ids']);

$lyrics = $song->lyrics;
$lyrics = str_replace("'", "`", $lyrics);

$result = mysqli_query($conn, "REPLACE INTO `songs`(`user_name`, `title`, `sub_title`, `lyrics`) VALUES ('{$user_name}', '{$song->title}', '{$song->sub_title}', '{$lyrics}');");

$_SESSION['draft'] = false;



// $song->set_id(get_last_id_from_title($song->title));

// MAYBE do get song instead, and start fresh. This is being buggy.


header("Location: ./?page=song_list");