<?php
/*
    update user 
    how to call : http://localhost/api/bookmychef/update_user.php?userid=1&name=John&username=john123&password=test&email=john@test.com&mobileno=1234567890&city=City1&address=Street1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"User updated successfully"}]
    input : userid, name, username, password, email, mobileno, city, address (required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['userid'],
        $input['name'],
        $input['username'],
        $input['password'],
        $input['email'],
        $input['mobileno'],
        $input['city'],
        $input['address']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE user SET name=?, username=?, password=?, email=?, mobileno=?, city=?, address=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['name']);
        $stat->bindparam(2, $input['username']);
        $stat->bindparam(3, $input['password']);
        $stat->bindparam(4, $input['email']);
        $stat->bindparam(5, $input['mobileno']);
        $stat->bindparam(6, $input['city']);
        $stat->bindparam(7, $input['address']);
        $stat->bindparam(8, $input['userid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'User updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt']);
    }
}
echo json_encode($response);
?>
