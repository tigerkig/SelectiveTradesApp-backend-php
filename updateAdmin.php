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
        $query = "update admins set username='$username', email='$email', phone_number='$phone_number', date_registered='$date_registered', firebase_tokens='$firebase_tokens', admin_password='$password', logged_in='$logged_in', last_login='$last_login', active='$active', app_version_android='$app_version_android', app_version_ios='$app_version_ios', device='$device', ip_address='$ip_address', profile_image_url='$profile_image_url', hash='$hash' where email='$email'";
        $insert = mysqli_query($conn, $query);
        if($insert){
            echo 'success';
        }
        else{
            echo 'Unable to update admin';
        }
    }
?>