<?php
/*
    usage: Used to insert a new worker service into the database
    how to call: http://localhost/api/bookmyworker/insert_worker_service.php?workerid=1&serviceid=1&area=area&charge=100&duration=60&details=details
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Worker service inserted successfully"}]
    input: workerid, serviceid, area, charge, duration, details (all required)
*/

require_once 'connection.php'; // Include your database connection script
$response = [];
$input = $_REQUEST;

// Check if all required input fields are provided for worker_worker_service table
if (
    isset(
        $input['workerid'],
        $input['serviceid'],
        $input['area'],
        $input['charge'],
        $input['duration'],
        $input['details']
    )
) {
    // Prepare the SQL query for worker_worker_service table
    $sql =
        'INSERT INTO worker_worker_service (workerid, serviceid, area, charge, duration, details) VALUES (?, ?, ?, ?, ?, ?)';
    $stat = $db->prepare($sql);

    // Bind parameters and execute the query
    $stat->bindparam(1, $input['workerid']);
    $stat->bindparam(2, $input['serviceid']);
    $stat->bindparam(3, $input['area']);
    $stat->bindparam(4, $input['charge']);
    $stat->bindparam(5, $input['duration']);
    $stat->bindparam(6, $input['details']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Worker service inserted successfully',
        ]);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to insert worker service']);
    }
} else {
    // If any required input is missing
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);

?>
