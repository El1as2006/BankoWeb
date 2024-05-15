<?php

$servername = "Localhost";
$dbname = "Banko";
$username = "Banko_user";
$password = "Info2024/*-";

try {
  $conn = new PDO("postgresql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}