<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_GET;
    
    $email = $data['email'];
    $password = $data['password'];
    
    if($conn){
        $query = "select user_password from users where email='$email'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result == 0)){
            echo 'Incorrect credential combination';
        }
        else{
            $rows = array();
            while($r = mysqli_fetch_assoc($result)){
                $rows[] = $r;
            }
            echo json_encode($rows);
        }
    }
    else{
        echo 'Connection failure';
    }
?>