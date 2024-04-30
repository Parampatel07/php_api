<?php
/*
    usage: to get rating_review 
    how to call : http://localhost/api/event_management/get_review_rating.php
    how to call : http://localhost/api/event_management/get_review_rating.php?id=1
    how to call : http://localhost/api/event_management/get_review_rating.php?eventid=1
    input : three possibilities 
    1 ] without input 
    2 ] with id 
    3 ] with eventid 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql = 'SELECT * FROM rating_review WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } elseif (isset($input['eventid'])) {
        $sql = 'SELECT * FROM rating_review WHERE eventid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['eventid']);
    } else {
        $sql = 'SELECT * FROM rating_review';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $rating_review = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($rating_review)]);
    array_push($response, ['data' => $rating_review]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
