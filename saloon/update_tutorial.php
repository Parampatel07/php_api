<?php
/*
        update tutorial 
        how to call : http://localhost/api/saloon/update_tutorial.php?tutorialid=1&title=Title&description=Description151&video_url=video_url
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"Tutorial updated successfully"}]
        input : tutorialid,title,description,video_url(required) 
    */
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['tutorialid'],
        $input['title'],
        $input['description'],
        $input['video_url']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE saloon_tutoiral SET title=?, description=?, video_url=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['title']);
        $stat->bindparam(2, $input['description']);
        $stat->bindparam(3, $input['video_url']);
        $stat->bindparam(4, $input['tutorialid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Tutorial updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);
