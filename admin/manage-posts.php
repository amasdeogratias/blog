<?php
include './layouts/header.php';

$query = "SELECT * FROM posts ORDER BY id";
$post_result = mysqli_query($connect, $query);

?>
<section class="dashboard">
    <?php
        if(isset($_SESSION['add-post-success'])):
        ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-post-success'];
                unset($_SESSION['add-post-success']);
                ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['add-post'])):
        ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['add-post'];
                unset($_SESSION['add-post']);
                ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['edit-post-success'])):
        ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-post-success'];
                unset($_SESSION['edit-post-success']);
                ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['delete-post-post'])):
            ?>
            <div class="alert__message success container">
                <p>
                    <?= $_SESSION['delete-post-post'];
                    unset($_SESSION['delete-post-post']);
                    ?>
                </p>
            </div>
        <?php endif; ?>
    <div class="container dashboard__container">
        <button class="sidebar__toggle" id="show__sidebar-btn"><i class="uil uil-angle-right-b"></i></button>
        <button class="sidebar__toggle" id="hide__sidebar-btn"><i class="uil uil-angle-left-b"></i></button>
        <?php
        include './layouts/sidebar.php';
        ?>
        <main>
            <h2>Manage Posts</h2>
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                while($values = mysqli_fetch_assoc($post_result)){
                       $category_id = $values['category_id'];
                       $category_query = "SELECT title FROM categories WHERE id=$category_id";
                       $category_result = mysqli_query($connect, $category_query);
                       $category = mysqli_fetch_assoc($category_result); 
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $values['title']; ?></td>
                    <td><?php echo $category['title']; ?></td>
                    <td>
                        <a href="<?=ROOT_URL ?>admin/edit-post.php?id=<?=$values['id']?>" class="btn sm">Edit</a>
                        <a href="<?=ROOT_URL ?>admin/delete-post.php?id=<?=$values['id']?>" class="btn sm danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </main>
    </div>
</section>

<?php
include './layouts/footer.php';
?>

