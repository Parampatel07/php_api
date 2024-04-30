<?php
/*
    Usage: Used to delete a message from the tour_message table

    How to call: http://localhost/api/tour/delete_message.php?messageid=1

    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Message deleted successfully"}]

    Input: messageid (required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (isset($input['messageid']) == false) {
    array_push($response, ['error' => 'Input is missing']);
} else {
    try {
        $sql = 'DELETE FROM tour_message WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindParam(1, $input['messageid']);
        $stat->execute();

        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Message deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}

echo json_encode($response);
?>