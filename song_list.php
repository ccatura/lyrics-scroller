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
                        <a href='./?page=create_edit&song_id={$id}'><div id='add-to-setlist'>+SETLIST</div></a>
                    </div>";
}
echo $html;


$html = '';
$result_setlist = get_setlists();
$user_name      = $_SESSION['user_name'];

echo "<div class='small-section'>";

while ($row = mysqli_fetch_assoc($result_setlist)) {
    $setlist_title  = $row['title'];
    $setlist_id     = $row['id'];

    $html .= "<a href=''>
                <div>{$setlist_title}</div> 
                <div>({$setlist_id})</div>
            </a>";
}

$html .= "</div>";
echo $html;
