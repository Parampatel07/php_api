<?php
/*
    usage: to delete a catering_service 
    how to call : http://localhost/api/event_management/delete_catering_service.php?id=1
    input : id
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['id']) == false) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'DELETE FROM catering_service WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Catering Service Deleted successfully ',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Delete Attempt ']);
    }
}
echo json_encode($response);
?>
