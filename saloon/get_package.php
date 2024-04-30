<?php
/*
        usage: get package 
        how to call : http://localhost/api/saloon/get_package.php?packageid=1
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"total":1,"data":[{"packageid":1,"name":"Package1","service_included":"Service1,Service2","price":100,"description":"Description","photo":"package_photo.jpg"}],"message":"Package data found"}]
        input : packageid(optional) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['packageid']) == false) {
    try {
        $sql = 'SELECT * from saloon_package';
        $stat = $db->prepare($sql);
        $stat->execute();
        $result = $stat->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            array_push($response, ['error' => 'no']);
            array_push($response, ['total' => 0]);
            array_push($response, ['message' => 'No package data found']);
        } else {
            array_push($response, ['error' => 'no']);
            array_push($response, ['total' => sizeof($result)]);
            array_push($response, ['data' => $result]);
        }
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['total' => 0]);
        array_push($response, ['message' => 'Invalid Request']);
    }
} else {
    try {
        $packageid = $input['packageid'];
        $sql = 'SELECT * from saloon_package where id = ? ';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $packageid);
        $stat->execute();
        $result = $stat->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            array_push($response, ['error' => 'no']);
            array_push($response, ['total' => 0]);
            array_push($response, [
                'message' => 'No package data found with packageid',
            ]);
        } else {
            array_push($response, ['error' => 'no']);
            array_push($response, ['total' => sizeof($result)]);
            array_push($response, ['data' => $result]);
        }
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['total' => 0]);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
