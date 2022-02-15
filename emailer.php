
<?php

    // send mail code
    include('assets/plugins/phpmailer/PHPMailer5.2.1/class.phpmailer.php');


    $mail = new PHPMailer(true);

    $mail->Host       = "mail.shopdomain.ir";
    $mail->SMTPAuth   = true;                  // SMTP authentication
    $mail->Username   = "info@shopdomain.ir";
    $mail->Password   = "Xy123456789@";

    $mail->IsSMTP();
    $mail->AddAddress("rezahazrat12345@gmail.com");
    $mail->SetFrom('info@shopdomain.ir', 'admin');

    $mail->Subject = 'welcome to PHP course';

    $mail->CharSet = 'UTF-8'; // Farsi needs this unicode

    $mail->AltBody = 'Your device can not open html files. Please chaange it. DASMEH.ir';

    $mail->ContentType = 'text/html';
    $content_html="<h2>hello,</h2><p>I am <b>Ali</b> from <span style='color:green'>Iran</span>.</p>";
    $mail->MsgHTML($content_html); // html document to send

    //$mail->AddAttachment('images/phpmailer.gif');
    $mail->Send();
    // end send mail code

    if($mail){
        return 1;
    }else{ return 0;
    }


// select db.
// while( $email = mysqli_fetch_assoc($emails) ){
//     email_send($email)
// }

?>