<?php
/*
    update worker_admin 
    how to call : http://localhost/api/bookmyworker/update_admin.php?adminid=2&username=newadmin&password=newpass&email=newadmin@example.com
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Admin updated successfully"}]
    input : adminid, username, password, email (all required) 
*/

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['adminid'],
        $input['username'],
        $input['password'],
        $input['email']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE worker_admin SET username = ?, password = ?, email = ? WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['username']);
        $stat->bindparam(2, $input['password']);
        $stat->bindparam(3, $input['email']);
        $stat->bindparam(4, $input['adminid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Admin updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);

?>
