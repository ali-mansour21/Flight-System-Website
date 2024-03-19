<?php
include "./connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $query = $conn->prepare('select m.*,u.first_name,u.last_name from messages as m join users as u on m.user_id = u.user_id');
    $query->execute();
    $query->store_result();
    $query->bind_result(
        $message_id,
        $user_id,
        $message_text,
        $sent_date,
        $first_name,
        $last_name,
    );
    while ($row = $query->fetch()) {
        $message = [
            "message_id" => $message_id,
            "user_id" => $user_id,
            "message_text" => $message_text,
            "sent_date" => $sent_date,
            "first_name" => $first_name,
            "last_name" => $last_name,
        ];
        $response[] = $message;
    }
    echo json_encode($response);
}
if($_SERVER['REQUEST_METHOD']== 'POST'){
    $user_id = $_POST['user_id'];
    $message_text = $_POST['message_text'];
    $query = $conn->prepare('insert into messages (message_text,user_id) values (?,?)');
    $query->bind_param('si', $message_text, $user_id);
    if ($query->execute()) {
        $response['status'] ='success';
        $response['message'] = "Message sent successfully";
    } else {
        $response['status'] = 'error';
        $response['message'] = "Something went wrong";
    }
    echo json_encode($response);
}