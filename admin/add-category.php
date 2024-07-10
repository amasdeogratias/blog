<?php
include './layouts/header.php';
//get back form data if invalid
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;

unset($_SESSION['add-category-data']);
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
        <form action="<?php echo ROOT_URL ?>admin/add-category-logic.php" method="POST">
            <input type="text" name="title" id="title" value="<?php echo $title?>" placeholder="Enter title">
            <textarea name="description" id="description" value="<?php echo $description?>"  rows="4"></textarea>
            <button type="submit" name="submit" class="btn">Save category</button>
        </form>
    </div>
</section>

<?php
include './layouts/footer.php';
?>

