<?php
    include 'connection_details.php';
    
    /* Namespace alias. */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    /* If you installed PHPMailer without Composer do this instead: */
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
    extract($_REQUEST);
    
    if($conn){
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        
        $user_hash = $data->event->app_user_id;
        $expiration = (int)$data->event->expiration_at_ms;
        $_expiration = strval($expiration);
        
        $original_user_hash = $data->event->original_app_user_id;
        $price = $data->event->price;
        $price_in_purchased_currency = $data->event->price_in_purchased_currency;
        $currency = $data->event->currency;
        $product_id = $data->event->product_id;
        $store = $data->event->store;
        $transaction_id = $data->event->transaction_id;
        $take_home_percent = $data->event->takehome_percentage;
        $type = $data->event->type;
        $purchased_at = $data->event->purchased_at_ms;
        $country_code = $data->event->country_code;
        
        $query = "update users set expiry_date='$expiration', sub_type='store' where hash='$user_hash'";
        
        $insert_query = "insert into payment_history (user_hash, original_user_hash, price, price_in_purchased_currency, currency, product_id, store, transaction_id, take_home_percent, type, purchased_at, expiration, country_code) values ('$user_hash', '$original_user_hash', '$price', '$price_in_purchased_currency', '$currency', '$product_id', '$store', '$transaction_id', '$take_home_percent', '$type', '$purchased_at', '$expiration', '$country_code')";
        
        $result = mysqli_query($conn, $query);
        $insert_result = mysqli_query($conn, $insert_query);
        
        if($result && $insert_result){
            echo 200;
            $_query = "select email,username,phone_number from users where hash='$user_hash'";
            $send_query = mysqli_query($conn, $_query);
            $email = '';
            $phone_number = '';
            $username = '';
            $to_send = '';
            
            if(mysqli_num_rows($send_query) != 0){
                while($r = mysqli_fetch_assoc($send_query)) {
                    $username = $r['username'];
                    $email = $r['email'];
                    $phone_number = $r['phone_number'];
                }
                $timestamp = date("m-d-Y", $purchased_at/1000);
                $to_send = "Payment notification for:\nUsername: '$username'\nEmail: '$email'\nPhone number: '$phone_number'\nPayment date: '$timestamp'\nAmount: '$price'\nType: '$type'\nProduct: '$product_id'\nStore: '$store'\nCurrency: '$currency'";
                
                $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => "support@selectivetrades.com",
                    'Name' => "SelectiveTrades"
                ],
                'To' => [
                    [
                        'Email' => "selectivetrades1@gmail.com",
                    ]
                ],
                'Subject' => "Payment notification",
                'TextPart' => "$to_send",
            ]
        ]
    ];
    $ch = curl_init();
  
    curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json')
    );
    curl_setopt($ch, CURLOPT_USERPWD, "9c568fca2f1a16a5a30fa8782c554ed4:683a79fa6567dc22b5d5327fd1d3d629");
    $server_output = curl_exec($ch);
    curl_close ($ch);
      
    $response = json_decode($server_output);
    if ($response->Messages[0]->Status == 'success') {
        
    }
            }
        }
        else{
            echo 500;   
        }
        
    }
    else{
        echo 500;
    }
?>