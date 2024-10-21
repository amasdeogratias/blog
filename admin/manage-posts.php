<?php
include './layouts/header.php';

$query = "SELECT p.id as Id, p.title as name, c.title as title FROM posts p, categories c WHERE p.category_id=c.id ORDER BY p.id";
$result = mysqli_query($connect, $query);
$Posts = array();
while($rows = mysqli_fetch_assoc($result)){
    $Posts[] = $rows;
}
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
                    foreach ($Posts as $key => $values){
                        
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $values['name']; ?></td>
                    <td><?php echo $values['title']; ?></td>
                    <td>
                        <a href="edit-post.php?id=<?=$values['Id']?>" class="btn sm">Edit</a>
                        <a href="delete-post.php?id=<?=$values['Id']?>" class="btn sm danger">Delete</a>
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

