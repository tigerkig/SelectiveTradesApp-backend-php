<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;
    
    $username = $data['username'];
    $email = $data['email'];
    $phone_number = $data['phone_number'];
    $date_registered = $data['date_registered'];
    $firebase_tokens = $data['firebase_tokens'];
    $password = $data['password'];
    $logged_in = $data['logged_in'];
    $active = $data['active'];
    $app_version_ios = $data['app_version_ios'];
    $app_version_android = $data['app_version_android'];
    $device = $data['device'];
    $ip_address = $data['ip_address'];
    $profile_image_url = $data['profile_image_url'];
    $hash = $data['hash'];
    $last_login = $data['last_login'];
    
    if($conn){
        $query = "insert into admins (username, email, phone_number, date_registered, firebase_tokens, admin_password, logged_in, active, app_version_ios, app_version_android, device, ip_address, profile_image_url, hash, last_login) values ('$username', '$email', '$phone_number', '$date_registered', '$firebase_tokens', '$password', '$logged_in', '$active', '$app_version_ios', '$app_version_android', '$device', '$ip_address', '$profile_image_url', '$hash', '$last_login')";
        $insert = mysqli_query($conn, $query);
        if($insert){
            echo 'success';
        }
        else{
            echo mysqli_error($conn);
            //echo 'Unable to sign up';
        }
    }
    else{
        echo 'failure';
    }
?>