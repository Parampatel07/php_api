<!-- UPDATE package SET name=?, service_included=?, price=?, description=?, photo=? WHERE packageid=? -->
<?php
/*
        update package 
        how to call : http://localhost/api/saloon/update_package.php?packageid=1&name=Package10&service_included=Service1,Service2&price=100&description=Description&old_image=package_photo.jpg
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Package updated successfully"}]
        input : packageid,name,service_included,price,description,photo(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['name'], $input['service_included'], $input['price'], $input['description'], $input['old_image'] ,$input['packageid'] ) == false) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql = 'UPDATE saloon_package SET name=?, service_included=?, price=?, description=?, photo=? WHERE id=?';
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
        $stat->bindParam(2, $input['service_included']);
        $stat->bindParam(3, $input['price']);
        $stat->bindParam(4, $input['description']);
        $stat->bindParam(5, $image_name);
        $stat->bindParam(6, $input['packageid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Package Updated  successfully   ',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt ']);
    }
}
echo json_encode($response);
?>
    