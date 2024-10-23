<?php
require 'config/database.php';

if (isset($_GET['id'])){
    global $connect;
    //get form data
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connect, $query);
    $user = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) == 1){
        $avatar_name = $user['avatar'];
        $avatar_path = "../images/".$avatar_name;

        //delete image
        if($avatar_path){
            unlink($avatar_path);
        }
    }

    //for later
    //fetch all user post's thumbnail and delete them
    $thumbnail_query = "SELECT thumbnail FROM posts WHERE author_id=$id";
    $thumbnail_result = mysqli_query($connect, $thumbnail_query);
    if(mysqli_num_rows($thumbnail_result) > 0){
        while($value = mysqli_fetch_assoc($thumbnail_result)){
            $thumbnail_path = "../images/".$value['thumbnail'];

            //delete thumbnail from images folder;
            if($thumbnail_path){
                unlink($thumbnail_path);
            }
        }
    }




    //delete user
    $delete_user_query = "DELETE FROM users WHERE  id=$id LIMIT 1";
    $delete_user_result = mysqli_query($connect, $delete_user_query);
    if(!mysqli_errno($connect)){
        $_SESSION['delete-user-user']="Problem in user deletion";
    }{
        $_SESSION['delete-user-user']="User deleted successfully";
        header('location:'.ROOT_URL.'admin/manage-users.php');
        die();
    }
    
    
}
header('location:'.ROOT_URL.'admin/manage-users.php');
die();