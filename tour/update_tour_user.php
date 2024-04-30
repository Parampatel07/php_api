<?php
/*
    Usage: Used to update a tour user
    How to call: http://localhost/api/tour/update_tour_user.php?id=2&usertype=Admin&username=JohnDoe&password=123456&email=johndoe@example.com
    Output:
    [{"error":"input is missing"}]
    [{"message":"Tour user updated successfully"}]
    Input: id, usertype, username, password, email (all required)
*/
require_once 'connection.php';
$input = $_REQUEST;
if (isset($input['id'], $input['usertype'], $input['username'], $input['password'], $input['email'])) {
    $sql = 'UPDATE tour_user SET usertype = ?, username = ?, password = ?, email = ? WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['usertype']);
    $stat->bindParam(2, $input['username']);
    $stat->bindParam(3, $input['password']);
    $stat->bindParam(4, $input['email']);
    $stat->bindParam(5, $input['id']);
    $stat->execute();
    echo json_encode(['message' => 'Tour user updated successfully']);
} else {
    echo json_encode(['error' => 'Input is missing']);
}
?>