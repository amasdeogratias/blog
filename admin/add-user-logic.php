<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    global $connect;

    $first_name = filter_var($_POST['firstname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_var($_POST['lastname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $user_name = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password2 = filter_var($_POST['confirm-password'], FILTER_SANITIZE_SPECIAL_CHARS);
    $user_role = filter_var($_POST['user_role'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];

    //validate inputs
    if(!$first_name){
        $_SESSION['add-user'] = "Enter user first name";
    }elseif(!$last_name){
        $_SESSION['add-user'] = "Enter user last name";
    }elseif(!$user_name){
        $_SESSION['add-user'] = "Enter user username";
    }elseif(!$email){
        $_SESSION['add-user'] = "Enter email address";
    }elseif(!$password){
        $_SESSION['add-user'] = "Enter password";
    }elseif (strlen($password) < 8 || strlen($password2) < 8){
        $_SESSION['add-user'] = "Password should be 8+ characters";
    }elseif (!$avatar['name']){
        $_SESSION['add-user'] = "Please select an image";
    }else{

        if($password !== $password2) {
            $_SESSION['add-user'] = "Passwords do not match";
        }else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            //check if username or email already exist in database
            $user_check_query = "SELECT * FROM users WHERE username='$user_name' OR email='$email'";
            $user_check_result = mysqli_query($connect, $user_check_query);
            if(mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['add-user'] = "Username or Email already exist";
            }else{
                //avatar
                //rename avatar
                $time = time(); // make each image name unique
                $avatar_name = $time. $avatar['name'];
                $avatar_tmp = $avatar['tmp_name'];
                $avatar_destination_path = '../images/' . $avatar_name;

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
                        $_SESSION['add-user'] = "File size too big. Should be less than 1mb";
                    }
                }else{
                    $_SESSION['add-user'] = "File should be png, jpg or jpeg";
                }
            }
        }

    }


    if (isset($_SESSION['add-user'])) {
        $_SESSION['add-user-data'] = $_POST;
        header('location:'.ROOT_URL.'admin/add-user.php');
        die();
    }else{
        //proceed with insertion of data
        $created_at = date('Y-m-d H:i:s');
        $query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin, created_at)
        VALUES ('$first_name', '$last_name', '$user_name', '$email', '$hashed_password', '$avatar_name', '$user_role', '$created_at')";
        $result = mysqli_query($connect, $query);
        if($result) {
            //redirect to login
            $_SESSION['add-user-success'] = "User created successful...";
            header("location: ".ROOT_URL . "admin/manage-users.php");
            die();
        }
    }
}else{
    header('location: '.ROOT_URL . 'admin/add-user.php');
    die();
}
