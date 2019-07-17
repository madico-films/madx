<?php

$first_name   = $_POST['firstName'];
$last_name    = $_POST['lastName'];
$email        = $_POST['email'];
$phone        = $_POST['phone'];
$message      = $_POST['message'];
$dealer_email = $_POST['dealerEmail'];

$to      = $dealer_email;
$subject = "Inquiry from Madico Dealer Directory";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "From: noreply@madico.com\n";
$headers .= 'Bcc: dealer-results-form@madico.com' . "\r\n";

$body = <<<EOD
First Name: $first_name
Last Name: $last_name
Phone: $phone
Email: $email
Message: $message
EOD;


mail($to,$subject,$body,$headers);

echo "Your message has been sent!";

?>