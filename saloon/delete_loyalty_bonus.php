<?php
/*
        delete loyalty bonus 
        how to call : http://localhost/api/saloon/delete_loyalty_bonus.php?bonusid=1
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Loyalty bonus deleted successfully"}]
        input : bonusid(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['bonusid']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'DELETE FROM saloon_loyalty_bonus WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['bonusid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Loyalty bonus deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);