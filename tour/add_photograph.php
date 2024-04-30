<?php
/*
    usage: used to add a new photograph for a tour

    how to call: http://localhost/api/tour/add_photograph.php?tourid=1&caption=beautiful%20landscape&photo=tour_photo.jpg

    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"photograph added successfully"}]

    input: tourid, caption, photo (all required)
*/

require_once 'connection.php';

$response = [];
$input = $_REQUEST;

if (isset($input['tourid'], $input['caption'], $_FILES['photo']) == false) {
    array_unshift($response, ['error' => 'Input is missing']);
} else {
    try {
        $sql = 'INSERT INTO tour_photograph (tourid, caption, photopath) VALUES (?, ?, ?)';
        $stat = $db->prepare($sql);
        $stat->bindParam(1, $input['tourid']);
        $stat->bindParam(2, $input['caption']);

        $image_name = rand(10, 99) . rand(10, 99) . rand(10, 99) . $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "images/" . $image_name);
        $stat->bindParam(3, $image_name);

        $stat->execute();

        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Photograph added successfully',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Attempt']);
    }
}

echo json_encode($response);
?>