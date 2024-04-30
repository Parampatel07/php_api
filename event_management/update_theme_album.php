<?php
/*
    usage: to update a theme_album 
    how to call : http://localhost/api/event_management/update_theme_album.php?albumid=1&themeid=ThemeID&old_image=photo1.jpg&description=Description
    input : albumid, themeid, photo, description (required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['albumid'],
        $input['themeid'],
        $input['old_image'],
        $input['description']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE theme_album SET themeid=?, photo=?, description=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['themeid']);
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
        $stat->bindparam(3, $input['description']);
        $stat->bindparam(4, $input['albumid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Theme Album updated successfully',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
?>
