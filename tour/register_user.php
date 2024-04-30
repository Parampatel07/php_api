<?php
/*
    usage: used to register a new user (tour operator or customer) into the database

    how to call: http://localhost/api/tour/register_user.php?usertype=tour%20operator&username=johndoe&password=123456&email=john.doe@example.com

    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"user registered successfully"}]

    input: usertype, username, password, email (all required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (
    isset(
        $input['usertype'],
        $input['username'],
        $input['password'],
        $input['email']
    )
) {
    $sql =
        'insert into tour_user (usertype, username, password, email) values (?, ?, ?, ?)';
    $stat = $db->prepare($sql);
    $stat->bindparam(1, $input['usertype']);
    $stat->bindparam(2, $input['username']);
    $stat->bindparam(3, $input['password']);
    $stat->bindparam(4, $input['email']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'user registered successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'failed to register user']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>
