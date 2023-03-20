<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;
    
    $text = $data['data'];
    echo "$text";
    
?>