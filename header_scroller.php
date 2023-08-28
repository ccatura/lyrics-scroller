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
        <div class="outer-el" id='fullscreen'>
            <div class="button-label" id='fullscreen-label'>fullscreen</div>
            <div class="button-wrapper">
                <div class="button material-symbols-outlined">play_circle</div>
            </div>        </div>
        <div class="outer-el">
            <div class="button-label">speed</div>
            <div class="button-wrapper">
                <div class="button material-symbols-outlined" id='speed-down'>do_not_disturb_on</div>
                <div class="button material-symbols-outlined" id='speed-up'>add_circle</div>
            </div>
            <div class="button-properties" id='speed'><?php echo get_song_settings($song->id, 'speed', 'mobile'); ?></div>
        </div>  
        <div class="outer-el">
            <div class="button-label">size</div>
            <div class="button-wrapper">
                <div class="button material-symbols-outlined" id='font-smaller'>do_not_disturb_on</div>
                <div class="button material-symbols-outlined" id='font-bigger'>add_circle</div>
            </div>
            <div class="button-properties" id='size'><?php echo get_song_settings($song->id, 'size', 'mobile'); ?></div>
        </div>
        <div class="outer-el">
            <div class="button-label">prev - next</div>
            <div class="button-wrapper">
                <div class="button material-symbols-outlined" id='previous-song'>arrow_circle_left</div>
                <div class="button material-symbols-outlined" id='next-song'>arrow_circle_right</div>
            </div>
            <div class="button-properties">this song</div>            
        </div>
    </div>
    <div class="header-menu">
        <div class='inner-el to-right menu-toggle' id='menu-toggle'>&#9776;</div>
    </div>
</div>


