<?php
/*
        usage: get category 
        how to call : http://localhost/api/saloon/get_category.php?categoryid=1
        how to call : http://localhost/api/saloon/get_category.php
        1 ] with categoryid
        2 ] without input
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"total":2,"data":[{"id":1,"name":"Haircut","photo":"images\/haircut.jpg"}],"message":"Category data found"}]
        input : categoryid(optional) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['categoryid']
    ) == false
) {
    try {
        $sql =
            'SELECT * FROM saloon_category';
        $stat = $db->prepare($sql);
        $stat->execute();
        $result = $stat->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            array_push($response, ['error' => 'no']);
            array_push($response, ['total' => 0]);
            array_push($response, ['message' => 'No Category data found']);
        } else {
            array_push($response, ['error' => 'no']);
            array_push($response, ['total' => count($result)]);
            array_push($response, ['data' => $result]);
        }
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['total' => 0]);
        array_push($response, ['message' => 'Invalid Request']);
    }
} else {
    try {
        $categoryid = $input['categoryid'];
        $sql =
            'SELECT * FROM saloon_category WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $categoryid);
        $stat->execute();
        $result = $stat->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            array_push($response, ['error' => 'no']);
            array_push($response, ['total' => 0]);
            array_push($response, ['message' => 'No Category data found']);
        } else {
            array_push($response, ['error' => 'no']);
            array_push($response, ['total' => count($result)]);
            array_push($response, ['data' => $result]);
        }
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['total' => 0]);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);