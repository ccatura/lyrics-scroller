
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
        <div class='click-list-section'>
            <div class='page-title'>Set Lists</div>";

while ($row = mysqli_fetch_assoc($result)) {
    $setlist_title  = $row['title'];
    $setlist_id     = $row['id'];

    $html       .= "<a class='click-list-item' href='./?page=setlist&setlist_id={$setlist_id}'>
                        <div class='click-list-inner-title'>{$setlist_title}</div> 
                        <div class='click-list-inner-sub-title'>(ID: {$setlist_id}) (Songs: 5)</div>
                    </a>";
}






echo $html;