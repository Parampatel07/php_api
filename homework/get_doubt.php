<?php
/*
    usage: to get doubt 
    how to call : http://localhost/api/homework/get_doubt.php
    how to call : http://localhost/api/homework/get_doubt.php?id=1
    how to call : http://localhost/api/homework/get_doubt.php?studentid=1
    how to call : http://localhost/api/homework/get_doubt.php?teacherid=1
    input : four possibilities 
    1 ] without input 
    2 ] with id 
    3 ] with studentid 
    4] with teacherid 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql =
            'SELECT d.*, s.fullname as student_name, t.email as teacher_email FROM doubt d JOIN student s ON d.studentid = s.id JOIN teacher t ON d.teacherid = t.id WHERE d.id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } elseif (isset($input['studentid'])) {
        $sql =
            'SELECT d.*, s.fullname as student_name, t.email as teacher_email FROM doubt d JOIN student s ON d.studentid = s.id JOIN teacher t ON d.teacherid = t.id WHERE d.studentid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['studentid']);
    } elseif (isset($input['teacherid'])) {
        $sql =
            'SELECT d.*, s.fullname as student_name, t.email as teacher_email FROM doubt d JOIN student s ON d.studentid = s.id JOIN teacher t ON d.teacherid = t.id WHERE d.teacherid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['teacherid']);
    } else {
        $sql =
            'SELECT d.*, s.fullname as student_name, t.email as teacher_email FROM doubt d JOIN student s ON d.studentid = s.id JOIN teacher t ON d.teacherid = t.id';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $doubt = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($doubt)]);
    array_push($response, ['data' => $doubt]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
