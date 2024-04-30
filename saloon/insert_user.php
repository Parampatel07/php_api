<?php
/*
        insert user 
        how to call : http://localhost/api/saloon/insert_user.php?email=user@example.com&password=password&mobile=1234567890&name=User
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"User inserted successfully"}]
        input : email,password,mobile,name(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
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
            'INSERT INTO saloon_user (email, password, mobile, name) VALUES (?,?,?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['email']);
        $stat->bindparam(2, $input['password']);
        $stat->bindparam(3, $input['mobile']);
        $stat->bindparam(4, $input['name']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'User inserted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);