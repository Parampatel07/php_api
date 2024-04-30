<?php
/*
    update worker_worker 
    how to call : http://localhost/api/bookmyworker/update_worker.php?workerid=2&city=newcity&email=newworker@example.com&password=newpass&mobile=1234567892&name=newworker&photo=newworker_photo.jpg&dob=1980-01-02&gender=female&rate=200&bio=newbio&maritalstatus=married&height=180&weight=70&habits=newhabits&education=neweducation&religion=newreligion&language=newlanguage&bankname=newbank&accountholdername=newholder&accountno=123457&ifsccode=newIFSC
    output :
    [{"error":"input is missing"}] 
    [{"error":"no"},{"success":"yes"},{"message":"Worker updated successfully"}]
    input : workerid, city, email, password, mobile, name, photo, dob, gender, rate, bio, maritalstatus, height, weight, habits, education, religion, language, bankname, accountholdername, accountno, ifsccode (all required) 
*/

require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['workerid'],
        $input['city'],
        $input['email'],
        $input['password'],
        $input['mobile'],
        $input['name'],
     //    $_FILES['photo'],
        $input['dob'],
        $input['gender'],
        $input['rate'],
        $input['bio'],
        $input['maritalstatus'],
        $input['height'],
        $input['weight'],
        $input['habits'],
        $input['education'],
        $input['religion'],
        $input['language'],
        $input['bankname'],
        $input['accountholdername'],
        $input['accountno'],
        $input['ifsccode']
    ) == false
) {
    array_push($response, ['error' => 'Input is missing ']);
} else {
    try {
        $sql =
            'UPDATE worker_worker SET city = ?, email = ?, password = ?, mobile = ?, name = ?, photo = ?, dob = ?, gender = ?, rate = ?, bio = ?, maritalstatus = ?, height = ?, weight = ?, habits = ?, education = ?, religion = ?, language = ?, bankname = ?, accountholdername = ?, accountno = ?, ifsccode = ? WHERE id = ?';
        $stat = $db->prepare($sql);
        $stat->bindparam(1, $input['city']);
        $stat->bindparam(2, $input['email']);
        $stat->bindparam(3, $input['password']);
        $stat->bindparam(4, $input['mobile']);
        $stat->bindparam(5, $input['name']);
        $image_name =
            rand(10, 99) .
            rand(10, 99) .
            rand(10, 99) .
            $_FILES['photo']['name'];
        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            'images/' . $image_name
        );
        $stat->bindparam(6, $image_name);
        $stat->bindparam(7, $input['dob']);
        $stat->bindparam(8, $input['gender']);
        $stat->bindparam(9, $input['rate']);
        $stat->bindparam(10, $input['bio']);
        $stat->bindparam(11, $input['maritalstatus']);
        $stat->bindparam(12, $input['height']);
        $stat->bindparam(13, $input['weight']);
        $stat->bindparam(14, $input['habits']);
        $stat->bindparam(15, $input['education']);
        $stat->bindparam(16, $input['religion']);
        $stat->bindparam(17, $input['language']);
        $stat->bindparam(18, $input['bankname']);
        $stat->bindparam(19, $input['accountholdername']);
        $stat->bindparam(20, $input['accountno']);
        $stat->bindparam(21, $input['ifsccode']);
        $stat->bindparam(22, $input['workerid']);
        $stat->execute();
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'Worker updated successfully']);
    } catch (PDOException $error) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Invalid Request']);
    }
}
echo json_encode($response);

?>
