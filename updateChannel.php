<?php
    include 'connection_details.php';
    
    if($conn){
        extract($_REQUEST);
        $data = $_POST;
        
        $old_channel_name = $data['old_channel_name'];
        $new_channel_name = $data['new_channel_name'];
        $channel_image = $data['channel_image'];
        
        $delete_old_channel = "delete from channels where channel_name='$old_channel_name'";
        
        $create_new_channel = "insert into channels (channel_name, channel_image) values ('$new_channel_name', '$channel_image')";
        
        $update_channel_messages = "update channel_messages set channel='$new_channel_name' where channel='$old_channel_name'";
        
        mysqli_query($conn, $delete_old_channel);
        sleep(2);
        mysqli_query($conn, $create_new_channel);
        sleep(2);
        mysqli_query($conn, $update_channel_messages);   
    }
    else{
        echo 'failure';
    }
?>