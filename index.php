<?php
include './partials/header.php';
?>
    <section class="featured">
        <div class="container featured__container">
            <div class="post__thumbnail">
                <img src="./images/blog1.jpg">
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
        </div>
    </section>
<?php
include './partials/footer.php';
?>