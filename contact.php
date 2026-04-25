<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'primespace.cleanings1@gmail.com'; // your email
        $mail->Password   = 'hcrt bthk hwme fvie'; // NOT your real password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Form data
        $name    = $_POST['name'];
        $email   = $_POST['email'];
        $phone   = $_POST['phone'];
        $message = $_POST['message'];

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('primespace.cleanings1@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Message';
        $mail->Body    = "
            <b>Name:</b> $name <br>
            <b>Email:</b> $email <br>
            <b>Phone:</b> $phone <br><br>
            <b>Message:</b><br>$message
        ";

        $mail->send();
        echo 'Message sent successfully';

    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
}