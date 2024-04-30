<?php
/*
    update homework 
    how to call : http://localhost/api/homework/update_homework.php?homeworkid=1&title=Math%20Assignment&detail=Solve%20these%20problems&subject=Math&teacherid=1&standardid=1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Homework updated successfully"}]
    input : homeworkid, title, detail, subject, teacherid, standardid (all required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['homeworkid'],
        $input['title'],
        $input['detail'],
        $input['subject'],
        $input['teacherid'],
        $input['standardid']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE homework SET title=?, detail=?, subject=?, teacherid=?, standardid=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['title']);
        $stat->bindparam(2, $input['detail']);
        $stat->bindparam(3, $input['subject']);
        $stat->bindparam(4, $input['teacherid']);
        $stat->bindparam(5, $input['standardid']);
        $stat->bindparam(6, $input['homeworkid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Homework updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt']);
    }
}
echo json_encode($response);
?>
