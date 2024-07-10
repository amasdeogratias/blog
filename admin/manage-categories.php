<?php
include './layouts/header.php';

//fetch categories
$query = "SELECT * FROM categories ORDER BY id";
$result = mysqli_query($connect, $query);
$Categories = array();
while($rows = mysqli_fetch_assoc($result)){
    $Categories[] = $rows;
}
?>
<section class="dashboard">
    <div class="container dashboard__container">
        <button class="sidebar__toggle" id="show__sidebar-btn"><i class="uil uil-angle-right-b"></i></button>
        <button class="sidebar__toggle" id="hide__sidebar-btn"><i class="uil uil-angle-left-b"></i></button>
        <?php
        include './layouts/sidebar.php';
        ?>
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
                <?php
                $i=1;
                    foreach ($Categories as $key => $values){
                        
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $values['title']; ?></td>
                    <td>
                        <a href="edit-category.php" class="btn sm">Edit</a>
                        <a href="" class="btn sm danger">Delete</a>
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

