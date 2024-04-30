<?php
/*
    Usage: Used to update a school city
    How to call: http://localhost/api/school/update_school_city.php?id=1&name=New%20City%20Name&pincode=654321
    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"School city updated successfully"}]
    [{"error":"yes"},{"success":"no"},{"message":"Failed to update school city"}]
    Input: id, name, pincode (all required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['id'], $input['name'], $input['pincode'])) {
    $sql = 'UPDATE school_city SET name = ?, pincode = ? WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['name']);
    $stat->bindParam(2, $input['pincode']);
    $stat->bindParam(3, $input['id']);
    $result = $stat->execute();
    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'School city updated successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to update school city']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}
echo json_encode($response);
?>