<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;

    $email = $data['email'];
    $active = $data['active'];
    
    if($conn){
        $query = "update admins set active='$active' where email='$email'";
        $insert = mysqli_query($conn, $query);
        if($insert){
            echo 'success';
        }
        else{
            echo 'Unable to update admin login';
        }
    }
?>