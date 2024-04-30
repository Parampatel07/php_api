<?php
/*usage: used to add a new message for a tour

   how to call: http://localhost/api/tour/add_message.php?tourid=1&senderid=2&messagetext=hello%20there!

   output:
   [{"error":"input is missing"}]
   [{"error":"no"},{"success":"yes"},{"message":"message added successfully"}]

   input: tourid, senderid, messagetext (all required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (
   isset(
       $input['tourid'],
       $input['senderid'],
       $input['messagetext']
   )
) {
   $sql = 'insert into tour_message (tourid, senderid, messagetext, timestamp) values (?, ?, ?, current_timestamp())';
   $stat = $db->prepare($sql);
   $stat->bindparam(1, $input['tourid']);
   $stat->bindparam(2, $input['senderid']);
   $stat->bindparam(3, $input['messagetext']);
   $result = $stat->execute();

   if ($result) {
       array_push($response, ['error' => 'no']);
       array_push($response, ['success' => 'yes']);
       array_push($response, ['message' => 'message added successfully']);
   } else {
       array_push($response, ['error' => 'yes']);
       array_push($response, ['success' => 'no']);
       array_push($response, ['message' => 'failed to add message']);
   }
} else {
   array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>