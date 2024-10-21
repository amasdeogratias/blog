<?php
include './layouts/header.php';
//get back form data if invalid
global $connect;
$query = "SELECT * FROM categories ORDER BY id";
$categories = mysqli_query($connect, $query);

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) == 1){
        $post = mysqli_fetch_assoc($result);
    }
}else{
    header('location:'.ROOT_URL.'admin/manage-posts.php');
    die();
}
?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Post</h2>
        <?php
        if (isset($_SESSION['edit-post'])){ ?>
            <div class="alert__message error">
                <?php
                echo $_SESSION['edit-post'];
                unset($_SESSION['edit-post']);
                ?>
            </div>
        <?php } ?>
        <form action="<?php echo ROOT_URL ?>admin/edit-post-logic.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="post_id" id="post_id" value="<?php echo $post['id']?>">
            <input type="hidden" name="previous_thumbnail_name" id="previous_thumbnail_name" value="<?php echo $post['thumbnail']?>">
            <input type="text" name="title" id="title" value="<?php echo $post['title']?>" placeholder="Enter title">
            <select name="category" id="category">
                <?php 
                while($category = mysqli_fetch_assoc($categories)){?>
                    <option value="<?php echo $category['id'] ?>"<?php echo ($post['category_id'] === $category['id'] ? 'selected' : '') ?>><?php echo $category['title'] ?></option>
                <?php }?>
            </select>
            <textarea name="body" id="body" value="<?php echo $post['body']?>"  rows="4"><?php echo $post['body']?></textarea>
            <?php if(isset($_SESSION['user_is_admin'])) {?>
                <div class="form__control inline">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" checked>
                    <label for="is_featured">Featured</label>
                </div>
            <?php } ?>
            <div class="form__control">
                <label for="thumbnail">Change Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Update Post</button>
        </form>
    </div>
</section>

<?php
include './layouts/footer.php';
?>

