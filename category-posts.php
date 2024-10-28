<?php
include './partials/header.php';
if(isset($_GET['category_id'])){
    $category_id = filter_var($_GET['category_id'], FILTER_SANITIZE_SPECIAL_CHARS);
    $query = "SELECT * FROM posts WHERE category_id=$category_id ORDER BY created_at DESC";
    $result = mysqli_query($connect, $query);

    $category_title_query = "SELECT title FROM categories WHERE id=$category_id";
    $category_title_result = mysqli_query($connect, $category_title_query);
    if(mysqli_num_rows($category_title_result) == 1){
        $category_data = mysqli_fetch_assoc($category_title_result);
    }

}else{
    header("location:" .ROOT_URL);
    die();
}
?>

    <header class="category__title">
        <h1><?php echo $category_data['title'] ?></h1>
    </header>
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
                    <h2 class="post__title"><a href="post.php"><?= $rows['title'] ?></a> </h2>
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

<?php
include './partials/footer.php';
?>