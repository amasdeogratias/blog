<?php
require './layouts/is_admin.php';
include './layouts/header.php';
//get back form data if invalid
global $connect;
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) == 1){
        $category = mysqli_fetch_assoc($result);
    }
}else{
    header('location:'.ROOT_URL.'admin/manage-categories.php');
    die();
}
?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Category</h2>
        <?php
        if (isset($_SESSION['add-category'])){ ?>
            <div class="alert__message error">
                <?php
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']);
                ?>
            </div>
        <?php } ?>
        <form action="<?php echo ROOT_URL ?>admin/edit-category-logic.php" method="POST">
            <input type="hidden" name="category_id" id="category_id" value="<?php echo $category['id']?>">
            <input type="text" name="title" id="title" value="<?php echo $category['title']?>" placeholder="Enter title">
            <textarea name="description" id="description"rows="4"><?php echo $category['description'] ?></textarea>
            <button type="submit" name="submit" class="btn">Update category</button>
        </form>
    </div>
</section>

<?php
include './layouts/footer.php';
?>

