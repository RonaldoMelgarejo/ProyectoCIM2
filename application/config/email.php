<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.office365.com'; // Servidor SMTP de Outlook/Microsoft 365
$config['smtp_port'] = 587; // Utiliza el puerto 587 para TLS.
$config['smtp_user'] = 'pablo_ronaldo_mel@hotmail.com'; // Tu dirección de correo de Outlook
$config['smtp_pass'] = 'Asus1089'; // Contraseña de tu cuenta de Outlook
$config['smtp_crypto'] = 'tls'; // Utiliza TLS como método de cifrado.
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['wordwrap'] = TRUE;