<?php
/*
    update worker_user 
    how to call : http://localhost/api/bookmyworker/update_user.php?userid=2&name=newuser&email=newuser@example.com&password=newpass&mobile=1234567891&city=newcity&area=newarea&flat=newflat&pincode=12345711
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"User updated successfully"}]
    input : userid, name, email, password, mobile, city, area, flat, pincode (all required) 
*/

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['userid'],
        $input['name'],
        $input['email'],
        $input['password'],
        $input['mobile'],
        $input['city'],
        $input['area'],
        $input['flat'],
        $input['pincode']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE worker_user SET name = ?, email = ?, password = ?, mobile = ?, city = ?, area = ?, flat = ?, pincode = ? WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['name']);
        $stat->bindparam(2, $input['email']);
        $stat->bindparam(3, $input['password']);
        $stat->bindparam(4, $input['mobile']);
        $stat->bindparam(5, $input['city']);
        $stat->bindparam(6, $input['area']);
        $stat->bindparam(7, $input['flat']);
        $stat->bindparam(8, $input['pincode']);
        $stat->bindparam(9, $input['userid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'User updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
