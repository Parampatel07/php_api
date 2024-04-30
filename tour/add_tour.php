<?php
/*
    usage: used to add a new tour into the database
    how to call: http://localhost/api/tour/add_tour.php?operatorid=1&destinations=paris%2c%20london&facilities=accommodation%2c%20transportation&ticketpriceadult=99.99&ticketpricechild=49.99&termsandconditions=terms%20and%20conditions...
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"tour added successfully"}]
    input: operatorid, destinations, facilities, ticketpriceadult, ticketpricechild, termsandconditions (all required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['operatorid'],
        $input['destinations'],
        $input['facilities'],
        $input['ticketpriceadult'],
        $input['ticketpricechild'],
        $input['termsandconditions']
    )
) {
    $sql =
        'insert into tour_tour (operatorid, destinations, facilities, ticketpriceadult, ticketpricechild, termsandconditions) values (?, ?, ?, ?, ?, ?)';
    $stat = $db->prepare($sql);
    $stat->bindparam(1, $input['operatorid']);
    $stat->bindparam(2, $input['destinations']);
    $stat->bindparam(3, $input['facilities']);
    $stat->bindparam(4, $input['ticketpriceadult']);
    $stat->bindparam(5, $input['ticketpricechild']);
    $stat->bindparam(6, $input['termsandconditions']);
    $result = $stat->execute();
    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'tour added successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'failed to add tour']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}
echo json_encode($response);
?>