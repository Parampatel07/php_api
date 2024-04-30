<?php
/*
    usage: to insert theme 
    how to call : http://localhost/api/event_management/insert_theme.php?name=themeName&description=themeDescription&minbudget=minBudget&maxbudget=maxBudget&photo=theme.png
    input : name, description, minbudget, maxbudget, photo
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['name'],
        $input['description'],
        $input['minbudget'],
        $input['maxbudget']
    ) == false
) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'INSERT into theme (name , description , minbudget , maxbudget , photo ) VALUES (?,?,?,?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['name']);
        $stat->bindparam(2, $input['description']);
        $stat->bindparam(3, $input['minbudget']);
        $stat->bindparam(4, $input['maxbudget']);
        $image_name =
            rand(10, 99) .
            rand(10, 99) .
            rand(10, 99) .
            $_FILES['photo']['name'];
        move_uploaded_file(
            $_FILES['name']['tmp_name'],
            'images/' . $image_name
        );
        $stat->bindParam(5, $image_name);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Theme Added successfully   ',
        ]);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Attempt ']);
    }
}
echo json_encode($response);
?>
