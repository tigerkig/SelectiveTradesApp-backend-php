<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_GET;
    
    $user = $data['user'];
    $table = $data['table'];
    
    if($conn){
        $query = "select * from $table where user='$user'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) != 0){
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