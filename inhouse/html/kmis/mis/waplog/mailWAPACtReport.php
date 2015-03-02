<?php 
error_reporting(0);
$prevdate = date("Y-m-d", time() - 60 * 60 * 24);
$rechargeDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));
$reportdate=date('j F ,Y ',strtotime($rechargeDate));
require '/var/www/html/kmis/mis/waplog/contentsWAPActReport.php';
require '/var/www/html/hungamacare/summercontest/PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Set who the message is to be sent from
//set encoding
$mail->Encoding='base64';
$mail->setFrom('ms.mis@hungama.com', 'MS Mis');
//Set an alternative reply-to address
$mail->addReplyTo('ms.mis@hungama.com', 'MS Mis');
//Set who the message is to be sent to
$mail->addAddress('satay.tiwari@hungama.com', 'Satay Tiwari');
$mail->addAddress('gagandeep.matnaja@hungama.com', 'Gagandeep Matnaja');
$mail->addAddress('monika.patel@hungama.com', 'Monika Patel');
$mail->addAddress('kunalk.arora@hungama.com', 'Kunal Arora');
$mail->addAddress('salil.mahajan@hungama.com', 'Salil Mahajan');
$mail->addAddress('gaurav.talwar@hungama.com', 'Gaurav Talwar');
$mail->addAddress('gagandeep.arora@hungama.com', 'Gagandeep Arora');
//Set the subject line
$mail->Subject = 'Airtel ads click_report updated Data of date '.$prevdate;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$htmlfilename='emailcontentWAPActReport_'.date('Ymd').'.html';
$mail->msgHTML(file_get_contents($htmlfilename), dirname(__FILE__));
//Attach an image file
$mail->addAttachment($filepath);
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
//delete CSV file from server
unlink($filepath);
unlink($htmlfilename);
}
?>