<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;

    $email = $data['email'];
    $logged_in = $data['logged_in'];
    
    if($conn){
        $query = "update admins set logged_in='$logged_in' where email='$email'";
        $insert = mysqli_query($conn, $query);
        if($insert){
            echo 'success';
        }
        else{
            echo 'Unable to update admin login';
        }
    }
?>