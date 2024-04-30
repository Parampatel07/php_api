<?php
/*
        delete category 
        how to call : http://localhost/api/saloon/delete_category.php?categoryid=1
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Category Deleted successfully "}]
        input : categoryid(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['categoryid']
    ) == false
) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'DELETE FROM saloon_category WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['categoryid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Category Deleted successfully ']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Delete Attempt ']);
    }
}
echo json_encode($response);