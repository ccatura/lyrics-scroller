
<?php
// if (isset($_SESSION['song_object'])) {
//     song_create_edit($_SESSION['song_object']); // Edits the current song object in the session


// } else {
//     if (isset($_GET['song_id'])) {
//         song_create_edit($_GET['song_id']); // Edits the song that was sent over in the URL's query string
//     } else {
//         song_create_edit(); // Creates a blank song creation template
//     }
// }

?>

<div class="create-song-container">
    <div class="create-song-main-header">
        <div class="create-song-save-buttons">
            <input class='popup-button' type="submit" value='Save Song' onclick='saveSong();' />
            <input class='popup-button' type="button" value='Reset' />
            <input type="hidden" id="user-name" value="<?php echo $_SESSION['user_name']; ?>">
        </div>
        <div class="create-song-main-header-row">
            <div class='create-song-labels'>Title</div>
            <input class='create-song-inputs' id='create-song-title' type="text" value='New Song' />
        </div>
        <div class="create-song-main-header-row">
            <div class='create-song-labels'>Sub-Title</div>
            <input class='create-song-inputs' id='create-song-sub-title' type="text" value='By Charlie Katt' />
        </div>
        <div class="create-song-main-header-row">
            <div class='create-song-labels'>Song ID</div>
            <input class='create-song-inputs' id='create-song-id' type="text" placeholder='[New Song - No ID Yet]' disabled />
        </div>
    </div>

<?php
include('./song_part.php');
?>
</div>