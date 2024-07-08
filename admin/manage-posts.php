<?php
include './layouts/header.php';
?>
<section class="dashboard">
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
                <tr>
                    <td>1</td>
                    <td>lorem8 ipsum</td>
                    <td>Travel</td>
                    <td>
                        <a href="" class="btn sm">Edit</a>
                        <a href="" class="btn sm danger">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>lorem ipsum ipsum</td>
                    <td>Wild Life</td>
                    <td>
                        <a href="edit-post.php" class="btn sm">Edit</a>
                        <a href="" class="btn sm danger">Delete</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </main>
    </div>
</section>

<?php
include './layouts/footer.php';
?>

