<?php
include './partials/header.php';

$query = "SELECT * FROM posts ORDER BY id";
$result = mysqli_query($connect, $query);

$featured_query = "SELECT * FROM posts WHERE is_featured = 1";
$featured_result = mysqli_query($connect, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

$categories_query = "SELECT * FROM categories ORDER BY id";
$categories_result = mysqli_query($connect, $categories_query);
?>
<?php if(mysqli_num_rows($featured_result) == 1) : ?>
    <section class="featured">
        <div class="container featured__container">
            <div class="post__thumbnail">
                <img src="./images/<?= $featured['thumbnail'] ?>">
            </div>
            <div class="post__info">
                <?php 
                    $category_id = $featured['category_id'];
                    $category_query = "SELECT id, title FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connect, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                ?>
                <a href="category-posts.php?category_id=<?php echo $category['id'] ?>" class="category__button"><?php echo $category['title'] ?></a>
                <h2 class="post__title"><a href="post.php?post_id=<?php echo $featured['id'] ?>"><?php echo $featured['title'] ?></a> </h2>
                <p class="post__body">
                <?php echo $featured['body'] ?>
                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/avatar2.jpg">
                    </div>
                    <div class="post__author-info">
                        <?php
                            $author_id = $featured['author_id'];
                            $author_query = "SELECT firstname, lastname FROM users WHERE id=$author_id";
                            $author_result = mysqli_query($connect, $author_query);
                            $author = mysqli_fetch_assoc($author_result);
                         ?>
                        <h5><?php echo $author['firstname'] . $author['lastname'] ?></h5>
                        <small style="color:white"><?php echo date('r', strtotime($featured['created_at'])) ?></small>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <section class="featured">
        <div class="container featured__container">
        </div>
    </section>
<?php endif; ?>
<!--- End Featured -->
    
    <section class="posts">
        <div class="container posts__container">
            <?php while($rows = mysqli_fetch_assoc($result)){
                $category_id = $rows['category_id'];
                $category_query = "SELECT id, title FROM categories WHERE id=$category_id";
                $category_result = mysqli_query($connect, $category_query);
                $category = mysqli_fetch_assoc($category_result);

                $author_id = $rows['author_id'];
                $author_query = "SELECT firstname, lastname, avatar FROM users WHERE id=$author_id";
                $author_result = mysqli_query($connect, $author_query);
                $author = mysqli_fetch_assoc($author_result);
                 ?>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/<?php echo $rows['thumbnail'] ?>" alt="">
                </div>
                <div class="post__info">
                    <a href="category-posts.php?category_id=<?= $category['id']?>" class="category__button"><?= $category['title']?></a>
                    <h2 class="post__title"><a href="post.php?post_id=<?php echo $rows['id'] ?>"><?= $rows['title'] ?></a> </h2>
                    <p class="post__body">
                    <?= substr($rows['body'], 0,300) ?>...
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./images/<?php echo $author['avatar'] ?>" alt="">
                        </div>
                        <div class="post__author-info">
                            <h5>By: <?= $author['firstname'] . ' ' .$author['lastname'] ?></h5>
                            <small style="color:white"><?php echo date("M d, Y H:i", strtotime($rows['created_at'])) ?></small>
                        </div>
                    </div>
                </div>
            </article>
            <?php } ?>
        </div> 
    </section>

    <section class="category__buttons">
        <div class="container category__buttons-container">
            <?php while($rows = mysqli_fetch_assoc($categories_result)){ ?>
            <a href="category-posts.php?category_id=<?= $rows['id'] ?>" class="category__button"><?= $rows['title'] ?></a>
            <?php } ?>
            
        </div>
    </section>
<?php
include './partials/footer.php';
?>