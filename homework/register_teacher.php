<?php
/*
    usage: Used to register a new teacher into the database
    how to call: http://localhost/api/homework/register_teacher.php?email=jane.doe@example.com&password=123456&mobileno=1234567890
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Teacher registered successfully"}]
    input: email, password, mobileno (all required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;

if (isset($input['email'], $input['password'], $input['mobileno'])) {
    $sql = 'INSERT INTO teacher (email, password, mobileno) VALUES (?, ?, ?)';
    $stat = $db->prepare($sql);
    $stat->bindparam(1, $input['email']);
    $stat->bindparam(2, $input['password']);
    $stat->bindparam(3, $input['mobileno']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Teacher registered successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to register teacher']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>
