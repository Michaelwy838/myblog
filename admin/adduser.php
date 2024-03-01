<?php

include_once('../header.php');
if (!isset($_SESSION['user_logged_in'])) {
    header('location: ../index.php');
    die();
}
$name = $_SESSION['data']['name'] ?? null;
$username = $_SESSION['data']['username'] ?? null;
$email = $_SESSION['data']['email'] ?? null;
$createpassword = $_SESSION['data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['data']['confirmpasword'] ?? null;

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
                <li><a href="addcategory.php">Add Category</a></li>
                <li><a class="active" href="adduser.php">Add User</a></li>
            <?php endif ?>

        </ul>
        </ul>
    </section>
    <section>
        <div class="forms">
            <?php if (isset($_SESSION['error'])) : ?>
                <div style="background-color: red; color: white; padding: 3px; margin-bottom: 3px;">
                    <p>
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <h3>Add User</h3>
            <form action="http://localhost/myblog/logic/adduserlogic.php" method="POST">
                <input type="text" name="name" placeholder="Full Name" value="<?php echo $name ?>">
                <input type="text" name="username" placeholder="User Name" value="<?php echo $username ?>">
                <input type="text" name="email" placeholder="Email" value="<?php echo $email ?>">
                <input type="password" name="createpassword" placeholder="Create Password" value="<?php echo $createpassword ?>">
                <input type="password" name="confirmpassword" placeholder="Confirm Password" value="<?php echo $confirmpassword ?>">
                <input class="button" type="submit" name="submit" value="submit">
            </form>
        </div>
    </section>
</div>
</body>

</html>