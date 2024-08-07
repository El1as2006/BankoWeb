<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
function encrypt($plaintext, $password) {
    $method = "AES-256-CBC";
    $key = "7<xwv,9j%N%.!0LEsSwc.Ca3X!SdAO|/";
    $iv = "3e021f9e2aeadb31";
	echo 'IV: ' . $iv . '<br>';

    $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
    $hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);

    return $iv . $hash . $ciphertext;
}

$plaintext = "Este es un texto de prueba.";
$password = "mi_contraseña_segura";

echo 'Texto cifrado: ' . bin2hex(encrypt($plaintext, $password)) . '<br>';



 function decrypt($ivHashCiphertext, $password) {
     $method = "AES-256-CBC";
    $iv = substr($ivHashCiphertext, 0, 16);
     $hash = substr($ivHashCiphertext, 16, 32);
     $ciphertext = substr($ivHashCiphertext, 48);
     $key = hash('sha256', $password, true);

    if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;

     return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
 }