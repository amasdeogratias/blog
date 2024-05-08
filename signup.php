<?php
include 'config/constants.php';

//if error
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$password = $_SESSION['signup-data']['password'] ?? null;
$confirm_password = $_SESSION['signup-data']['confirm-password'] ?? null;

//unset or delete signup session
unset($_SESSION['signup-data'])
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale">
    <title>BLOG</title>

    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&
        display=swap" rel="stylesheet">
</head>
<body>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Sign Up</h2>
        <?php
        if(isset($_SESSION['signup'])) {?>
            <div class="alert__message error">
                <?php

                    echo $_SESSION['signup'];
                    unset($_SESSION['signup']);
                ?>
            </div>
        <?php } ?>

        <form action="<?= ROOT_URL ?>signup-logic.php" method="post" enctype="multipart/form-data">
            <input type="text" name="firstname" value="<?php echo $firstname ?>" placeholder="First Name">
            <input type="text" name="lastname" value="<?php echo $lastname ?>" placeholder="Last Name">
            <input type="text" name="username" value="<?php echo $username ?>" placeholder="Username">
            <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
            <input type="password" name="password" value="<?php echo $password ?>" placeholder="Create Password">
            <input type="password" name="confirm-password" value="<?php echo $confirm_password ?>" placeholder="Confirm Password">
            <div class="form__control">
                <label for="avatar">use Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Sign Up</button>
            <small>Already have an account? <a href="signin.php">Sign In</a> </small>
        </form>
    </div>
</section>
</body>
</html>
