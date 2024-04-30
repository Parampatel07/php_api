<?php
/*
    usage: to delete a theme_album 
    how to call : http://localhost/api/event_management/delete_theme_album.php?id=1
    input : id
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['id']) == false) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'DELETE FROM theme_album WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Theme Album Deleted successfully ',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Delete Attempt ']);
    }
}
echo json_encode($response);
?>
