<?php
    include 'connection_details.php';
    
    if($conn){
        extract($_REQUEST);
        $data = $_POST;
        
        $status = $data['status'];
        $id = $data['id'];
        $timestamp = $data['timestamp'];
        
        $query = "update channel_messages set status='$status' where message_timestamp='$timestamp'";
        $delete_if_exist = "delete from edited_channel_messages where message_timestamp='$timestamp' and id='$id'";
        $copy_message = "insert into edited_channel_messages (id, message, channel, message_timestamp, attachment, attachment_type, status) select id, message, channel, message_timestamp, attachment, attachment_type,status from channel_messages where message_timestamp='$timestamp'";
        mysqli_query($conn, $query);
        sleep(2);
        mysqli_query($conn, $delete_if_exist);
        sleep(2);
        mysqli_query($conn, $copy_message);
    }
    else{
        echo 'failure';
    }
?>