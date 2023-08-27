<?php



$_SESSION['settings_array'] = array(
    "speed"         => $_GET['speed'],
    "size"          => $_GET['size'],
    "auto_scroll"   => $_GET['auto_scroll']
);



save_song_settings('3', $_SESSION['settings_array'], 'mobile');

