<?php
is_logged_in();

if ($_GET['create_type'] == 'new') {
    unset($_SESSION['song_object']);
    $save_or_update = 'Save';
} else {
    $save_or_update = 'Update';
}


$title      = $_SESSION['song_object']->title       ? $_SESSION['song_object']->title :     'New Song';
$sub_title  = $_SESSION['song_object']->sub_title   ? $_SESSION['song_object']->sub_title : 'Sub Title';
$id         = $_SESSION['song_object']->id          ? $_SESSION['song_object']->id :        'ID Automatically Inserted';
$lyrics     = $_SESSION['song_object']->lyrics;

?>

<div class="create-song-container">
    <div class="create-song-main-header">
        <div class="create-song-save-buttons">
            <input class='popup-button' type="submit" value='<?php echo $save_or_update ?>' onclick='saveSong("<?php echo $save_or_update ?>");' />
            <!-- <input class='popup-button' type="button" value='<?php echo $save_or_update ?> & View' /> -->
            <input class='popup-button' type="button" value='Reset' />
            <input type="hidden" id="user-name" value="<?php echo $_SESSION['user_name']; ?>">
        </div>
        <div class="create-song-main-header-row">
            <div class='create-song-labels'>Title</div>
            <input class='create-song-inputs' id='create-song-title' type="text" value='<?php echo $title ?>' />
        </div>
        <div class="create-song-main-header-row">
            <div class='create-song-labels'>Sub-Title</div>
            <input class='create-song-inputs' id='create-song-sub-title' type="text" value='<?php echo $sub_title ?>' />
        </div>
        <div class="create-song-main-header-row">
            <div class='create-song-labels'>Song ID</div>
            <input class='create-song-inputs' id='create-song-id' type="text" value='<?php echo $id ?>' disabled />
        </div>
    </div>

<?php
include('./song_part.php');
echo "<div id='raw-lyrics' style='display:none;'>" . song_parts_to_json($lyrics) . "</div>";

// echo song_parts_to_json($lyrics);

?>
</div>