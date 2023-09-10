<div class='menu' id='menu'>
    <a class='menu-item' id='close-menu'>&#10005;</a>
    <!-- <a href='./' class='menu-item'>Home</a> -->
    <?php
    $id = $song->id; 
    if ($_GET['page'] == 'scroller') {
        echo "<a href='./?page=get_song&song_id={$id}' class='menu-item'><span class='button material-symbols-outlined'>refresh</span> Refresh Song</a><hr style='width:100%'>";
    }
    ?>
    <a href='./?page=song_list' class='menu-item'><span class="button material-symbols-outlined">music_note</span> Songs</a>
    <a href='./?page=setlists' class='menu-item'><span class="button material-symbols-outlined">queue_music</span> Setlists</a>
    <a href='./?page=song_search' class='menu-item'><span class="button material-symbols-outlined">search</span> Search</a>
    
    <hr style='width:100%'>
    <a href='./?page=create_edit_song&create_type=new' class='menu-item'><span class="button material-symbols-outlined">piano</span> Create Song</a>

    <?php if ($_GET['page'] == 'scroller') {
        if (!$_SESSION['draft']) {
            echo "<a href='./?page=create_edit_song&create_type=current' class='menu-item'><span class='button material-symbols-outlined'>edit</span> Edit This Song</a>";
            echo "<div class='menu-item'><span class='button material-symbols-outlined'>add</span> Add to Setlist</div>";

            $title_stripped = str_replace('\'', '', $song->title);
            $html = "<select class='dropdown' song_name='{$title_stripped}'><option value='null'>[Select Setlist]</option>";
            $result_setlist = get_setlists();
            while ($row = mysqli_fetch_assoc($result_setlist)) {
                $setlist_title  = $row['title'];
                $setlist_id     = $row['id'];
            
                $html .= "<option class='options' value='{$setlist_id}-{$id}'>{$setlist_title} ({$setlist_id})</option>";
            }
            $html .= "</select>";
            echo $html . '<br>';

            echo "<a href='./' class='menu-item'><span class='button material-symbols-outlined'>delete</span> Delete Song</a>";
        }
    } ?>

    <?php if ($_GET['page'] == 'scroller' && !$_SESSION['draft']) {
        // echo "<a class='menu-item' id='auto-scroll'>Autoscroll on Load <span id='auto-scroll-properties'>{$auto_scroll_x}</span></a>";
        echo "<div class='menu-item'><span class='button material-symbols-outlined'>save</span> Save Settings for:</div>";
        if ($_SESSION['screen_width'] == 'mobile') {
            echo "<div class='menu-item save-song-settings indent' id='save-song-settings-mobile' platform='mobile'>&#8226; Mobile</div>";
        } else {
            echo "<div class='menu-item save-song-settings indent' id='save-song-settings-desktop' platform='desktop'>&#8226; Desktop</div>";
        }
    } ?>

    <hr style='width:100%'>
    <a href='./?page=global_settings' class='menu-item'><span class="button material-symbols-outlined">settings</span> Global Settings</a>
    <a href='./?page=logout' class='menu-item'><span class="button material-symbols-outlined">logout</span> Logout</a>
    <div><span class="button material-symbols-outlined">computer</span> Screen Width: <span id='screen-width'><?php echo $_SESSION['screen_width'] ?></span></div>
</div>
