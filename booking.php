<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs
    $name     = htmlspecialchars(strip_tags($_POST['name']));
    $email    = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone    = htmlspecialchars(strip_tags($_POST['phone']));
    $service  = htmlspecialchars(strip_tags($_POST['service']));
    $date     = htmlspecialchars(strip_tags($_POST['date']));
    $time     = htmlspecialchars(strip_tags($_POST['time']));
    $duration = htmlspecialchars(strip_tags($_POST['duration']));
    $msg      = htmlspecialchars(strip_tags($_POST['message']));

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'primespace.cleanings1@gmail.com';
        $mail->Password   = 'hcrt bthk hwme fvie'; // move to env var ideally
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom($email, $name);
        $mail->addAddress('primespace.cleanings1@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'New Booking Request';
        $mail->Body    = "
            <b>Name:</b> $name <br>
            <b>Email:</b> $email <br>
            <b>Phone:</b> $phone <br>
            <b>Service:</b> $service <br>
            <b>Date & Time:</b> $date at $time <br>
            <b>Duration:</b> $duration <br><br>
            <b>Message:</b><br>$msg
        ";

        $mail->send();
        echo 'sent';

    } catch (Exception $e) {
        echo 'failed';
    }
}
?>