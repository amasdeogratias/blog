<?php
include './partials/header.php';
?>

    <header class="category__title">
        <h1>Category Title</h1>
    </header>
    <section class="posts">
        <div class="container posts__container">
            <article class="post">
                <div class="post__thumbnail">
                    <img src="">
                </div>
                <div class="post__info">
                    <a href="category-posts.php" class="category__button">Post category</a>
                    <h2 class="post__title"><a href="post.php">Post title</a> </h2>
                    <p class="post__body">
                        lorem ipsum dolor sit amet consectectur
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./images/avatar2.jpg">
                        </div>
                        <div class="post__author-info">
                            <h5>By: Deo Amas</h5>
                            <small>June 10, 2022 -07:23</small>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>

<?php
include './partials/footer.php';
?>