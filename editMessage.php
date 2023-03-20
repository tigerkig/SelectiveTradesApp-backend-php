<?php
    include 'connection_details.php';
    
    if($conn){
        extract($_REQUEST);
        $data = $_POST;

        $timestamp = $data["timestamp"];
        $message_timestamp = $data["message_timestamp"];
        $id = $data["id"];
        $message = $data["message"];
        
        $update_message = "update channel_messages set message='$message' where message_timestamp='$message_timestamp' and id='$id'";

        $delete_if_exist = "delete from edited_channel_messages where message_timestamp='$message_timestamp' and id='$id'";
        
        $copy_message = "insert into edited_channel_messages (id, message, channel, message_timestamp, attachment, attachment_type, status) select id, message, channel, message_timestamp, attachment, attachment_type, status from channel_messages where message_timestamp='$message_timestamp' and id='$id'";
        
        $update_timestamp = "update edited_channel_messages set timestamp='$timestamp' where message_timestamp='$message_timestamp'";
       
        mysqli_query($conn, $update_message);
        mysqli_query($conn, $delete_if_exist);
        mysqli_query($conn, $copy_message);
        mysqli_query($conn, $update_timestamp);
        
        echo 'success';
    }
    else{
        echo 'failure';
    }
    
?>