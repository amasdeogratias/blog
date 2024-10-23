<?php
require './layouts/is_admin.php';
include './layouts/header.php';
//get back form data if invalid
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$password = $_SESSION['add-user-data']['password'] ?? null;
$confirm_password = $_SESSION['add-user-data']['confirm-password'] ?? null;

unset($_SESSION['add-user-data']);

?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Add User</h2>
        <?php
        if (isset($_SESSION['add-user'])){ ?>
            <div class="alert__message error">
                <?php
                echo $_SESSION['add-user'];
                unset($_SESSION['add-user']);
                ?>
            </div>
        <?php } ?>
        <form action="<?= ROOT_URL ?>admin/add-user-logic.php" method="post" enctype="multipart/form-data">
            <input type="text" name="firstname" value="<?php echo $firstname ?>" placeholder="First Name">
            <input type="text" name="lastname" value="<?php echo $lastname ?>" placeholder="Last Name">
            <input type="text" name="username" value="<?php echo $username ?>" placeholder="Username">
            <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
            <input type="password" name="password" value="<?php echo $password ?>" placeholder="Create Password">
            <input type="password" name="confirm-password" value="<?php echo $confirm_password ?>" placeholder="Confirm Password">
            <select name="user_role" id="user_role">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <div class="form__control">
                <label for="avatar">use Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Add User</button>
        </form>
    </div>
</section>

<?php
include './layouts/footer.php';
?>

