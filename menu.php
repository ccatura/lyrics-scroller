<div class='menu' id='menu'>
    <a class='menu-item' id='close-menu'>&#10005;</a>
    <!-- <a href='./' class='menu-item'>Home</a> -->
    <a href='./?page=song_list' class='menu-item'><span class="button material-symbols-outlined">music_note</span> Songs</a>
    <a href='./?page=setlists' class='menu-item'><span class="button material-symbols-outlined">queue_music</span> Setlists</a>
    <a href='./?page=song_search' class='menu-item'><span class="button material-symbols-outlined">search</span> Search</a>
    
    <hr style='width:100%'>
    <a href='./?page=create_edit' class='menu-item'><span class="button material-symbols-outlined">piano</span> Create Song</a>

    <?php if ($_GET['page'] == 'scroller') {
        if (!$_SESSION['draft']) {
            echo "<a href='./index.php' class='menu-item'><span class='button material-symbols-outlined'>edit</span> Edit This Song</a>";
            echo "<a href='./index.php' class='menu-item'><span class='button material-symbols-outlined'>add</span> Add to Setlist</a>";
            echo "<a href='./index.php' class='menu-item'><span class='button material-symbols-outlined'>delete</span> Delete Song</a>";
        }
    } ?>

    <?php if ($_GET['page'] == 'scroller' && !$_SESSION['draft']) {
        // echo "<a class='menu-item' id='auto-scroll'>Autoscroll on Load <span id='auto-scroll-properties'>{$auto_scroll_x}</span></a>";
        echo "<a class='menu-item'><span class='button material-symbols-outlined'>save</span> Save Settings for:</a>";
        echo "<a class='menu-item save-song-settings indent' id='save-song-settings-mobile' platform='mobile'>&#8226; Mobile</a>";
        echo "<a class='menu-item save-song-settings indent' id='save-song-settings-desktop' platform='desktop'>&#8226; Desktop</a>";
    } ?>

    <hr style='width:100%'>
    <a href='./?page=global_settings' class='menu-item'><span class="button material-symbols-outlined">settings</span> Global Settings</a>
    <a href='./index.php' class='menu-item'><span class="button material-symbols-outlined">logout</span> Logout</a>
</div>
