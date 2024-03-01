<?php
session_start();
require_once('db_config.php');

if (isset($_POST['submit'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sql = "SELECT * FROM categories WHERE Categoryname = '$name'";
    $result = mysqli_query($conn, $sql);
    $category = mysqli_fetch_assoc($result);

    if (empty($name) || empty($description)) {
        $_SESSION['error'] = 'All Fields Are Required';
    } elseif (strlen($name) < 3) {
        $_SESSION['error'] = 'Category name is too short';
    } elseif (strlen($description) < 10) {
        $_SESSION['error'] = 'Not well Described';
    } elseif (array_filter($category)) {
        $_SESSION['error'] = 'Category Already Exists';
    }

    if (isset($_SESSION['error'])) {
        $_SESSION['data'] = $_POST;
        header('location: http://localhost/myblog/admin/addcategory.php');
        die();
    } else {
        $adminname = $_SESSION['user_logged_in'];
        $sql1 = "INSERT INTO categories(Categoryname, description, Admin_name) VALUES('$name', '$description', '$adminname')";
        if (mysqli_query($conn, $sql1)) {
            $_SESSION['sucess'] = 'One(1) Category has been added sucessfully';
            header('location: http://localhost/myblog/admin/managecategories.php');
        } else {
            $_SESSION['error'] = 'something went wrong, please try again';
            header('location: http://localhost/myblog/admin/addcategory.php');
            die();
        }
    }
} else {
    header('location: http://localhost/myblog/admin/addcategory.php');
    die();
}
?>