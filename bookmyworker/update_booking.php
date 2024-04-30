<?php
/*
    update worker_booking 
    how to call : http://localhost/api/bookmyworker/update_booking.php?bookingid=1&workerid=2&userid=2&bookingdate=2024-04-12&servicedate=2024-04-13&remarks=good&paymentstatus=paid&bookingstatus=confirmed&review=excellent&rating=50
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Booking updated successfully"}]
    input : bookingid, workerid, userid, bookingdate, servicedate, remarks, paymentstatus, bookingstatus, review, rating (all required) 
*/

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['bookingid'],
        $input['workerid'],
        $input['userid'],
        $input['bookingdate'],
        $input['servicedate'],
        $input['remarks'],
        $input['paymentstatus'],
        $input['bookingstatus'],
        $input['review'],
        $input['rating']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE worker_booking SET workerid = ?, userid = ?, bookingdate = ?, servicedate = ?, remarks = ?, paymentstatus = ?, bookingstatus = ?, review = ?, rating = ? WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['workerid']);
        $stat->bindparam(2, $input['userid']);
        $stat->bindparam(3, $input['bookingdate']);
        $stat->bindparam(4, $input['servicedate']);
        $stat->bindparam(5, $input['remarks']);
        $stat->bindparam(6, $input['paymentstatus']);
        $stat->bindparam(7, $input['bookingstatus']);
        $stat->bindparam(8, $input['review']);
        $stat->bindparam(9, $input['rating']);
        $stat->bindparam(10, $input['bookingid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Booking updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);

?>
