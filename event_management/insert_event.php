<?php
/*
    usage: to insert event 
    how to call : http://localhost/api/event_management/insert_event.php?name=eventName&type=eventType&start_date=2004-02-10&end_date=2005-02-10&venue=venue&budget=0
    input : name, type, start_date, end_date, venue, budget
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['name'],
        $input['type'],
        $input['start_date'],
        $input['end_date'],
        $input['venue'],
        $input['budget']
    ) == false
) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'INSERT into event (name , type , start_date , end_date , venue , budget) VALUES (?,?,?,?,?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['name']);
        $stat->bindparam(2, $input['type']);
        $stat->bindparam(3, $input['start_date']);
        $stat->bindparam(4, $input['end_date']);
        $stat->bindparam(5, $input['venue']);
        $stat->bindparam(6, $input['budget']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Event inserted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Attempt ']);
    }
}
echo json_encode($response);
?>
