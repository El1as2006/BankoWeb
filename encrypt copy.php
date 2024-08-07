<?php 
require 'funcs/funcs.php';
$plaintext = "12341234";

$encrypted_text = encryptPayload($plaintext);

echo $encrypted_text;