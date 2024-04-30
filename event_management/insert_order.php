<?php
/*
    usage: to insert order 
    how to call : http://localhost/api/event_management/insert_order.php?eventid=1&themeid=1&customerid=1&orderstatus=1
    input : eventid, themeid, customerid, orderstatus
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['eventid'],
        $input['themeid'],
        $input['customerid'],
        $input['orderstatus']
    ) == false
) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'INSERT into orders (eventid , themeid , customerid , orderstatus) VALUES (?,?,?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['eventid']);
        $stat->bindparam(2, $input['themeid']);
        $stat->bindparam(3, $input['customerid']);
        $stat->bindparam(4, $input['orderstatus']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Order inserted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Attempt ']);
    }
}
echo json_encode($response);
?>
