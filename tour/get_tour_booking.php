<?php
/*
    Usage: Used to get a tour booking
    How to call: http://localhost/api/tour/get_tour_booking.php
    How to call: http://localhost/api/tour/get_tour_booking.php?id=1
    Input: two possibilities 
    1 ] without input 
    2 ] with id 
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"tourid":"1","customerid":"1","bookingdate":"2024-04-08"}]
    Input: id (optional)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM tour_booking WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $tour_booking = $stat->fetch(PDO::FETCH_ASSOC);
    if ($tour_booking) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, $tour_booking);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['message' => 'Tour booking not found']);
    }
} else {
    $sql = 'SELECT * FROM tour_booking';
    $stat = $db->prepare($sql);
    $stat->execute();
    $tour_bookings = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['success' => 'yes']);
    array_push($response, ['data' => $tour_bookings]);
}
echo json_encode($response);
?>