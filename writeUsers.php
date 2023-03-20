<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;
    
    $query = $data['query'];
    
    if($conn){
        $insert = mysqli_query($conn, $query);
        if($insert){
            echo 'success';
        }
        else{
            echo 'Unable to sign up';
        }
    }
    else{
        echo 'failure';
    }
?>