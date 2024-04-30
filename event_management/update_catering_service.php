<?php
/*
    usage: to update a catering_service 
    how to call : http://localhost/api/event_management/update_catering_service.php?serviceid=1&name=Name&description=Description&price=Price&old_image=photo12.jpg
    input : serviceid, name, description, price, photo (required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['serviceid'],
        $input['name'],
        $input['description'],
        $input['price'],
        $input['old_image']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE catering_service SET name=?, description=?, price=?, photo=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['name']);
        $stat->bindparam(2, $input['description']);
        $stat->bindparam(3, $input['price']);
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
        $stat->bindParam(4, $image_name);
        $stat->bindparam(5, $input['serviceid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Catering Service updated successfully',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
