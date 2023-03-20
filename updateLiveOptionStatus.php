<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;
    
    $tracker = $data['tracker'];
    $status = $data['status'];
    
    $query = "update live_options set status='$status' where tracker='$tracker'";
    mysqli_query($conn, $query);
    echo 'success';
?>