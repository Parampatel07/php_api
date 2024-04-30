<?php
/*
    usage: to get service 
    how to call : http://localhost/api/bookmychef/get_service.php
    how to call : http://localhost/api/bookmychef/get_service.php?id=1
    how to call : http://localhost/api/bookmychef/get_service.php?chefid=1
    how to call : http://localhost/api/bookmychef/get_service.php?userid=1
    how to call : http://localhost/api/bookmychef/get_service.php?cookingdate=2004-10-02
    how to call : http://localhost/api/bookmychef/get_service.php?paymentstatus=1
    how to call : http://localhost/api/bookmychef/get_service.php?orderstatus=1
    how to call : http://localhost/api/bookmychef/get_service.php?cityid=1
    input : eight possibilities 
    1 ] without input 
    2 ] with id 
    3 ] with chefid 
    4] with userid 
    5] with cookingdate 
    6] with paymentstatus 
    7] with orderstatus 
    8] with cityid 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql = 'SELECT * FROM service WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } elseif (isset($input['chefid'])) {
        $sql = 'SELECT * FROM service WHERE chefid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['chefid']);
    } elseif (isset($input['userid'])) {
        $sql = 'SELECT * FROM service WHERE userid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['userid']);
    } elseif (isset($input['cookingdate'])) {
        $sql = 'SELECT * FROM service WHERE cookingdate = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['cookingdate']);
    } elseif (isset($input['paymentstatus'])) {
        $sql = 'SELECT * FROM service WHERE paymentstatus = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['paymentstatus']);
    } elseif (isset($input['orderstatus'])) {
        $sql = 'SELECT * FROM service WHERE orderstatus = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['orderstatus']);
    } elseif (isset($input['cityid'])) {
        $sql = 'SELECT * FROM service WHERE cityid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['cityid']);
    } else {
        $sql = 'SELECT * FROM service';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $service = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($service)]);
    array_push($response, ['data' => $service]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
