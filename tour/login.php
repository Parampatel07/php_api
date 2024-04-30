<?php
/*
    Usage: Used for user login

    How to call: http://localhost/api/tour/login.php?username=johndoe&password=123456

    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Login successful","user_data":{...}}]
    [{"error":"yes"},{"success":"no"},{"message":"Invalid username or password"}]

    Input: username, password (all required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (isset($input['username'], $input['password'])) {
    $sql = 'SELECT * FROM tour_user WHERE username = ? AND password = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['username']);
    $stat->bindParam(2, $input['password']);
    $stat->execute();
    $user = $stat->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['user_id' => $user['id']]);
        array_push($response, ['message' => 'Login successful']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid username or password']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>