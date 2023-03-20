<?php
    include 'connection_details.php';
    
    if($conn){
        extract($_REQUEST);
        $data = $_POST;

        $timestamp = $data["timestamp"];
        $id = $data["id"];
        $secondary_status = $data["secondary_status"];
        $secondary_status_color = $data["secondary_status_color"];
        $secondary_status_timestamp = $data["secondary_status_timestamp"];
        
        $update_message = "update channel_messages set secondary_status='$secondary_status', secondary_status_color='$secondary_status_color', secondary_status_timestamp='$secondary_status_timestamp' where message_timestamp='$timestamp' and id='$id'";

        $delete_if_exist = "delete from edited_channel_messages where message_timestamp='$timestamp' and id='$id'";
        
        $copy_message = "insert into edited_channel_messages (id, message, channel, message_timestamp, attachment, attachment_type, status, secondary_status, secondary_status_color, secondary_status_timestamp) select id, message, channel, message_timestamp, attachment, attachment_type, status, secondary_status, secondary_status_color, secondary_status_timestamp from channel_messages where message_timestamp='$timestamp' and id='$id'";
        
        $update_timestamp = "update edited_channel_messages set timestamp='$timestamp' where message_timestamp='$message_timestamp'";
       
        
        mysqli_query($conn, $delete_if_exist);
        mysqli_query($conn, $update_message);
        mysqli_query($conn, $copy_message);
        mysqli_query($conn, $update_timestamp);
        
        echo 'success';
    }
    else{
        echo 'failure';
    }
    
?>