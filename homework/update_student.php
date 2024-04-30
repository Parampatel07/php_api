<?php
/*
    update student 
    how to call : http://localhost/api/homework/update_student.php?studentid=2&fullname=param%20patel&email=john.doe@example.com&password=123456&mobileno=1234567890&standardid=1&rollno=1&division=A
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Student updated successfully"}]
    input : studentid, fullname, email, password, mobileno, standardid, rollno, division (all required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['studentid'],
        $input['fullname'],
        $input['email'],
        $input['password'],
        $input['mobileno'],
        $input['standardid'],
        $input['rollno'],
        $input['division']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE student SET fullname=?, email=?, password=?, mobileno=?, standardid=?, rollno=?, division=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['fullname']);
        $stat->bindparam(2, $input['email']);
        $stat->bindparam(3, $input['password']);
        $stat->bindparam(4, $input['mobileno']);
        $stat->bindparam(5, $input['standardid']);
        $stat->bindparam(6, $input['rollno']);
        $stat->bindparam(7, $input['division']);
        $stat->bindparam(8, $input['studentid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Student updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt']);
    }
}
echo json_encode($response);
?>
