<?php
/*
    Usage: Used to create a new school content
    How to call: http://localhost/api/school/create_school_content.php?schoolid=1&title=Content%20Title&detail=Content%20Details&contenttype=1&filename=file.pdf
    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"School content created successfully"}]
    Input: schoolid, title, detail, contenttype, filename (all required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['schoolid'], $input['title'], $input['detail'], $input['contenttype'], $input['filename'])) {
    $sql = 'INSERT INTO school_content (schoolid, title, detail, contenttype, filename) VALUES (?, ?, ?, ?, ?)';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['schoolid']);
    $stat->bindParam(2, $input['title']);
    $stat->bindParam(3, $input['detail']);
    $stat->bindParam(4, $input['contenttype']);
    $stat->bindParam(5, $input['filename']);
    $result = $stat->execute();
    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'School content created successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to create school content']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}
echo json_encode($response);
?>