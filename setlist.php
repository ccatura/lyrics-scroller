<?php

unset($_SESSION['song_object']);
$_SESSION['draft'] = false;

$user_name  = $_SESSION['user_name'];
$setlist_id = $_GET['setlist_id'];
$html = "";
$setlist_array = array();
$_SESSION['draft'] = false;

$result = mysqli_query($conn,  "SELECT songs.title as 'song_title', setlist_links.setlist_id as 'setlist_id', songs.id as 'song_id', setlists.title as 'setlist_title', setlist_links.song_order as 'song_order' FROM songs
                                JOIN setlist_links on song_id = songs.id
                                JOIN setlists on setlists.id = setlist_links.setlist_id
                                WHERE setlist_links.setlist_id = '{$setlist_id}'
                                AND setlist_links.user_name = '{$user_name}' ORDER BY song_order;");

$setlist_index = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $title          = $row['song_title'];
    $setlist_title  = $row['setlist_title'];
    $song_id        = $row['song_id'];
    $song_order     = $row['song_order'];
    $setlist_array += [$setlist_index => $song_id];

    $html       .= "<a id='{$setlist_id}-{$song_order}' class='click-list-item' href='./?page=get_song&song_id={$song_id}&setlist_index={$setlist_index}'>
                        <div class='click-list-inner-title'>{$setlist_index}) {$title} (ID: {$song_id})</div>
                    </a>
                    <div class='option-item-section fake-link remove-from-setlist' setlist_id='{$setlist_id}' song_order='{$song_order}'>Remove from Setlist</div>
                    ";
    $setlist_index++;
}


$_SESSION['setlist_ids'] = $setlist_array;
$_SESSION['setlist_index'] = 1;

echo "<div class='content-section'>
        <div class='click-list-section'>
            <div class='page-title'>Set List: {$setlist_title}</div>";


echo $html;