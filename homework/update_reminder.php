<?php
/*
    update reminder 
    how to call : http://localhost/api/homework/update_reminder.php?reminderid=2&title=Exam%20Reminder&detail=Final2%20exam%20on%20Monday&standardid=1&teacherid=1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Reminder updated successfully"}]
    input : reminderid, title, detail, standardid, teacherid (all required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['reminderid'],
        $input['title'],
        $input['detail'],
        $input['standardid'],
        $input['teacherid']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE reminder SET title=?, detail=?, standardid=?, teacherid=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['title']);
        $stat->bindparam(2, $input['detail']);
        $stat->bindparam(3, $input['standardid']);
        $stat->bindparam(4, $input['teacherid']);
        $stat->bindparam(5, $input['reminderid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Reminder updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt']);
    }
}
echo json_encode($response);
?>
