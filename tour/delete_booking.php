<?php
/*
    Usage: Used to delete a booking from the tour_booking table

    How to call: http://localhost/api/tour/delete_booking.php?bookingid=1

    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Booking deleted successfully"}]

    Input: bookingid (required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (isset($input['bookingid']) == false) {
    array_push($response, ['error' => 'Input is missing']);
} else {
    try {
        $sql = 'DELETE FROM tour_booking WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindParam(1, $input['bookingid']);
        $stat->execute();

        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Booking deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}

echo json_encode($response);
?>