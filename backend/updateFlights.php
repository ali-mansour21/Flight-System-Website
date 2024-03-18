<?php
include "./connection.php";
$flight_id = $_POST['flight_id'];
$air_plane = $_POST['air_plane'];
$departure_date = $_POST['departure_date'];
$arrival_date = $_POST['arrival_date'];
$flight_status = $_POST['flight_status'];
$query = $conn->prepare('update flights set departure_date = ?, arrival_date = ?,  airplane_id = ?, flights_status= ? where flight_id = ?');
$query->bind_param('ssiii', $departure_date, $arrival_date, $air_plane, $flight_status, $flight_id);

if ($query->execute()) {
    $response['status'] = 'success';
    $response['message'] = "Flight updated successfully";
} else {
    $response['status'] = 'error';
    $response['message'] = "Something went wrong";
}
echo json_encode($response);
