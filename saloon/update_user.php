<?php
/*
        update user 
        how to call : http://localhost/api/saloon/update_user.php?userid=1&email=user121212@example.com&password=password&mobile=1234567890&name=User
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"User updated successfully"}]
        input : userid,email,password,mobile,name(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['userid'],
        $input['email'],
        $input['password'],
        $input['mobile'],
        $input['name']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE saloon_user SET email=?, password=?, mobile=?, name=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['email']);
        $stat->bindparam(2, $input['password']);
        $stat->bindparam(3, $input['mobile']);
        $stat->bindparam(4, $input['name']);
        $stat->bindparam(5, $input['userid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'User updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);