<?php
/*
    Usage: Used to update a tour tour
    How to call: http://localhost/api/tour/update_tour_tour.php?id=2&operatorid=1&destinations=Paris,London&facilities=Guide,Transport&ticketpriceadult=100&ticketpricechild=50&termsandconditions=No refund
    Output:
    [{"error":"input is missing"}]
    [{"message":"Tour tour updated successfully"}]
    Input: id, operatorid, destinations, facilities, ticketpriceadult, ticketpricechild, termsandconditions (all required)
*/
require_once 'connection.php';
$input = $_REQUEST;
if (isset($input['id'], $input['operatorid'], $input['destinations'], $input['facilities'], $input['ticketpriceadult'], $input['ticketpricechild'], $input['termsandconditions'])) {
    $sql = 'UPDATE tour_tour SET operatorid = ?, destinations = ?, facilities = ?, ticketpriceadult = ?, ticketpricechild = ?, termsandconditions = ? WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['operatorid']);
    $stat->bindParam(2, $input['destinations']);
    $stat->bindParam(3, $input['facilities']);
    $stat->bindParam(4, $input['ticketpriceadult']);
    $stat->bindParam(5, $input['ticketpricechild']);
    $stat->bindParam(6, $input['termsandconditions']);
    $stat->bindParam(7, $input['id']);
    $stat->execute();
    echo json_encode(['message' => 'Tour tour updated successfully']);
} else {
    echo json_encode(['error' => 'Input is missing']);
}
?>