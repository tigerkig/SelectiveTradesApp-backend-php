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
    $last_login = $data['last_login'];
    $email_notif = $data['email_notif'];
    $sub_type = $data['sub_type'];
    
    if($conn){
        $query = "update users set username='$username', stripe_id='$stripe_id', email='$email', phone_number='$phone_number', date_registered='$date_registered', expiry_date='$expiry_date', firebase_tokens='$firebase_tokens', user_password='$password', logged_in='$logged_in', last_login='$last_login', active='$active', app_version_android='$app_version_android', app_version_ios='$app_version_ios', device='$device', ip_address='$ip_address', profile_image_url='$profile_image_url', hash='$hash', email_notif='$email_notif', sub_type='$sub_type' where email='$email'";
        $insert = mysqli_query($conn, $query);
        if($insert){
            echo 'success';
        }
        else{
            echo 'Unable to update user';
        }
    }
?>