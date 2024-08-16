<?php
require 'config/database.php';

if (isset($_GET['id'])){
    global $connect;
    //get form data
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //for later
    //update category id of posts that belong to this id of uncategorized category


    //delete category
    $query = "DELETE FROM categories WHERE  id=$id LIMIT 1";
    $result = mysqli_query($connect, $query);
    $_SESSION['delete-category-category']="Category deleted successfully";
}
header('location:'.ROOT_URL.'admin/manage-categories.php');
die();