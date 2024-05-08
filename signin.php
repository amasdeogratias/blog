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
                session_start();
                if (isset($_SESSION['signup-success'])){ ?>
                <div class="alert__message success">
                    <?php
                    echo $_SESSION['signup-success'];
                    unset($_SESSION['signup-success']);
                    ?>
                </div>
                <?php } ?>
                <form action="" method="post">
                    <input type="email" placeholder="Username or Email">
                    <input type="password" placeholder="Password">
                    <button type="submit" class="btn">Sign In</button>
                    <small>Don't have account? <a href="signup.php">Sign Up</a> </small>
                </form>
            </div>
        </section>
    </body>
</html>
