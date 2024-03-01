<?php

include_once 'header.php';

if (isset($_SESSION['user_logged_in'])) {
    header('location: index.php');
    die();
}
// unset($_SESSION['error']);
$name = $_SESSION['data']['name'] ?? null;
$username = $_SESSION['data']['username'] ?? null;
$email = $_SESSION['data']['email'] ?? null;
$createpassword = $_SESSION['data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['data']['confirmpasword'] ?? null;

unset($_SESSION['data']);

?>
<div class="forms">
    <h3>Sign Up</h3>
    <?php if (isset($_SESSION['error'])) : ?>
        <div class="errors">
            <p>
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </p>
        </div>
    <?php endif ?>
    <form action="logic/signuplogic.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Full Name" value="<?php echo $name; ?>">
        <input type="text" name="username" placeholder="User Name" value="<?php echo $username; ?>">
        <input type="text" name="email" placeholder="Email" value="<?php echo $email; ?>">
        <input type="password" name="createpassword" placeholder="Create Password" value="<?php echo $createpassword; ?>">
        <input type="password" name="confirmpassword" placeholder="Confirm Password" value="<?php echo $confirmpassword; ?>">
        <label for="">Profile Picture</label>
        <input type="file" name="thumbnail">
        <input class="button" type="submit" name="submit" value="submit">
    </form>
</div>
</body>

</html>