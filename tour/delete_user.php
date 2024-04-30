<?php
/*
    Usage: Used to delete a user from the tour_user table

    How to call: http://localhost/api/tour/delete_user.php?userid=1

    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"User deleted successfully"}]

    Input: userid (required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (isset($input['userid']) == false) {
    array_push($response, ['error' => 'Input is missing']);
} else {
    try {
        $sql = 'DELETE FROM tour_user WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindParam(1, $input['userid']);
        $stat->execute();

        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'User deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}

echo json_encode($response);
?>