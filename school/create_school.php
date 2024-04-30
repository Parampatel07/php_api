<?php
/*
    Usage: Used to create a new school
    How to call: http://localhost/api/school/create_school.php?password=...&email=...&schoolname=...&mobile=...&contactno=...&address=...&cityid=...&status=...&categoryid=...&carpetarea=...&noofbuildings=...&establishmentyear=...&parkingfacility=...&playground=...&library=...&canteen=...&hostel=...&busfacility=...&auditorium=...&restroom=...&stroage=...&actype=...&multimedia=...&awards=...&isgranted=...&trust=...&website=...&coeducation=...&scout=...&PT=...&uniform=...&parentmeeting=...&minimumparenteducation=...&music=...&dance=...&gimnisum=...&computerlab=...&firesafty=...&profilecompletionstatus=...&acctype=...
    Output:
    [{"error":"input is missing"}]
    [{"error":"no"},{"success":"yes"},{"message":"School created successfully"}]
    Input: password, email, schoolname, mobile, contactno, address, cityid, status, categoryid, carpetarea, noofbuildings, establishmentyear, parkingfacility, playground, library, canteen, hostel, busfacility, auditorium, restroom, stroage, actype, multimedia, awards, isgranted, trust, website, coeducation, scout, PT, uniform, parentmeeting, minimumparenteducation, music, dance, gimnisum, computerlab, firesafty, profilecompletionstatus, acctype (all required)
*/
require_once 'connection.php';
$response = [];
$input = $_REQUEST;
if (
    isset(
        $input['password'],
        $input['email'],
        $input['schoolname'],
        $input['mobile'],
        $input['contactno'],
        $input['address'],
        $input['cityid'],
        $input['status'],
        $input['categoryid'],
        $input['carpetarea'],
        $input['noofbuildings'],
        $input['establishmentyear'],
        $input['parkingfacility'],
        $input['playground'],
        $input['library'],
        $input['canteen'],
        $input['hostel'],
        $input['busfacility'],
        $input['auditorium'],
        $input['restroom'],
        $input['stroage'],
        $input['actype'],
        $input['multimedia'],
        $input['awards'],
        $input['isgranted'],
        $input['trust'],
        $input['website'],
        $input['coeducation'],
        $input['scout'],
        $input['PT'],
        $input['uniform'],
        $input['parentmeeting'],
        $input['minimumparenteducation'],
        $input['music'],
        $input['dance'],
        $input['gimnisum'],
        $input['computerlab'],
        $input['firesafty'],
        $input['profilecompletionstatus'],
        $input['acctype']
    )
) {
    $sql =
        'INSERT INTO school_school (password, email, schoolname, mobile, contactno, address, cityid, status, categoryid, carpetarea, noofbuildings, establishmentyear, parkingfacility, playground, library, canteen, hostel, busfacility, auditorium, restroom, stroage, actype, multimedia, awards, isgranted, trust, website, coeducation, scout, PT, uniform, parentmeeting, minimumparenteducation, music, dance, gimnisum, computerlab, firesafty, profilecompletionstatus, acctype) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['password']);
    $stat->bindParam(2, $input['email']);
    $stat->bindParam(3, $input['schoolname']);
    $stat->bindParam(4, $input['mobile']);
    $stat->bindParam(5, $input['contactno']);
    $stat->bindParam(6, $input['address']);
    $stat->bindParam(7, $input['cityid']);
    $stat->bindParam(8, $input['status']);
    $stat->bindParam(9, $input['categoryid']);
    $stat->bindParam(10, $input['carpetarea']);
    $stat->bindParam(11, $input['noofbuildings']);
    $stat->bindParam(12, $input['establishmentyear']);
    $stat->bindParam(13, $input['parkingfacility']);
    $stat->bindParam(14, $input['playground']);
    $stat->bindParam(15, $input['library']);
    $stat->bindParam(16, $input['canteen']);
    $stat->bindParam(17, $input['hostel']);
    $stat->bindParam(18, $input['busfacility']);
    $stat->bindParam(19, $input['auditorium']);
    $stat->bindParam(20, $input['restroom']);
    $stat->bindParam(21, $input['stroage']);
    $stat->bindParam(22, $input['actype']);
    $stat->bindParam(23, $input['multimedia']);
    $stat->bindParam(24, $input['awards']);
    $stat->bindParam(25, $input['isgranted']);
    $stat->bindParam(26, $input['trust']);
    $stat->bindParam(27, $input['website']);
    $stat->bindParam(28, $input['coeducation']);
    $stat->bindParam(29, $input['scout']);
    $stat->bindParam(30, $input['PT']);
    $stat->bindParam(31, $input['uniform']);
    $stat->bindParam(32, $input['parentmeeting']);
    $stat->bindParam(33, $input['minimumparenteducation']);
    $stat->bindParam(34, $input['music']);
    $stat->bindParam(35, $input['dance']);
    $stat->bindParam(36, $input['gimnisum']);
    $stat->bindParam(37, $input['computerlab']);
    $stat->bindParam(38, $input['firesafty']);
    $stat->bindParam(39, $input['profilecompletionstatus']);
    $stat->bindParam(40, $input['acctype']);
    $result = $stat->execute();
    if ($result) {
        array_push($response, ['error' => 'no']);
        array_push($response, ['success' => 'yes']);
        array_push($response, ['message' => 'School created successfully']);
    } else {
        array_push($response, ['error' => 'yes']);
        array_push($response, ['success' => 'no']);
        array_push($response, ['message' => 'Failed to create school']);
    }
} else {
    array_push($response, ['error' => 'input is missing']);
}
echo json_encode($response);
?>
