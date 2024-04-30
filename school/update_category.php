<?php
/*
Usage: Used to update a category

How to call: http://localhost/api/school/update_category.php?id=1&name=New%20Category%20Name&detail=New%20Category%20Details

Output:
[{"error":"input is missing"}]
[{"error":"no"},{"success":"yes"},{"message":"Category updated successfully"}]
[{"error":"yes"},{"success":"no"},{"message":"Failed to update category"}]

Input: id, name, detail (all required)

*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (isset($input['id'], $input['name'], $input['detail'])) {
    $sql = 'UPDATE school_category SET name = ?, detail = ? WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['name']);
    $stat->bindParam(2, $input['detail']);
    $stat->bindParam(3, $input['id']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Category updated successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to update category']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>
