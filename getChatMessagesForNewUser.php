<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_GET;
    
    $date_registered = (int)$data['date_registered'];
    
    if($conn){
        $query = "select * from chat_messages where timestamp>$date_registered";
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