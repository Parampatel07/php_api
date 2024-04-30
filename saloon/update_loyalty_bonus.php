<?php
/*
        update loyalty bonus 
        how to call : http://localhost/api/saloon/update_loyalty_bonus.php?bonusid=1&userid=1&bonus_point=1001&last_redeemed_date=2023-02-17&status=1
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Loyalty bonus updated successfully"}]
        input : bonusid,userid,bonus_point,last_redeemed_date,status(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['bonusid'],
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
            'UPDATE saloon_loyalty_bonus SET userid = ?, bonus_point = ?, last_redeemed_date = ?, status = ? WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['userid']);
        $stat->bindparam(2, $input['bonus_point']);
        $stat->bindparam(3, $input['last_redeemed_date']);
        $stat->bindparam(4, $input['status']);
        $stat->bindparam(5, $input['bonusid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Loyalty bonus updated successfully',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
