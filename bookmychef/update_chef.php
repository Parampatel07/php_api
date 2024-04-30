<?php
/*
    update chef 
    how to call : http://localhost/api/bookmychef/update_chef.php?chefid=1&cityid=1&email=test@test.com&password=test&mobile=1234567890&name=Chef1&oldphoto=chef_photo.jpg&dob=1980-01-01&gender=M&cookingtype=1&rate=100&bio=Best+chef+in+town
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Chef updated successfully"}]
    input : chefid, cityid, email, password, mobile, name, photo, dob, gender, cookingtype, rate, bio (required) 
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['chefid'],
        $input['cityid'],
        $input['email'],
        $input['password'],
        $input['mobile'],
        $input['name'],
        $input['oldphoto'],
        $input['dob'],
        $input['gender'],
        $input['cookingtype'],
        $input['rate'],
        $input['bio']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        if (sizeof($_FILES) <= 0) {
            $image = $input['oldphoto'];
        } else {
            $image =
                rand(10, 99) .
                rand(10, 99) .
                rand(10, 99) .
                $_FILES['photo']['name'];
            move_uploaded_file(
                $_FILES['photo']['tmp_name'],
                'images/' . $image
            );
        }
        $sql =
            'UPDATE chef SET cityid=?, email=?, password=?, mobile=?, name=?, photo=?, dob=?, gender=?, cookingtype=?, rate=?, bio=? WHERE id=?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['cityid']);
        $stat->bindparam(2, $input['email']);
        $stat->bindparam(3, $input['password']);
        $stat->bindparam(4, $input['mobile']);
        $stat->bindparam(5, $input['name']);
        $stat->bindparam(6, $image);
        $stat->bindparam(7, $input['dob']);
        $stat->bindparam(8, $input['gender']);
        $stat->bindparam(9, $input['cookingtype']);
        $stat->bindparam(10, $input['rate']);
        $stat->bindparam(11, $input['bio']);
        $stat->bindparam(12, $input['chefid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Chef updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Update Attempt']);
    }
}
echo json_encode($response);
?>
