<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_GET;
    
    $email = $data['email'];
    $password = $data['password'];
    
    if($conn){
        $query = "update users set user_password='$password' where email='$email'";
        $send_query = mysqli_query($conn, $query);
        if($send_query){
            echo 'success';
        }
        else{
            echo 'failure';
        }
    }
    else{
        echo mysqli_connect_error();
    }
?>