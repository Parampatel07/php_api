<?php
/*
    Usage: Used to update a tour photograph
    How to call: http://localhost/api/tour/update_tour_photograph.php?id=2&tourid=1&photopath=path/to/photo&caption=Beautiful view
    Output:
    [{"error":"input is missing"}]
    [{"message":"Tour photograph updated successfully"}]
    Input: id, tourid, photopath, caption (all required)
*/
require_once 'connection.php';
$input = $_REQUEST;
if (isset($input['id'], $input['tourid'], $input['photopath'], $input['caption'])) {
    $sql = 'UPDATE tour_photograph SET tourid = ?, photopath = ?, caption = ? WHERE id = ?';
    $stat = $db->prepare($sql);

    $stat->bindParam(1, $input['tourid']);
    $stat->bindParam(2, $input['photopath']);
    $stat->bindParam(3, $input['caption']);
    $stat->bindParam(4, $input['id']);
    $stat->execute();
    echo json_encode(['message' => 'Tour photograph updated successfully']);
} else {
    echo json_encode(['error' => 'Input is missing']);
}
?>