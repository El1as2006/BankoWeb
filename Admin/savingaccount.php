<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="package/dist/sweetalert2.css">
    <script src="package/dist/sweetalert2.min.js"></script>
    <title>Saving Accounts</title>
</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['logged_admin']) || $_SESSION['logged_admin'] !== true) {
    header('Location: ../login_view.php');
    exit;
}

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

require 'funcs/funcs.php';
$hashed_account = utf8_encode(encryptPayload($n_account));


$count_stmt = $pgsql->prepare("SELECT COUNT(*) FROM public.accounts WHERE owner_id = :owner_id AND accounttype = 'savings'");
$count_stmt->execute([':owner_id' => $user_id]);
$account_count = $count_stmt->fetchColumn();

print_r ($account_count);

if ($account_count >= 1) {
    echo "<script>
            Swal.fire({
                title: 'Maximum Accounts Reached',
                text: 'You already have an account registered.',
                icon: 'warning',
                confirmButtonText: 'Close'
            }).then(function() {
                window.location = 'addingaccounts.php';
            });
          </script>";
} else {
    $stmt = $pgsql->prepare("INSERT INTO public.accounts
    (owner_id, balance, accounttype, accountnumber, points)
    VALUES (:owner_id, :balance, :accounttype, :accountnumber, :points);");

    $params = [
        ':owner_id' => $user_id,
        ':balance' => 0,
        ':accounttype' => 'savings',   
        ':accountnumber' => $hashed_account, 
        ':points' => 0,
    ];

    if ($stmt->execute($params)) {
        echo "<script>
                  Swal.fire({
                      title: 'Registered Successfully',
                      text: 'Saving Account Registered Successfully',
                      icon: 'success',
                      confirmButtonText: 'Close'
                  }).then(function() {
                      window.location = 'addingaccounts.php';
                  });
                </script>";
    } else {
        echo "<script>
                  Swal.fire({
                      title: 'Error Registering',
                      text: 'Saving Account Not Registered',
                      icon: 'error',
                      confirmButtonText: 'Close'
                  }).then(function() {
                      window.location = 'addingaccounts.php';
                  });
                </script>";
    }
}
?>
</body>
</html>


