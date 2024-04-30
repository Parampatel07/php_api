<?php
/*
    update principal 
    how to call : http://localhost/api/homework/update_principal.php?principalid=1&email=principle@gmail.com&password=123456&mobileno=1234567890
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Principal updated successfully"}]
    input : principalid, email, password, mobileno (all required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['principalid'],
        $input['email'],
        $input['password'],
        $input['mobileno']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE principal SET email=?, password=?, mobileno=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['email']);
        $stat->bindparam(2, $input['password']);
        $stat->bindparam(3, $input['mobileno']);
        $stat->bindparam(4, $input['principalid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Principal updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt']);
    }
}
echo json_encode($response);
?>
