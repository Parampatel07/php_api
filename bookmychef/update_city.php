<?php
/*
    update city 
    how to call : http://localhost/api/bookmychef/update_city.php?cityid=1&title=NewCity1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"City updated successfully"}]
    input : cityid, title (required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['cityid'], $input['title']) == false) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'UPDATE city SET title=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['title']);
        $stat->bindparam(2, $input['cityid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'City updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt']);
    }
}
echo json_encode($response);
?>
