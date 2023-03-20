<?php
/*
This call sends a message to one recipient.
*/
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_GET;
    
    $hash = 'f0425c52cda3b2b619d182d0e937ff98e0441ca5024101a52008725e70e32c31';
    $query = "select email,username,phone_number from users where hash='$hash'";
    $send_query = mysqli_query($conn, $query);
    $user_email = '';
    $phone_number = '';
    $username = '';
    $store = 'APPSTORE';
    $amount = '$24.99';
    $date = '';
    $type = 'RENEWAL';
    $product = 'selective_trades_app_251m';
    
    $to_send = '';
    
    if(mysqli_num_rows($send_query) != 0){
        while($r = mysqli_fetch_assoc($send_query)) {
            $username = $r['username'];
            $user_email = $r['email'];
            $phone_number = $r['phone_number'];
            $timestamp = 1641790281939/1000;
            $date = date( "m-d-Y", $timestamp);
        }
        $to_send = "Payment notification for:\nUsername: '$username'\nEmail: '$user_email'\nPhone number: '$phone_number'\nPayment date: '$date'\nAmount: '$amount'\nType: '$type'\nProduct: '$product'";
    }
    

    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => "support@selectivetrades.com",
                    'Name' => "SelectiveTrades"
                ],
                'To' => [
                    [
                        'Email' => "$user_email",
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
        echo "Email sent successfully.";
}
?>
