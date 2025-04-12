
<?php
use PHPMailer\PHPMailer\PHPMailer;

require "PHPMailer/PHPMailer.php";
require "PHPMailer/SMTP.php";
require "PHPMailer/Exception.php";

if (isset($_POST['email'])) {
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $email = $_POST['email'];
    $mobile = $_POST['PhoneNumber'];
    $body = $_POST['body'];

    $name = $FirstName . ' ' . $LastName;


    $mail = new PHPMailer();

    //SMTP Settings
    $mail->isSMTP();
    $mail->Host = "ynhc.com.au";
    $mail->SMTPAuth = False;
    $mail->Username = ""; //enter you email address
    $mail->Password = ''; //enter you email password
    $mail->Port = 25;
    $mail->SMTPSecure = "None";
    $mail->SMTPDebug = 2;

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress(""); //enter you email address
    $mail->Subject = ("Contact form inquiry");


    $emailmessage = "<p style='font-size: 18px; color: #000000; font-weight: 600; padding-left: 20px;'>You have received Inquiry email</p>
    <div style='border: 1px solid #0000002f; border-radius: 10px; max-width: 600px;'>
	<div style=' display: grid; grid-template-columns: 80px 10px auto; grid-gap:50px ; border-bottom: 1px solid #0000002f;padding:15px 20px;  '><p style='margin: 0; font-weight:500; color: #000000;'> Name </p><span style='font-weight: 500;'>:</span><p style='color:#000000;font-size: 16px;  margin: 0; font-weight: 600; '> $name </p></div><div style=' display: grid; grid-template-columns: 80px 10px auto; grid-gap:50px ; padding: 15px 20px;  border-bottom: 1px solid #0000002f'><p style='margin: 0; font-weight:500; color: #000000;'> Email </p><span style='font-weight: 500;'>:</span><p style='color:#000000;font-size: 16px;  margin: 0; font-weight: 600;'> $email </p></div><div style=' display: grid; grid-template-columns: 80px 10px auto; grid-gap:50px ; padding: 15px 20px;  border-bottom: 1px solid #0000002f'><p style='margin: 0; font-weight:500; color: #000000;'> Mobile</p><span style='font-weight: 500;'>:</span><p style='color:#000000;font-size: 16px;  margin: 0; font-weight: 600;'> $mobile </p></div><div style=' display: grid; grid-template-columns: 80px 10px auto; grid-gap:50px ; padding: 15px 20px; '><p style='margin: 0; font-weight:500; color: #000000;'> Message</p>
		<span style='font-weight: 500;'>:</span><p style='color:#000000;font-size: 16px;  margin: 0; font-weight: 600;'> $body </p></div></div>";
    $mail->Body = $emailmessage;


    $mail->Body = $emailmessage;

    if ($mail->send()) {
        $status = "success";
        $response = "Email is sent!";
    } else {
        $status = "failed";
        $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
    }

    exit(json_encode(array("status" => $status, "response" => $response)));
}

?>