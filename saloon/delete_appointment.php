<?php
/*
        usage: delete appointment 
        how to call : http://localhost/api/saloon/delete_appointment.php?appointmentid=1
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Appointment Deleted successfully "}]
        input : appointmentid(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['appointmentid']) == false) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'DELETE FROM saloon_appointment WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['appointmentid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Appointment Deleted successfully ',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Delete Attempt ']);
    }
}
echo json_encode($response);