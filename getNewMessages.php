<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_GET;
    
    $last_id = (int)$data['last_id'];
    $channel = $data['channel'];
    
    if($conn){
        $query = "select * from channel_messages where channel='$channel' and id>$last_id";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            $rows = array();
            while($r = mysqli_fetch_assoc($result)){
                $rows[] = $r;
            }
            print json_encode($rows);
        }
        else{
            echo 'failure';
        }
    }
    else{
        echo 'failure';
    }
?>