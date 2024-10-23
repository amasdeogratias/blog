<?php
include './layouts/header.php';
//get back form data if invalid
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;
$category = $_SESSION['add-post-data']['category'] ?? null;

unset($_SESSION['add-post-data']);

$query = "SELECT id, title FROM categories GROUP BY title";
$result = mysqli_query($connect, $query);
$Categories = array();
while($rows = mysqli_fetch_assoc($result)){
    $Categories[] = $rows;
}
?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Post</h2>
        <?php
        if (isset($_SESSION['add-post'])){ ?>
            <div class="alert__message error">
                <?php
                echo $_SESSION['add-post'];
                unset($_SESSION['add-post']);
                ?>
            </div>
        <?php } ?>
        <form action="<?php echo ROOT_URL ?>admin/add-post-logic.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" id="title" value="<?php echo $title?>" placeholder="Enter title">
            <select name="category" id="category">
                <option value="">Select Category ...</option>
                <?php 
                foreach($Categories as $key => $value){?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value['title'] ?></option>
                <?php }?>
            </select>
            <textarea name="body" id="body" value="<?php echo $body?>"  rows="4"><?php echo $body?></textarea>
            <?php if(isset($_SESSION['user_is_admin'])) {?>
                <div class="form__control inline">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" checked>
                    <label for="is_featured">Featured</label>
                </div>
            <?php } ?>
            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Add Post</button>
        </form>
    </div>
</section>

<?php
include './layouts/footer.php';
?>

