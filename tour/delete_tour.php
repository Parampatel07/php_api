<?php
/*
    Usage: Used to delete a tour from the tour_tour table

    How to call: http://localhost/api/tour/delete_tour.php?tourid=1

    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Tour deleted successfully"}]

    Input: tourid (required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (isset($input['tourid']) == false) {
    array_push($response, ['error' => 'Input is missing']);
} else {
    try {
        $sql = 'DELETE FROM tour_tour WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindParam(1, $input['tourid']);
        $stat->execute();

        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Tour deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}

echo json_encode($response);
?>