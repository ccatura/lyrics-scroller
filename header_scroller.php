<?php
$song = $_SESSION['song_object'];
?>

<div class='header-inner'>
    <div class='header-buttons'>
        <div class="outer-el" id='scroll-toggle-button'>
            <div class="button-label" id='state-label'>play</div>
            <div class="button-wrapper">
                <div class="button material-symbols-outlined" id='play'>play_circle</div>
            </div>
            <div class="button-properties"></div>
        </div>

        <?php
            $screen_width = $_SESSION['screen_width'];
            // echo get_song_settings($song->id, 'auto_scroll', 'mobile');
            if (get_song_settings($song->id, 'auto_scroll', $screen_width) == '1') {
                $auto_scroll_x = 'check_circle';
            } else {
                $auto_scroll_x = 'circle';
            }
        

            if (!$_SESSION['draft']) {
                echo "<div class='outer-el' id='auto-scroll'>
                    <div class='button-label'>auto scroll</div>
                    <div class='button-wrapper'>
                        <div class='button material-symbols-outlined' id='auto-scroll-properties'>{$auto_scroll_x}</div>
                    </div>
                </div>";
            }
        ?>


        <div class="outer-el">
            <div class="button-label">speed:
                <span class="button-properties" id='speed'><?php echo get_song_settings($song->id, 'speed', $screen_width); ?></span>
            </div>
            <div class="button-wrapper">
                <div class="button material-symbols-outlined" id='speed-down'>do_not_disturb_on</div>
                <div class="button material-symbols-outlined" id='speed-up'>add_circle</div>
            </div>
        </div>  
        <div class="outer-el">
            <div class="button-label">size:
                <span class="button-properties" id='size'><?php echo get_song_settings($song->id, 'size', $screen_width); ?></span>
            </div>
            <div class="button-wrapper">
                <div class="button material-symbols-outlined" id='font-smaller'>do_not_disturb_on</div>
                <div class="button material-symbols-outlined" id='font-bigger'>add_circle</div>
            </div>
        </div>
    </div>
    <div class="header-menu">
        <div class='inner-el to-right menu-toggle' id='menu-toggle'>&#9776;</div>
    </div>
</div>


