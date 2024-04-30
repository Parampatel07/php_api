<?php
/*
        delete package 
        how to call : http://localhost/api/saloon/delete_package.php?packageid=1
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Package deleted successfully"}]
        input : packageid(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['packageid']) == false) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'DELETE FROM saloon_package WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['packageid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Package deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
