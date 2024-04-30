<?php
/*
    Usage: Used to create a new school fee
    How to call: http://localhost/api/school/create_school_fee.php?schoolid=1&title=Fee%20Title&amount=1000
    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"School fee created successfully"}]
    Input: schoolid, title, amount (all required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['schoolid'], $input['title'], $input['amount'])) {
    $sql = 'INSERT INTO school_fees (schoolid, title, amount) VALUES (?, ?, ?)';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['schoolid']);
    $stat->bindParam(2, $input['title']);
    $stat->bindParam(3, $input['amount']);
    $result = $stat->execute();
    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'School fee created successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to create school fee']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}
echo json_encode($response);
?>