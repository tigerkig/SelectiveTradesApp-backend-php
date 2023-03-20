
<?php
/*
This call sends a message to one recipient.
*/
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_GET;
    
    $message = $data['message'];
    $user_email = $data['user'];
    
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
                'Subject' => "New issue from $user_email",
                'TextPart' => "$message",
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
        echo 'success';
    }
?>

