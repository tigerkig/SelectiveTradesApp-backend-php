<?php
    include 'connection_details.php';
    extract($_REQUEST);
    $data = $_POST;
    
    $message = $data['message'];
    $channel = $data['channel'];
    $timestamp = $data['timestamp'];
    $attachment = $data['attachment'];
    $attachment_type = $data['attachment_type'];
    $status = $data['status'];
    
    if($conn){
        $query = "insert into channel_messages (message, channel, message_timestamp, attachment, attachment_type, status) values ('$message','$channel', '$timestamp', '$attachment', '$attachment_type', '$status')";
        $result = mysqli_query($conn, $query);
        if($result){
            echo 'success';
        }
        else{
            echo mysqli_error($conn);
        }
    }
    else{
        echo 'failure';
    }
?>