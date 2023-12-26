<?php

class SendMail
{

    public function sendVerificationEmail($email, $verificationCode, $name)
    {

        try {
            // Replace with your SMTP server & port
            ini_set("SMTP", "smtp.gmail.com");
            ini_set("smtp_port", "587");

            // Email content
            $subject = "Verify Your AMORAL Account - One-Time Passcode (OTP)";
            $message =
                '<div style="background-color: #e7e7e7; padding: 40px 15px 50px 15px; margin: 5px; border-top-left-radius: 30px; border-bottom-right-radius: 30px;">'
                . '<p style="text-align: start; font-size: 19px; padding: 0; margin:0 0 0 15px;" >Dear ' . $name . ',</p> <br>'
                . '<p style="color:white; text-align: center; font-size: 42px; padding: 20px 0 0 10px; margin: 0px;">Welcome To</p>'
                . '<p style="color:black; text-align: center; font-size: 36px; padding: 0px; margin: 0px;">Amoral!</p><br>'
                // . '<p style="color:blue; text-align: center; font-size: 22px; padding: 0px; margin: 0px;">Clothes Design & Printing Company</p><br>'
                . '<p style="font-size: 18px; text-align: center;padding: 0px 20px;">Thank you for choosing AMORAL for your personalized t-shirt'
                . ' printing needs.<br> To ensure the security of your account, we\'re excited to assist you in verifying your registration.<br>'
                . '</p> <p style="font-size: 21px; text-align: center;"> <b>Your One-Time Passcode: ' . $verificationCode
                . '</b> <br></p> <p style="font-size: 18px; text-align: center;">'
                . 'If you haven\'t initiated this registration, please contact our support team immediately.<br><br>'
                . 'Thank you for choosing AMORAL.<br>We look forward to being a part of your creative journey.</p>'
                . '<p style="text-align: start; font-size: 18px; padding: 0px; margin: 0 0 0 15px;">'
                . 'Best Regards,<br> The AMORAL Team.<br>
                [Contact Information]<br>[Social Media Links]<br>[Website URL]
                </p>';

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
