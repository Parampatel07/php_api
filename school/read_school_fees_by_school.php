<?php
/*
    Usage: Used to read school fees by school
    How to call: http://localhost/api/school/read_school_fees_by_school.php?schoolid=1
    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"data":[...]}]
    [{"error":"yes"},{"success":"no"},{"message":"No school fees found for the given school"}]
Input: schoolid (required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['schoolid'])) {
$sql = 'SELECT * FROM school_fees WHERE schoolid = ?';
$stat = $db->prepare($sql);
$stat->bindParam(1, $input['schoolid']);
$stat->execute();
$school_fees = $stat->fetchAll(PDO::FETCH_ASSOC);
if ($school_fees) {
array_push($response, ['error' => 'no']);
array_push($response, ['success' => 'yes']);
array_push($response, ['data' => $school_fees]);
} else {
array_push($response, ['error' => 'yes']);
array_push($response, ['success' => 'no']);
array_push($response, ['message' => 'No school fees found for the given school']);
}
} else {
array_push($response, ['error' => 'input is missing']);
}
echo json_encode($response);
?>