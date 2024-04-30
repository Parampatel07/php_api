<?php
/*
    Usage: Used to delete an alarm from the tour_alarm table

    How to call: http://localhost/api/tour/delete_alarm.php?alarmid=1

    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Alarm deleted successfully"}]

    Input: alarmid (required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (isset($input['alarmid']) == false) {
    array_push($response, ['error' => 'Input is missing']);
} else {
    try {
        $sql = 'DELETE FROM tour_alarm WHERE id = ?';
$stat = $db->prepare($sql);
$stat->bindParam(1, $input['alarmid']);
$stat->execute();
array_push($response, ['error' => 'no']);
    array_push($response, ['success' => 'yes']);
    array_push($response, ['message' => 'Alarm deleted successfully']);
} catch (PDOException $error) {
    array_push($response, ['error' => 'no']);
    array_push($response, ['success' => 'no']);
    array_push($response, ['message' => 'Invalid Request']);
}
}

echo json_encode($response);
?>
