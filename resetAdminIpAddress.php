<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;

    $email = $data['email'];
    
    if($conn){
        $query = "update admins set ip_address='' where email='$email'";
        $insert = mysqli_query($conn, $query);
        if($insert){
            echo 'success';
        }
        else{
            echo 'Unable to update admin ip';
        }
    }
?>