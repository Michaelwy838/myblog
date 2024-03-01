
<?php
require_once('db_config.php');
session_start();
if (isset($_POST['submit'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sql1 = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
    $result = mysqli_query($conn, $sql1);
    $userexists = mysqli_fetch_assoc($result);
    $db_password = $userexists['password'];
    // // print_r($user);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "All Fields Are Required";
    } elseif (!array_filter($userexists)) {
        $_SESSION['error'] = "User not Found, Try Again!";
    } elseif (!password_verify($password , $db_password)) {
        $_SESSION['error'] = "Incorrect Password";
    }

    if (isset($_SESSION['error'])) {
        $_SESSION['data'] = $_POST;
        header('location: ../login.php');
        die();
    } else {
        $_SESSION['user_logged_in'] = $userexists['username'];
        $status = $userexists['status'];
        if($status == 'admin'){
            $_SESSION['user_is_admin'] = true;
        }else{
            $_SESSION['user_is_user'] = true;
        }
        header('location: ../index.php');
        die();
    }
} else {
    header('location: ../login.php');
    die();
}
?>