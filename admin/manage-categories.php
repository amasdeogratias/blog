<?php
include 'partials/header.php';
?>
<section class="dashboard">
    <div class="container dashboard__container">
        <aside>
            <ul>
                <li>
                    <a href=""><i class="uil uil-pen"></i> <h5>Add Post</h5></a>
                </li>
                <li>
                    <a href=""><i class="uil uil-postcard"></i> <h5>Manage Posts</h5></a>
                </li>
                <li>
                    <a href=""><i class="uil uil-user-plus"></i> <h5>Add User</h5></a>
                </li>
                <li>
                    <a href="manage-users.php"><i class="uil uil-list-ul"></i> <h5>Manage Users</h5></a>
                </li>
                <li>
                    <a href=""><i class="uil uil-edit"></i> <h5>Add Category</h5></a>
                </li>
                <li>
                    <a href=""><i class="uil uil-list-ul"></i> <h5>Manage Categories</h5></a>
                </li>
            </ul>
        </aside>
        <main>
            <h2>Manage Categories</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Travel</td>
                        <td><a href="" class="btn sm">Edit</a> </td>
                        <td><a href="" class="btn sm danger">Delete</a> </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Travel</td>
                        <td>
                            <a href="" class="btn sm">Edit</a>
                            <a href="" class="btn sm danger">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>
</section>

<?php
include 'partials/footer.php';
?>

