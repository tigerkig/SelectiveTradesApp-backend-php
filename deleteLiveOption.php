<?php
    include 'connection_details.php';
    
    if($conn){
        extract($_REQUEST);
        $data = $_POST;
    
        $tracker = $data['tracker'];
    
        $query = "delete from live_options where tracker='$tracker'";
        mysqli_query($conn, $query);
        echo 'success';
    }
    else{
        echo 'failure';
    }
    
?>