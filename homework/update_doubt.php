<?php
/*
    update doubt 
    how to call : http://localhost/api/homework/update_doubt.php?doubtid=2&studentid=1&teacherid=1&title=Science%20problem&detail=I%20dont%20understand%20this%20equation&solutions=solutions
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Doubt updated successfully"}]
    input : doubtid, studentid, teacherid, title, detail, solutions (all required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['doubtid'],
        $input['studentid'],
        $input['teacherid'],
        $input['title'],
        $input['detail'],
        $input['solutions']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE doubt SET studentid=?, teacherid=?, title=?, detail=?, solutions=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['studentid']);
        $stat->bindparam(2, $input['teacherid']);
        $stat->bindparam(3, $input['title']);
        $stat->bindparam(4, $input['detail']);
        $stat->bindparam(5, $input['solutions']);
        $stat->bindparam(6, $input['doubtid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Doubt updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt']);
    }
}
echo json_encode($response);
?>
