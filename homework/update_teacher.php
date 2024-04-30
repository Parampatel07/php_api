<?php
/*
    update teacher 
    how to call : http://localhost/api/homework/update_teacher.php?teacherid=1&email=jane.doe@example.com&password=123456&mobileno=1234567890
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Teacher updated successfully"}]
    input : teacherid, email, password, mobileno (all required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['teacherid'],
        $input['email'],
        $input['password'],
        $input['mobileno']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'UPDATE teacher SET email=?, password=?, mobileno=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['email']);
        $stat->bindparam(2, $input['password']);
        $stat->bindparam(3, $input['mobileno']);
        $stat->bindparam(4, $input['teacherid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Teacher updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt']);
    }
}
echo json_encode($response);
?>
