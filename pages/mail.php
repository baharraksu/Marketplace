<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendHelloEmail($email, $name)
{
    require 'vendor/autoload.php';
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'mail.trtur.org';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@trtur.org';
        $mail->Password = 'iNfo_61';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('info@trtur.org', 'Selam Mesajı');
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = 'Selam!';
        $mail->Body = 'Merhaba ' . $name . '! Bu sadece bir selam mesajıdır.';
        $mail->AltBody = 'Merhaba ' . $name . '! Bu sadece bir selam mesajıdır.';

        $mail->send();
        echo "E-posta başarıyla gönderildi!";
    } catch (Exception $e) {
        echo "E-posta gönderilemedi. Mailer Hatası: {$mail->ErrorInfo}";
    }
}

if (isset($_GET['email']) && isset($_GET['name'])) {
    $email = $_GET['email'];
    $name = $_GET['name'];
    sendHelloEmail($email, $name);
} else {
    echo "E-posta ve isim parametreleri eksik.";
}
