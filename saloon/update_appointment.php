<
<?php
/*
        usage: update appointment 
        how to call : http://localhost/api/saloon/update_appointment.php?userid=1&appointment_date=2004-10-02&appointment_time=10:30&status=0&serviceid=1&appointmentid=1
        output :
        [{"error":"input is missing"}] 
         [{"error":"no"},{"success":"no"},{"message":"invalid login attempt"}]
        [{"error":"no"},{"success":"yes"},{"message":"login successful"},{"id":"3"}]
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
        $input['appointmentid'],
        $input['serviceid']
    ) == false
) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE saloon_appointment set userid = ? , appointment_date = ? , appointment_time = ? , status = ? , serviceid = ? where appointmentid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['userid']);
        $stat->bindparam(2, $input['appointment_date']);
        $stat->bindparam(3, $input['appointment_time']);
        $stat->bindparam(4, $input['status']);
        $stat->bindparam(5, $input['serviceid']);
        $stat->bindparam(6, $input['appointmentid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Appointment Updated successfully   ',
        ]);
    } catch (PDOException $error) {
        //    echo $error;
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, [
            'message' => 'Appointment Update Attempt Invalid ',
        ]);
    }
}
echo json_encode($response);


?>
