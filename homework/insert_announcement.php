<?php
/*
    usage: Used to insert a new announcement into the database
    how to call: http://localhost/api/homework/insert_announcement.php?title=Exam&detail=Final%20exam%20on%20Monday&standardid=1&teacherid=1
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Announcement inserted successfully"}]
    input: title, detail, standardid, teacherid (all required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;

if (
    isset(
        $input['title'],
        $input['detail'],
        $input['standardid'],
        $input['teacherid']
    )
) {
    $sql =
        'INSERT INTO announcement (title, detail, standardid, teacherid) VALUES (?, ?, ?, ?)';
    $stat = $db->prepare($sql);
    $stat->bindparam(1, $input['title']);
    $stat->bindparam(2, $input['detail']);
    $stat->bindparam(3, $input['standardid']);
    $stat->bindparam(4, $input['teacherid']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Announcement inserted successfully',
        ]);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to insert announcement']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>
