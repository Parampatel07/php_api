<?php
/*
        insert service 
        how to call : http://localhost/api/saloon/insert_service.php?name=Service1&price=100&description=Description&duration=60&photo=category.png
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Service inserted successfully"}]
        input : name,photo,price,description,duration(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['name'],
        $input['price'],
        $input['description'],
        $input['duration']
    ) == false
) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'INSERT INTO saloon_service (name, photo, price, description, duration) VALUES (?,?,?,?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['name']);
        $image_name =
            rand(10, 99) .
            rand(10, 99) .
            rand(10, 99) .
            $_FILES['photo']['name'];
        move_uploaded_file(
            $_FILES['name']['tmp_name'],
            'images/' . $image_name
        );
        $stat->bindParam(2, $image_name);
        $stat->bindParam(3, $input['price']);
        $stat->bindParam(4, $input['description']);
        $stat->bindParam(5, $input['duration']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Service Added successfully   ',
        ]);
    } catch (PDOException $error) {
        echo $error;
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Attempt ']);
    }
}
echo json_encode($response);
?>
        