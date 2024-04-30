<?php
/*
Usage: Used to read category details

How to call: http://localhost/api/school/read_category.php?id=1

Output:
[{"error":"input is missing"}]
[{"error":"no"},{"success":"yes"},{"data":{...}}]
[{"error":"yes"},{"success":"no"},{"message":"Category not found"}]

Input: id (required)

*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (isset($input['id'])) {
    $sql = 'SELECT * FROM school_category WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
} else {
    $sql = 'SELECT * FROM school_category ';
    $stat = $db->prepare($sql);
}
$stat->execute();
$category = $stat->fetch(PDO::FETCH_ASSOC);

if ($category) {
    array_push($response, ['error' => 'no']);
    array_push($response, ['success' => 'yes']);
    array_push($response, ['data' => $category]);
} else {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['success' => 'no']);
    array_push($response, ['message' => 'Category not found']);
}

echo json_encode($response);
?>
