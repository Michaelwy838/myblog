<?php
include_once('../header.php');
include_once('../logic/db_config.php');

if (!isset($_SESSION['user_logged_in'])) {
    header('location: ../index.php');
    die();
}

$heading = $_SESSION['data']['heading'] ?? null;
$category = $_SESSION['data']['category'] ?? null;
$story = $_SESSION['data']['story'] ?? null;

$sql3 = "SELECT * FROM categories";
$result3 = mysqli_query($conn, $sql3);
$categories = mysqli_fetch_all($result3, MYSQLI_ASSOC);

unset($_SESSION['data']);
?>
<div class="dashboard">
    <section>
        <ul class="pages">
            <li><a href="managepost.php">Manage Posts</a></li>
            <li><a class="active" href="addpost.php">Add Post</a></li>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
                <li><a href="managecategories.php">Manage Categories</a></li>
                <li><a href="manageusers.php">Manage Users</a></li>
                <li><a href="addcategory.php">Add Category</a></li>
                <li><a href="adduser.php">Add User</a></li>
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
            <h3>Add Post</h3>
            <form action="http://localhost/myblog/logic/addpostlogic.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="heading" placeholder="Heading" value="<?php echo $heading ?>">
                <select name="category">
                    <option value="">-category-</option>
                    <?php for ($i = 0; $i < count($categories); $i++) { ?>
                        <option value="<?php echo $categories[$i]['Categoryname']; ?>"><?php echo $categories[$i]['Categoryname']; ?></option>
                    <?php } ?>
                </select>
                <textarea name="story" id="" placeholder="Description"></textarea>
                <label for="">Thumbnail</label>
                <input type="file" name="thumbnail">
                <input class="button" type="submit" name="submit" value="submit">
            </form>
        </div>
    </section>
</div>
</body>

</html>