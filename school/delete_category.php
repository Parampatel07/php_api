<?php
/*
Usage: Used to delete a category

How to call: http://localhost/api/school/delete_category.php?id=1

Output:
[{"error":"input is missing"}]
[{"error":"no"},{"success":"yes"},{"message":"Category deleted successfully"}]

Input: id (required)

*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (isset($input['id'])) {
$sql = 'DELETE FROM school_category WHERE id = ?';
$stat = $db->prepare($sql);
$stat->bindParam(1, $input['id']);
$result = $stat->execute();

if ($result) {
    array_push($response, ['error' => 'no']);
    array_push($response, ['success' => 'yes']);
    array_push($response, ['message' => 'Category deleted successfully']);
} else {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['success' => 'no']);
    array_push($response, ['message' => 'Failed to delete category']);
}

} else {
array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>