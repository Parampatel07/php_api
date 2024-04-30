<?php
/*
    Usage: Used to update a school content
    How to call: http://localhost/api/school/update_school_content.php?id=1&schoolid=1&title=New%20Title&detail=New%20Details&contenttype=2&filename=new_file.pdf
    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"School content updated successfully"}]
    [{"error":"yes"},{"success":"no"},{"message":"Failed to update school content"}]
    Input: id, schoolid, title, detail, contenttype, filename (all required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['id'], $input['schoolid'], $input['title'], $input['detail'], $input['contenttype'], $input['filename'])) {
    $sql = 'UPDATE school_content SET schoolid = ?, title = ?, detail = ?, contenttype = ?, filename = ? WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['schoolid']);
    $stat->bindParam(2, $input['title']);
    $stat->bindParam(3, $input['detail']);
    $stat->bindParam(4, $input['contenttype']);
    $stat->bindParam(5, $input['filename']);
    $stat->bindParam(6, $input['id']);
    $result = $stat->execute();
    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'School content updated successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to update school content']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}
echo json_encode($response);
?>