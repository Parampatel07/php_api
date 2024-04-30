<?php
/*
    Usage: Used to update a tour message
    How to call: http://localhost/api/tour/update_tour_message.php?id=2&tourid=1&senderid=1&messagetext=He2llo&timestamp=2024-04-08 04:49:51
    Output:
    [{"error":"input is missing"}]
    [{"message":"Tour message updated successfully"}]
    Input: id, tourid, senderid, messagetext, timestamp (all required)
*/
require_once 'connection.php';
$input = $_REQUEST;
if (isset($input['id'], $input['tourid'], $input['senderid'], $input['messagetext'], $input['timestamp'])) {
    $sql = 'UPDATE tour_message SET tourid = ?, senderid = ?, messagetext = ?, timestamp = ? WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['tourid']);
    $stat->bindParam(2, $input['senderid']);
    $stat->bindParam(3, $input['messagetext']);
    $stat->bindParam(4, $input['timestamp']);
    $stat->bindParam(5, $input['id']);
    $stat->execute();
    echo json_encode(['message' => 'Tour message updated successfully']);
} else {
    echo json_encode(['error' => 'Input is missing']);
}
?>