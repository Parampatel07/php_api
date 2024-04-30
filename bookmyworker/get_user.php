<?php
/*
    usage: to get worker_user 
    how to call : http://localhost/api/bookmyworker/get_user.php
    how to call : http://localhost/api/bookmyworker/get_user.php?id=2
    input : two possibilities 
    1 ] without input 
    2 ] with id 
*/

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql = 'SELECT * FROM worker_user WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } else {
        $sql = 'SELECT * FROM worker_user';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $worker_user = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($worker_user)]);
    array_push($response, ['data' => $worker_user]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);

?>
