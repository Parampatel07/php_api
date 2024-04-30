<?php
/*
    usage: Used to insert a new doubt into the database
    how to call: http://localhost/api/homework/insert_doubt.php?studentid=1&teacherid=1&title=Math%20problem&detail=I%20dont%20understand%20this%20equation&solutions=2121
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Doubt inserted successfully"}]
    input: studentid, teacherid, title, detail, solutions (all required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;

if (
    isset(
        $input['studentid'],
        $input['teacherid'],
        $input['title'],
        $input['detail'],
        $input['solutions']
    )
) {
    $sql =
        'INSERT INTO doubt (studentid, teacherid, title, detail, solutions) VALUES (?, ?, ?, ?, ?)';
    $stat = $db->prepare($sql);
    $stat->bindparam(1, $input['studentid']);
    $stat->bindparam(2, $input['teacherid']);
    $stat->bindparam(3, $input['title']);
    $stat->bindparam(4, $input['detail']);
    $stat->bindparam(5, $input['solutions']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Doubt inserted successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to insert doubt']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>
