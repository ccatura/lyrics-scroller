`<?php

unset($_SESSION['song_object']);
$_SESSION['draft'] = false;

$user_name = $_SESSION['user_name'];
$html = "
    <div class='content-section'>
        <div class='click-list-section'>
            <div class='page-title'>Song List</div>";

$result = mysqli_query($conn,"SELECT `title`, `id` FROM `setlists` WHERE `user_name` = '{$user_name}' ORDER BY `title` ");

while ($row = mysqli_fetch_assoc($result)) {
    $title      = $row['title'];
    $sub_title  = $row['sub_title'];
    $id         = $row['id'];

    $html       .= "<a class='click-list-item' href='./?page=get_song&song_id={$id}'>
                        <div class='click-list-inner-title'>{$title}</div> 
                        <div class='click-list-inner-sub-title'>({$id})</div>
                    </a>";
}






echo $html;