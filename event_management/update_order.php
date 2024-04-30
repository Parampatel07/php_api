<?php
/*
    usage: to update an order 
    how to call : http://localhost/api/event_management/update_order.php?orderid=1&eventid=1&themeid=1&customerid=1&orderstatus=OrderStatus
    input : orderid, eventid, themeid, customerid, orderstatus (required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['orderid'],
        $input['eventid'],
        $input['themeid'],
        $input['customerid'],
        $input['orderstatus']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE orders SET eventid=?, themeid=?, customerid=?, orderstatus=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['eventid']);
        $stat->bindparam(2, $input['themeid']);
        $stat->bindparam(3, $input['customerid']);
        $stat->bindparam(4, $input['orderstatus']);
        $stat->bindparam(5, $input['orderid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Order updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
