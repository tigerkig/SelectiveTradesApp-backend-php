<?php
    include 'connection_details.php';
    
    if($conn){
        extract($_REQUEST);
        $data = $_POST;
        
        $timestamp = $data["timestamp"];
        $message_timestamp = $data["message_timestamp"];
        $message = $data["message"];
        
        $copy_message = "insert into deleted_channel_messages (id, message, channel, message_timestamp, attachment, attachment_type) select id, message, channel, message_timestamp, attachment, attachment_type from channel_messages where message_timestamp='$message_timestamp' and message='$message'";
        
        $delete_message = "delete from channel_messages where message_timestamp='$message_timestamp' and message='$message'";
        
        $update_timestamp = "update deleted_channel_messages set timestamp='$timestamp' where message_timestamp='$message_timestamp'";
       
        mysqli_query($conn, $copy_message);
        mysqli_query($conn, $delete_message);
        mysqli_query($conn, $update_timestamp);
        
        echo 'success';
    }
    else{
        echo 'failure';
    }
    
?>