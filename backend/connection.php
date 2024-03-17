<?php
require '../vendor/autoload.php';

use Firebase\JWT\JWT;

$algorithm = 'HS256';
function generateSecretKey($length = 40)
{
    return bin2hex(random_bytes($length / 2));
}

$secret_key = generateSecretKey();

$host = "localhost";
$user = "root";
$password = "";
$db_name = "flight_systemdb";

$conn = mysqli_connect($host, $user, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
