<?php
/*
    usage: to insert theme_album 
    how to call : http://localhost/api/event_management/insert_theme_album.php?themeid=themeID&photo=theme.png&description=themeDescription
    input : themeid, photo, description
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset($input['themeid'],  $input['description']) == false
) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'INSERT into theme_album (themeid , photo , description ) VALUES (?,?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['themeid']);
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
        $stat->bindparam(3, $input['description']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Theme Album Added successfully   ',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Attempt ']);
    }
}
echo json_encode($response);
?>
