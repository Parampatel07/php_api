<?php
/*
    usage: used to add a new income or expense entry for a tour

    how to call: http://localhost/api/tour/add_incomeexpense.php?tourid=1&income=1000&expense=500

    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"income and expense entry added successfully"}]

    input: tourid, income, expense (all required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (
    isset(
        $input['tourid'],
        $input['income'],
        $input['expense']
    )
) {
    $sql = 'insert into tour_incomeexpense (tourid, income, expense) values (?, ?, ?)';
    $stat = $db->prepare($sql);
    $stat->bindparam(1, $input['tourid']);
    $stat->bindparam(2, $input['income']);
    $stat->bindparam(3, $input['expense']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'income and expense entry added successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'failed to add income and expense entry']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>