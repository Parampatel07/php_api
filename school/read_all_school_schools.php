<?php
/*
 Usage: Used to read all schools
 How to call: http://localhost/api/school/read_all_school_schools.php
 Output:
 [{"error":"no"},{"success":"yes"},{"data":[...]}]
*/
require_once 'connection.php';
$response = [];
$sql = 'SELECT * FROM school_school';
$stat = $db->prepare($sql);
$stat->execute();
$schools = $stat->fetchAll(PDO::FETCH_ASSOC);
array_push($response, ['error' => 'no']);
array_push($response, ['success' => 'yes']);
array_push($response, ['total' => sizeof($schools)]);
array_push($response, ['data' => $schools]);
echo json_encode($response);
?>