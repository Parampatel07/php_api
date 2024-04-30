<?php
/*
          usage: to get appointment 
          how to call : http://localhost/api/saloon/get_product.php
          how to call : http://localhost/api/saloon/get_product.php?productid=1
          how to call : http://localhost/api/saloon/get_product.php?categoryid=1
          input : three possibllity 
          1 ] without input 
          2 ] with userid 
          3 ] with date 
          4] appointmentid 
          [{"error":"input is missing"}] 
          [{"error":"no"},{"success":"yes"},{"name":"product 1","photo":"https:\/\/picsum.photos\/150\/150","price":"200","productid":"1","quantity":"10"},{"name":"product 1","photo":"https:\/\/picsum.photos\/150\/150","price":"200","productid":"1","quantity":"2"}]
          input : userid
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['productid']) == true) {
    $sql = 'SELECT p.* , c.name as category_name from saloon_product p , saloon_category c where p.id = ? and  p.categoryid = c.id ';
    $stat = $db->prepare($sql);
    $stat->setFetchMode(PDO::FETCH_ASSOC);
    $stat->bindParam(1, $input['productid']);
    $stat->execute();
    $table = $stat->fetchAll();
    // var_dump($table);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => sizeof($table)]);
    array_push($response, ['data' => $table]);
} elseif (isset($input['categoryid'])) {
    $sql =
        'SELECT p.* , c.name as category_name from saloon_product p , saloon_category c where p.categoryid = ? and  p.categoryid = c.id ';
    $stat = $db->prepare($sql);
    $stat->setFetchMode(PDO::FETCH_ASSOC);
    $stat->bindParam(1, $input['categoryid']);
    $stat->execute();
    $table = $stat->fetchAll();
    // var_dump($table);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => sizeof($table)]);
    array_push($response, ['data' => $table]);
} else {
    $sql =
        'SELECT p.* , c.name as category_name from saloon_product p , saloon_category c where p.categoryid = c.id';
    $stat = $db->prepare($sql);
    $stat->setFetchMode(PDO::FETCH_ASSOC);
    $stat->execute();
    $table = $stat->fetchAll();
    // var_dump($table);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => sizeof($table)]);
    array_push($response, ['data' => $table]);
}
echo json_encode($response);
?>
