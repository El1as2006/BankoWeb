<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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


$pgsql = include_once "conexion.php";

$user_id = $_GET["id"];

$stmt = $conn->prepare("INSERT INTO public.cards_debit
(card_number, account_id, expiration_date, cvv)
VALUES( :card_number, :id, :expiration_date, :cvv);");

$params = [
    ':card_number' => $n_account,
    ':cvv' => $cvv,
    ':expiration_date' => $exp_date,
    ':id' => $user_id,
];

$stmt->execute($params);

header("Location: index_view.php");
exit();