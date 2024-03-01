
<?php
require_once('db_config.php');
session_start();

if (isset($_POST['submit'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = $_POST['email'];
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];
    $sql1 = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $sql1);
    $userexists = mysqli_fetch_assoc($result);
    // print_r($user);
    if (empty($name) || empty($username) || empty($thumbnail) || empty($email) || empty($createpassword) || empty($confirmpassword)) {
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
    } elseif (array_filter($userexists)) {
        $_SESSION['error'] = "Username/Email Already Taken";
    }

    if (isset($_SESSION['error'])) {
        $_SESSION['data'] = $_POST;
        header('location: ../signup.php');
        die();
    } else {
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = 'avatar/' . $thumbnail_name;

        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extention = explode('.', $thumbnail_name);
        $extention = end($extention);
        if (in_array($extention, $allowed_files)) {
            if ($thumbnail['size'] < 2000000) {
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {
                $_SESSION['error'] = "file is too big";
                $_SESSION['data'] = $_POST;
                header('location: ../signup.php');
                die();
            }
        } else {
            $_SESSION['error'] = 'file format incorrect';
            $_SESSION['data'] = $_POST;
            header('location: ../signup.php');
            die();
        }

        $password = password_hash($confirmpassword, PASSWORD_DEFAULT);
        $creator = 'self';
        $status = 'user';
        $sql = "INSERT INTO users(name, username,  password, creator, profile_picture, status, email) VALUES('$name', '$username', '$password', '$creator', '$thumbnail_name', '$status', '$email')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['sucess'] = 'Signup Sucessfull, Log in';
            header('location: ../login.php');
            die();
        } else {
            $_SESSION['error'] = 'something went wrong, please try again';
            header('location: ../signup.php');
            die();
        }
    }
} else {
    header('location: signup.php');
    die();
}
?>