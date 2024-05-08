<?php
include 'config/constants.php';

//if error, mantain data in each inputs
$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

//unset or delete signup session
unset($_SESSION['signin-data'])
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
                <h2>Sign In</h2>
                <?php
                if (isset($_SESSION['signup-success'])){ ?>
                <div class="alert__message success">
                    <?php
                    echo $_SESSION['signup-success'];
                    unset($_SESSION['signup-success']);
                    ?>
                </div>
                <?php }elseif(isset($_SESSION['signin'])){ ?>
                <div class="alert__message error">
                    <?php
                    echo $_SESSION['signin'];
                    unset($_SESSION['signin']);
                    ?>
                </div>
                 <?php } ?>
                <form action="<?= ROOT_URL ?>signin-logic.php" method="post">
                    <input type="text" name="username_email" value="<?php echo $username_email ?>" placeholder="Username or Email">
                    <input type="password" name="password" value="<?php echo $password ?>" placeholder="Password">
                    <button type="submit" name="submit" class="btn">Sign In</button>
                    <small>Don't have account? <a href="signup.php">Sign Up</a> </small>
                </form>
            </div>
        </section>
    </body>
</html>
