<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;
    
    $tracker = $data['tracker'];
    $status = $data['status'];
    $pct_change = $data['pct_change'];
    $live_price = $data['live_price'];
    
    $query = "update live_options set status='$status', pct_change='$pct_change', live_price='$live_price' where tracker='$tracker'";
    mysqli_query($conn, $query);
    echo 'success';
?>