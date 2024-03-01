
<?php
require_once('db_config.php');
session_start();

if (isset($_POST['submit'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = $_POST['email'];
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sql1 = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $sql1);
    $userexists = mysqli_fetch_assoc($result);
    // print_r($user);
    if (empty($name) || empty($username) || empty($email) || empty($createpassword) || empty($confirmpassword)) {
        $_SESSION['error'] = "All Fields Are Required";
    } elseif (strlen($name) < 3) {
        $_SESSION['error'] = "Invalid name";
    } elseif (strlen($username) < 2) {
        $_SESSION['error'] = "Invalid username";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email";
    } elseif ($createpassword != $confirmpassword) {
        $_SESSION['error'] = "Password dont match";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['error'] = "Password is weak";
    }elseif(array_filter($userexists)){
        $_SESSION['error'] = "Username/Email Already Taken";   
    }

    if (isset($_SESSION['error'])) {
        $_SESSION['data'] = $_POST;
        header('location: ../admin/adduser.php');
        die();
    } else {
        $password = password_hash($confirmpassword, PASSWORD_DEFAULT);
        $creator = $_SESSION['user_logged_in'];
        $sql = "INSERT INTO users(name, username, email, password, creator) VALUES('$name', '$username', '$email', '$password', '$creator')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['sucess'] = 'User Sucessfully Created';
            header('location: ../admin/manageusers.php');
            die();
        }
        else {
            $_SESSION['error'] = 'something went wrong, please try again';
            header('location: ../admin/adduser.php');
            die();
        }
    }
} else {
    header('location: ../admin/adduser.php');
    die();
}
?>