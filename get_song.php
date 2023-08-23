<?php
$song_id = $_GET['song_id'];
$user_name = 'ccatura'; // This will eventually be who is logged in

$result = mysqli_query($conn,"SELECT * FROM `songs` WHERE `id` = '{$song_id}' AND `user_name` = '{$user_name}' LIMIT 1");

while ($row = mysqli_fetch_assoc($result)) {
    $title      = $row['title'];
    $sub_title  = $row['sub_title'];
    $lyrics     = $row['lyrics'];
    $id         = $row['id'];
}

$song = new Song();
$song->title = $title;
$song->sub_title = $sub_title;
$song->lyrics = $lyrics;
$song->id = $id;


$_SESSION['song_object'] = $song;

header("Location: ./?page=scroller");