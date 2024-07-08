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
            <h2>Manage Users</h2>
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Admin</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Travel</td>
                    <td>Travel</td>
                    <td>Yes</td>
                    <td>
                        <a href="edit-user.php" class="btn sm">Edit</a>
                        <a href="" class="btn sm danger">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Wild Life</td>
                    <td>Wild Life</td>
                    <td>No</td>
                    <td>
                        <a href="edit-user.php" class="btn sm">Edit</a>
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

