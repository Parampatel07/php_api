<?php
/*
    usage: Used to insert a new city into the database
    how to call: http://localhost/api/bookmychef/insert_city.php?title=New%20York
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"City inserted successfully"}]
    input: title (required)
*/
require_once 'connection.php'; // Include your database connection script
$response = [];
$input = $_REQUEST;

// Check if all required input fields are provided
if (isset($input['title'])) {
    // Prepare the SQL query
    $sql = 'INSERT INTO city (title) VALUES (?)';
    $stat = $db->prepare($sql);

    // Bind parameters and execute the query
    $stat->bindparam(1, $input['title']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'City inserted successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to insert city']);
    }
} else {
    // If any required input is missing
    array_push($response, ['error' => 'input is missing']);
}

// Encode response as JSON and output
echo json_encode($response);
?>
