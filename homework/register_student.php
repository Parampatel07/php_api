<?php
/*
    usage: Used to register a new student into the database
    how to call: http://localhost/api/homework/register_student.php?fullname=John%20Doe&email=john.doe@example.com&password=123456&mobileno=1234567890&standardid=1&rollno=1&division=A
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Student registered successfully"}]
    input: fullname, email, password, mobileno, standardid, rollno, division (all required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;

if (
    isset(
        $input['fullname'],
        $input['email'],
        $input['password'],
        $input['mobileno'],
        $input['standardid'],
        $input['rollno'],
        $input['division']
    )
) {
    $sql =
        'INSERT INTO student (fullname, email, password, mobileno, standardid, rollno, division) VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stat = $db->prepare($sql);
    $stat->bindparam(1, $input['fullname']);
    $stat->bindparam(2, $input['email']);
    $stat->bindparam(3, $input['password']);
    $stat->bindparam(4, $input['mobileno']);
    $stat->bindparam(5, $input['standardid']);
    $stat->bindparam(6, $input['rollno']);
    $stat->bindparam(7, $input['division']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Student registered successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to register student']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>
