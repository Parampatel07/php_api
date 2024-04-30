<?php
/*
    usage: Used to insert a new standard into the database
    how to call: http://localhost/api/homework/insert_standard.php?name=10th%20Grade&medium=English
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Standard inserted successfully"}]
    input: name, medium (all required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;

if (isset($input['name'], $input['medium'])) {
    $sql = 'INSERT INTO standard (name, medium) VALUES (?, ?)';
    $stat = $db->prepare($sql);
    $stat->bindparam(1, $input['name']);
    $stat->bindparam(2, $input['medium']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Standard inserted successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to insert standard']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>
