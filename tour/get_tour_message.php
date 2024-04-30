<?php
/*
    Usage: Used to get a tour message
    How to call: http://localhost/api/tour/get_tour_message.php
    How to call: http://localhost/api/tour/get_tour_message.php?id=1
    Input: two possibilities 
    1 ] without input 
    2 ] with id 
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"tourid":"1","senderid":"1","messagetext":"Hello","timestamp":"2024-04-08 04:49:51"}]
    Input: id (optional)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM tour_message WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $tour_message = $stat->fetch(PDO::FETCH_ASSOC);
    if ($tour_message) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, $tour_message);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['message' => 'Tour message not found']);
    }
} else {
    $sql = 'SELECT * FROM tour_message';
    $stat = $db->prepare($sql);
    $stat->execute();
    $tour_messages = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['success' => 'yes']);
    array_push($response, ['data' => $tour_messages]);
}
echo json_encode($response);
?>