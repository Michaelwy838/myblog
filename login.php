<?php

include_once 'header.php';
require_once 'logic/db_config.php';
if (isset($_SESSION['user_logged_in'])) {
    header('location: index.php');
    die();
}

$username = $_SESSION['data']['username'] ?? '';
$password = $_SESSION['data']['password'] ?? '';

unset($_SESSION['data']);
?>
<div class="forms">
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

    <h3>Log In</h3>
    <form action="logic/loginlogic.php" method="POST">
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="errors">
                <p>
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </p>
            </div>

        <?php endif ?>
        <input type="text" name="username" placeholder="User Name or Email" value="<?php echo $username ; ?>">
        <input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
        <input class="button" type="submit" name="submit" value="submit">
    </form>
</div>
</body>

</html>