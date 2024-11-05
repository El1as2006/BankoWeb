<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../package/dist/sweetalert2.css">
    <script src="../package/dist/sweetalert2.min.js"></script>
    <title>Document</title>
</head>
<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// if (!isset($_SESSION['logged_admin']) || $_SESSION['logged_admin'] !== true) {
//     header('Location: ../login_view.php');
//     exit;
// }

function generateCard($limit){
    $code = '';
    for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
    return $code;
}
$n_account = generateCard(16);

function generateCVV($limit){
    $code = '';
    for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
    return $code;
}
$cvv = generateCVV(3);

$date = new DateTime();
$date->modify("+5 years");
$exp_date = $date->format("m/y");


$pgsql = include_once "../conexion.php";

$user_id = $_GET["id"];

require '../funcs/funcs.php';

  $encrypted_card = (encryptPayload($n_account));
  $encrypted_cvv = (encryptPayload($cvv));


$stmt = $conn->prepare("INSERT INTO public.cards_debit
(card_number, account_id, expiration_date, cvv)
VALUES( :card_number, :id, :expiration_date, :cvv);");

$params = [
    ':card_number' => $encrypted_card,
    ':cvv' => $encrypted_cvv,
    ':expiration_date' => $exp_date,
    ':id' => $user_id,
];

if ($stmt->execute($params)) {
    echo "<script>
              Swal.fire({
                  title: 'Registered Succesfully',
                  text: 'Debit Card Registered Succesfully',
                  icon: 'success',
                  button: 'Close'
              }).then(function() {
                  window.location = 'addingcards.php';
              });
            </script>";
  } else {
    echo "<script>
              Swal.fire({
                  title: 'Error registering',
                  text: 'Debit Card Not Registered',
                  icon: 'error',
                  button: 'Close'
              }).then(function() {
                  window.location = 'addingcards.php';
              });
            </script>";
  }

?>

</body>
</html>
