<?php
include "./connection.php";
$flight_id = $_POST['flight_id'];
$departure_date = $_POST['departure_date'];
$arrival_date = $_POST['arrival_date'];
$departure_time = $_POST['departure_time'];
$arrival_time = $_POST['arrival_time'];
$flight_status = $_POST['flight_status'];
$query = $conn->prepare('update flights set departure_date = ?, arrival_date = ?,  departure_time = ?, arrival_time = ?, flights_status= ? where flight_id = ?');
$query->bind_param('ssssii', $departure_date, $arrival_date, $departure_time, $arrival_time, $flight_status, $flight_id);

if ($query->execute()) {
    $response['status'] = 'success';
    $response['message'] = "Flight updated successfully";
} else {
    $response['status'] = 'error';
    $response['message'] = "Something went wrong";
}
echo json_encode($response);
