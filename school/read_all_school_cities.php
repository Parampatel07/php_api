<?php
/*
    Usage: Used to read all school cities
    How to call: http://localhost/api/school/read_all_school_cities.php
    Output:
    [{"error":"no"},{"success":"yes"},{"data":[...]}]
*/
require_once 'connection.php';
$response = [];
$sql = 'SELECT * FROM school_city';
$stat = $db->prepare($sql);
$stat->execute();
$school_cities = $stat->fetchAll(PDO::FETCH_ASSOC);
array_push($response, ['error' => 'no']);
array_push($response, ['success' => 'yes']);
array_push($response, ['data' => $school_cities]);
echo json_encode($response);
?>