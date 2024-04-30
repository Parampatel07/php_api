<?php
/*
        insert category 
        how to call : http://localhost/api/saloon/insert_category.php?name=category1&photo=category.png
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Category Inserted successfully "}]
        input : name,photo(required) 
        check pending due to photo 
    */

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['name'], $_FILES['photo']) == false) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'INSERT into saloon_category (name , photo ) VALUES (?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['name']);
        $image_name = rand(10,99) . rand(10,99) . rand(10,99) . $_FILES['photo']['name'];
        move_uploaded_file($_FILES['name']['tmp_name'],"images/".$image_name);
        $stat->bindParam(2,$image_name);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Category Added successfully   ',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Attempt ']);
    }
}
echo json_encode($response);
?>
    