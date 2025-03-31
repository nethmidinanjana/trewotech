<?php

require "connection.php";
require "config.php";
loadEnv();

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`= '" . $email . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {

        $code = uniqid();

        Database::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('MY_EMAIL');
        $mail->Password = getenv('GMAIL_APP_PW');
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('nethmidinanjana@gmail.com', 'Reset Password');
        $mail->addReplyTo('nethmidinanjana@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Trewo Tech Forgot password Verification Code';
        $bodyContent = '<h1 style="color:blue;">Your verification code is ' . $code . '</h1>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo 'Verification code sending failed.';
        } else {
            echo 'success';
        }
    } else {
        echo ("Invalid Email Address !!!");
    }
}
