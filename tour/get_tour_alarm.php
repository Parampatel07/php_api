<?php
/*
    Usage: Used to get a tour alarm
    How to call: http://localhost/api/tour/get_tour_alarm.php
    How to call: http://localhost/api/tour/get_tour_alarm.php?id=1
    Input: two possibilities 
    1 ] without input 
    2 ] with id 
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"tourid":"1","alarmtime":"2024-04-08 04:49:51"}]
    Input: id (optional)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM tour_alarm WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $tour_alarm = $stat->fetch(PDO::FETCH_ASSOC);
    if ($tour_alarm) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, $tour_alarm);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['message' => 'Tour alarm not found']);
    }
} else {
    $sql = 'SELECT * FROM tour_alarm';
    $stat = $db->prepare($sql);
    $stat->execute();
    $tour_alarms = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['success' => 'yes']);
    array_push($response, ['data' => $tour_alarms]);
}
echo json_encode($response);
?>