<?php
$simple_string = "Welcome to GeeksforGeeks";

echo "Original String: " . $simple_string . "\n";

$ciphering = "BF-CBC";

$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;

$encryption_iv = random_bytes($iv_length);

// Alternatively, you can use a fixed iv if needed
// $encryption_iv = openssl_random_pseudo_bytes($iv_length);

$encryption_key = openssl_digest(php_uname(), 'MD5', TRUE);

$encryption = openssl_encrypt($simple_string, $ciphering,
	$encryption_key, $options, $encryption_iv);

echo "Encrypted String: " . $encryption . "\n";

$decryption = openssl_decrypt($encryption, $ciphering,
	$encryption_key, $options, $encryption_iv);

echo "Decrypted String: " . $decryption;







