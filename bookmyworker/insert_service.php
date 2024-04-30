<?php
/*
    usage: Used to insert a new worker service into the database
    how to call: http://localhost/api/bookmyworker/insert_service.php?title=service&photo=service_photo.jpg&area=area&charge=100&duration=60
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Worker service inserted successfully"}]
    input: title, photo, area, charge, duration (all required)
*/

require_once 'connection.php'; // Include your database connection script
$response = [];
$input = $_REQUEST;

// Check if all required input fields are provided for worker_service table
if (
    isset(
        $input['title'],
        //    $_FILES['photo'],
        $input['area'],
        $input['charge'],
        $input['duration']
    )
) {
    // Prepare the SQL query for worker_service table
    $sql =
        'INSERT INTO worker_service (title, photo, area, charge, duration) VALUES (?, ?, ?, ?, ?)';
    $stat = $db->prepare($sql);

    // Bind parameters and execute the query
    $stat->bindparam(1, $input['title']);
    $image_name =
        rand(10, 99) . rand(10, 99) . rand(10, 99) . $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $image_name);
    $stat->bindparam(2, $image_name);
    $stat->bindparam(3, $input['area']);
    $stat->bindparam(4, $input['charge']);
    $stat->bindparam(5, $input['duration']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Worker service inserted successfully',
        ]);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to insert worker service']);
    }
} else {
    // If any required input is missing
    array_push($response, ['error' => 'input is missing']);
}

echo json_encode($response);

?>
