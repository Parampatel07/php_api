<?php
/*
    update worker_worker_service 
    how to call : http://localhost/api/bookmyworker/update_worker_service.php?workerserviceid=2&workerid=2&serviceid=2&area=newarea&charge=200&duration=120&details=newdetails
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Worker service updated successfully"}]
    input : workerserviceid, workerid, serviceid, area, charge, duration, details (all required) 
*/

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['workerserviceid'],
        $input['workerid'],
        $input['serviceid'],
        $input['area'],
        $input['charge'],
        $input['duration'],
        $input['details']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE worker_worker_service SET workerid = ?, serviceid = ?, area = ?, charge = ?, duration = ?, details = ? WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['workerid']);
        $stat->bindparam(2, $input['serviceid']);
        $stat->bindparam(3, $input['area']);
        $stat->bindparam(4, $input['charge']);
        $stat->bindparam(5, $input['duration']);
        $stat->bindparam(6, $input['details']);
        $stat->bindparam(7, $input['workerserviceid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Worker service updated successfully',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);

?>
