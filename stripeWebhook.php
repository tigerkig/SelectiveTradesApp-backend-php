<?php
    include 'connection_details.php';
  
    require_once 'Stripe/init.php';
    
    extract($_REQUEST);
    
    if($conn){
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        
        $expiration = (int)$data->data->object->current_period_end;
        $stripe_id = $data->data->object->customer;
        $status = $data->data->object->status;
        $subscription_id = $data->data->object->id;
        
        if($status == 'active'){
            $expiry = $expiration * 1000;
            $query = "update users set expiry_date='$expiry', sub_type='stripe', subscription_id='$subscription_id' where stripe_id='$stripe_id'";
            
            mysqli_query($conn, $query);
            
            $select_query = "select hash from users where stripe_id='$stripe_id'";
            $result = mysqli_query($conn, $select_query);
            while($r = mysqli_fetch_assoc($result)){
                $user_hash = $r['hash'];
                $product_id = 'Stripe_Subscription';
                $purchase_date = floor(microtime(true) * 1000);
                $type = 'Renewal';
                $currency = 'USD';
                $insert_query = "insert into payment_history (user_hash, price, store, expiration, product_id, purchased_at, type, currency) value ('$user_hash', '24.99', 'Stripe', '$expiry', '$product_id', '$purchase_date', '$type', '$currency')";
                mysqli_query($conn, $insert_query);
            }
            echo 200;
            
        }
    }
    else{
        echo 500;
    }
?>