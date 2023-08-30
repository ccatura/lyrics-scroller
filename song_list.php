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
                        <div class='add-to-setlist fake-link' id='song_{$id}' song_title='{$title_stripped}'>Add to: 


                        <select class='dropdown' song_name='{$title_stripped}'><option value='null'>Setlist</option>";
                        $result_setlist = get_setlists();
                        while ($row = mysqli_fetch_assoc($result_setlist)) {
                            $setlist_title  = $row['title'];
                            $setlist_id     = $row['id'];
                        
                            $html .= "<option class='options' value='{$setlist_id}-{$id}'>{$setlist_title} ({$setlist_id})</option>";
                        }
                        $html .= "</select></div></div>";
}
echo $html;
