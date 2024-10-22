<?php
include './layouts/header.php';
//get back form data if invalid
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) == 1){
        $user = mysqli_fetch_assoc($result);
    }
}else{
    header('location:'.ROOT_URL.'admin/manage-users.php');
    exit();
}

?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit User</h2>
        <?php
        if (isset($_SESSION['edit-user'])){ ?>
            <div class="alert__message error">
                <?php
                echo $_SESSION['edit-user'];
                unset($_SESSION['edit-user']);
                ?>
            </div>
        <?php } ?>
        <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>" placeholder="First Name">
            <input type="text" name="firstname" value="<?php echo $user['firstname'] ?>" placeholder="First Name">
            <input type="text" name="lastname" value="<?php echo $user['lastname'] ?>" placeholder="Last Name">
            <select name="user_role" id="user_role">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <button type="submit" name="submit" class="btn">Update User</button>
        </form>
    </div>
</section>

<?php
include './layouts/footer.php';
?>

