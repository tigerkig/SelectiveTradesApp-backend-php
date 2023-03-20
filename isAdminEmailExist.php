<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_GET;
    
    $email = $data['email'];
    
    if($conn){
        $query = "select * from admins where email='$email'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 0){
            echo 'false';
        }
        else{
            echo 'true';
        }
    }
?>