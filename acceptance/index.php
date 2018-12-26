<?php

// ini_set('display_errors',1);
// error_reporting(E_ALL);

use HGSI\Repository\PasswordFactory;
use HGSI\Repository\OpenSSL;
// use HGSI\Repository\Mcrypt;

include_once ('app/boostrap.php');

$encrypt = PasswordFactory::create(new OpenSSL());
$string ='this is password';
$secret_key = $encrypt->generateKey();
$encode_string =  $encrypt->encryptString($string);
echo $original = $encrypt->decryptString($encode_string);



