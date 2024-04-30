<?php
/*
    Usage: Used to get a tour user
    How to call: http://localhost/api/tour/get_tour_user.php
    How to call: http://localhost/api/tour/get_tour_user.php?id=1
    Input: two possibilities 
    1 ] without input 
    2 ] with id 
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"usertype":"Admin","username":"JohnDoe","password":"123456","email":"johndoe@example.com"}]
    Input: id (optional)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM tour_user WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $tour_user = $stat->fetch(PDO::FETCH_ASSOC);
    if ($tour_user) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, $tour_user);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['message' => 'Tour user not found']);
    }
} else {
    $sql = 'SELECT * FROM tour_user';
    $stat = $db->prepare($sql);
    $stat->execute();
    $tour_users = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['success' => 'yes']);
    array_push($response, ['data' => $tour_users]);
}
echo json_encode($response);
?>