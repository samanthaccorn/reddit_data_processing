<?php
$servername = "http://dsg1.crc.nd.edu/cse30246/noname/";
$database = "users";
$username = "u266072517_user";
$password = "buystuffpwd";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());

}
echo "Connected successfully";
mysqli_close($conn);
?>
