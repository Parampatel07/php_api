<?php
/*
    usage: to get orders 
    how to call : http://localhost/api/event_management/get_orders.php
    how to call : http://localhost/api/event_management/get_orders.php?id=1
    how to call : http://localhost/api/event_management/get_orders.php?eventid=1
    how to call : http://localhost/api/event_management/get_orders.php?themeid=1
    how to call : http://localhost/api/event_management/get_orders.php?customerid=1
    how to call : http://localhost/api/event_management/get_orders.php?orderstatus=1
    input : six possibilities 
    1 ] without input 
    2 ] with id 
    3 ] with eventid 
    4 ] with themeid 
    5 ] with customerid 
    6 ] with orderstatus 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql = 'SELECT * FROM orders WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } elseif (isset($input['eventid'])) {
        $sql = 'SELECT * FROM orders WHERE eventid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['eventid']);
    } elseif (isset($input['themeid'])) {
        $sql = 'SELECT * FROM orders WHERE themeid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['themeid']);
    } elseif (isset($input['customerid'])) {
        $sql = 'SELECT * FROM orders WHERE customerid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['customerid']);
    } elseif (isset($input['orderstatus'])) {
        $sql = 'SELECT * FROM orders WHERE orderstatus = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['orderstatus']);
    } else {
        $sql = 'SELECT * FROM orders';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $orders = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($orders)]);
    array_push($response, ['data' => $orders]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
