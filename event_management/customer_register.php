<?php
/*
     usage: to register for customer 
     how to call : http://localhost/api/event_management/customer_register.php?email=param1@gmail.com&password=987987&name=param&mobile=9874563210
     output :
     [{"error":"input is missing"}] 
     [{"error":"no"},{"success":"no"},{message:"Invalid register attempt"}]
     [{"error":"no"},{"success":"yes"},{message:"register successful "}]
     input : email,password(required) 
     */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['email'],
        $input['password'],
        $input['name'],
        $input['mobile']
    ) == false
) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    $sql = 'SELECT id from customer where email = ? ';
    $stat = $db->prepare($sql);
    $stat->setFetchMode(PDO::FETCH_ASSOC);
    $stat->bindparam(1, $input['email']);
    $stat->execute();
    $count = $stat->rowCount();
    if ($count > 0) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Email already exists ']);
    } else {
        // continue
        $sql =
            'INSERT INTO customer (email, password , name , mobile) VALUES (?, ? , ? , ?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['email']);
        $stat->bindparam(2, $input['password']);
        $stat->bindparam(3, $input['name']);
        $stat->bindparam(4, $input['mobile']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Register Successful ']);
    }
}
echo json_encode($response);
?>
