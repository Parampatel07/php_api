<?php
/*
    usage: to get reminder 
    how to call : http://localhost/api/homework/get_   reminder.php
    how to call : http://localhost/api/homework/get_reminder.php?id=1
    how to call : http://localhost/api/homework/get_reminder.php?standardid=1
    how to call : http://localhost/api/homework/get_reminder.php?teacherid=1
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
            'SELECT r.*, s.name as standard_name, t.email as teacher_email FROM reminder r JOIN standard s ON r.standardid = s.id JOIN teacher t ON r.teacherid = t.id WHERE r.id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } elseif (isset($input['standardid'])) {
        $sql =
            'SELECT r.*, s.name as standard_name, t.email as teacher_email FROM reminder r JOIN standard s ON r.standardid = s.id JOIN teacher t ON r.teacherid = t.id WHERE r.standardid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['standardid']);
    } elseif (isset($input['teacherid'])) {
        $sql =
            'SELECT r.*, s.name as standard_name, t.email as teacher_email FROM reminder r JOIN standard s ON r.standardid = s.id JOIN teacher t ON r.teacherid = t.id WHERE r.teacherid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['teacherid']);
    } else {
        $sql =
            'SELECT r.*, s.name as standard_name, t.email as teacher_email FROM reminder r JOIN standard s ON r.standardid = s.id JOIN teacher t ON r.teacherid = t.id';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $reminder = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($reminder)]);
    array_push($response, ['data' => $reminder]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
