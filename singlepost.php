<?php

include_once('header.php');
include_once('logic/db_config.php');

if (!isset($_SESSION['user_logged_in'])) {
    $_SESSION['error'] = 'Sign Up/Log In To Read Full Story';
    header('location: index.php');
    die();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM posts WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $singlepost = mysqli_fetch_assoc($result);
}
$sql1 = "SELECT * FROM users";
$result1 = mysqli_query($conn, $sql1);
$users = mysqli_fetch_all($result1, MYSQLI_ASSOC);


?>
<div style="padding: 10px 100px 10px 100px;">
    <h1 style="text-align: center;"><?php echo strtoupper($singlepost['heading']); ?></h1>
    <img style="width: 100%; display: block; margin-left: auto; margin-right: auto;" src="<?php echo 'logic/images/' . $singlepost['thumbnail']; ?>" alt="">
    <p style="font-weight: 900; color: green; margin: 0; border-bottom: 1px solid green;"><?php echo $singlepost['category']; ?></p>
    <p><?php echo $singlepost['story'] . '</br>' . ' readmore...'; ?></p>
    <?php
    for ($y = 0; $y < count($users); $y++) {
        if ($singlepost['author'] == $users[$y]['username']) {
            $profile_picture = $users[$y]['profile_picture'];
        }
    }
    ?>
    <div style="display: flex; align-items: center;">
        <img style="width: 50px; height: 50px; margin-right: 10px; border-radius: 50%;" src="<?php echo 'logic/avatar/' . $profile_picture; ?>" alt="">
        <p><?php echo 'By ' . $singlepost['author'] . '<br>' .  $singlepost['time']; ?></p>
    </div>

</div>

</body>

</html>