<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_GET;
    
    if($conn){
        if(isset($_GET['user'])){
            $email = $data['email'];
            $query = "select firebase_tokens from users where email='$email'"; 
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
            $query = "select firebase_tokens, email, logged_in, expiry_date from users"; 
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
    }
    else{
        echo 'failure';
    }
    
?>