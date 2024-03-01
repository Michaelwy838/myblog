<?php


include_once('../logic/db_config.php');
include_once('../header.php');

if (!isset($_SESSION['user_logged_in'])) {
    header('location: ../index.php');
    die();
}

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
// print_r($users);

?>
<div class="dashboard">
    <section>
        <ul class="pages">
            <li><a href="managepost.php">Manage Posts</a></li>
            <li><a href="addpost.php">Add Post</a></li>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
                <li><a href="managecategories.php">Manage Categories</a></li>
                <li><a  class="active" href="manageusers.php">Manage Users</a></li>
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
        <h1 style="text-align: center; padding-bottom: 27px;">Users</h1>
        <table id="users">
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>UserStatus</th>
                <th>CreatedBy</th>
                <th>Action</th>
            </tr>
            <?php
            for ($i = 0; $i < count($users); $i++) { ?>
                <tr>
                    <td><?php echo $users[$i]['name'] ?></td>
                    <td><?php echo $users[$i]['username'] ?></td>
                    <td><?php echo $users[$i]['email'] ?></td>
                    <td><?php echo $users[$i]['status'] ?></td>
                    <td><?php echo $users[$i]['creator'] ?></td>
                    <td><button>Delete</button><button class="edit">Edit</button></td>
                </tr>
            <?php } ?>
        </table>
        <a style="background-color: green; color: white; padding: 5px 15px; margin: 20px auto; display: block; width: fit-content;" href="adduser.php">Add User</a>
    </section>
</div>
</body>

</html>