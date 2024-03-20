    <?php
    include "./connection.php";





    //documentation::
    // get need the id
    // get all just the baseurl
    //delete need the request_id
    //add coin request need the user_id and the amount 
    //delete need the request_id
    //for the update status , it need the request_id and the staus that need to be updated

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
            if (!empty($_GET["id"])) {
                $id = intval($_GET["id"]);
                $response = deleteCoinRequest($id);
                echo json_encode($response);
            } else {
                echo json_encode(["status" => "Error", "message" => "Coin request ID is required for deletion"]);
            }
            break;
        case 'PUT':
            if (!empty($_GET["id"]) && !empty($_GET["status"])) {
                $id = intval($_GET["id"]);
                $newStatus = intval($_GET["status"]);
                $response = toggleCoinRequestStatus($id, $newStatus);
                echo json_encode($response);
            } else {
                echo json_encode(["status" => "Error", "message" => "Coin request ID and new status are required for status toggle"]);
            }
            break;

        default:
            echo json_encode(["status" => "Invalid request method"]);
            break;
    }

    function getAllCoinRequests()
    {
        global $conn;
        $query = $conn->prepare("SELECT coin.*,u.first_name,u.last_name FROM coinrequests as coin join users as u on coin.user_id=u.user_id ");
        $query->execute();
        $result = $query->get_result();

        $coinsRequests = [];
        while ($row = $result->fetch_assoc()) {
            $coinsRequests[] = $row;
        }

        return ["status" => "Success", "coinsRequests" => $coinsRequests];
    }


    function getCoinRequest($id)
    {
        global $conn;
        $query = $conn->prepare("SELECT * FROM coinrequests WHERE request_id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();

        $coinsRequest = $result->fetch_assoc();

        return ["status" => "Success", "coinsRequest" => $coinsRequest];
    }

    function addCoinRequest($user_id, $amount)
    {
        global $conn;
        $query = $conn->prepare("INSERT INTO coinrequests (user_id, amount) VALUES (?, ?)");

        if (!$query) {
            return ["status" => "Error", "message" => $conn->error];
        }

        $query->bind_param("ii", $user_id, $amount);

        if ($query->execute()) {
            return ["status" => "Success", "message" => "Coin request added successfully"];
        } else {
            return ["status" => "Error", "message" => $query->error];
        }
    }

    function deleteCoinRequest($id)
    {
        global $conn;

        $query = $conn->prepare("DELETE FROM coinrequests WHERE request_id = ?");
        $query->bind_param("i", $id);

        if ($query->execute()) {
            return ["status" => "Success", "message" => "Coin request deleted successfully"];
        } else {
            return ["status" => "Error", "message" => $conn->error];
        }
    }


    function toggleCoinRequestStatus($id, $newStatus)
    {
        global $conn;

        $updateQuery = $conn->prepare("UPDATE coinrequests SET status = ? WHERE request_id = ?");
        $updateQuery->bind_param("ii", $newStatus, $id);

        if ($updateQuery->execute()) {
            return ["status" => "Success", "message" => "Coin request status updated successfully"];
        } else {
            return ["status" => "Error", "message" => $conn->error];
        }
    }
