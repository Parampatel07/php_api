<?php
/*
        delete chat message 
        how to call : http://localhost/api/saloon/delete_chat_message.php?messageid=1
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Chat message deleted successfully"}]
        input : messageid(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['messageid']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'DELETE FROM saloon_chat_message WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['messageid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Chat message deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);