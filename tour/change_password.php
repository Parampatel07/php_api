<?php
/*
    Usage: Used to change the user's password

    How to call: http://localhost/api/tour/change_password.php?userid=1&oldpassword=987987&newpassword=123123

    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Password changed successfully"}]
    [{"error":"yes"},{"success":"no"},{"message":"Invalid old password"}]

    Input: userid, oldpassword, newpassword (all required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (isset($input['userid'], $input['oldpassword'], $input['newpassword'])) {
    $sql = 'SELECT * FROM tour_user WHERE id = ? AND password = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['userid']);
    $stat->bindParam(2, $input['oldpassword']);
    $stat->execute();
    $user = $stat->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $sql = 'UPDATE tour_user SET password = ? WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindParam(1, $input['newpassword']);
        $stat->bindParam(2, $input['userid']);
        $result = $stat->execute();

        if ($result) {
            array_push($response, ['error' => 'no']);
            array_push($response, ['success' => 'yes']);
            array_push($response, [
                'message' => 'Password changed successfully',
            ]);
        } else {
            array_push($response, ['error' => 'yes']);
            array_push($response, ['success' => 'no']);
            array_push($response, ['message' => 'Failed to change password']);
        }
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid old password']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);
?>
