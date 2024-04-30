<?php
/*
    delete worker_worker 
    how to call : http://localhost/api/bookmyworker/delete_worker.php?workerid=1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Worker deleted successfully"}]
    input : workerid(required) 
*/

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['workerid']) == false) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'DELETE FROM worker_worker WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['workerid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Worker deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);

?>
