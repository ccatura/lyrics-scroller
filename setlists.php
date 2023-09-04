
<div class='small-section'>
    <span class='section-title'>Create Setlist</span>
    <form id='setlist-action' method='post'>
        <input type='text' placeholder='User Name' id='setlist-title' />
        <input type="submit" value='Create'>
    </form>
</div>

<?php

unset($_SESSION['song_object']);
$_SESSION['draft']  = false;
$result             = get_setlists('id');
$user_name          = $_SESSION['user_name'];

$html = "
    <div class='content-section'>
            <div class='page-title'>Set Lists</div>";

while ($row = mysqli_fetch_assoc($result)) {
    $setlist_title  = $row['title'];
    $setlist_id     = $row['id'];
    $song_count     = set_list_song_count($setlist_id);


    $html       .= "<div class='click-list-item' id='{$setlist_id}'>
                        <a class='click-list-iner-left' href='./?page=setlist&setlist_id={$setlist_id}'>
                            <div class='click-list-title'>{$setlist_title} ({$song_count})</div> 
                            <div class='click-list-sub-title'>(ID: {$setlist_id})</div>
                        </a>
                        <div class='click-list-inner-right'>
                            <a href='./?page=create_edit&song_id={$id}'>EDIT</a>
                            <div onclick='popupAlert(`Warning!`,`The setlist {$setlist_title} and all its songs will be removed!`,``,`deleteSetlist`, this);' class='option-item-section fake-link delete-setlist' setlist_id='{$setlist_id}' setlist_title='{$setlist_title}'>Delete Setlist</div>
                        </div>
                    </div>";
}






echo $html;