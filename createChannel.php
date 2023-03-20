<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;
    
    $channel_name = $data['channel_name'];
    $channel_image = $data['channel_image'];
    
    if($conn){
        $query = "insert into channels (channel_name, channel_image) values ('$channel_name', '$channel_image')";
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