<?php
/*
          usage: to get appointment 
          how to call : http://localhost/api/saloon/get_loyalty_bonus.php
          how to call : http://localhost/api/saloon/get_loyalty_bonus.php?userid=1
          how to call : http://localhost/api/saloon/get_loyalty_bonus.php?bonusid=1
          how to call : http://localhost/api/saloon/get_loyalty_bonus.php?last_redeemed_date=2004-10-02
          input : three possibllity 
          1 ] without input 
          2 ] with userid 
          3 ] with last redeemed date 
          4] bonusid 
          [{"error":"input is missing"}] 
          [{"error":"no"},{"success":"yes"},{"name":"product 1","photo":"https:\/\/picsum.photos\/150\/150","price":"200","productid":"1","quantity":"10"},{"name":"product 1","photo":"https:\/\/picsum.photos\/150\/150","price":"200","productid":"1","quantity":"2"}]
          input : userid
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['last_redeemed_date']) == true) {
    $sql =
        'SELECT lb.* , u.name as user_name from saloon_loyalty_bonus lb , saloon_user u where lb.last_redeemed_date = ? and lb.userid = u.id';
    $stat = $db->prepare($sql);
    $stat->setFetchMode(PDO::FETCH_ASSOC);
    $stat->bindParam(1, $input['last_redeemed_date']);
    $stat->execute();
    $table = $stat->fetchAll();
    // var_dump($table);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => sizeof($table)]);
    array_push($response, ['data' => $table]);
} elseif (isset($input['userid']) == true) {
    $sql =
        'SELECT lb.* , u.name as user_name from saloon_loyalty_bonus lb , saloon_user u where lb.userid = ? and lb.userid = u.id ';
    $stat = $db->prepare($sql);
    $stat->setFetchMode(PDO::FETCH_ASSOC);
    $stat->bindParam(1, $input['userid']);
    $stat->execute();
    $table = $stat->fetchAll();
    // var_dump($table);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => sizeof($table)]);
    array_push($response, ['data' => $table]);
} elseif (isset($input['bonusid'])) {
    $sql = 'SELECT lb.* , u.name as user_name from saloon_loyalty_bonus lb , saloon_user u where lb.id = ? and lb.userid = u.id';
    $stat = $db->prepare($sql);
    $stat->setFetchMode(PDO::FETCH_ASSOC);
    $stat->bindParam(1, $input['bonusid']);
    $stat->execute();
    $table = $stat->fetchAll();
    // var_dump($table);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => sizeof($table)]);
    array_push($response, ['data' => $table]);
} else {
    $sql =
        'SELECT lb.* , u.name as user_name from saloon_loyalty_bonus lb , saloon_user u where lb.userid = u.id';
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
