<?php
/*
    usage: Used to insert a new worker user into the database
    how to call: http://localhost/api/bookmyworker/insert_user.php?name=user&email=user@example.com&password=1234&mobile=1234567890&city=city&area=area&flat=flat&pincode=123456
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Worker user inserted successfully"}]
    input: name, email, password, mobile, city, area, flat, pincode (all required)
*/

require_once 'connection.php'; // Include your database connection script
$response = [];
$input = $_REQUEST;

// Check if all required input fields are provided for worker_user table
if (
    isset(
        $input['name'],
        $input['email'],
        $input['password'],
        $input['mobile'],
        $input['city'],
        $input['area'],
        $input['flat'],
        $input['pincode']
    )
) {
    // Prepare the SQL query for worker_user table
    $sql =
        'INSERT INTO worker_user (name, email, password, mobile, city, area, flat, pincode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $stat = $db->prepare($sql);

    // Bind parameters and execute the query
    $stat->bindparam(1, $input['name']);
    $stat->bindparam(2, $input['email']);
    $stat->bindparam(3, $input['password']);
    $stat->bindparam(4, $input['mobile']);
    $stat->bindparam(5, $input['city']);
    $stat->bindparam(6, $input['area']);
    $stat->bindparam(7, $input['flat']);
    $stat->bindparam(8, $input['pincode']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Worker user inserted successfully',
        ]);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to insert worker user']);
    }
} else {
    // If any required input is missing
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);

?>
