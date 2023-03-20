<?php
    include 'connection_details.php';
    extract($_REQUEST);
    $data = $_POST;
    
    $message = $data['message'];
    $sender_name = $data['sender_name'];
    $timestamp = $data['timestamp'];
    $attachment = $data['attachment'];
    $sender_id = (int)$data['sender_id'];
    $status = $data['status'];
    
    if($conn){
        $query = "insert into chat_messages (message, sender_name, message_timestamp, attachment_url, sender_id, status) values ('$message','$sender_name', '$timestamp', '$attachment', '$sender_id', '$status')";
        echo mysqli_error($conn);
        $result = mysqli_query($conn, $query);
        if($result){
            echo 'success';
        }
        else{
            echo 'failure';
        }
    }
    else{
        echo 'failure';
    }
?>