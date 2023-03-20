<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;
    
    $symbol = $data['symbol'];
    $buy_price = $data['buy_price'];
    $buy_date = $data['buy_date'];
    $user = $data['user'];
    $quantity = $data['quantity'];
    $table = $data['table'];
    
    if($conn){
        $query = "insert into $table (symbol, buy_price, buy_date, user, quantity) values ('$symbol', '$buy_price', '$buy_date', '$user', '$quantity')";
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