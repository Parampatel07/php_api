<?php
/*
    update standard 
    how to call : http://localhost/api/homework/update_standard.php?standardid=1&name=10th%20Grade&medium=English
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Standard updated successfully"}]
    input : standardid, name, medium (all required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['standardid'], $input['name'], $input['medium']) == false) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'UPDATE standard SET name=?, medium=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['name']);
        $stat->bindparam(2, $input['medium']);
        $stat->bindparam(3, $input['standardid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Standard updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt']);
    }
}
echo json_encode($response);
?>
