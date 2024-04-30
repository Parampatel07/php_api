<?php
/*
    delete worker_admin 
    how to call : http://localhost/api/bookmyworker/delete_admin.php?adminid=1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Admin deleted successfully"}]
    input : adminid(required) 
*/

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['adminid']) == false) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'DELETE FROM worker_admin WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['adminid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Admin deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);

?>
