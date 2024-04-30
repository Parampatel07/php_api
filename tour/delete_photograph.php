<?php
/*
Usage: Used to delete a photograph from the tour_photograph table
How to call: http://localhost/api/tour/delete_photograph.php?photoid=1

Output:
[{"error":"input is missing"}]
[{"error":"no"},{"success":"yes"},{"message":"Photograph deleted successfully"}]

Input: photoid (required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (isset($input['photoid']) == false) {
array_push($response, ['error' => 'Input is missing']);
} else {
try {
$sql = 'DELETE FROM tour_photograph WHERE id = ?';
$stat = $db->prepare($sql);
$stat->bindParam(1, $input['photoid']);
$stat->execute();
array_push($response, ['error' => 'no']);
    array_push($response, ['success' => 'yes']);
    array_push($response, ['message' => 'Photograph deleted successfully']);
} catch (PDOException $error) {
    array_push($response, ['error' => 'no']);
    array_push($response, ['success' => 'no']);
    array_push($response, ['message' => 'Invalid Request']);
}
}

echo json_encode($response);
?>