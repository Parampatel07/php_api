<?php
/*
    delete worker_service 
    how to call : http://localhost/api/bookmyworker/delete_service.php?serviceid=1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Service deleted successfully"}]
    input : serviceid(required) 
*/

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['serviceid']) == false) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'DELETE FROM worker_service WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['serviceid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Service deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);

?>
