<?php
/*
    usage: Used to insert a new homework into the database
    how to call: http://localhost/api/homework/insert_homework.php?title=Math%20Assignment&detail=Solve%20these%20problems&subject=Math&teacherid=1&standardid=1
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Homework inserted successfully"}]
    input: title, detail, subject, teacherid, standardid (all required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;

if (
    isset(
        $input['title'],
        $input['detail'],
        $input['subject'],
        $input['teacherid'],
        $input['standardid']
    )
) {
    $sql =
        'INSERT INTO homework (title, detail, subject, teacherid, standardid) VALUES (?, ?, ?, ?, ?)';
    $stat = $db->prepare($sql);
    $stat->bindparam(1, $input['title']);
    $stat->bindparam(2, $input['detail']);
    $stat->bindparam(3, $input['subject']);
    $stat->bindparam(4, $input['teacherid']);
    $stat->bindparam(5, $input['standardid']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Homework inserted successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to insert homework']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>
