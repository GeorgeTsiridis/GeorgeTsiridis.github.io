<!-- <?php
    // $name = $_Post['name'];
    // $visitor_email = $_Post['email'];
    // $message = $_Post['message'];

    // $email_from = 'goglys19@gmail.com';

    // $email_subject = "New Contact Form";
    
    // $email_body = "User Name: $name.\n".
    //                 "User Email: $visitor_email.\n".
    //                     "User Message: $message.\n";

    // $to = "g.tsiridis@activemms.com";

    // $headers = "From: $email_from \r\n";

    // $headers = "Reply-To: $visitor_email \r\n";

    // mail($to,$email_subject,$email_body,$headers);

    // header("Location: index.html");
?> -->

<?php

$curl = curl_init();
$name = $_POST['name']; 
$email = $_POST['email']; 
// $subject = $_POST['subject']; 
$message = $_POST['message'];

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n  \"personalizations\": [\n    {\n      \"to\": [\n        {\n          \"email\": \"[g.tsiridis@activemms.com]\"\n        }\n      ],\n      \"subject\": \"New Contact\"\n    }\n  ],\n  \"from\": {\n    \"email\": \"[g.tsiridis@activemms.com]\"\n  },\n  \"content\": [\n    {\n      \"type\": \"text/html\",\n      \"value\": \"$name<br>$email<br>$subject<br>$message\"\n    }\n  ]\n}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer [SG API key]",
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
header('Location: index.html');

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

?>