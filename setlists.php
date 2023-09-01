
<div class='small-section'>
    <span class='section-title'>Create Setlist</span>
    <form>
        <input type='text' placeholder='User Name' />
        <a href='./?page=song_list'>Create</a>
    </form>
</div>



<?php

unset($_SESSION['song_object']);
$_SESSION['draft']  = false;
$result             = get_setlists();
$user_name          = $_SESSION['user_name'];

$html = "
    <div class='content-section'>
            <div class='page-title'>Set Lists</div>";

while ($row = mysqli_fetch_assoc($result)) {
    $setlist_title  = $row['title'];
    $setlist_id     = $row['id'];
    $song_count     = set_list_song_count($setlist_id);


    $html       .= "<div class='click-list-item'>
                        <a class='click-list-iner-left' href='./?page=setlist&setlist_id={$setlist_id}'>
                            <div class='click-list-title'>{$setlist_title} ({$song_count})</div> 
                            <div class='click-list-sub-title'>(ID: {$setlist_id})</div>
                        </a>
                    </div>";
}






echo $html;