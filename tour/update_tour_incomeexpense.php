<?php
/*
    Usage: Used to update a tour incomeexpense
    How to call: http://localhost/api/tour/update_tour_incomeexpense.php?id=2&tourid=1&income=1000&expense=5010
    Output:
    [{"error":"input is missing"}]
    [{"message":"Tour incomeexpense updated successfully"}]
    Input: id, tourid, income, expense (all required)
*/
require_once 'connection.php';
$input = $_REQUEST;
if (isset($input['id'], $input['tourid'], $input['income'], $input['expense'])) {
    $sql = 'UPDATE tour_incomeexpense SET tourid = ?, income = ?, expense = ? WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['tourid']);
    $stat->bindParam(2, $input['income']);
    $stat->bindParam(3, $input['expense']);
    $stat->bindParam(4, $input['id']);
    $stat->execute();
    echo json_encode(['message' => 'Tour incomeexpense updated successfully']);
} else {
    echo json_encode(['error' => 'Input is missing']);
}
?>