<?php

    include 'connection_details.php';
    if($conn){
        extract($_REQUEST);
        $data = $_POST;
        
        $channel = $data["channel"];
        
        $copy_channel = "insert into deleted_channels (id, channel_name, number_of_members, channel_image, members) select id, channel_name, number_of_members, channel_image, members from channels where channel_name='$channel'";
        
        mysqli_query($conn, $copy_channel);
        echo 'success';
    }
    else{
        echo 'failure';
    }
    
        
?>