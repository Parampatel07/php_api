<?php
/*
        insert tutorial 
        how to call : http://localhost/api/saloon/insert_tutorial.php?title=Title&description=Description&video_url=video_url
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Tutorial inserted successfully"}]
        input : title,description,video_url(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset($input['title'], $input['description'], $input['video_url']) == false
) {
    array_unshift($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'INSERT INTO saloon_tutoiral ( title , description , video_url ) VALUES (?,?,?)';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['title']);
        $stat->bindParam(2, $input['description']);
        $stat->bindParam(3, $input['video_url']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, [
            'message' => 'Tutoiral Added successfully   ',
        ]);
    } catch (PDOException $error) {
        echo $error;
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Attempt ']);
    }
}
echo json_encode($response);
?>
        