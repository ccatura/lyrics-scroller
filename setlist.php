<?php

unset($_SESSION['song_object']);
$_SESSION['draft'] = false;

$user_name  = $_SESSION['user_name'];
$setlist_id = $_GET['setlist_id'];
$html = "";
$setlist_array = array();
$_SESSION['draft'] = false;

$result = mysqli_query($conn,  "SELECT songs.title as 'song_title', setlist_links.setlist_id as 'setlist_id', songs.id as 'song_id', setlists.title as 'setlist_title' FROM songs
                                JOIN setlist_links on song_id = songs.id
                                JOIN setlists on setlists.id = setlist_links.setlist_id
                                WHERE setlist_links.setlist_id = '{$setlist_id}'
                                AND setlist_links.user_name = '{$user_name}' ORDER BY song_order;");

$setlist_index = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $title          = $row['song_title'];
    $setlist_title  = $row['setlist_title'];
    $song_id        = $row['song_id'];

   $setlist_array += [$setlist_index => $song_id];

    $html       .= "<a class='click-list-item' href='./?page=get_song&song_id={$song_id}&setlist_index={$setlist_index}'>
                        <div class='click-list-inner-title'>{$setlist_index}) {$title} {$song_id}</div> 
                    </a>";
    $setlist_index++;
}


$_SESSION['setlist_ids'] = $setlist_array;
$_SESSION['setlist_index'] = 1;
// var_dump($_SESSION['setlist_ids']);
// echo $setlist_array;
echo "<div class='content-section'>
        <div class='click-list-section'>
            <div class='page-title'>Set List: {$setlist_title}</div>";


echo $html;