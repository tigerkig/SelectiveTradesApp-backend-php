<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;
    
    $table = $data["table"];
    $id = $data["id"];
    
    $query = "delete from $table where id=$id";
    mysqli_query($conn, $query);
?>