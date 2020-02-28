<?php

$url = 'https://api.sendgrid.com/';
$user = 'contato.vitalup';
$pass = 'Vital@2019';


$name = $_POST["name"];
$from = $_POST["email"];
$subject = "Contato - Vital UP - Site";
$text = $_POST["message"];
$phone = $_POST["phone"];

$msg = "Olá, meu nome é $name,
Estou entrando em contato por: $text, em caso de dúvida meu contato é: $phone
Aguardo retorno.";


$header = array(
	'Authorization: Bearer' => $SENDGRID_API_KEY,
	'Content-Type' => 'application/json',
);

$data = array (
	'personalizations' => 
	array (
	  0 => 
	  array (
		'to' => 
		array (
		  0 => 
		  array (
			'email' => 'anapessoa@vitalup.com.br',
		  ),
		),
	  ),
	),
	'from' => 
	array (
	  'email' => $from,
	),
	'subject' => $subject,
	'content' => 
	array (
	  0 => 
	  array (
		'type' => 'text/plain',
		'value' => $msg,
	  ),
	),
);

$request = $url.'api.sendgrid.com/v3/mail/send';

// Generate curl request
$session = curl_init($request);
// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $data);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, $header);
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

?>