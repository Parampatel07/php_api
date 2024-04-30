<?php
/*
    usage: to update an event 
    how to call : http://localhost/api/event_management/update_event.php?eventid=1&name=Name&type=Type&start_date=2000-10-20&end_date=2002-04-20&venue=Venue&budget=Budget
    input : eventid, name, type, start_date, end_date, venue, budget (required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['eventid'],
        $input['name'],
        $input['type'],
        $input['start_date'],
        $input['end_date'],
        $input['venue'],
        $input['budget']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE event SET name=?, type=?, start_date=?, end_date=?, venue=?, budget=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['name']);
        $stat->bindparam(2, $input['type']);
        $stat->bindparam(3, $input['start_date']);
        $stat->bindparam(4, $input['end_date']);
        $stat->bindparam(5, $input['venue']);
        $stat->bindparam(6, $input['budget']);
        $stat->bindparam(7, $input['eventid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Event updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
