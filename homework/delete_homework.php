<?php
/*
    delete homework 
    how to call : http://localhost/api/homework/delete_homework.php?homeworkid=1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Homework deleted successfully"}]
    input : homeworkid(required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['homeworkid']) == false) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'DELETE FROM homework WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['homeworkid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Homework deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
