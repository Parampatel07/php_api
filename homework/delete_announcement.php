<?php
/*
    delete announcement 
    how to call : http://localhost/api/homework/delete_announcement.php?announcementid=1
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Announcement deleted successfully"}]
    input : announcementid(required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['announcementid']) == false) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'DELETE FROM announcement WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['announcementid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Announcement deleted successfully',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
