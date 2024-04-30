<?php
/*
   usage: used to add a new alarm for a tour

   how to call: http://localhost/api/tour/add_alarm.php?tourid=1&alarmtime=2023-06-01%2012:00:00

   output:
   [{"error":"input is missing"}]
   [{"error":"no"},{"success":"yes"},{"message":"alarm added successfully"}]

   input: tourid, alarmtime (all required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (
   isset(
       $input['tourid'],
       $input['alarmtime']
   )
) {
   $sql = 'insert into tour_alarm (tourid, alarmtime) values (?, ?)';
   $stat = $db->prepare($sql);
   $stat->bindparam(1, $input['tourid']);
   $stat->bindparam(2, $input['alarmtime']);
   $result = $stat->execute();

   if ($result) {
       array_push($response, ['error' => 'no']);
       array_push($response, ['success' => 'yes']);
       array_push($response, ['message' => 'alarm added successfully']);
   } else {
       array_push($response, ['error' => 'yes']);
       array_push($response, ['success' => 'no']);
       array_push($response, ['message' => 'failed to add alarm']);
   }
} else {
   array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>