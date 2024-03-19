<?php
include "./connection.php";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $query = $conn->prepare('select * from reviews)');
    $query->execute();
    $query->store_result();
    $query->bind_result(
        $review_id,
        $user_id,
        $flight_id,
        $rating,
        $review_text
    );
    while ($row = $query->fetch()) {
        $response['reviews'][] = $row;
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $flight_id = $_POST['flight_id'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];
    $query = $conn->prepare('insert into reviews (user_id, flight_id, rating, review_text) values (?,?,?,?,?)');
    $query->bind_param('iiss', $user_id, $flight_id, $rating, $review_text);
    if ($query->execute()) {
        $response['status'] ='success';
        $response['message'] = "Successfully added";
    } else {
        $response['status'] = 'error';
        $response['message'] = "Something went wrong";
    }
}