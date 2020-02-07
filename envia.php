<?php

$url = 'https://api.sendgrid.com/';
$user = 'candletech';
$pass = 'thesims123!@#';


$name = $_POST["name"];
$from = $_POST["email"];
$subject = "Contato - Vital Up";
$text = $name.': '.$_POST["message"];



$params = array(
	'api_user'  => $user,
	'api_key'   => $pass,
	'to'        => 'contato@vitalup.com.br',
	'subject'   => $subject,
	'html'      => $text,
	'text'      => $text,
	'from'      => $from,
);

$request =  $url.'api/mail.send.json';

// Generate curl request
$session = curl_init($request);
// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
// Tell PHP not to use SSLv3 (instead opting for TLS)
//curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);

//Turn off SSL
curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);//New line
curl_setopt($session, CURLOPT_SSL_VERIFYHOST, false);//New line

curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
$response = curl_exec($session);

// print everything out
//var_dump($response,curl_error($session),curl_getinfo($session));

echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Enviado com Sucesso !')
	window.location.href='index.html';
	</SCRIPT>");

curl_close($session);

