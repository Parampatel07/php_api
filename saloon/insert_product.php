<?php
/*
        insert product 
        how to call : http://localhost/api/saloon/insert_product.php?name=Product1&categoryid=1&price=100&description=Description&photo=category.png
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Product inserted successfully"}]
        input : name,categoryid,price,description,photo(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['name'],
        $input['categoryid'],
        $input['price'],
        $input['description']
    ) == false
) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'INSERT into saloon_product (name , categoryid , price , description ,photo) VALUES (?,?,?,?,?)';
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
        $stat->bindParam(2, $input['categoryid']);
        $stat->bindParam(3, $input['price']);
        $stat->bindParam(4, $input['description']);
        $stat->bindParam(5, $image_name);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Product Added successfully   ',
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
        