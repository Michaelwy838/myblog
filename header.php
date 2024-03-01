<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/myblog/css/styles.css">
    <title>MyBlog</title>
</head>

<body>
    <nav>
        <div class="nav_bar">
            <a class="logo" href="http://localhost/myblog/index.php">MyBlog</a>
            <ul class="lists">
                <?php if (!isset($_SESSION['user_logged_in'])) : ?>
                    <li class="border" style="font-size: 20px; padding-right: 10px;">Guest</li>
                    <li class="border"><a href="signup.php">Sign Up</a></li>
                    <li><a href="login.php">Log In</a></li>
                <?php else : ?>
                    <li class="border" style="font-size: 20px; padding-right: 10px;">
                        Hi
                        <?php
                        echo $_SESSION['user_logged_in'];
                        ?>
                    </li>
                    <li class="border"><a href="http://localhost/myblog/admin/managepost.php">Dashboard</a></li>

                    <li class="logout"><a href="http://localhost/myblog/logic/logout.php" style="color: red;">Log Out</a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>