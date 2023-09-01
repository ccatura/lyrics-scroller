<?php
$setlist_title = $_GET['setlist_title'];
$user_name = $_SESSION['user_name'];

$result = mysqli_query($conn, "INSERT INTO setlists (`user_name`, `title`) values ('{$user_name}', '{$setlist_title}');");

header("Location: ./?page=setlists");