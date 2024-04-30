<?php
/*
    update cousine 
    how to call : http://localhost/api/bookmychef/update_cousine.php?cousineid=1&title=Italian1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"cousine updated successfully"}]
    input : cousineid, title (required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['cousineid'], $input['title']) == false) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'UPDATE cousine SET title=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['title']);
        $stat->bindparam(2, $input['cousineid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'cousine updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt']);
    }
}
echo json_encode($response);
?>
