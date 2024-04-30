<?php
/*
        insert loyalty bonus 
        how to call : http://localhost/api/saloon/insert_loyalty_bonus.php?userid=1&bonus_point=100&last_redeemed_date=2023-02-17&status=1
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Loyalty bonus inserted successfully"}]
        input : userid,bonus_point,last_redeemed,status(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['userid'],
        $input['bonus_point'],
        $input['last_redeemed_date'],
        $input['status']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'INSERT INTO saloon_loyalty_bonus (userid, bonus_point, last_redeemed_date, status) VALUES (?,?,?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['userid']);
        $stat->bindparam(2, $input['bonus_point']);
        $stat->bindparam(3, $input['last_redeemed_date']);
        $stat->bindparam(4, $input['status']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Loyalty bonus inserted successfully',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
