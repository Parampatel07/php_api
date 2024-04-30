<?php
/*
    Usage: Used to update a tour alarm
    How to call: http://localhost/api/tour/update_tour_alarm.php?id=1&tourid=1&alarmtime=2024-04-08 04:49:51
    Output:
    [{"error":"input is missing"}]
    [{"message":"Tour alarm updated successfully"}]
    Input: id, tourid, alarmtime (all required)
*/
require_once 'connection.php';
$input = $_REQUEST;
if (isset($input['id'], $input['tourid'], $input['alarmtime'])) {
    $sql = 'UPDATE tour_alarm SET tourid = ?, alarmtime = ? WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['tourid']);
    $stat->bindParam(2, $input['alarmtime']);
    $stat->bindParam(3, $input['id']);
    $stat->execute();
    echo json_encode(['message' => 'Tour alarm updated successfully']);
} else {
    echo json_encode(['error' => 'Input is missing']);
}
?>