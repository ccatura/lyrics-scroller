<?php
// if (isset($_GET['type'])) {
//     $type = $_GET['type'];
// } else {
//     $type = '';
// }

if ($page == 'scroller') {
    $html = file_get_contents('./header_scroller.php') . menu() . "</div>";
} else {
    $html = file_get_contents('./header_common.php') . menu() . "</div>";
}






echo $html;

