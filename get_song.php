<?php
$song_id = $_GET['song_id'];
$user_name = $_SESSION['user_name'];

if (isset($_GET['setlist_index'])) {
    $_SESSION['setlist_index'] = $_GET['setlist_index'];
}

$result = mysqli_query($conn, "SELECT * FROM `songs` WHERE `id` = '{$song_id}' AND `user_name` = '{$user_name}' LIMIT 1");

while ($row = mysqli_fetch_assoc($result)) {
    $title      = $row['title'];
    $sub_title  = $row['sub_title'];
    $lyrics     = $row['lyrics'];
    $id         = $row['id'];
}

$song = new Song();
$song->set_title($title);
$song->set_sub_title($sub_title);
$song->set_lyrics($lyrics);
$song->set_id($id);


$_SESSION['song_object'] = $song;

header("Location: ./?page=scroller");

echo "<script>window.location.replace('./?page=scroller');</script>";
