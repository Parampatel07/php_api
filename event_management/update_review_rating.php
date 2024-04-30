<?php
/*
    usage: to update a rating_review 
    how to call : http://localhost/api/event_management/update_review_rating.php?reviewid=1&eventid=1&rating=1&reviews=Reviews
    input : reviewid, eventid, rating, reviews (required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['reviewid'],
        $input['eventid'],
        $input['rating'],
        $input['reviews']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE rating_review SET eventid=?, rating=?, reviews=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['eventid']);
        $stat->bindparam(2, $input['rating']);
        $stat->bindparam(3, $input['reviews']);
        $stat->bindparam(4, $input['reviewid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Rating and Review updated successfully',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
