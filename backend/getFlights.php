<?php
include "./connection.php";

$query = $conn->prepare('select * from flights');
$query->execute();
$query->store_result();
$query->bind_result(
    $id,
    $airplane_id,
    $airline_id,
    $departure_airport,
    $arrival_airport,
    $departure_date,
    $arrival_date,
    $departure_time,
    $arrival_time,
    $base_brice,
    $flight_status
);
while ($query->fetch()) {
    $flight = [
        'id' => $id,
        'airplane_id' => $airplane_id,
        'airline_id' => $airline_id,
        'departure_airport' => $departure_airport,
        'arrival_airport' => $arrival_airport,
        'departure_date' => $departure_date,
        'arrival_date' => $arrival_date,
        'departure_time' => $departure_time,
        'arrival_time' => $arrival_time,
        'base_brice' => $base_brice,
        'flight_status' => $flight_status
    ];
    $response[] = $flight;
}
echo json_encode($response);
