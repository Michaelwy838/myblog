<?php

$conn = mysqli_connect('localhost', 'root', '', 'myblog');
if(!$conn){
    echo "query error: " . mysqli_connect_error();
}
?>