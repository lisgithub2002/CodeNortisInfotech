<?php
use PHPMailer\PHPMailer\PHPMailer;

require "PHPMailer/PHPMailer.php";
require "PHPMailer/SMTP.php";
require "PHPMailer/Exception.php";

if (isset($_POST['FullName']) && isset($_POST['Email'])) {

    // Get all form fields
    $Fullname = $_POST['FullName'];
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone'];
    $Location = $_POST['Location'];
    $Gender = $_POST['Gender'];
    $DOB = $_POST['DOB'];
    $CurrentSalary = $_POST['CurrentSalary'];
    $ExpectedSalary = $_POST['ExpectedSalary'];
    $JoiningDays = $_POST['JoiningDays'];
    $JobTitle = $_POST['JobTitle'];
    $Remark = $_POST['Remark'];
    $Skills = isset($_POST['Skills']) ? implode(", ", $_POST['Skills']) : '';

    $file_tmp  = $_FILES['doc']['tmp_name'];
    $file_name = $_FILES['doc']['name'];

    $mail = new PHPMailer();

    // SMTP Settings
    $mail->isSMTP();
    $mail->Host = "ynhc.com.au";
    $mail->SMTPAuth = false;
    $mail->Username = "admin@ynhc.com.au";
    $mail->Password = 'Admin$ynhc2021';
    $mail->Port = 25;
    $mail->SMTPSecure = "None";
    $mail->SMTPDebug = 0;

    // Email Settings
    $mail->isHTML(true);
    $mail->setFrom($Email, $Fullname);
    $mail->addAddress("admin@ynhc.com.au");
    $mail->Subject = ("Inquiry Form Submission");

    // Add attachment if exists
    if (!empty($file_tmp)) {
        $mail->addAttachment($file_tmp, $file_name);
    }

    // Create email body
    $emailmessage = "
    <h2>New Inquiry Received</h2>
    <table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; font-family: Arial; font-size: 14px;'>
        <tr><td><strong>Full Name</strong></td><td>$Fullname</td></tr>
        <tr><td><strong>Email</strong></td><td>$Email</td></tr>
        <tr><td><strong>Phone</strong></td><td>$Phone</td></tr>
        <tr><td><strong>Location</strong></td><td>$Location</td></tr>
        <tr><td><strong>Gender</strong></td><td>$Gender</td></tr>
        <tr><td><strong>Date of Birth</strong></td><td>$DOB</td></tr>
        <tr><td><strong>Current Salary</strong></td><td>$CurrentSalary</td></tr>
        <tr><td><strong>Expected Salary</strong></td><td>$ExpectedSalary</td></tr>
        <tr><td><strong>Available to Join (Days)</strong></td><td>$JoiningDays</td></tr>
        <tr><td><strong>Job Title</strong></td><td>$JobTitle</td></tr>
        <tr><td><strong>Skills</strong></td><td>$Skills</td></tr>
        <tr><td><strong>Remark</strong></td><td>$Remark</td></tr>
    </table>";

    $mail->Body = $emailmessage;

    // Send Email
    if ($mail->send()) {
        $status = "success";
        $response = "Email is sent!";
    } else {
        $status = "failed";
        $response = "Something went wrong: <br><br>" . $mail->ErrorInfo;
    }

    exit(json_encode(array("status" => $status, "response" => $response)));
}
?>
