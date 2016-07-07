<?php

$email_to = "juliekbergen@gmail.com";
$email_subject = "Portfolio Site Submission";

$first_name = $_POST['name']; 
$email_from = $_POST['email']; 
$comments = $_POST['message']; 

// Validation
function died($error) {
    echo $error."<br /><br />";
    die();
}

$error_message = "";
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

if(!preg_match($email_exp,$email_from)) {
$error_message .= '<div class="email-erorr">Please enter a valid email.</div>';
}
$string_exp = "/^[A-Za-z .'-]+$/";

if(!preg_match($string_exp,$first_name)) {
$error_message .= '<div class="name-erorr">Please enter your name.</div>';
}

if(strlen($comments) < 2) {
$error_message .= '<div class="message-erorr">Please enter a message.</div>';
}

if(strlen($error_message) > 0) {
died($error_message);
}
// End Validation

// $headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers = "From: <webmaster@juliebergen.com>" . "\r\n";
$headers .= "Cc: " . $email_from ."\r\n";
$headers .= "Reply-To: " . $email_from ."\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

function clean_string($string) {
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}
$email_message = "Form details below.\r\n\r\n";
$email_message .= "Name: ".clean_string($first_name)."\r\n";
$email_message .= "Email: ".clean_string($email_from)."\r\n";
$email_message .= "Comments: ".clean_string($comments)."\r\n";
 
mail($email_to,$email_subject,$email_message,$headers);
echo "<div class=\"success_message\"><i class=\"fa fa-check\"></i> Your message was sent.</div><script>$('#contactform')[0].reset();</script>"; 
?>