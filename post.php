<?php
include './partials/header.php';
if(isset($_GET['post_id'])){
    $post_id = filter_var($_GET['post_id'], FILTER_SANITIZE_SPECIAL_CHARS);
    $query = "SELECT * FROM posts WHERE id=$post_id ORDER BY created_at DESC";
    $result = mysqli_query($connect, $query);
    $post = mysqli_fetch_assoc($result);

}else{
    header("location:" .ROOT_URL);
    die();
}
?>
    <section class="singlepost">
        <div class="container singlepost__container">
            <h2 class="post__title"><a href="post.php"><?php echo $post['title'] ?></a> </h2>
            <div class="post__author">
                <?php
                    $author_id = $post['author_id'];
                    $author_query = "SELECT firstname, lastname, avatar FROM users WHERE id=$author_id";
                    $author_result = mysqli_query($connect, $author_query);
                    $author = mysqli_fetch_assoc($author_result);
                ?>
                <div class="post__author-avatar">
                    <img src="./images/<?php echo $author['avatar'] ?>" alt="">
                </div>
                <div class="post__author-info">
                    <h5>By: <?php echo $author['firstname'] . ' ' . $author['lastname'] ?></h5>
                    <small style="color:white"><?php echo date("M d, Y H:i", strtotime($post['created_at'])) ?></small>
                </div>
            </div>
            <div class="singlepost__thumbnail">
            <img src="./images/<?php echo $post['thumbnail'] ?>" alt="">
            </div>
            <p class="post__body">
                <?php echo $post['body'] ?>
            </p>
        </div>
    </section>
<?php
include './partials/footer.php';
?>