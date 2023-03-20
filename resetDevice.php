<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;

    $email = $data['email'];
    
    if($conn){
        $query = "update users set device='' where email='$email'";
        $insert = mysqli_query($conn, $query);
        if($insert){
            echo 'success';
        }
        else{
            echo 'Unable to update user device';
        }
    }
?>