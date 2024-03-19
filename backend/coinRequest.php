<?php
include "./connection.php";

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $response = getCoinRequest($id);
            echo json_encode($response);
        } else {
            $response = getAllCoinRequests();
            echo json_encode($response);
        }
        break;
    case 'POST':
        if (!empty($_POST["user_id"]) && !empty($_POST["amount"])) {
            $user_id = intval($_POST["user_id"]);
            $amount = intval($_POST["amount"]);
            $response = addCoinRequest($user_id, $amount);
            echo json_encode($response);
        } else {
            echo json_encode(["status" => "User ID and amount are required"]);
        }
        break;

    case 'DELETE':
        echo json_encode(["status" => "DELETE method not allowed for coin requests"]);
        break;
    default:
        echo json_encode(["status" => "Invalid request method"]);
        break;
}

function getAllCoinRequests() {
    global $mysqli;
    $query = $mysqli->prepare("SELECT * FROM coinrequests");
    $query->execute();
    $result = $query->get_result();

    $RequestCoin = [];
    while ($row = $result->fetch_assoc()) {
        $coinsRequests[] = $row;
    }

    return ["status" => "Success", "coinsRequests" => $coinsRequests];
}


function getCoinRequest($id) {
    global $mysqli;
    $query = $mysqli->prepare("SELECT * FROM coinrequests WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();

    $coinsRequest = $result->fetch_assoc();

    return ["status" => "Success", "coinsRequest" => $coinsRequest];
}