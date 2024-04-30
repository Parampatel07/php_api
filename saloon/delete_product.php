<?php
/*
        delete product 
        how to call : http://localhost/api/saloon/delete_product.php?productid=1
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Product deleted successfully"}]
        input : productid(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['productid']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'DELETE FROM saloon_product WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['productid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Product deleted successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);