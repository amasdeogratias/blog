<?php
require './config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch post from db
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) == 1){
        $post = mysqli_fetch_assoc($result);
        $thumbnail = $post['thumbnail'];
        $thumbnail_path = "./uploads/".$thumbnail;

        if($thumbnail_path){
            unlink($thumbnail_path);

            //delete post
            $delete_query = "DELETE FROM posts WHERE id=$id";
            $delete_result = mysqli_query($connect, $delete_query);

            if(!mysqli_errno($connect)){
                $_SESSION['delete-post-post'] = "Post deleted successfully";
            }
        }
    }
}
header('location:'.ROOT_URL.'admin/manage-posts.php');
die();