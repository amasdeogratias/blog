<?php
require 'config/database.php';

if (isset($_POST['submit'])){
    global $connect;
    //get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);
    $date = date('Y-m-d H:i:s');

    if(!$title) {
        $_SESSION['add-category'] = "Enter title";
    }elseif (!$description) {
        $_SESSION['add-category'] = "Enter description";
    }

    //redirect back to add category page if invalid input
    if (isset($_SESSION['add-category'])) {
        $_SESSION['add-category-data'] = $_POST;
        header('location:'.ROOT_URL.'admin/add-category.php');
        die();
    }else {
        //insert data into database
        $query = "INSERT INTO categories (title, description, created_at) VALUES ('$title', '$description', '$date')";
        $result = mysqli_query($connect, $query);
        if(mysqli_errno($connect)){
            $_SESSION['add-category'] = "Couldn't add category";
            header('location:'.ROOT_URL.'admin/add-category.php');
            die();
        }else {
            $_SESSION['add-category-success'] = "Category $title added successfully";
            header('location:'.ROOT_URL.'admin/manage-categories.php');
            die();
        }
    }
}