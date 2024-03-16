<?php
$host = "localhost";
$user = "root";
$password = "";
$db_name = "flight_systemdb";

$conn = mysqli_connect($host, $user, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
