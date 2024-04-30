<?php
/*
    usage: to get announcement 
    how to call : http://localhost/api/homework/get_announcement.php
    how to call : http://localhost/api/homework/get_announcement.php?id=1
    how to call : http://localhost/api/homework/get_announcement.php?standardid=1
    how to call : http://localhost/api/homework/get_announcement.php?teacherid=1
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
            'SELECT a.*, t.email as teacher_email , s.name as standard_name FROM announcement a JOIN teacher t ON a.teacherid = t.id JOIN standard s ON a.standardid = s.id WHERE a.id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } elseif (isset($input['standardid'])) {
        $sql =
            'SELECT a.*, t.email as teacher_email, s.name as standard_name FROM announcement a JOIN teacher t ON a.teacherid = t.id JOIN standard s ON a.standardid = s.id WHERE a.standardid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['standardid']);
    } elseif (isset($input['teacherid'])) {
        $sql =
            'SELECT a.*, t.email as teacher_email, s.name as standard_name FROM announcement a JOIN teacher t ON a.teacherid = t.id JOIN standard s ON a.standardid = s.id WHERE a.teacherid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['teacherid']);
    } else {
        $sql =
            'SELECT a.*, t.email as teacher_email, s.name as standard_name FROM announcement a JOIN teacher t ON a.teacherid = t.id JOIN standard s ON a.standardid = s.id';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $announcement = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($announcement)]);
    array_push($response, ['data' => $announcement]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
