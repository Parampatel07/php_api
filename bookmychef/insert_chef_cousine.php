<?php
/*
    usage: Used to insert chef-cuisine relationships into the database
    how to call: http://localhost/api/bookmychef/insert_chef_cousine.php?chefid=1&courseid=2
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Chef cuisine relationship inserted successfully"}]
    input: chefid, courseid (required)
*/
require_once 'connection.php'; // Include your database connection script
$response = [];
$input = $_REQUEST;

// Check if all required input fields are provided
if (isset($input['chefid'], $input['courseid'])) {
    // Prepare the SQL query
    $sql = 'INSERT INTO chef_cousine (chefid, courseid) VALUES (?, ?)';
    $stat = $db->prepare($sql);

    // Bind parameters and execute the query
    $stat->bindparam(1, $input['chefid']);
    $stat->bindparam(2, $input['courseid']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Chef cuisine relationship inserted successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to insert chef cuisine relationship']);
    }
} else {
    // If any required input is missing
    array_push($response, ['error' => 'input is missing']);
}

// Encode response as JSON and output
echo json_encode($response);
?>
