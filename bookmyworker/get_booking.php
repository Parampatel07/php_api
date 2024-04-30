<?php
/*
    usage: to get worker_booking 
    how to call : http://localhost/api/bookmyworker/get_booking.php
    how to call : http://localhost/api/bookmyworker/get_booking.php?id=2
    how to call : http://localhost/api/bookmyworker/get_booking.php?workerid=2
    how to call : http://localhost/api/bookmyworker/get_booking.php?userid=2
    input : four possibilities 
    1 ] without input 
    2 ] with id 
    3 ] with workerid 
    4] with userid 
*/

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql =
            'SELECT worker_booking.*, worker_worker.name as worker_name, worker_user.name as user_name FROM worker_booking LEFT JOIN worker_worker ON worker_booking.workerid = worker_worker.id LEFT JOIN worker_user ON worker_booking.userid = worker_user.id WHERE worker_booking.id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } elseif (isset($input['workerid'])) {
        $sql =
            'SELECT worker_booking.*, worker_worker.name as worker_name, worker_user.name as user_name FROM worker_booking LEFT JOIN worker_worker ON worker_booking.workerid = worker_worker.id LEFT JOIN worker_user ON worker_booking.userid = worker_user.id WHERE worker_booking.workerid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['workerid']);
    } elseif (isset($input['userid'])) {
        $sql =
            'SELECT worker_booking.*, worker_worker.name as worker_name, worker_user.name as user_name FROM worker_booking LEFT JOIN worker_worker ON worker_booking.workerid = worker_worker.id LEFT JOIN worker_user ON worker_booking.userid = worker_user.id WHERE worker_booking.userid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['userid']);
    } else {
        $sql =
            'SELECT worker_booking.*, worker_worker.name as worker_name, worker_user.name as user_name FROM worker_booking LEFT JOIN worker_worker ON worker_booking.workerid = worker_worker.id LEFT JOIN worker_user ON worker_booking.userid = worker_user.id';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $worker_booking = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($worker_booking)]);
    array_push($response, ['data' => $worker_booking]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);

?>
