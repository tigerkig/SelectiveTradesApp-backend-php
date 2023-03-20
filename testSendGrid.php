<?php
    include 'connection_details.php';
    
    require_once 'sendGrid/sendgrid-php.php';
    
    extract($_REQUEST);
    $data = $_GET;
    
    $message = $data['message'];
    $user_email = $data['email'];
    $username = $data['username'];
    
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("noreply@selectivetrades.com", "SelectiveTrades");
    $email->setSubject("SelectiveTrades");
    $email->addTo($user_email);
    $email->addContent("text/plain", $message);
    $sendgrid = new \SendGrid('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');
    try {
        $response = $sendgrid->send($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }
?>