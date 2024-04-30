<?php
/*
    get chef 
    how to call : http://localhost/api/bookmychef/get_chef.php?chefid=2
    how to call : http://localhost/api/bookmychef/get_chef.php?cityid=1
    how to call : http://localhost/api/bookmychef/get_chef.php?cookingtype=1
    how to call : http://localhost/api/bookmychef/get_chef.php
    input : chefid or cityid (optional) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
try {
    if (isset($input['chefid'])) {
        $sql =
            'SELECT id, cityid, email, password, mobile, name, photo, dob, gender, cookingtype, rate, bio FROM chef WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['chefid']);
    } elseif (isset($input['cityid'])) {
        $sql =
            'SELECT id, cityid, email, password, mobile, name, photo, dob, gender, cookingtype, rate, bio FROM chef WHERE cityid = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['cityid']);
    } elseif (isset($input['cookingtype'])) {
        $sql =
            'SELECT id, cityid, email, password, mobile, name, photo, dob, gender, cookingtype, rate, bio FROM chef WHERE cookingtype = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['cookingtype']);
    } else {
        $sql =
            'SELECT id, cityid, email, password, mobile, name, photo, dob, gender, cookingtype, rate, bio FROM chef';
        $stat = $db->prepare($sql);
    }
    $stat->execute();
    $chef = $stat->fetchAll(PDO::FETCH_ASSOC);
    array_push($response, ['error' => 'no']);
    array_push($response, ['total' => count($chef)]);
    array_push($response, ['data' => $chef]);
} catch (PDOException $error) {
    array_push($response, ['error' => 'yes']);
    array_push($response, ['total' => 0]);
}
echo json_encode($response);
?>
