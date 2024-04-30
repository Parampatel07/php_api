<!-- Create a change password api using doctor_api  -->
<?php
/*
     usage: to login for admin 
     how to call : http://localhost/api/bookmychef/user_change_password.php?user_id=1&oldpassword=987987&newpassword=123123&confirmpassword=123123
     output :
     [{"error":"input is missing"}] 
     [{"error":"no"},{"success":"no"},{message:"Invalid change attempt"}]
     [{"error":"no"},{"success":"yes"},{message:"password changed successfully "}]
     input : user_id,oldpassword,newpassword,confirmpassword
     */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['user_id'],
        $input['oldpassword'],
        $input['newpassword'],
        $input['confirmpassword']
    ) == false
) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    if ($input['newpassword'] == $input['confirmpassword']) {
        //continue
        $sql = 'SELECT password from user where id = ? ';
        $stat = $db->prepare($sql);
        $stat->setFetchMode(PDO::FETCH_ASSOC);
        $stat->bindparam(1, $input['user_id']);
        $stat->execute();
        $row = $stat->fetch();
        if ($input['oldpassword'] == $row['password']) {
            // continue
            $sql = 'UPDATE user set password = ? where id  = ? ';
            $stat = $db->prepare($sql);
            $stat->bindparam(1, $input['newpassword']);
            $stat->bindparam(2, $input['user_id']);
            $stat->execute();
            array_push($response, ['error' => 'no']);
            array_push($response, ['success' => 'yes']);
            array_push($response, [
                'message' => 'Password changed successfully ',
            ]);
        } else {
             array_push($response, ['error' => 'no']);
             array_push($response, ['success' => 'no']);
             array_push($response, ['message' => 'Invalid Change Attempt ']);
          }
     } else {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Change Attempt ']);
    }
}
echo json_encode($response);


?>
