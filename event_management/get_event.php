<?php
/*
    usage: to get event 
    how to call : http://localhost/api/event_management/get_event.php
    how to call : http://localhost/api/event_management/get_event.php?id=1
    input : two possibilities 
    1 ] without input 
    2 ] with id 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql = 'SELECT * FROM event WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } else {
        $sql = 'SELECT * FROM event';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $event = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($event)]);
    array_push($response, ['data' => $event]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
