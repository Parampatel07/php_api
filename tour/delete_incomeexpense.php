<?php
/*
    Usage: Used to delete an income or expense entry from the tour_incomeExpense table

    How to call: http://localhost/api/tour/delete_incomeexpense.php?incomeexpenseid=1

    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Income and expense entry deleted successfully"}]

    Input: incomeexpenseid (required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (isset($input['incomeexpenseid']) == false) {
    array_push($response, ['error' => 'Input is missing']);
} else {
    try {
        $sql = 'DELETE FROM tour_incomeExpense WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindParam(1, $input['incomeexpenseid']);
        $stat->execute();

        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Income and expense entry deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}

echo json_encode($response);
?>