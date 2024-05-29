<?php
// (A) SETTINGS - CHANGE TO YOUR OWN!
$dbhost = "localhost";
$dbname = "cyberma3_lms";
$dbchar = "utf8";
$dbuser = "cyberma3_mbuvi";
$dbpass = "3030Mbuvi@";
$prvalid = 300; // Password reset is valid for 300 seconds

// (B) CONNECT TO DATABASE
try {
  $pdo = new PDO(
    "mysql:host=$dbhost;dbname=$dbname;charset=$dbchar",
    $dbuser, $dbpass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
  );
} catch (Exception $ex) { exit($ex->getMessage()); }
