<?php
/*
    Usage: Used to update a tour booking
    How to call: http://localhost/api/tour/update_tour_booking.php?id=1&tourid=1&customerid=1&bookingdate=2024-04-08
    Output:
    [{"error":"input is missing"}]
    [{"message":"Tour booking updated successfully"}]
    Input: id, tourid, customerid, bookingdate (all required)
*/
require_once 'connection.php';
$input = $_REQUEST;
if (isset($input['id'], $input['tourid'], $input['customerid'], $input['bookingdate'])) {
    $sql = 'UPDATE tour_booking SET tourid = ?, customerid = ?, bookingdate = ? WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['tourid']);
    $stat->bindParam(2, $input['customerid']);
    $stat->bindParam(3, $input['bookingdate']);
    $stat->bindParam(4, $input['id']);
    $stat->execute();
    echo json_encode(['message' => 'Tour booking updated successfully']);
} else {
    echo json_encode(['error' => 'Input is missing']);
}
?>