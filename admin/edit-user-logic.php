<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    global $connect;

    $id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
    $first_name = filter_var($_POST['firstname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_var($_POST['lastname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $user_role = filter_var($_POST['user_role'], FILTER_SANITIZE_NUMBER_INT);

    //validate inputs
    if(!$first_name){
        $_SESSION['add-user'] = "Couldn't update post. Invalid form data on edit page.";
    }elseif(!$last_name){
        $_SESSION['add-user'] = "Couldn't update post. Invalid form data on edit page.";
    }else{
        //check if username or email already exist in database
        $user_check_query = "SELECT * FROM users WHERE username='$user_name' OR email='$email'";
        $user_check_result = mysqli_query($connect, $user_check_query);
        if(mysqli_num_rows($user_check_result) > 0) {
            $_SESSION['add-user'] = "Username or Email already exist";
        }
    }


    if (isset($_SESSION['add-user'])) {
        header('location:'.ROOT_URL.'admin/manage-users.php');
        die();
    }else{
        //proceed with insertion of data
        $created_at = date('Y-m-d H:i:s');
        $query = "UPDATE users SET firstname='$first_name', lastname='$last_name', is_admin='$user_role' WHERE id=$id";
        $result = mysqli_query($connect, $query);
        if($result) {
            //redirect to login
            $_SESSION['edit-user-success'] = "User updated successful...";
            header("location: ".ROOT_URL . "admin/manage-users.php");
            die();
        }
    }
}else{
    header('location: '.ROOT_URL . 'admin/manage-users.php');
    die();
}
