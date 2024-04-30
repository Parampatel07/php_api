<?php
/*
    delete teacher 
    how to call : http://localhost/api/homework/delete_teacher.php?teacherid=1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Teacher deleted successfully"}]
    input : teacherid(required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['teacherid']) == false) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'DELETE FROM teacher WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['teacherid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Teacher deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
