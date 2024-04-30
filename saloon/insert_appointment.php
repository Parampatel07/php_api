
<?php
/*
        usage: insert appointment 
        how to call : http://localhost/api/saloon/insert_appointment.php?userid=1&appointment_date=2004-10-02&appointment_time=10:30&status=0&serviceid=1
        output :
        [{"error":"input is missing"}] 
       [{"error":"no"},{"success":"yes"},{"message":"Appointment Booked successfully "}]
        input : email,password(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['userid'],
        $input['appointment_date'],
        $input['appointment_time'],
        $input['status'],
        $input['serviceid']
    ) == false
) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'INSERT into saloon_appointment ( userid , appointment_date , appointment_time , status , serviceid ) VALUES (?,?,?,?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['userid']);
        $stat->bindparam(2, $input['appointment_date']);
        $stat->bindparam(3, $input['appointment_time']);
        $stat->bindparam(4, $input['status']);
        $stat->bindparam(5, $input['serviceid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Appointment Booked successfully   ',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Booking Attempt ']);
    }
}
echo json_encode($response);


?>
