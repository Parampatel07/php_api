<?php
/*
        usage: get chat message 
        how to call : http://localhost/api/saloon/get_customer_ticket.php?ticketid=1
        how to call : http://localhost/api/saloon/get_customer_ticket.php?userid=1
        how to call : http://localhost/api/saloon/get_customer_ticket.php
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
if (isset($input['ticketid']) == true) {
    try {
        $ticketid = $input['ticketid'];
        $sql =
            'SELECT cs.* , u.name as user_name from saloon_customer_support_ticket cs , saloon_user u where cs.id = ?  and u.id = cs.userid';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $ticketid);
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
            'SELECT cs.* , u.name as user_name from saloon_customer_support_ticket cs , saloon_user u where cs.userid = ?  and u.id = cs.userid';
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
            'SELECT cs.* , u.name as user_name from saloon_customer_support_ticket cs , saloon_user u where u.id = cs.userid';
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
