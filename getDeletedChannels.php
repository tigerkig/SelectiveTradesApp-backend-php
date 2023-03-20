<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_GET;
    
    if($conn){
        $query = "select * from deleted_channels";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 0){
            echo 'failure';
        }
        else{
            $rows = array();
            while($r = mysqli_fetch_assoc($result)){
                $rows[] = $r;
            }
            print json_encode($rows);
        }
    }
    else{
        echo 'failure';
    }
?>