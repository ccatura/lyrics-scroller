<?php
    $servername = "sql647.main-hosting.eu";
    $username   = "u682819236_scroll2";
    include("pword.php");
    $dbname     = "u682819236_music_scroll2";
    $conn       = mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn){
        die('Could not Connect MySql Server:' .mysql_error());
    }
?>