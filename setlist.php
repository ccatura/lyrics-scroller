<?php

unset($_SESSION['song_object']);
$_SESSION['draft'] = false;

$user_name  = $_SESSION['user_name'];
$setlist_id = $_GET['setlist_id'];
$html = "";
$songlist = '';
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
    $title_stripped = str_replace('`', '',$title);

    $html       .= "<div class='click-list-item' id='{$setlist_id}-{$song_order}'>
                        <a class='click-list-iner-left' href='./?page=get_song&song_id={$song_id}&setlist_index={$setlist_index}'>
                            <div class='click-list-title'>{$setlist_index}) {$title} (Song ID: {$song_id})</div>
                        </a>
                        <div class='click-list-inner-right'>
                            <div onclick='popupAlert(`Warning!`,`The song \"{$title_stripped}\" will be removed from setlist \"{$setlist_title}\"!`,``,`removeSongFromSetlist`, this);' class='option-item-section fake-link delete-setlist' setlist_id='{$setlist_id}' setlist_title='{$setlist_title}' song_order='{$song_order}'>Remove from Setlist</div>
                            <div class='add-to-setlist fake-link' id='song_{$id}' song_title='{$title_stripped}'>Add to:
                                <select class='dropdown' song_name='{$title_stripped}'><option value='null'>[Select Setlist]</option>";
                                $result_setlist = get_setlists();
                                while ($row = mysqli_fetch_assoc($result_setlist)) {
                                    $setlist_title  = $row['title'];
                                    $setlist_id     = $row['id'];
                                
                                    $html .= "<option class='options' value='{$setlist_id}-{$song_id}'>{$setlist_title} ({$setlist_id})</option>";
                                }
                                $html .= "</select></div>
                        </div>
                    </div>";
    $setlist_index++;
}

$result_songlist = get_song_list();
$songlist .= "<select class='dropdown' setlist_title='{$setlist_title}'><option value='null'>[Select Song]</option>";
while ($row = mysqli_fetch_assoc($result_songlist)) {
    $song_title  = $row['title'];
    $song_id     = $row['id'];
    $songlist .= "<option class='options' value='{$setlist_id}-{$song_id}'>{$song_title} ({$song_id})</option>";
}
$songlist .= '</select>';


$_SESSION['setlist_ids'] = $setlist_array;
$_SESSION['setlist_index'] = 1;

echo "<div class='content-section'>
        <div class='click-list-section'>
            <div class='page-title'>Set List: {$setlist_title} ({$setlist_id})</div>
            <div>Add song to setlist: {$songlist}</div>";


echo $html;