<?php

include_once('header.php');
include_once('logic/db_config.php');


$sql3 = "SELECT * FROM posts";
$result3 = mysqli_query($conn, $sql3);
$posts = mysqli_fetch_all($result3, MYSQLI_ASSOC);

$sql1 = "SELECT * FROM users";
$result1 = mysqli_query($conn, $sql1);
$users = mysqli_fetch_all($result1, MYSQLI_ASSOC);
// print_r($profile_pictures);
$sql = "SELECT * FROM posts";
$result = mysqli_query($conn, $sql);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

// $dir = "logic/avatar";
// $files = scandir($dir);
// print_r($files);


// print_r($posts);
?>
<?php if (isset($_SESSION['error'])) : ?>
    <div class="errors" style="background-color: red; color: white; padding: 3px; font-size: 20px;">
        <p>
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </p>
    </div>
<?php endif ?>
<h1 class="updates">Daily Updates</h1>
<div style="display: grid; grid-template-columns: 1fr 1fr; align-items: left;">
    <?php
    for ($i = 0; $i < count($posts); $i++) { ?>
        <div>
            <h1>
                <a href="singlepost.php?id=<?php echo $posts[$i]['id']; ?>"><?php echo $posts[$i]['heading']; ?></a>
            </h1>
            <a href="singlepost.php?id=<?php echo $posts[$i]['id']; ?>"><img style="width: 450px; border: 5px solid rgb(0, 172, 232); border-radius: 10px;" src="<?php echo "logic/images/" . $posts[$i]['thumbnail'] ?>" alt=""></a>
            <div>
                <?php echo $posts[$i]['category']; ?>
                <?php
                for ($y = 0; $y < count($users); $y++) {
                    if ($posts[$i]['author'] == $users[$y]['username']) {
                        $profile_picture = $users[$y]['profile_picture'];
                    }
                }
                ?>
                <div style="display: flex; align-items: center;">
                    <img style="width: 50px; height: 50px; margin-right: 10px; border-radius: 50%;" src="<?php echo 'logic/avatar/' . $profile_picture; ?>" alt="">
                    <p style="font-weight: bold;">
                        By <?php echo $posts[$i]['author']; ?> <br>
                        Posted on <?php echo $posts[$i]['time']; ?>
                    </p>
                </div>


            </div>
        </div>
</div>


<?php } ?>
<h1 class="updates">Sports</h1>
</body>

</html>