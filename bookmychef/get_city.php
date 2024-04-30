<?php
/*
    usage: to get city 
    how to call : http://localhost/api/bookmychef/get_city.php
    how to call : http://localhost/api/bookmychef/get_city.php?id=1
    input : two possibilities 
    1 ] without input 
    2 ] with id 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql = 'SELECT * FROM city WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } else {
        $sql = 'SELECT * FROM city';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $city = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($city)]);
    array_push($response, ['data' => $city]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
