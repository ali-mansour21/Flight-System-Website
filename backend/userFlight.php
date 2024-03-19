<?php

include "./connection.php";


//when using the api , it need a user id to get the data

$user_id = $_GET['user'];

if (!empty($user_id)) {
    $id = intval($user_id);
    $response = getflights($user_id);
    echo json_encode($response);
} else {
    echo json_encode($response);
}

function getflights($user_id) {
    global $conn; 
    $query = $conn->prepare("SELECT f.* FROM flights AS f
        JOIN bookings AS b ON f.flight_id = b.flight_id 
        JOIN users AS u ON b.user_id = u.user_id
        WHERE u.user_id = ?");

    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();

    $flights = [];
    while ($row = $result->fetch_assoc()) {
        $flights[] = $row;
    }

    return ["status" => "Success", "flights" => $flights];
}
?>