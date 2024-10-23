<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");
require 'config/database.php';

if (isset($_POST['submit'])){
    global $connect;
    //get form data
    $id = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_SPECIAL_CHARS);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];
    $date = date('Y-m-d H:i:s');

    $is_featured = $is_featured == 1 ? : 0;

    if(!$title) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit page.";
    }elseif (!$body) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit page.";
    }elseif(!$category){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit page.";
    }else{
        //delete existing thumbnail if new thumbnail is available
        if($thumbnail['name']){
            $previous_thumbnail_path = "../images/".$previous_thumbnail_name;
            if($previous_thumbnail_path){
                unlink($previous_thumbnail_path);
            }
        }


        //new thumbnail
         //upload image
         
 
         if(!($thumbnail['name'])){
            $file_name=$previous_thumbnail_name;
         }else{
            $time = time();
            $file_name = $time. $thumbnail['name'];
            $tmp_name = $thumbnail['tmp_name'];
            $destination_path = "../images/". $file_name;
    
            //allowed files
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $file_name);
            $extension = end($extension);
            if(!in_array($extension, $allowed_files)){
                $_SESSION['edit-post'] = "File should be png, jpg or jpeg";
                exit;
            }else{
                if($thumbnail['size'] > 1000000){
                    $_SESSION['edit-post'] = "File size should be less or equal to 1mb";
                    exit;
                }
                move_uploaded_file($tmp_name, $destination_path);
            }
         }
         
    }
    //redirect back to add category page if invalid input
    if (isset($_SESSION['edit-post'])) {
        header('location:'.ROOT_URL.'admin/edit-post.php');
        die();
    }else {


        //set is_featured of all posts to 0 if is_featured for this post is 1
        if($is_featured == 1){
            $zero_is_featured_query="UPDATE posts SET is_featured=0";
            $zero_is_featured_result=mysqli_query($connect, $zero_is_featured_query);
        }

        //set thumbnail if new one is uploaded, else keep old one
        $thumbnail_to_insert = $file_name ?? $previous_thumbnail_name;
       
        //insert data into database
        $user_id = $_SESSION['user_id'];
        $query = "UPDATE posts SET category_id='$category', author_id='$user_id', title='$title', body = '$body',
                thumbnail = '$thumbnail_to_insert', is_featured='$is_featured', created_at='$date' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connect, $query);
    }
    if(mysqli_errno($connect)){
        $_SESSION['edit-post'] = "Couldn't add post";
        header('location:'.ROOT_URL.'admin/edit-post.php');
        die();
    }else {
        $_SESSION['edit-post-success'] = "Post $title updated successfully";
        header('location:'.ROOT_URL.'admin/manage-posts.php');
        die();
    }
}