<?php
/*
        usage: used to login as chef 
        how to call : http://localhost/api/bookmychef/chef_login.php?email=chef@example.com&password=123123
        output :
        [{"error":"input is missing"}] 
         [{"error":"no"},{"success":"no"},{"message":"invalid login attempt"}]
        [{"error":"no"},{"success":"yes"},{"message":"login successful"},{"id":"3"}]
        input : email,password(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['email'], $input['password']) == false) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    $sql = 'SELECT password,id from chef where email = ? ';
    $stat = $db->prepare($sql);
    $stat->setFetchMode(PDO::FETCH_ASSOC);
    $stat->bindparam(1, $input['email']);
    $stat->execute();
    $row = $stat->fetch();
    $count = $stat->rowCount();
    if ($count == 0) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Login Attempt ']);
    } else {
        if ($input['password'] == $row['password']) {
            //password matched
            array_push($response, ['error' => 'no']);
            array_push($response, ['success' => 'yes']);
            array_push($response, ['chefid' => $row['id']]);
            array_push($response, ['message' => 'Login Successfull ']);
        } else {
            array_push($response, ['error' => 'no']);
            array_push($response, ['success' => 'no']);
            array_push($response, ['message' => 'Invalid Login Attempt ']);
        }
    }
}
echo json_encode($response);
?>
