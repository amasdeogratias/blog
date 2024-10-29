<?php
include './partials/header.php';

$query = "SELECT * FROM posts ORDER BY created_at DESC";
$result = mysqli_query($connect, $query);

$categories_query = "SELECT * FROM categories ORDER BY id";
$categories_result = mysqli_query($connect, $categories_query);
?>

    <section class="search__bar">
        <form class="container search__bar-container" action="">
            <div>
                <i class="uil uil-search"></i>
                <input type="search" name="search" placeholder="Search">
            </div>
            <button type="submit" class="btn">Go</button>
        </form>
    </section>

    <section class="posts <?= $featured ? '' : 'section__extra-margin'?>">
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