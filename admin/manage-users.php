<?php
include './layouts/header.php';

$query = "SELECT * FROM users ORDER BY id";
$result = mysqli_query($connect, $query);
?>
<section class="dashboard">
<?php
    if(isset($_SESSION['add-user-success'])):
    ?>
    <div class="alert__message success container">
        <p>
            <?= $_SESSION['add-user-success'];
            unset($_SESSION['add-user-success']);
            ?>
        </p>
    </div>
    <?php elseif(isset($_SESSION['add-user'])):
    ?>
    <div class="alert__message error container">
        <p>
            <?= $_SESSION['add-user'];
            unset($_SESSION['add-user']);
            ?>
        </p>
    </div>
    <?php elseif(isset($_SESSION['edit-user-success'])):
        ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-user-success'];
                unset($_SESSION['edit-user-success']);
                ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['delete-user-user'])):
        ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-user-user'];
                unset($_SESSION['delete-user-user']);
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
                    <?php
                    $i=1;
                    while($rows = mysqli_fetch_assoc($result)){?>
                    <tr>
                       <td><?php echo $i++ ?></td> 
                       <td><?php echo $rows['firstname']. ' '. $rows['lastname'] ?></td> 
                       <td><?php echo $rows['username'] ?></td> 
                       <td><?php echo $rows['is_admin'] ? 'YES' : 'NO' ?></td> 
                       <td>
                            <a href="<?=ROOT_URL ?>admin/edit-user.php?id=<?=$rows['id']?>" class="btn sm primary">Edit</a>
                            <a href="<?=ROOT_URL ?>admin/delete-user.php?id=<?=$rows['id']?>" class="btn sm danger">Delete</a>
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

