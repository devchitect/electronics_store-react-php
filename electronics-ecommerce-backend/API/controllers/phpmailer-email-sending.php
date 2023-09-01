<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;                 

    //Set PHPMailer to use SMTP.
    $mail->isSMTP();        
    //Set SMTP host name                      
    $mail->Host = "smtp.gmail.com";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;                      
    //Provide username and password
    $mail->Username = "dungntth2208073@fpt.edu.vn";             
    $mail->Password = $stmp_key;                       
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";                       
    //Set TCP port to connect to
    $mail->Port = 587;                    
    $mail->From = "century@abcxyz.com";
    $mail->FromName = "Century Electronics Store";
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "Email verify code";
    $mail->addEmbeddedImage($_SERVER["DOCUMENT_ROOT"] .'/electronics-ecommerce-backend/resources/logo.png','logo.png','logo.png');
    $mail->Body = "<div>Dear $client_name, 
                    <p>Your verify code is <b>$otp</b> !</p>
                    <p>Verify your account to be an official member, promotions and surprises are await!<p/>    
                    <br><br><br>
                    <h4>With regards, Century!</h4>
                    <img src='cid:logo.png' />
                    </div>
                ";
    $mail->send();             

?>