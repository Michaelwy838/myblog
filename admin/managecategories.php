<?php

include_once('../logic/db_config.php');
include_once('../header.php');
if (!isset($_SESSION['user_logged_in'])) {
    header('location: ../index.php');
    die();
}


$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
// print_r($users);

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM categories WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header('location: managecategories.php');
    } else {
        echo 'query error ' . mysqli_error($conn);
    }
}

?>
<div class="dashboard">
    <section>
        <ul class="pages">
            <li><a href="managepost.php">Manage Posts</a></li>
            <li><a href="addpost.php">Add Post</a></li>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
                <li><a class="active" href="managecategories.php">Manage Categories</a></li>
                <li><a href="manageusers.php">Manage Users</a></li>
                <li><a href="addcategory.php">Add Category</a></li>
                <li><a href="adduser.php">Add User</a></li>
            <?php endif ?>

        </ul>

        </ul>
    </section>
    <section>
        <?php if (isset($_SESSION['sucess'])) : ?>
            <div style="background-color: green; color: white; padding: 3px;">
                <p>
                    <?php
                    echo $_SESSION['sucess'];
                    unset($_SESSION['sucess']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <h1 style="text-align: center; padding-bottom: 27px;">Categories</h1>
        <table id="users">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php
            for ($i = 0; $i < count($categories); $i++) { ?>
                <tr>
                    <td><?php echo $categories[$i]['Categoryname'] ?></td>
                    <td><?php echo $categories[$i]['description'] ?></td>
                    <td>
                        <form action="managecategories.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $categories[$i]['id'] ?>">
                            <button name="delete" value="delete" type="delete">Delete</button>
                            <a style="background-color: rgb(0, 172, 232);" href="edit.php?id=<?php echo $categories[$i]['id'] ?>">Edit</a>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <a style="background-color: green; color: white; padding: 5px 15px; margin: 20px auto; display: block; width: fit-content;" href="addcategory.php">Add Category</a>

    </section>
</div>
</body>

</html>