<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;
    
    $tracker = $data['tracker'];
    $timestamp = $data['timestamp'];
    $channel = $data['channel'];
    
    if($conn){
        $query = "insert into live_options (tracker, timestamp, channel) values ('$tracker', '$timestamp', '$channel')";
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