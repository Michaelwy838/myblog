<?php

include_once('../logic/db_config.php');
include_once('../header.php');
if (!isset($_SESSION['user_logged_in'])) {
    header('location: ../index.php');
    die();
}


$sql = "SELECT * FROM posts";
$result = mysqli_query($conn, $sql);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
// print_r($users);
$sql3 = "SELECT * FROM users";
$result3 = mysqli_query($conn, $sql3);
$users = mysqli_fetch_all($result3, MYSQLI_ASSOC);


if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM posts WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header('location: managepost.php');
    } else {
        echo 'query error ' . mysqli_error($conn);
    }
}
?>
<div class="dashboard">
    <section>
        <ul class="pages">

            <li><a class="active" href="managepost.php">Manage Posts</a></li>
            <li><a href="addpost.php">Add Post</a></li>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
                <li><a href="managecategories.php">Manage Categories</a></li>
                <li><a href="manageusers.php">Manage Users</a></li>
                <li><a href="addcategory.php">Add Category</a></li>
                <li><a href="adduser.php">Add User</a></li>
            <?php endif ?>

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
        <h1 style="text-align: center; padding-bottom: 27px;">Posts</h1>
        <table id="users">
            <tr>
                <th>Headlines</th>
                <th>Category</th>
                <th>Thumbnail</th>
                <th>Author</th>
                <th>time</th>
                <th>Action</th>
            </tr>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
                <?php
                for ($i = 0; $i < count($posts); $i++) { ?>
                    <tr>
                        <td><?php echo $posts[$i]['heading'] ?></td>
                        <td><?php echo $posts[$i]['category'] ?></td>
                        <td><img style="width: 100px; border-radius: 5px; border: 5px solid rgb(0, 172, 232);" src="<?php echo "../logic/images/" . $posts[$i]['thumbnail'] ?>" alt=""></td>
                        <td><?php echo $posts[$i]['author'] ?></td>
                        <td><?php echo $posts[$i]['time'] ?></td>
                        <td>
                        <form action="managepost.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $posts[$i]['id'] ?>">
                            <button name="delete" value="delete" type="delete">Delete</button>
                            <a style="background-color: rgb(0, 172, 232);" href="edit.php?id=<?php echo $posts[$i]['id'] ?>">Edit</a>
                        </form>
                        </td>
                    </tr>
                <?php } ?>
            <?php else : ?>
                <?php
                for ($x = 0; $x < count($posts); $x++) { ?>
                    <?php if ($_SESSION['user_logged_in'] == $posts[$x]['author']) : ?>
                        <tr>
                        <td><?php echo $posts[$x]['heading'] ?></td>
                        <td><?php echo $posts[$x]['category'] ?></td>
                        <td><img style="width: 100px; border-radius: 5px; border: 5px solid rgb(0, 172, 232);" src="<?php echo "../logic/images/" . $posts[$x]['thumbnail'] ?>" alt=""></td>
                        <td><?php echo $posts[$x]['author'] ?></td>
                        <td><?php echo $posts[$x]['time'] ?></td>
                        <td>
                        <form action="managepost.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $posts[$i]['id'] ?>">
                            <button name="delete" value="delete" type="delete">Delete</button>
                            <a style="background-color: rgb(0, 172, 232);" href="edit.php?id=<?php echo $posts[$i]['id'] ?>">Edit</a>
                        </form>
                        </td>
                    </tr>
                    <?php endif ?>
                <?php } ?>
            <?php endif ?>
        </table>
        <a style="background-color: green; color: white; padding: 5px 15px; margin: 20px auto; display: block; width: fit-content;" href="addpost.php">Add Post</a>

    </section>
</div>
</body>

</html>