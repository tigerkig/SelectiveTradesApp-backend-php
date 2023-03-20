<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_GET;
    
    $phone = $data['phone_number'];
    
    if($conn){
        $query = "select * from users where phone_number='$phone'";
        $result = mysqli_query($conn, $query);
        echo mysqli_error($conn);
        if(mysqli_num_rows($result) == 0){
            echo 'false';
        }
        else{
            echo 'true';
        }
    }
?>