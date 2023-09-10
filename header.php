<?php

if (isset($_SESSION['user_name'])) {

    if ($page == 'scroller') {
        include('./header_scroller.php');
    } else {
        include('./header_common.php');
    }

    include('./menu.php');
    include('./popup_alert.php');
} else {
    include('./header_login.php');
}

// is_logged_in();