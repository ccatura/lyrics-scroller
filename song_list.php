<?php

unset($_SESSION['song_object']);
$user_name = 'ccatura'; // This will eventually be sho is logged in
$html = "
    
    <div class='content-section'>
        <div class='click-list-section'>
            <div class='page-title'>Song List</div>";
    //         <a class='click-list-item' href='./?page=get_song&song_id=2'>Song 1</a>
    //         <a class='click-list-item' href='./?page=get_song&song_id=1'>You Raise Me Up</a>
    //     </div>
    // </div>
    // ";

$result = mysqli_query($conn,"SELECT `title`, `sub_title`, `id` FROM `songs` WHERE `user_name` = '{$user_name}' ORDER BY `title` ");

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
                        <a href='./?page=create_edit&song_id={$id}'><div>+ SETLIST</div></a>
                    </div>";
}






echo $html;