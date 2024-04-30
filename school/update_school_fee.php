<?php
/*
    Usage: Used to update a school fee
    How to call: http://localhost/api/school/update_school_fee.php?id=1&schoolid=1&title=New%20Fee%20Title&amount=2000
    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"School fee updated successfully"}]
    [{"error":"yes"},{"success":"no"},{"message":"Failed to update school fee"}]
    Input: id, schoolid, title, amount (all required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['id'], $input['schoolid'], $input['title'], $input['amount'])) {
    $sql = 'UPDATE school_fees SET schoolid = ?, title = ?, amount = ? WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['schoolid']);
    $stat->bindParam(2, $input['title']);
    $stat->bindParam(3, $input['amount']);
    $stat->bindParam(4, $input['id']);
    $result = $stat->execute();
    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'School fee updated successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to update school fee']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}
echo json_encode($response);
?>