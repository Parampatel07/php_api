<?php
/*
    delete chef cousine 
    how to call : http://localhost/api/bookmychef/delete_chef_cousine.php?chefcousineid=1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Chef cousine deleted successfully"}]
    input : chefcousineid(required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['chefcousineid']) == false) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'DELETE FROM chef_cousine WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['chefcousineid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Chef cousine deleted successfully',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
