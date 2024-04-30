<?php
/*
    usage: to get theme_album 
    how to call : http://localhost/api/event_management/get_theme_album.php
    how to call : http://localhost/api/event_management/get_theme_album.php?id=1
    how to call : http://localhost/api/event_management/get_theme_album.php?themeid=1
    input : three possibilities 
    1 ] without input 
    2 ] with id 
    3 ] with themeid 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql = 'SELECT * FROM theme_album WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } elseif (isset($input['themeid'])) {
        $sql = 'SELECT * FROM theme_album WHERE themeid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['themeid']);
    } else {
        $sql = 'SELECT * FROM theme_album';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $theme_album = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($theme_album)]);
    array_push($response, ['data' => $theme_album]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
