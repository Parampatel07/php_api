<?php

/*
    usage: Used to insert a new booking into the database
    how to call: http://localhost/api/bookmyworker/insert_booking.php?workerid=1&userid=2&bookingdate=2024-04-12&servicedate=2024-04-13&remarks=good&paymentstatus=paid&bookingstatus=confirmed&review=excellent&rating=5
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Booking inserted successfully"}]
    input: workerid, userid, bookingdate, servicedate, remarks, paymentstatus, bookingstatus, review, rating (all required)
*/

require_once 'connection.php'; // Include your database connection script
$response = [];
$input = $_REQUEST;

// Check if all required input fields are provided for booking table
if (
    isset(
        $input['workerid'],
        $input['userid'],
        $input['bookingdate'],
        $input['servicedate'],
        $input['remarks'],
        $input['paymentstatus'],
        $input['bookingstatus'],
        $input['review'],
        $input['rating']
    )
) {
    // Prepare the SQL query for booking table
    $sql =
        'INSERT INTO worker_booking (workerid, userid, bookingdate, servicedate, remarks, paymentstatus, bookingstatus, review, rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $stat = $db->prepare($sql);

    // Bind parameters and execute the query
    $stat->bindparam(1, $input['workerid']);
    $stat->bindparam(2, $input['userid']);
    $stat->bindparam(3, $input['bookingdate']);
    $stat->bindparam(4, $input['servicedate']);
    $stat->bindparam(5, $input['remarks']);
    $stat->bindparam(6, $input['paymentstatus']);
    $stat->bindparam(7, $input['bookingstatus']);
    $stat->bindparam(8, $input['review']);
    $stat->bindparam(9, $input['rating']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Booking inserted successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to insert booking']);
    }
} else {
    // If any required input is missing
    array_push($response, ['error' => 'input is missing']);
}
echo json_encode($response);
?>
