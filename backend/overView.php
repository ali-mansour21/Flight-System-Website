<?php
include "./connection.php";
$user_type = 0;
$user_query = $conn->prepare('select count(*) as totalUsers from users where type = ?');

$user_query->bind_param('i', $user_type);
$user_query->execute();

$user_result = $user_query->get_result();

$row = $user_result->fetch_assoc();
$response['totalUsers'] = $row['totalUsers'];

$books_query = $conn->prepare('select count(*) as totalBooks from bookings');
$books_query->execute();

$books_result = $books_query->get_result();

$row = $books_result->fetch_assoc();

$response['totalBooks'] = $row['totalBooks'];

$revene_query = $conn->prepare('select sum(total_price) as totalRevenes from bookings');


$revene_query->execute();

$revene_result = $revene_query->get_result();

$row = $revene_result->fetch_assoc();

$response['totalRevenes'] = $row['totalRevenes'];

echo json_encode($response);
