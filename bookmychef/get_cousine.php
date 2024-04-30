<?php
/*
    usage: to get cousine 
    how to call : http://localhost/api/bookmychef/get_cousine.php
    how to call : http://localhost/api/bookmychef/get_cousine.php?id=1
    input : two possibilities 
    1 ] without input 
    2 ] with id 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql = 'SELECT * FROM cousine WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } else {
        $sql = 'SELECT * FROM cousine';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $cousine = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($cousine)]);
    array_push($response, ['data' => $cousine]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
