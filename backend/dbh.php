<?php

$dbServername = "dsg1.crc.nd.edu";
$dbUsername = "scorn";
$dbPassword = "taurus";
$dbName = "scorn";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

?>
