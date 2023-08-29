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

    $html       .= "<a class='click-list-item' href='./?page=get_song&song_id={$id}'>
                        <div class='click-list-inner-title'>{$title}</div> 
                        <div class='click-list-inner-sub-title'>{$sub_title} ({$id})</div>
                    </a> 
                    <div class='option-item-section'>
                        <a href='./?page=create_edit&song_id={$id}'><div>EDIT</div></a>
                        <a href='' class='add-to-setlist'><div>+SETLIST</div></a>
                    </div>";
}
echo $html;


$html = '';
$result_setlist = get_setlists();
$user_name      = $_SESSION['user_name'];

echo "<div class='small-section floating' id='floating-setlists'>Add (song??) to Setlist:";

while ($row = mysqli_fetch_assoc($result_setlist)) {
    $setlist_title  = $row['title'];
    $setlist_id     = $row['id'];

    $html .= "<a href=''>
                <div class='click-list-item'>{$setlist_title} ({$setlist_id})</div>
            </a>";
}

$html .= "</div>";
echo $html;
