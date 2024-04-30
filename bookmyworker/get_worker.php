<?php
/*
    usage: to get worker_worker 
    how to call : http://localhost/api/bookmyworker/get_worker.php
    how to call : http://localhost/api/bookmyworker/get_worker.php?id=1
    input : two possibilities 
    1 ] without input 
    2 ] with id 
*/

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql = 'SELECT * FROM worker_worker WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } else {
        $sql = 'SELECT * FROM worker_worker';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $worker_worker = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($worker_worker)]);
    array_push($response, ['data' => $worker_worker]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);

?>
