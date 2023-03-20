<?php
    include 'connection_details.php';
    
    if($conn){
        extract($_REQUEST);
        $data = $_POST;
        
        $date_deleted = (int)$data["date_deleted"];
        $message_timestamp = (int)$data["message_timestamp"];
        
        $copy_message = "insert into deleted_chat_messages (id, message,message_timestamp, attachment_url) select id, message, message_timestamp, attachment_url from chat_messages where message_timestamp='$message_timestamp'";
        
        $delete_message = "delete from chat_messages where message_timestamp='$message_timestamp'";
        
        $update_timestamp = "update deleted_chat_messages set date_deleted='$date_deleted' where message_timestamp='$message_timestamp'";
       
        mysqli_query($conn, $copy_message);
        mysqli_query($conn, $delete_message);
        mysqli_query($conn, $update_timestamp);
        
        echo 'success';
    }
    else{
        echo 'failure';
    }
    
?>