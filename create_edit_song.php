
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
        <div class="create-song-main-header-row">
            <div class='create-song-labels'>Title</div>
            <input class='create-song-inputs' type="text">
        </div>
        <div class="create-song-main-header-row">
            <div class='create-song-labels'>Sub-Title</div>
            <input class='create-song-inputs' type="text">
        </div>
    </div>

<?php
include('./song_part.php');
include('./song_part.php');
?>
</div>