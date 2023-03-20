<?php
    include 'connection_details.php';
    
    extract($_REQUEST);
    $data = $_GET;
    
    $message = $data['pin'];
    $email = $data['email'];

    /* Namespace alias. */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    /* If you installed PHPMailer without Composer do this instead: */
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
    
    /* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
    $mail = new PHPMailer(TRUE);
    
    /* Open the try/catch block. */
    try {
       /* Set the mail sender. */
       $mail->setFrom('hello@tickethub.ng');
    
       /* Add a recipient.  selectivetrades1@gmail.com */
       $mail->addAddress('sherifffoladejo@gmail.com');
       $mail->addReplyTo('hello@tickethub.ng');
     
    
       /* Set the subject. */
       $mail->Subject = 'Your ticket for Prettyboy D-O Presents: Love Is War (Homecoming Edition)';
    
       /* Set the mail message body. */
       $mail->Body = 'Hi Sophie

Please find attached your ticket for Prettyboy D-O Presents: Love Is War (Homecoming Edition).
Please present it with your Valid ID on the day of the event.

Ticket Code:TK77190093';
       
       $mail->addAttachment('TKaNsb5DBuF.pdf');
    
       /* Finally send the mail. */
       $mail->send();
       //$mail->AddReplyTo($email, "Sheriff");
       echo 'sent';
     
    }
    catch (Exception $e)
    {
       /* PHPMailer exception. */
       echo $e->errorMessage();
    }
    catch (\Exception $e)
    {
       /* PHP exception (note the backslash to select the global namespace Exception class). */
       echo $e->getMessage();
    }
?>