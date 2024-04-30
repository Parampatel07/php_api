<?php
/*
          usage: to get appointment 
          how to call : http://localhost/api/saloon/get_appointment.php
          how to call : http://localhost/api/saloon/get_appointment.php?userid=1
          how to call : http://localhost/api/saloon/get_appointment.php?appointmentid=1
          how to call : http://localhost/api/saloon/get_appointment.php?appointment_date=2004-10-02
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
if (isset($input['appointment_date']) == true) {
    $sql =
        'SELECT a.* , u.name as username  from saloon_appointment a , saloon_user u  where a.userid = u.id and appointment_date = ? ';
    $stat = $db->prepare($sql);
    $stat->setFetchMode(PDO::FETCH_ASSOC);
    $stat->bindParam(1, $input['appointment_date']);
    $stat->execute();
    $table = $stat->fetchAll();
    // var_dump($table);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => sizeof($table)]);
    array_push($response, ['data' => $table]);
} elseif (isset($input['userid']) == true) {
    $sql =
        'SELECT a.* , u.name as username  from saloon_appointment a , saloon_user u  where a.userid = u.id and a.userid = ? ';
    $stat = $db->prepare($sql);
    $stat->setFetchMode(PDO::FETCH_ASSOC);
    $stat->bindParam(1, $input['userid']);
    $stat->execute();
    $table = $stat->fetchAll();
    // var_dump($table);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => sizeof($table)]);
    array_push($response, ['data' => $table]);
} elseif (isset($input['appointmentid'])) {
    $sql =
        'SELECT a.* , u.name as username  from saloon_appointment a , saloon_user u  where a.userid = u.id and a.id = ? ';
    $stat = $db->prepare($sql);
    $stat->setFetchMode(PDO::FETCH_ASSOC);
    $stat->bindParam(1, $input['appointmentid']);
    $stat->execute();
    $table = $stat->fetchAll();
    // var_dump($table);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => sizeof($table)]);
    array_push($response, ['data' => $table]);
} else {
    $sql =
        'SELECT a.* , u.name as username  from saloon_appointment a , saloon_user u  where a.userid = u.id';
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
