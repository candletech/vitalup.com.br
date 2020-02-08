<?php

$url = 'https://api.sendgrid.com/';
$user = 'vitalup';
$pass = 'Vital@2019';


$name = $_POST["name"];
$from = $_POST["email"];
$subject = "Contato - Vital Up";
$text = $name.': '.$_POST["message"];

require_once('sendgrid-php/sendgrid-php.php');

$from = new SendGrid\Email(null, $_POST["email"]);
$subject = "Contato - Vital Up";
$to = new SendGrid\Email(null, "contato@vitalup.com.br");
$content = new SendGrid\Content("text/plain", $_POST["message"]);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = '123Pingo456Floquinho';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
if($response->statusCode() == 202){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Enviado com Sucesso !')
	window.location.href='index.html';
	</SCRIPT>");
}else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Ocorreu um erro ao enviar, tente novamente.')
	window.location.href='index.html';
	</SCRIPT>");
}