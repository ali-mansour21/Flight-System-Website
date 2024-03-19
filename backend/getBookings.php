<?php
include "./connection.php";

$query = $conn->prepare('select * from bookings');

$query->execute();
$query->store_result();
$query->bind_result(
    $id,
    $user_id,
    $flight_id,
    $booking_date,
    $booking_time,
    $number_of_passengers,
    $total_price,
    $payment_status
);
while ($query->fetch()) {
    $booking = [
        'id' => $id,
        'user_id' => $user_id,
        'flight_id' => $flight_id,
        'booking_status' => $booking_status
    ];
    $response['bookings'][] = $booking;
}
$query_user = $conn->prepare('select * from users');
$query_user->execute();
$query_user->store_result();
$query_user->bind_result($id, $first_name, $last_name);
while ($query_user->fetch()) {
    $user = [
        'id' => $id,
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $response['users'][] = $user;
}

echo json_encode($response);
