<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;
    
    $value = $data['value'];
    $channel = $data['channel'];
    
    if($conn){
        $query = "update channels set senders='$value' where channel_name='$channel'";
        $result = mysqli_query($conn, $query);
        if($result){
            echo 'success';
        }
        else{
            echo 'failure';
        }
    }
    else{
        echo 'connection error';
    }
?>