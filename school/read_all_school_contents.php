<?php
/*
    Usage: Used to read all school contents
    How to call: http://localhost/api/school/read_all_school_contents.php
    Output:
    [{"error":"no"},{"success":"yes"},{"data":[...]}]
*/
require_once 'connection.php';
$response = [];
$sql = 'SELECT * FROM school_content';
$stat = $db->prepare($sql);
$stat->execute();
$school_contents = $stat->fetchAll(PDO::FETCH_ASSOC);
array_push($response, ['error' => 'no']);
array_push($response, ['success' => 'yes']);
array_push($response, ['data' => $school_contents]);
echo json_encode($response);
?>