<?php
/*
    usage: Used to insert a new admin into the database
    how to call: http://localhost/api/bookmyworker/insert_admin.php?username=admin&password=1234&email=admin@example.com
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Admin inserted successfully"}]
    input: username, password, email (all required)
*/

require_once 'connection.php'; // Include your database connection script
$response = [];
$input = $_REQUEST;

// Check if all required input fields are provided for admin table
if (isset($input['username'], $input['password'], $input['email'])) {
    // Prepare the SQL query for admin table
    $sql = 'INSERT INTO worker_admin (username, password, email) VALUES (?, ?, ?)';
    $stat = $db->prepare($sql);

    // Bind parameters and execute the query
    $stat->bindparam(1, $input['username']);
    $stat->bindparam(2, $input['password']);
    $stat->bindparam(3, $input['email']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Admin inserted successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to insert admin']);
    }
} else {
    // If any required input is missing
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);

?>
