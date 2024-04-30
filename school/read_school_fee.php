<?php
/*
    Usage: Used to read school fee details
    How to call: http://localhost/api/school/read_school_fee.php?id=1
    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"data":{...}}]
    [{"error":"yes"},{"success":"no"},{"message":"School fee not found"}]
    Input: id (required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM school_fees WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $school_fee = $stat->fetch(PDO::FETCH_ASSOC);
    if ($school_fee) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['data' => $school_fee]);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'School fee not found']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}
echo json_encode($response);
?>