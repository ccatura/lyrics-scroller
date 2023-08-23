<?php
// if (isset($_GET['type'])) {
//     $type = $_GET['type'];
// } else {
//     $type = '';
// }

if ($page == 'scroller') {
    $html = "
        <div class='outer-el'>
            <div class='inner-el'>START/STOP</div>
        </div>
        <div class='outer-el'>
            <div class='inner-el'>FASTER</div>
            <div class='inner-el'>SLOWER</div>
        </div>
        <div class='outer-el'>
            <div class='inner-el'>LARGER</div>
            <div class='inner-el'>SMALLER</div>
        </div>
        <div class='outer-el'>
            <div class='inner-el'>PREV</div>
            <div class='inner-el'>NEXT</div>
        </div>
        <div class='outer-el'>
            <div class='inner-el'>OTHER</div>
            <div class='inner-el'>OTHER</div>
        </div>
        <div class='outer-el'>
            <a class='inner-el' href='./?page=create_edit'>+ Create</a>
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
        <div class='outer-el'>
            <a class='inner-el' href='./?page=create_edit'>+ Create</a>
            <div class='inner-el to-right menu-toggle'>&#9776;</div>
            " . file_get_contents('./menu.html') . "
        </div>
    ";
}






echo $html;

