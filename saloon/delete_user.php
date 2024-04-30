<?php
/*
        delete service 
        how to call : http://localhost/api/saloon/delete_user.php?userid=1
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Service deleted successfully"}]
        input : serviceid(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;

if (isset($input['userid']) == false) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'DELETE FROM saloon_user WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['userid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'User deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
