<?php
/*
    delete worker_booking 
    how to call : http://localhost/api/bookmyworker/delete_booking.php?bookingid=1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Booking deleted successfully"}]
    input : bookingid(required) 
*/

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['bookingid']) == false) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'DELETE FROM worker_booking WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['bookingid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Booking deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);

?>
