<?php
/*
    update chef cuisine 
    how to call : http://localhost/api/bookmychef/update_chef_cousine.php?chefid=1&courseid=1&chef_cuisineid=1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Chef cuisine updated successfully"}]
    input : chefid, courseid (required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset($input['chefid'], $input['courseid'], $input['chef_cuisineid']) ==
    false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'UPDATE chef_cousine SET courseid=? , chefid=? where id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['courseid']);
        $stat->bindparam(2, $input['chefid']);
        $stat->bindparam(3, $input['chef_cuisineid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Chef cuisine updated successfully',
        ]);
    } catch (PDOException $error) {
        //    echo $error;
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt']);
    }
}
echo json_encode($response);
?>
