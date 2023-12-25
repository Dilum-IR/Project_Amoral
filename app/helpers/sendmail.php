<?php

class SendMail
{

    public function sendVerificationEmail($email, $verificationCode)
    {

        try {
            // Replace with your SMTP server & port
            ini_set("SMTP", "smtp.gmail.com");
            ini_set("smtp_port", "587");

            // Email content
            $subject = "Email Verification";
            $message = '<div style="background-color: #e7e7e7; padding: 10px 10px 50px 10px; margin: 5px; border-top-left-radius: 30px; border-bottom-right-radius: 30px;">'
                . '<p style="color:white; text-align: center; font-size: 42px; padding: 30px 0 0 0px; margin: 0px;">Welcome To</p>'
                . '<p style="color:black; text-align: center; font-size: 36px; padding: 0px; margin: 0px;">Amoral!</p><br>'
                . '<p style="color:blue; text-align: center; font-size: 22px; padding: 0px; margin: 0px;">Clothes Design & Printing Company</p><br>'
                . '<p style="font-size: 18px; text-align: center;padding: 0px 20px;">Thank you for signing up with our service.<br>'
                . 'To complete your registration and verify your email address,<br>'
                . 'please use the following <br> </p> <p style="font-size: 21px; text-align: center;"> <b>verification code : ' . $verificationCode
                . '</b> <br></p> <p style="font-size: 18px; text-align: center;">Please don\'t share this OTP code from any other users.<br>'
                . 'Only confirmed your email addresses will receive emails from Amoral.</p>';

            // Email headers
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: osrathnayake528@gmail.com" . "\r\n";

            // Send email
            if (mail($email, $subject, $message, $headers)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            
            return false;
        }
    }
}
