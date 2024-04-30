<?php
/*
    delete principal 
    how to call : http://localhost/api/homework/delete_principle.php?principalid=1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Principal deleted successfully"}]
    input : principalid(required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['principalid']) == false) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'DELETE FROM principal WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['principalid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Principal deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
