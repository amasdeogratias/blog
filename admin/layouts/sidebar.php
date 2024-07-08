<?php
// Get the current page's filename
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside>
    <ul>
        <li>
            <a href="dashboard.php" class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                <i class="uil uil-pen"></i> <h5>Dashboard</h5>
            </a>
        </li>
        <li>
            <a href="add-post.php" class="<?php echo ($current_page == 'add-post.php') ? 'active' : ''; ?>">
                <i class="uil uil-pen"></i> <h5>Add Post</h5>
            </a>
        </li>
        <li>
            <a href="manage-posts.php" class="<?php echo ($current_page == 'manage-posts.php') ? 'active' : ''; ?>">
                <i class="uil uil-postcard"></i> <h5>Manage Posts</h5>
            </a>
        </li>
        <li>
            <a href="add-user.php" class="<?php echo ($current_page == 'add-user.php') ? 'active' : ''; ?>">
                <i class="uil uil-user-plus"></i> <h5>Add User</h5>
            </a>
        </li>
        <li>
            <a href="manage-users.php" class="<?php echo ($current_page == 'manage-users.php') ? 'active' : ''; ?>">
                <i class="uil uil-list-ul"></i> <h5>Manage Users</h5>
            </a>
        </li>
        <li>
            <a href="add-category.php" class="<?php echo ($current_page == 'add-category.php') ? 'active' : ''; ?>">
                <i class="uil uil-edit"></i> <h5>Add Category</h5>
            </a>
        </li>
        <li>
            <a href="manage-categories.php" class="<?php echo ($current_page == 'manage-categories.php') ? 'active' : ''; ?>">
                <i class="uil uil-list-ul"></i> <h5>Manage Categories</h5>
            </a>
        </li>
    </ul>
</aside>