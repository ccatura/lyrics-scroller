<?php

unset($_SESSION['song_object']);
$_SESSION['draft'] = false;
unset($_SESSION['setlist_ids']);
unset($_SESSION['setlist_index']);
unset($_SESSION['setlist_ids']);

$user_name = $_SESSION['user_name'];
$song_count = include('./song_count.php');
$html = "
    <div class='content-section'>
            <div class='page-title'><span id='song-count'>{$song_count}</span> Songs</div>";

$result = get_song_list();
while ($row = mysqli_fetch_assoc($result)) {
    $title      = $row['title'];
    $sub_title  = $row['sub_title'];
    $id         = $row['id'];
    $title_stripped = str_replace('\'', '', $title);

    $html       .= "<div class='click-list-item' id='{$id}'>
                        <a class='click-list-inner-left' href='./?page=get_song&song_id={$id}'>
                            <div class='click-list-title'>{$title}</div> 
                            <div class='click-list-sub-title'>{$sub_title} ({$id})</div>
                        </a>
                    
                        <div class='click-list-inner-right'>
                            <div onclick='popupAlert(`Delete Song`,`The song \"{$title_stripped}\" will be permenantly deleted from your account! You cannot undo this action.`,``,`deleteSong`, this);' class='option-item-section fake-link' song_id='$id' user_name='$user_name'>Delete Song</div>

                            <div class='add-to-setlist fake-link' id='song_{$id}' song_title='{$title_stripped}'>Add to: 


                            <select class='dropdown' song_name='{$title_stripped}'><option value='null'>[Select Setlist]</option>";
                            $result_setlist = get_setlists();
                            while ($row = mysqli_fetch_assoc($result_setlist)) {
                                $setlist_title  = $row['title'];
                                $setlist_id     = $row['id'];
                            
                                $html .= "<option class='options' value='{$setlist_id}-{$id}'>{$setlist_title} ({$setlist_id})</option>";
                            }
                            $html .= "</select></div>
                        </div>
                    </div>";
}
echo $html;
