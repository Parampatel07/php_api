<?php
/*
    Insert Package
    How to call: http://localhost/api/saloon/insert_package.php?name=Package1&service_included=Service1,Service2&price=50&description=Description1&photo=package.png
    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Package Inserted successfully"}]
    Input: name, service_included, price, description, photo(required)
    photo check pending
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['name'], $input['service_included'], $input['price'], $input['description'], $_FILES['photo']) == false) {
    array_push($response, ['error' => 'Input is missing']);
} else {
    try {
        $sql = 'INSERT INTO saloon_package (name, service_included, price, description, photo) VALUES (?,?,?,?,?)';
        $stat = $db->prepare($sql);
        $stat->bindParam(1, $input['name']);
        $stat->bindParam(2, $input['service_included']);
        $stat->bindParam(3, $input['price']);
        $stat->bindParam(4, $input['description']);
        
        $image_name = rand(10,99) . rand(10,99) . rand(10,99) . $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "images/" . $image_name);
        
        $stat->bindParam(5, $image_name);
        $stat->execute();
        
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Package Inserted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Attempt']);
    }
}
echo json_encode($response);
?>
