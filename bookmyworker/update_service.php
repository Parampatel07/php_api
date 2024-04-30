<?php
/*
    update worker_service 
    how to call : http://localhost/api/bookmyworker/update_service.php?serviceid=2&title=newservice&photo=newservice_photo.jpg&area=newarea&charge=200&duration=120
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Service updated successfully"}]
    input : serviceid, title, photo, area, charge, duration (all required) 
*/

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['serviceid'],
        $input['title'],
     //    $_FILES['photo'],
        $input['area'],
        $input['charge'],
        $input['duration']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE worker_service SET title = ?, photo = ?, area = ?, charge = ?, duration = ? WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['title']);
        $image_name =
            rand(10, 99) .
            rand(10, 99) .
            rand(10, 99) .
            $_FILES['photo']['name'];
        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            'images/' . $image_name
        );
        $stat->bindparam(2, $image_name);
        $stat->bindparam(3, $input['area']);
        $stat->bindparam(4, $input['charge']);
        $stat->bindparam(5, $input['duration']);
        $stat->bindparam(6, $input['serviceid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Service updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);

?>
