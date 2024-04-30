<?php
/*
    usage: Used to insert a new user into the database
    how to call: http://localhost/api/bookmychef/user_register.php?name=John&username=johndoe&password=123456&email=johndoe@example.com&mobileno=1234567890&cityid=3&address=123 Street
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"User inserted successfully"}]
    input: name, username, password, email, mobileno, city, address (required)
*/
require_once 'connection.php'; // Include your database connection script
$response = [];
$input = $_REQUEST;

// Check if all required input fields are provided
if (
    isset(
        $input['name'],
        $input['username'],
        $input['password'],
        $input['email'],
        $input['mobileno'],
        $input['cityid'],
        $input['address']
    )
) {
    // Prepare the SQL query
    $sql =
        'INSERT INTO user (name, username, password, email, mobileno, city, address) VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stat = $db->prepare($sql);

    // Bind parameters and execute the query
    $stat->bindparam(1, $input['name']);
    $stat->bindparam(2, $input['username']);
    $stat->bindparam(3, $input['password']);
    $stat->bindparam(4, $input['email']);
    $stat->bindparam(5, $input['mobileno']);
    $stat->bindparam(6, $input['cityid']);
    $stat->bindparam(7, $input['address']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'User inserted successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to insert user']);
    }
} else {
    // If any required input is missing
    array_push($response, ['error' => 'input is missing']);
}

// Encode response as JSON and output
echo json_encode($response);
?>
