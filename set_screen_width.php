<?php
session_start();

$screen_width = json_decode(file_get_contents("php://input"), true);


if ($screen_width > 600) {
    $_SESSION['screen_width'] = 'desktop';
} else {
    $_SESSION['screen_width'] = 'mobile';
}


