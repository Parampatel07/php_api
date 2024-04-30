<?php
/*
    usage: Used to insert a new worker into the database
    how to call: http://localhost/api/bookmyworker/insert_worker.php?city=city&email=worker@example.com&password=1234&mobile=1234567890&name=worker&photo=worker_photo.jpg&dob=1980-01-01&gender=male&rate=100&bio=bio&maritalstatus=single&height=180&weight=70&habits=habits&education=education&religion=religion&language=language&bankname=bank&accountholdername=holder&accountno=123456&ifsccode=IFSC
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Worker inserted successfully"}]
    input: city, email, password, mobile, name, photo, dob, gender, rate, bio, maritalstatus, height, weight, habits, education, religion, language, bankname, accountholdername, accountno, ifsccode (all required)
*/

require_once 'connection.php'; // Include your database connection script
$response = [];
$input = $_REQUEST;

// Check if all required input fields are provided for worker_worker table
if (
    isset(
        $input['city'],
        $input['email'],
        $input['password'],
        $input['mobile'],
        $input['name'],
     //    $_FILES['photo'],
        $input['dob'],
        $input['gender'],
        $input['rate'],
        $input['bio'],
        $input['maritalstatus'],
        $input['height'],
        $input['weight'],
        $input['habits'],
        $input['education'],
        $input['religion'],
        $input['language'],
        $input['bankname'],
        $input['accountholdername'],
        $input['accountno'],
        $input['ifsccode']
    )
) {
    // Prepare the SQL query for worker_worker table
    $sql =
        'INSERT INTO worker_worker (city, email, password, mobile, name, photo, dob, gender, rate, bio, maritalstatus, height, weight, habits, education, religion, language, bankname, accountholdername, accountno, ifsccode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $stat = $db->prepare($sql);

    // Bind parameters and execute the query
    $stat->bindparam(1, $input['city']);
    $stat->bindparam(2, $input['email']);
    $stat->bindparam(3, $input['password']);
    $stat->bindparam(4, $input['mobile']);
    $stat->bindparam(5, $input['name']);
    $image_name =
        rand(10, 99) . rand(10, 99) . rand(10, 99) . $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $image_name);
    $stat->bindparam(6, $image_name);
    $stat->bindparam(7, $input['dob']);
    $stat->bindparam(8, $input['gender']);
    $stat->bindparam(9, $input['rate']);
    $stat->bindparam(10, $input['bio']);
    $stat->bindparam(11, $input['maritalstatus']);
    $stat->bindparam(12, $input['height']);
    $stat->bindparam(13, $input['weight']);
    $stat->bindparam(14, $input['habits']);
    $stat->bindparam(15, $input['education']);
    $stat->bindparam(16, $input['religion']);
    $stat->bindparam(17, $input['language']);
    $stat->bindparam(18, $input['bankname']);
    $stat->bindparam(19, $input['accountholdername']);
    $stat->bindparam(20, $input['accountno']);
    $stat->bindparam(21, $input['ifsccode']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Worker inserted successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to insert worker']);
    }
} else {
    // If any required input is missing
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);

?>
