<?php
/*
    Usage: Used to get a tour photograph
    How to call: http://localhost/api/tour/get_tour_photograph.php
    How to call: http://localhost/api/tour/get_tour_photograph.php?id=1
    Input: two possibilities 
    1 ] without input 
    2 ] with id 
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"tourid":"1","photopath":"path/to/photo","caption":"Beautiful view"}]
    Input: id (optional)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM tour_photograph WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $tour_photograph = $stat->fetch(PDO::FETCH_ASSOC);
    if ($tour_photograph) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, $tour_photograph);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['message' => 'Tour photograph not found']);
    }
} else {
    $sql = 'SELECT * FROM tour_photograph';
    $stat = $db->prepare($sql);
    $stat->execute();
    $tour_photographs = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['success' => 'yes']);
    array_push($response, ['data' => $tour_photographs]);
}
echo json_encode($response);
?>