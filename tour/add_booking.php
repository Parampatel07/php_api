<?php
/*
    usage: used to add a new booking for a tour

    how to call: http://localhost/api/tour/add_booking.php?tourid=1&customerid=2

    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"booking added successfully"}]

    input: tourid, customerid (all required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (
    isset(
        $input['tourid'],
        $input['customerid']
    )
) {
    $sql = 'insert into tour_booking (tourid, customerid, bookingdate) values (?, ?, current_date())';
    $stat = $db->prepare($sql);
    $stat->bindparam(1, $input['tourid']);
    $stat->bindparam(2, $input['customerid']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'booking added successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'failed to add booking']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>