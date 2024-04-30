<?php
/*
    usage: to get chef_cousine 
    how to call : http://localhost/api/bookmychef/get_chef_cousine.php
    how to call : http://localhost/api/bookmychef/get_chef_cousine.php?id=1
    how to call : http://localhost/api/bookmychef/get_chef_cousine.php?chefid=1
    how to call : http://localhost/api/bookmychef/get_chef_cousine.php?courseid=1
    input : four possibilities 
    1 ] without input 
    2 ] with id 
    3 ] with chefid 
    4] with courseid 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql = 'SELECT * FROM chef_cousine WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } elseif (isset($input['chefid'])) {
        $sql = 'SELECT * FROM chef_cousine WHERE chefid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['chefid']);
    } elseif (isset($input['courseid'])) {
        $sql = 'SELECT * FROM chef_cousine WHERE courseid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['courseid']);
    } else {
        $sql = 'SELECT * FROM chef_cousine';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $chef_cousine = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($chef_cousine)]);
    array_push($response, ['data' => $chef_cousine]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
