<?php
/*
    Usage: Used to get a tour incomeexpense
    How to call: http://localhost/api/tour/get_tour_incomeexpense.php
    How to call: http://localhost/api/tour/get_tour_incomeexpense.php?id=1
    Input: two possibilities 
    1 ] without input 
    2 ] with id 
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"tourid":"1","income":"1000","expense":"500"}]
    Input: id (optional)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM tour_incomeexpense WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $tour_incomeexpense = $stat->fetch(PDO::FETCH_ASSOC);
    if ($tour_incomeexpense) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, $tour_incomeexpense);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['message' => 'Tour incomeexpense not found']);
    }
} else {
    $sql = 'SELECT * FROM tour_incomeexpense';
    $stat = $db->prepare($sql);
    $stat->execute();
    $tour_incomeexpenses = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['success' => 'yes']);
    array_push($response, ['data' => $tour_incomeexpenses]);
}
echo json_encode($response);
?>