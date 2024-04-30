<?php
/*
    Usage: Used to create a new category

    How to call: http://localhost/api/school/create_category.php?name=Category%20Name&detail=Category%20Details

    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Category created successfully"}]

    Input: name, detail (all required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (isset($input['name'], $input['detail'])) {
    $sql = 'INSERT INTO school_category (name, detail) VALUES (?, ?)';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['name']);
    $stat->bindParam(2, $input['detail']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Category created successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' =>
        'Failed to create category']);
}
} else {
array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>