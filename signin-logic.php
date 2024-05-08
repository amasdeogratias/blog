<?php
require 'config/database.php';

if(isset($_POST['submit'])) {
global $connect;
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

    //validation
    if(!$username_email) {
        $_SESSION['signin'] = "Username or Email required";
    }elseif(!$password){
        $_SESSION['signin'] = "Password required";
    }else {
        //fetch user from db
        $user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
        $user_result = mysqli_query($connect, $user_query);

        if (mysqli_num_rows($user_result) == 1) {

            $user_record = mysqli_fetch_assoc($user_result);
            $db_password = $user_record['password'];

            //compare password with input
            if(password_verify($password, $db_password)) {
                //set session for access control
                $_SESSION['user_id'] = $user_record['id'];
                $_SESSION['username'] = $user_record['username'];
                //check if user is admin
                if($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }
                //log user in
                header('location: ' . ROOT_URL . 'admin/');
            }else {
                $_SESSION['signin'] = "Please enter correct password";
            }
        }else {
            $_SESSION['signin'] = "User not found";
        }
    }
    //if any problem, redirect back to sign in page
   if (isset($_SESSION['signin'])) {
       $_SESSION['signin-data'] = $_POST;
       header("location: " .ROOT_URL . "signin.php");
       die();
   }
}else {
    header("location: " .ROOT_URL . "signin.php");
    die();
}
