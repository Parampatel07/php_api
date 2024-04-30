<?php
/*
        update product 
        how to call : http://localhost/api/saloon/update_product.php?productid=1&name=Product1001&categoryid=1&price=100&description=Description&old_image=product_photo.jpg
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Product updated successfully"}]
        input : productid,name,categoryid,price,description,photo(required) 
    */

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['productid'],
        $input['name'],
        $input['categoryid'],
        $input['price'],
        $input['description'],
        $input['old_image']
    ) == false
) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE saloon_product set name = ? , photo = ? , categoryid = ? , price = ? , description = ? where id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['name']);
        if (sizeof($_FILES) <= 0) {
            $image_name = $input['old_image'];
        } else {
            $image_name =
                rand(10, 99) .
                rand(10, 99) .
                rand(10, 99) .
                $_FILES['photo']['name'];
            move_uploaded_file(
                $_FILES['name']['tmp_name'],
                'images/' . $image_name
            );
        }
        $stat->bindParam(2, $image_name);
        $stat->bindParam(3, $input['categoryid']);
        $stat->bindParam(4, $input['price']);
        $stat->bindParam(5, $input['description']);
        $stat->bindParam(6, $input['productid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Product Updated  successfully   ',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt ']);
    }
}
echo json_encode($response);
?>
    