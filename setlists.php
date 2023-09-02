
<div class='small-section'>
    <span class='section-title'>Create Setlist</span>
    <form>
        <input type='text' placeholder='User Name' id='setlist-title' />
        <a href='' id='setlist-href'>Create</a>
    </form>
</div>

<!-- Rewrite this to be better, with buttons and everything -->
<script>
var setlistTitle = document.getElementById('setlist-title');
var setlistHREF = document.getElementById('setlist-href');

setlistTitle.addEventListener('change', ()=> {
    setlistHREF.href = './?page=create_setlist&setlist_title=' + setlistTitle.value;
});

</script>

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
                            <a href='./?page=create_edit&song_id={$id}''>EDIT</a>
                            <div class='option-item-section fake-link delete-setlist' setlist_id='{$setlist_id}'>Delete Setlist</div>
                        </div>
                    </div>";
}






echo $html;