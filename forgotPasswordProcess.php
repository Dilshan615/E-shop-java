<?php

include "connection.php";
include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_GET["e"];

if (!empty($email)) {

    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "'");
    $n = $rs->num_rows;

    if ($n == 1) {
        $code = uniqid();
        Database::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dilshan0763126293@gmail.com';
        $mail->Password = 'sawzcxzarmrnoxvh';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('dilshan0763126293@gmail.com', 'Reset Password');
        $mail->addReplyTo('dilshan0763126293@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "EShop Forgot Passuord Verification Code";

        $bodyContent = '<hl style="color:green;"> Your Verification Code is ' . $code . '</hl>';

        $mail->Body = $bodyContent;

        if (!$mail->send()) {
            echo ("Verification Code Sending Failed");
        } else {
            echo ("success");
        }
    } else {
        echo ("Invalid Email Address");
    }
} else {
    echo "Please Enter Your Registered Email Address";
}
