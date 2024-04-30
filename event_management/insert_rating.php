<?php
/*
    usage: to insert rating_review 
    how to call : http://localhost/api/event_management/insert_rating.php?eventid=1&rating=1&reviews=reviews
    input : eventid, rating, reviews
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['eventid'], $input['rating'], $input['reviews']) == false) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'INSERT into rating_review (eventid , rating , reviews) VALUES (?,?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['eventid']);
        $stat->bindparam(2, $input['rating']);
        $stat->bindparam(3, $input['reviews']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Rating and Review inserted successfully',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Attempt ']);
    }
}
echo json_encode($response);
?>
