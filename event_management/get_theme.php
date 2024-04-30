<?php
/*
    usage: to get theme 
    how to call : http://localhost/api/event_management/get_theme.php
    how to call : http://localhost/api/event_management/get_theme.php?id=1
    input : two possibilities 
    1 ] without input 
    2 ] with id 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['id'])) {
        $sql = 'SELECT * FROM theme WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['id']);
    } else {
        $sql = 'SELECT * FROM theme';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $theme = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($theme)]);
    array_push($response, ['data' => $theme]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
