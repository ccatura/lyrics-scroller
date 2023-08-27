<div class='menu' id='menu'>
    <a class='menu-item' id='close-menu'>&#10005;</a>
    <a href='./' class='menu-item'>Home</a>
    <a href='./?page=song_list' class='menu-item'>Song List</a>
    <a href='./?page=song_search' class='menu-item'>Song Search</a>
    <hr style='width:100%'>
    <a href='./?page=create_edit' class='menu-item'>Create New Song</a>

    <?php if ($_GET['page'] == 'scroller') {
        echo "<a href='./index.php' class='menu-item'>Edit Song</a>";
    } ?>

    <?php if ($_GET['page'] == 'scroller' && !$_SESSION['draft']) {
        echo "<a class='menu-item' id='save-song-settings'>Save Song Settings</a>";
    } ?>

    <hr style='width:100%'>
    <a href='./?page=global_settings' class='menu-item'>Global Settings</a>
    <a href='./index.php' class='menu-item'>Logout</a>
</div>
