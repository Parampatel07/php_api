<?php
/*
        usage: get chat message 
        how to call : http://localhost/api/saloon/get_chat_message.php?messageid=1
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"total":2,"data":[{"id":1,"userid":1,"content":"Hello World","timestamp":"2023-02-17 16:26:34","user_name":"John Doe"}],"message":"Chat message data found with userid"},
        {"error":"no"},{"total":2,"data":[{"id":1,"userid":1,"content":"Hello World","timestamp":"2023-02-17 16:26:34","user_name":"John Doe"},
        {"id":2,"userid":1,"content":"Hello Again","timestamp":"2023-02-17 16:26:34","user_name":"John Doe"}],"message":"Chat message data found"},
        {"error":"no"},{"total":0,"message":"No chat message data found"}
        ]
        input : messageid(optional) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['messageid']) == true) {
    try {
        $messageid = $input['messageid'];
        $sql =
            'SELECT cm.*, u.name as user_name from saloon_chat_message cm , saloon_user u where cm.id = ?  and cm.userid = u.id';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $messageid);
        $stat->execute();
        $result = $stat->fetchAll(PDO::FETCH_ASSOC);
        array_push($response, ['error' => 'no']);
        array_push($response, ['total' => sizeof($result)]);
        array_push($response, ['data' => $result]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['total' => 0]);
        array_push($response, ['message' => 'Invalid Request']);
    }
} elseif (isset($input['userid']) == true) {
    try {
        $userid = $input['userid'];
        $sql =
            'SELECT cm.*, u.name as user_name from saloon_chat_message cm , saloon_user u where cm.userid = ?  and cm.userid = u.id';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $userid);
        $stat->execute();
        $result = $stat->fetchAll(PDO::FETCH_ASSOC);
        array_push($response, ['error' => 'no']);
        array_push($response, ['total' => sizeof($result)]);
        array_push($response, ['data' => $result]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['total' => 0]);
        array_push($response, ['message' => 'Invalid Request']);
    }
} else {
    try {
        $sql =
            'SELECT cm.*, u.name as user_name from saloon_chat_message cm , saloon_user u where cm.userid = u.id';
        $stat = $db->prepare($sql);
        $stat->execute();
        $result = $stat->fetchAll(PDO::FETCH_ASSOC);
        array_push($response, ['error' => 'no']);
        array_push($response, ['total' => sizeof($result)]);
        array_push($response, ['data' => $result]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['total' => 0]);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
