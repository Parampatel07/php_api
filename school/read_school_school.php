<?php
/*
 Usage: Used to read school details
 How to call: http://localhost/api/school/read_school_school.php?id=1
 Output:
 [{"error":"input is missing"}]
 [{"error":"no"},{"success":"yes"},{"data":{...}}]
 [{"error":"yes"},{"success":"no"},{"message":"School not found"}]
 Input: id (required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM school_school WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $school = $stat->fetch(PDO::FETCH_ASSOC);
    if ($school) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['total' => '1']);
        array_push($response, ['data' => $school]);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'School not found']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}
echo json_encode($response);
?>
