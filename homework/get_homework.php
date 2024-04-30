<?php
/*
    usage: to get homework 
    how to call : http://localhost/api/homework/get_homework.php
    how to call : http://localhost/api/homework/get_homework.php?id=1
    how to call : http://localhost/api/homework/get_homework.php?standardid=1
    how to call : http://localhost/api/homework/get_homework.php?teacherid=1
    input : four possibilities 
    1 ] without input 
    2 ] with id 
    3 ] with standardid 
    4] with teacherid 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql =
            'SELECT h.*, s.name as standard_name, t.email as teacher_email FROM homework h JOIN standard s ON h.standardid = s.id JOIN teacher t ON h.teacherid = t.id WHERE h.id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } elseif (isset($input['standardid'])) {
        $sql =
            'SELECT h.*, s.name as standard_name, t.email as teacher_email FROM homework h JOIN standard s ON h.standardid = s.id JOIN teacher t ON h.teacherid = t.id WHERE h.standardid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['standardid']);
    } elseif (isset($input['teacherid'])) {
        $sql =
            'SELECT h.*, s.name as standard_name, t.email as teacher_email FROM homework h JOIN standard s ON h.standardid = s.id JOIN teacher t ON h.teacherid = t.id WHERE h.teacherid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['teacherid']);
    } else {
        $sql =
            'SELECT h.*, s.name as standard_name, t.email as teacher_email FROM homework h JOIN standard s ON h.standardid = s.id JOIN teacher t ON h.teacherid = t.id';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $homework = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($homework)]);
    array_push($response, ['data' => $homework]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
