<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;
    
    $symbol = $data['symbol'];
    $buy_price = $data['buy_price'];
    $buy_date = $data['buy_date'];
    $user = $data['user'];
    $table = $data['table'];
    
    if($conn){
        $query = "insert into $table (symbol, buy_price, buy_date, user) values ('$symbol', '$buy_price', '$buy_date', '$user')";
        $result = mysqli_query($conn, $query);
        if($result){
            echo 'success';
        }
        else{
            echo '1failure';
        }
    }
    else{
        echo 'failure';
    }
    
?>