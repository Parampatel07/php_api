<?php
/*
    usage: Used to insert a new chef into the database
    how to call: http://localhost/api/bookmychef/chef_register.php?cityid=1&email=chef@example.com&password=123456&mobile=1234567890&name=ChefJohn&photo=chef.jpg&dob=1990-01-01&gender=male&cookingtype=1&rate=50&bio=Experienced chef with a passion for Italian cuisine
    output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"Chef inserted successfully"}]
    input: cityid, email, password, mobile, name, image, dob, gender, cookingtype, rate, bio (required)
*/
require_once 'connection.php'; // Include your database connection script
$response = [];
$input = $_REQUEST;

// Check if all required input fields are provided
if (
    isset(
        $input['cityid'],
        $input['email'],
        $input['password'],
        $input['mobile'],
        $input['name'],
        $input['dob'],
        $input['gender'],
        $input['cookingtype'],
        $input['rate'],
        $input['bio']
    )
) {
    // Prepare the SQL query
    $sql =
        'INSERT INTO chef (cityid, email, password, mobile, name, photo, dob, gender, cookingtype, rate, bio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $stat = $db->prepare($sql);

    $image_name =
        rand(10, 99) . rand(10, 99) . rand(10, 99) . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image_name);

    // Bind parameters and execute the query
    $stat->bindparam(1, $input['cityid']);
    $stat->bindparam(2, $input['email']);
    $stat->bindparam(3, $input['password']);
    $stat->bindparam(4, $input['mobile']);
    $stat->bindparam(5, $input['name']);
    $stat->bindparam(6, $input['photo']);
    $stat->bindparam(7, $input['dob']);
    $stat->bindparam(8, $input['gender']);
    $stat->bindparam(9, $input['cookingtype']);
    $stat->bindparam(10, $input['rate']);
    $stat->bindparam(11, $input['bio']);
    $result = $stat->execute();

    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Chef inserted successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to insert chef']);
    }
} else {
    // If any required input is missing
    array_push($response, ['error' => 'input is missing']);
}

// Encode response as JSON and output
echo json_encode($response);
?>
