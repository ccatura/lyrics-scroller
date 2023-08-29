<?php

unset($_SESSION['song_object']);
$_SESSION['draft'] = false;
unset($_SESSION['setlist_ids']);

$user_name = $_SESSION['user_name'];
$html = "
    <div class='content-section'>
        <div class='click-list-section'>
            <div class='page-title'>Song List</div>";

$result = get_song_list();
while ($row = mysqli_fetch_assoc($result)) {
    $title      = $row['title'];
    $sub_title  = $row['sub_title'];
    $id         = $row['id'];
    $title_stripped = str_replace('\'', '', $title);

    $html       .= "<a class='click-list-item' href='./?page=get_song&song_id={$id}'>
                        <div class='click-list-inner-title'>{$title}</div> 
                        <div class='click-list-inner-sub-title'>{$sub_title} ({$id})</div>
                    </a> 
                    <div class='option-item-section'>
                        <a href='./?page=create_edit&song_id={$id}'><div>EDIT</div></a>
                        <div class='add-to-setlist fake-link' id='song_{$id}' song_title='{$title_stripped}'>+SETLIST</div>
                    </div>";
}
echo $html;




// Get little  setlist window
$html = '';
$result_setlist = get_setlists();
$user_name      = $_SESSION['user_name'];

echo "<div class='small-section floating' id='floating-setlists'>Add <span id='song-title'></span> to Setlist:";

while ($row = mysqli_fetch_assoc($result_setlist)) {
    $setlist_title  = $row['title'];
    $setlist_id     = $row['id'];

    $html .= "<div class='click-list-item fake-link setlist-to-add-it-to' id='setlist_{$setlist_id}'>{$setlist_title} ({$setlist_id})</div>";
}

$html .= "</div>";
echo $html;
