<?php
require 'config/database.php';

if (isset($_POST['submit'])){
    global $connect;
    //get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_SPECIAL_CHARS);
    $featured = $_POST['featured'];
    $thumbnail = $_FILES['thumbnail'];
    $date = date('Y-m-d H:i:s');

    if(!$title) {
        $_SESSION['add-post'] = "Enter post title";
    }elseif (!$body) {
        $_SESSION['add-post'] = "Enter body of post";
    }elseif(!$category){
        $_SESSION['add-post'] = "Enter post category";
    }elseif (!$thumbnail['name']){
        $_SESSION['add-post'] = "Please select an image";
    }
    //redirect back to add category page if invalid input
    if (isset($_SESSION['add-post'])) {
        $_SESSION['add-post-data'] = $_POST;
        header('location:'.ROOT_URL.'admin/add-post.php');
        die();
    }else {

        //upload image
        $time = time();
        $file_name = $time. $thumbnail['name'];
        $tmp_name = $thumbnail['tmp_name'];
        $destination_path = "./uploads/". $file_name;

        //allowed files
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $file_name);
        $extension = end($extension);

        if(!in_array($extension, $allowed_files)){
            $_SESSION['add-post'] = "File should be png, jpg or jpeg";
            exit;
        }else{
            if($thumbnail['size'] > 1000000){
                $_SESSION['add-post'] = "File size should be less or equal to 1mb";
                exit;
            }
            move_uploaded_file($tmp_name, $destination_path);
        }
        //insert data into database
        $user_id = $_SESSION['user_id'];
        $query = "INSERT INTO posts (category_id, author_id, title, body, thumbnail, is_featured, created_at) 
                VALUES ('$category', '$user_id', '$title', '$body', '$file_name', '$featured', '$date')";
        $result = mysqli_query($connect, $query);
        if(mysqli_errno($connect)){
            $_SESSION['add-post'] = "Couldn't add post";
            header('location:'.ROOT_URL.'admin/add-post.php');
            die();
        }else {
            $_SESSION['add-post-success'] = "Post $title added successfully";
            header('location:'.ROOT_URL.'admin/manage-posts.php');
            die();
        }
    }
}