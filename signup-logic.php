<?php
session_start();
require 'config/database.php';

if(isset($_POST['submit'])) {
    global $connect;
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
    $confirm_password = filter_var($_POST['confirm-password'], FILTER_SANITIZE_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

    //validate inputs
    if(!$firstname) {
        $_SESSION['signup'] = 'Please enter your First Name';
    } elseif (!$lastname){
        $_SESSION['signup'] = "Please enter your Last Name";
    }elseif (!$username){
        $_SESSION['signup'] = "Please enter your Username";
    }elseif (!$email){
        $_SESSION['signup'] = "Please enter your Email";
    }elseif (strlen($password) < 8 || strlen($confirm_password) < 8){
        $_SESSION['signup'] = "Password should be 8+ characters";
    }elseif (!$avatar['name']){
        $_SESSION['signup'] = "Please select an image";
    }else{
        //check if password don't match
        if($password !== $confirm_password) {
            $_SESSION['signup'] = "Password do not match";
        }else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            //check if username or email already exist in database
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connect, $user_check_query);
            if(mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "Username or Email already exist";
            }else{
                //avatar
                //rename avatar
                $time = time(); // make each image name unique
                $avatar_name = $time. $avatar['name'];
                $avatar_tmp = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

                //extensions allowed in image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $avatar_name);
                $extension = end($extension);

                if(in_array($extension, $allowed_files)) {
                    //make sure the image size is less or equal to (1mb)
                    if ($avatar['size'] < 1000000) {
                        //proceed with upload
                        move_uploaded_file($avatar_tmp, $avatar_destination_path);
                    }else{
                        $_SESSION['signup'] = "File size too big. Should be less than 1mb";
                    }
                }else{
                    $_SESSION['signup'] = "File should be png, jpg or jpeg";
                }
            }
        }
    }
    //redirect to signup
    if($_SESSION['signup']) {
        $_SESSION['signup-data'] = $_POST;
        header("location: ".ROOT_URL . "signup.php");
        die();
    }else {
        //insert new record into users
        $created_at = date('Y-m-d H:i:s');
        $query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin, created_at)
        VALUES ('$firstname', '$lastname', '$username', '$email', '$hashed_password', '$avatar_name', 0, '$created_at')";
        $result = mysqli_query($connect, $query);
        if($result) {
            //redirect to login
            $_SESSION['signup-success'] = "Registration successful. Please log in";
            header("location: ".ROOT_URL . "signin.php");
            die();
        }
    }
}else {
    //if button is not clicked, return back to signup page
    header("location: ".ROOT_URL . "signup.php");
}
