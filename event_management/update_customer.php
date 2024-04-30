<?php
/*
    usage: to update a customer 
    how to call : http://localhost/api/event_management/update_customer.php?customerid=1&name=Name&email=Email@gmail.com&mobile=9874563210&password=123123
    input : customerid, name, email, mobile, password (required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['customerid'],
        $input['name'],
        $input['email'],
        $input['mobile'],
        $input['password']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE customer SET name=?, email=?, mobile=?, password=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['name']);
        $stat->bindparam(2, $input['email']);
        $stat->bindparam(3, $input['mobile']);
        $stat->bindparam(4, $input['password']);
        $stat->bindparam(5, $input['customerid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Customer updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
