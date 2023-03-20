<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;
    
    $password = $data["password"];
    $email = $data["email"];
    
    if($conn){
        $query = "update users set user_password='$password' where email='$email'";
        $result = mysqli_query($conn, $query);
        if($result){
            echo 'success';
        }
        else{
            echo 'failure';
        }
    }
    else{
        echo 'failure';
    }
    
?>