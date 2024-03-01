<?php
require_once('db_config.php');
session_start();

    if (isset($_POST['submit'])) {
        $heading = filter_var($_POST['heading'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $category = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $story = filter_var($_POST['story'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $thumbnail = $_FILES['thumbnail'];
        // echo " $thumbnail ";
    
        if (empty($category) || empty($story) || empty($thumbnail) || empty($heading)) {
            $_SESSION['error'] = 'All Fields are Required';
        }elseif(strlen($heading) < 5){
            $_SESSION['error'] = 'Heading is not appropriate';
        }
        else {
            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = 'images/' . $thumbnail_name;
    
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extention = explode('.', $thumbnail_name);
            $extention = end($extention);
            if (in_array($extention, $allowed_files)) {
                if ($thumbnail['size'] < 2000000) {
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {
                    $_SESSION['error'] = "file is too big";
                }
            } else {
                $_SESSION['error'] = 'file format incorrect';
            }
        }
        if (isset($_SESSION['error'])) {
            $_SESSION['data'] = $_POST;
            header('location: http://localhost/myblog/admin/addpost.php');
            die();
        } else {
            $author = $_SESSION['user_logged_in'];
            $sql = "INSERT INTO posts(heading, category, story, thumbnail, author) VALUES('$heading', '$category', '$story', '$thumbnail_name', '$author')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['sucess'] = 'Post Added Sucessfully';
                header('location: ../admin/managepost.php');
                die();
            } else {
                $_SESSION['error'] = 'something went wrong';
                header('location: http://localhost/myblog/admin/addpost.php');
                die();
            }
        }
    }else{
        header('location: http://localhost/myblog/admin/addpost.php');
        die();
    }
    
    

?>