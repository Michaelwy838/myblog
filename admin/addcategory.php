<?php

include_once('../logic/db_config.php');
include_once('../header.php');

if (!isset($_SESSION['user_logged_in'])) {
    header('location: ../index.php');
    die();
}

$name = $_SESSION['data']['name'] ?? null;
$description = $_SESSION['data']['description'] ?? null;
unset($_SESSION['data']);


?>
<div class="dashboard">
    <section>
        <ul class="pages">
            <li><a href="managepost.php">Manage Posts</a></li>
            <li><a href="addpost.php">Add Post</a></li>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
                <li><a href="managecategories.php">Manage Categories</a></li>
                <li><a href="manageusers.php">Manage Users</a></li>
                <li><a class="active" href="addcategory.php">Add Category</a></li>
                <li><a href="adduser.php">Add User</a></li>
            <?php endif ?>

        </ul>
        </ul>
    </section>
    <section>
        <div class="forms">
            <?php if (isset($_SESSION['error'])) : ?>
                <div style="background-color: red; color: white; padding: 3px;">
                    <p>
                        <?php echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <h3>Add Category</h3>

            <form action="http://localhost/myblog/logic/addcategorylogic.php" method="POST">
                <input type="text" name="name" placeholder="Name" value="<?php echo $name ?>">
                <textarea name="description" id="" cols="30" rows="10" placeholder="Description"></textarea>
                <input class="button" type="submit" name="submit" value="submit">
            </form>
        </div>
    </section>
</div>
</body>

</html>