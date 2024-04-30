<?php
/*
    usage: to insert catering_service 
    how to call : http://localhost/api/event_management/insert_catering_service.php?name=serviceName&description=serviceDescription&price=servicePrice&photo=service.png
    input : name, description, price, photo
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['name'], $input['description'], $input['price']) == false) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'INSERT into catering_service (name , description , price , photo ) VALUES (?,?,?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['name']);
        $stat->bindparam(2, $input['description']);
        $stat->bindparam(3, $input['price']);
        $image_name =
            rand(10, 99) .
            rand(10, 99) .
            rand(10, 99) .
            $_FILES['photo']['name'];
        move_uploaded_file(
            $_FILES['name']['tmp_name'],
            'images/' . $image_name
        );
        $stat->bindParam(4, $image_name);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Catering Service Added successfully   ',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Attempt ']);
    }
}
echo json_encode($response);
?>
