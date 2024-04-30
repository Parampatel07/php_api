<?php
/*
        update service 
        how to call : http://localhost/api/saloon/update_service.php?serviceid=1&name=Service1&price=500&description=Description&duration=60&old_image=service_photo.jpg
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Service updated successfully"}]
        input : serviceid,name,price,description,duration,old_image(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['serviceid'],
        $input['name'],
        $input['price'],
        $input['description'],
        $input['duration'],
        $input['old_image']
    ) == false
) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE saloon_service set name = ? , price = ? , description = ? , duration = ? , photo = ? where id = ? ';
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
        $stat->bindParam(2, $input['price']);
        $stat->bindParam(3, $input['description']);
        $stat->bindParam(4, $input['duration']);
        $stat->bindParam(5, $image_name);
        $stat->bindParam(6, $input['serviceid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Service Updated Successfully ',
        ]);
    } catch (PDOException $error) {
     // echo $error;
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt ']);
    }
}
echo json_encode($response);
?>
    