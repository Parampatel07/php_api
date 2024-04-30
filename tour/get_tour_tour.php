<?php
/*
    Usage: Used to get a tour tour
    How to call: http://localhost/api/tour/get_tour_tour.php
    How to call: http://localhost/api/tour/get_tour_tour.php?id=1
    Input: two possibilities 
    1 ] without input 
    2 ] with id 
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"operatorid":"1","destinations":"Paris,London","facilities":"Guide,Transport","ticketpriceadult":"100","ticketpricechild":"50","termsandconditions":"No refund"}]
    Input: id (optional)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM tour_tour WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $tour_tour = $stat->fetch(PDO::FETCH_ASSOC);
    if ($tour_tour) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, $tour_tour);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['message' => 'Tour tour not found']);
    }
} else {
    $sql = 'SELECT * FROM tour_tour';
    $stat = $db->prepare($sql);
    $stat->execute();
    $tour_tours = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['success' => 'yes']);
    array_push($response, ['data' => $tour_tours]);
}
echo json_encode($response);
?>