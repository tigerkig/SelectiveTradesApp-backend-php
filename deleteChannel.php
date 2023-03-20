<?php

    include 'connection_details.php';
    if($conn){
        extract($_REQUEST);
        $data = $_POST;
        
        $channel = $data["channel"];
        
        $copy_channel = "insert into deleted_channels (id, channel_name, number_of_members, channel_image, members) select id, channel_name, number_of_members, channel_image, members from channels where channel_name='$channel'";
        
        $copy_channel_messages = "insert into deleted_channel_messages (id, message, channel, message_timestamp, attachment, attachment_type) select id, message, channel, message_timestamp, attachment, attachment_type from channel_messages where channel='$channel'";
        
        $delete_channel = "delete from channels where channel_name='$channel'";
        
        $delete_channel_messages = "delete from channel_messages where channel='$channel'";
        
        mysqli_query($conn, $copy_channel);
        sleep(4);
        mysqli_query($conn, $copy_channel_messages);
        sleep(4);
        mysqli_query($conn, $delete_channel);
        sleep(4);
        mysqli_query($conn, $delete_channel_messages);
        echo 'success';
    }
    else{
        echo 'failure';
    }
    
        
?>