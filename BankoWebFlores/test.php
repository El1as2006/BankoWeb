<?php
$address = "sa>da";
var_dump($address);
echo("<br>");
var_dump (preg_match('/[<>]/', $address));



echo("<br>");

$ade = (htmlspecialchars(trim($address)));
echo $ade;
var_dump($ade);
echo("<br>");
if (preg_match('/[<>]/', $address)) {
    echo "Hay script";
    exit;
 }else{
    echo "no ahy scrupt ";
 }
