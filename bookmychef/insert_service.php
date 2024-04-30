<?php
/*
    insert service 
    how to call : http://localhost/api/bookmychef/insert_service.php?chefid=1&userid=1&person=John&timings=10:00-12:00&cookingdate=2024-03-09&amount=100&paymentstatus=1&orderstatus=1&remarks=Good&address1=Street1&address2=Street2&cityid=1&review=Excellent&rating=5
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Service inserted successfully"}]
    input : chefid, userid, person, timings, cookingdate, amount, paymentstatus, orderstatus, remarks, address1, address2, cityid, review, rating (required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['chefid'],
        $input['userid'],
        $input['person'],
        $input['timings'],
        $input['cookingdate'],
        $input['amount'],
        $input['paymentstatus'],
        $input['orderstatus'],
        $input['remarks'],
        $input['address1'],
        $input['address2'],
        $input['cityid'],
        $input['review'],
        $input['rating']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'INSERT INTO service (chefid, userid, person, timings, cookingdate, amount, paymentstatus, orderstatus, remarks, address1, address2, cityid, review, rating) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['chefid']);
        $stat->bindparam(2, $input['userid']);
        $stat->bindparam(3, $input['person']);
        $stat->bindparam(4, $input['timings']);
        $stat->bindparam(5, $input['cookingdate']);
        $stat->bindparam(6, $input['amount']);
        $stat->bindparam(7, $input['paymentstatus']);
        $stat->bindparam(8, $input['orderstatus']);
        $stat->bindparam(9, $input['remarks']);
        $stat->bindparam(10, $input['address1']);
        $stat->bindparam(11, $input['address2']);
        $stat->bindparam(12, $input['cityid']);
        $stat->bindparam(13, $input['review']);
        $stat->bindparam(14, $input['rating']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Service inserted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>