<?php
/*
        insert ticket 
        how to call : http://localhost/api/saloon/insert_customer_ticket.php?userid=1&issue_desc=Test+issue&date_submitted=2023-02-17&status=1
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Ticket inserted successfully"}]
        input : userid,issue_desc,date_submitted,status(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['userid'],
        $input['issue_desc'],
        $input['date_submitted'],
        $input['status']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'INSERT INTO saloon_customer_support_ticket (userid, issue_desc, date_submitted, status) VALUES (?,?,?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['userid']);
        $stat->bindparam(2, $input['issue_desc']);
        $stat->bindparam(3, $input['date_submitted']);
        $stat->bindparam(4, $input['status']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Ticket inserted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);