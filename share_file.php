<?php
$filename = $_POST["file"];

// Recipient 
$to = $_POST["email"];
 
// Sender 
$from = 'no-reply@malwe.online'; 
$fromName = 'Malwe Admin'; 
 
// Email subject 
$subject = 'Malwe Admin Have Shared File';  
 
// Email body content 
$htmlContent = ' 
    <h3>Dear '.$to.'</h3> 
    <p>Malwe Admin have shared a file with you. You can download file on right clicking below link and select "Save link as...".</p>
    <a href="'.$filename.'" target="_blank" download="download" rel="noopener noreferrer">'.basename($filename).'</a>
'; 
 
// Header for sender info 
$headers = "From: $fromName"." <".$from.">\n";
$headers .= "MIME-Version: 1.0\n" ;
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
$headers .= "X-Priority: 1 (Highest)\n";
$headers .= "X-MSMail-Priority: High\n";
$headers .= "Importance: High\n";
 
// Send email 
$mail = mail($to, $subject, $htmlContent, $headers);  
 
// Email sending status 
echo $mail?"success":"error"; 
?>