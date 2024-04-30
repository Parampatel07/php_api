<?php
/*
    usage: to update a theme 
    how to call : http://localhost/api/event_management/update_theme.php?themeid=1&name=Name&description=Description&minbudget=MinBudget&maxbudget=MaxBudget&old_image=photo1.jpg
    input : themeid, name, description, minbudget, maxbudget, photo (required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['themeid'],
        $input['name'],
        $input['description'],
        $input['minbudget'],
        $input['maxbudget'],
        $input['old_image']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE theme SET name=?, description=?, minbudget=?, maxbudget=?, photo=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['name']);
        $stat->bindparam(2, $input['description']);
        $stat->bindparam(3, $input['minbudget']);
        $stat->bindparam(4, $input['maxbudget']);
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
        $stat->bindParam(5, $image_name);
        $stat->bindparam(6, $input['themeid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Theme updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
