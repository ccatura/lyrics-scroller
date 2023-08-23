<?php
// if (isset($_GET['type'])) {
//     $type = $_GET['type'];
// } else {
//     $type = '';
// }

if ($page == 'scroller') {
    $html = "
        <div class='outer-el'>
            <div class='inner-el'>START</div>
        </div>
        <div class='outer-el'>
            <span class='material-symbols-outlined inner-el'>play_arrow</span>
            <span class='material-symbols-outlined inner-el'>fast_forward</span>
        </div>
        <div class='outer-el'>
            <span class='material-symbols-outlined inner-el'>zoom_out_map</span>
            <span class='material-symbols-outlined inner-el'>zoom_in_map</span>
        </div>
        <div class='outer-el'>
            <span class='material-symbols-outlined inner-el'>skip_previous</span>
            <span class='material-symbols-outlined inner-el'>skip_next</span>
        </div>
        <div class='outer-el' id='menu-button'>
            <div class='inner-el to-right menu-toggle'>&#9776;</div>
        " . file_get_contents('./menu.html') . "
        </div>";
} else {
    $html = "
        <div class='outer-el'>
            <div class='inner-el'>Login</div>
        </div>
        <div class='outer-el'>
            <div class='inner-el'>Music Scroller</div>
        </div>
        <div class='outer-el' id='menu-button'>
            <div class='inner-el to-right menu-toggle'>&#9776;</div>
            " . file_get_contents('./menu.html') . "
        </div>
    ";
}






echo $html;

