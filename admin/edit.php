<?php

include_once('../logic/db_config.php');
include_once('../header.php');

if (!isset($_SESSION['user_logged_in'])) {
    header('location: ../index.php');
    die();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM categories WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $category = mysqli_fetch_assoc($result);

}


?>
<section>
    <div class="forms">
        <h3>Edit Category</h3>

        <form action="http://localhost/myblog/admin/edit.php" method="POST">
            <input type="text" name="name" placeholder="Name" value="<?php echo $category['Categoryname'];?>">
            <textarea name="description" id="" cols="30" rows="10" placeholder="Description"><?php echo $category['description'];?></textarea>
            <input class="button" type="submit" name="submit" value="submit">
        </form>
    </div>
</section>
</body>

</html>