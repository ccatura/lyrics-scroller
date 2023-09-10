<?php

if(!isset($_GET['register'])) {
    $html = "<form id='login' action='./?page=login' method='post'>
                <input type='hidden' name='login-type' value='login'>
                <div>User Name<br><input type='text' name='user_name' placeholder='User Name'></div>
                <div>Password<br><input type='password' name='pword' placeholder='Password'></div>
                <a href='./?type=recover&desc=Recover Account'>I Forgot My Password</a>
                <div><input type='submit' name='submit' value='Submit'></div>
                <a href='./?page=login&register=true'><div>Click Here to Register</div></a>
            </form>";
} else {
    $html = "<form id='login' action='./?page=login' method='post' enctype='multipart/form-data' autocomplete='off'>
                <input type='hidden' name='login-type' value='register'>
                <div>Choose User Name<br><input type='text' name='user_name' placeholder='Choose User Name' minlength='4' required autocomplete='off'></div>
                <div>Real Name<br><input type='text' name='name' placeholder='Real Name' required></div>
                <div>Email<br><input type='email' name='email' placeholder='Email' minlength='6' required></div>
                <div>Choose Password<br><input type='password' name='pword' placeholder='Choose Password' minlength='8' required autocomplete='off'></div>
                <div><input type='submit' name='submit' value='Submit'></div>
                <a href='./?page=login'><div>Have and account?<br>Login Here</div></a>
            </form>";
}

echo $html;

if (!empty($_POST)) {
    $user_name = strtolower($_POST['user_name']);
    $pword = $_POST['pword'];

    $result = mysqli_query($conn,"SELECT `name`, `user_name`, `pword` FROM `users` WHERE user_name = '{$user_name}' LIMIT 1;");

    // login here
    if ($_POST['login-type'] == 'login' && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $db_user_name = $row['user_name'];
            $db_pword     = $row['pword'];
            $pword        = hash('sha256', $pword);


            // Compare passwords for login
            if ($user_name == $db_user_name && $pword == $db_pword) {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                // header("Location: ./");
                echo "<script>window.location.replace('./');</script>";
                exit;
            }
        }
    // register here
    } elseif ($_POST['login-type'] == 'register' && mysqli_num_rows($result) < 1) {
        $year_born  = $_POST['year_born'];
        $name       = $_POST['name'];
        $email      = $_POST['email'];
        $pword      = hash('sha256', $pword);


        $result = mysqli_query($conn,"INSERT INTO `users` (`user_name`, `pword`, `name`, `email`) VALUES ('{$user_name}', '{$pword}', '{$name}', '{$email}');");
        if ($result) {
            $_SESSION['user_name'] = $user_name;
            $_SESSION['name'] = $name;
            echo "<script>window.location.replace('./');</script>";

            exit;
        }
    } else {
        echo "There was a problem. Please try again.";
    }
}

