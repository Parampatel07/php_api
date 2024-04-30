<?php
/*
    Usage: Used to create a new school city
    How to call: http://localhost/api/school/create_school_city.php?name=City%20Name&pincode=123456
    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"School city created successfully"}]
    Input: name, pincode (all required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['name'], $input['pincode'])) {
    $sql = 'INSERT INTO school_city (name, pincode) VALUES (?, ?)';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['name']);
    $stat->bindParam(2, $input['pincode']);
    $result = $stat->execute();
    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'School city created successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to create school city']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}
echo json_encode($response);
?>