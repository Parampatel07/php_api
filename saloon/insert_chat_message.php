<?php
/*
        insert chat message 
        how to call : http://localhost/api/saloon/insert_chat_message.php?userid=1&content=Hello%20World
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Chat message inserted successfully"}]
        input : userid,content(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['userid'],
        $input['content']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'INSERT INTO saloon_chat_message (userid, content) VALUES (?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['userid']);
        $stat->bindparam(2, $input['content']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Chat message inserted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);