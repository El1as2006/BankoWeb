<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="package/dist/sweetalert2.css">
  <script src="package/dist/sweetalert2.min.js"></script>
  <title>Document</title>
</head>
<body>
  
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function generateCode($limit) {
    $code = '';
    for ($i = 0; $i < $limit; $i++) { 
        $code .= mt_rand(0, 9); 
    }
    return $code;
}

$n_account = generateCode(10);
$pgsql = include_once "conexion.php";
$user_id = $_GET["id"];

function encryptPayload($plainText) {
    $key = '7<xwv,9j%N%.!0LEsSwc.Ca3X!SdAO|/';  
    $iv = '<w,jN.0EScC3!dO/'; 
    $encrypted = openssl_encrypt($plainText, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    $payload = base64_encode($iv . $encrypted); 
    return $payload;
}

$hashed_account = utf8_encode(encryptPayload($n_account));

// Check if the user already has an account
$count_stmt = $pgsql->prepare("SELECT COUNT(*) FROM public.accounts WHERE owner_id = :owner_id AND accounttype = 'checking'");
$count_stmt->execute([':owner_id' => $user_id]);
$account_count = $count_stmt->fetchColumn();



if ($account_count >= 1) {
    echo "<script>
            Swal.fire({
                title: 'Maximum Accounts Reached',
                text: 'You already have an account registered.',
                icon: 'warning',
                confirmButtonText: 'Close'
            }).then(function() {
                window.location = 'addingaccounts_cashier.php';
            });
          </script>";
} else {
    $stmt = $pgsql->prepare("INSERT INTO public.accounts
    (owner_id, balance, accounttype, accountnumber, points)
    VALUES (:owner_id, :balance, :accounttype, :accountnumber, :points);");

    $params = [
        ':owner_id' => $user_id,
        ':balance' => 0,
        ':accounttype' => 'checking',   
        ':accountnumber' => $hashed_account, 
        ':points' => 0,
    ];

    if ($stmt->execute($params)) {
        echo "<script>
                Swal.fire({
                    title: 'Registered Successfully',
                    text: 'Checking account registered successfully',
                    icon: 'success',
                    confirmButtonText: 'Close'
                }).then(function() {
                    window.location = 'addingaccounts_cashier.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error Registering',
                    text: 'Checking account not registered',
                    icon: 'error',
                    confirmButtonText: 'Close'
                }).then(function() {
                    window.location = 'addingaccounts_cashier';
                });
              </script>";
    }
}
?>
</body>
</html>
