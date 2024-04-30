<?php
/*
    usage: to get worker_worker_service 
    how to call : http://localhost/api/bookmyworker/get_worker_service.php
    how to call : http://localhost/api/bookmyworker/get_worker_service.php?id=2
    how to call : http://localhost/api/bookmyworker/get_worker_service.php?workerid=2
    how to call : http://localhost/api/bookmyworker/get_worker_service.php?serviceid=2
    input : four possibilities 
    1 ] without input 
    2 ] with id 
    3 ] with workerid 
    4] with serviceid 
*/

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql =
            'SELECT worker_worker_service.*, worker_worker.name as worker_name, worker_service.title as service_name FROM worker_worker_service LEFT JOIN worker_worker ON worker_worker_service.workerid = worker_worker.id LEFT JOIN worker_service ON worker_worker_service.serviceid = worker_service.id WHERE worker_worker_service.id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } elseif (isset($input['workerid'])) {
        $sql =
            'SELECT worker_worker_service.*, worker_worker.name as worker_name, worker_service.title as service_name FROM worker_worker_service LEFT JOIN worker_worker ON worker_worker_service.workerid = worker_worker.id LEFT JOIN worker_service ON worker_worker_service.serviceid = worker_service.id WHERE worker_worker_service.workerid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['workerid']);
    } elseif (isset($input['serviceid'])) {
        $sql =
            'SELECT worker_worker_service.*, worker_worker.name as worker_name, worker_service.title as service_name FROM worker_worker_service LEFT JOIN worker_worker ON worker_worker_service.workerid = worker_worker.id LEFT JOIN worker_service ON worker_worker_service.serviceid = worker_service.id WHERE worker_worker_service.serviceid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['serviceid']);
    } else {
        $sql =
            'SELECT worker_worker_service.*, worker_worker.name as worker_name, worker_service.title as service_name FROM worker_worker_service LEFT JOIN worker_worker ON worker_worker_service.workerid = worker_worker.id LEFT JOIN worker_service ON worker_worker_service.serviceid = worker_service.id';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $worker_worker_service = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($worker_worker_service)]);
    array_push($response, ['data' => $worker_worker_service]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);

?>
