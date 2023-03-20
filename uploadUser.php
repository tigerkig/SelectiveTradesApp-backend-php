<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_POST;
    
    $username = $data['username'];
    $stripe_id = $data['stripe_id'];
    $email = $data['email'];
    $phone_number = $data['phone_number'];
    $date_registered = $data['date_registered'];
    $expiry_date = $data['expiry_date'];
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
    $email_notif = $data['email_notif'];
    
    if($conn){
        $query = "insert into users (username, stripe_id, email, phone_number, date_registered, expiry_date, firebase_tokens, user_password, logged_in, active, app_version_ios, app_version_android, device, ip_address, profile_image_url, hash, email_notif) values ('$username', '$stripe_id', '$email', '$phone_number', '$date_registered', '$expiry_date', '$firebase_tokens', '$password', '$logged_in', '$active', '$app_version_ios', '$app_version_android', '$device', '$ip_address', '$profile_image_url', '$hash', '$email_notif')";
        $insert = mysqli_query($conn, $query);
        if($insert){
            echo 'success';
        }
        else{
            echo 'Unable to sign up';
        }
    }
    else{
        echo 'failure';
    }
?>