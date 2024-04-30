<?php
/*
    usage: to get student 
    how to call : http://localhost/api/homework/get_student.php
    how to call : http://localhost/api/homework/get_student.php?id=1
    how to call : http://localhost/api/homework/get_student.php?standardid=1
    input : three possibilities 
    1 ] without input 
    2 ] with id 
    3 ] with standardid 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql =
            'SELECT s.*, st.name as standard_name FROM student s JOIN standard st ON s.standardid = st.id WHERE s.id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } elseif (isset($input['standardid'])) {
        $sql =
            'SELECT s.*, st.name as standard_name FROM student s JOIN standard st ON s.standardid = st.id WHERE s.standardid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['standardid']);
    } else {
        $sql =
            'SELECT s.*, st.name as standard_name FROM student s JOIN standard st ON s.standardid = st.id';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $student = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($student)]);
    array_push($response, ['data' => $student]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
