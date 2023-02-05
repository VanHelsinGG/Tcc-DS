<?php 
    $hostname = "localhost";
    $user = "root";
    $password = "";
    $database = "";

    $db = mysqli_connect($hostname,$user,$password,$database);

    if(mysqli_connect_errno()){
        echo "MYSQL Error: " . mysqli_connect_error();
    }
?>