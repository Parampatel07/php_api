import os

def create_files(file_data):
    for data in file_data:
        file_name = data['file_name']
        file_content = data['content']

        # Create the file and write the content
        with open(file_name, 'w') as file:
            file.write(file_content)

        print(f"File '{file_name}' created successfully.")

# Example usage
file_data_list = [
    {
        'file_name': 'get_tour_alarm.php',
        'content': '''<?php
/*
    Usage: Used to get a tour alarm
    How to call: http://localhost/api/tour/get_tour_alarm.php?id=1
    Output:
    [{"error":"input is missing"}]
    [{"message":"Tour alarm fetched successfully", "data": {...}}]
    Input: id (required)
*/
require_once 'connection.php';
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM tour_alarm WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $tour_alarm = $stat->fetch(PDO::FETCH_ASSOC);
    if ($tour_alarm) {
        echo json_encode(['message' => 'Tour alarm fetched successfully', 'data' => $tour_alarm]);
    } else {
        echo json_encode(['error' => 'Tour alarm not found']);
    }
} else {
    echo json_encode(['error' => 'Input is missing']);
}
?>'''
    },
    {
        'file_name': 'get_tour_booking.php',
        'content': '''<?php
/*
    Usage: Used to get a tour booking
    How to call: http://localhost/api/tour/get_tour_booking.php?id=1
    Output:
    [{"error":"input is missing"}]
    [{"message":"Tour booking fetched successfully", "data": {...}}]
    Input: id (required)
*/
require_once 'connection.php';
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM tour_booking WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $tour_booking = $stat->fetch(PDO::FETCH_ASSOC);
    if ($tour_booking) {
        echo json_encode(['message' => 'Tour booking fetched successfully', 'data' => $tour_booking]);
    } else {
        echo json_encode(['error' => 'Tour booking not found']);
    }
} else {
    echo json_encode(['error' => 'Input is missing']);
}
?>'''
    },
      {
        'file_name': 'get_tour_incomeexpense.php',
        'content': '''<?php
/*
    Usage: Used to get a tour incomeexpense
    How to call: http://localhost/api/tour/get_tour_incomeexpense.php?id=1
    Output:
    [{"error":"input is missing"}]
    [{"message":"Tour incomeexpense fetched successfully", "data": {...}}]
    Input: id (required)
*/
require_once 'connection.php';
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM tour_incomeexpense WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $tour_incomeexpense = $stat->fetch(PDO::FETCH_ASSOC);
    if ($tour_incomeexpense) {
        echo json_encode(['message' => 'Tour incomeexpense fetched successfully', 'data' => $tour_incomeexpense]);
    } else {
        echo json_encode(['error' => 'Tour incomeexpense not found']);
    }
} else {
    echo json_encode(['error' => 'Input is missing']);
}
?>'''
    },
    {
        'file_name': 'get_tour_message.php',
        'content': '''<?php
/*
    Usage: Used to get a tour message
    How to call: http://localhost/api/tour/get_tour_message.php?id=1
    Output:
    [{"error":"input is missing"}]
    [{"message":"Tour message fetched successfully", "data": {...}}]
    Input: id (required)
*/
require_once 'connection.php';
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM tour_message WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $tour_message = $stat->fetch(PDO::FETCH_ASSOC);
    if ($tour_message) {
        echo json_encode(['message' => 'Tour message fetched successfully', 'data' => $tour_message]);
    } else {
        echo json_encode(['error' => 'Tour message not found']);
    }
} else {
    echo json_encode(['error' => 'Input is missing']);
}
?>'''
    },
    {
        'file_name': 'get_tour_photograph.php',
        'content': '''<?php
/*
    Usage: Used to get a tour photograph
    How to call: http://localhost/api/tour/get_tour_photograph.php?id=1
    Output:
    [{"error":"input is missing"}]
    [{"message":"Tour photograph fetched successfully", "data": {...}}]
    Input: id (required)
*/
require_once 'connection.php';
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM tour_photograph WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $tour_photograph = $stat->fetch(PDO::FETCH_ASSOC);
    if ($tour_photograph) {
        echo json_encode(['message' => 'Tour photograph fetched successfully', 'data' => $tour_photograph]);
    } else {
        echo json_encode(['error' => 'Tour photograph not found']);
    }
} else {
    echo json_encode(['error' => 'Input is missing']);
}
?>'''
    },
    {
        'file_name': 'get_tour_tour.php',
        'content': '''<?php
/*
    Usage: Used to get a tour tour
    How to call: http://localhost/api/tour/get_tour_tour.php?id=1
    Output:
    [{"error":"input is missing"}]
    [{"message":"Tour tour fetched successfully", "data": {...}}]
    Input: id (required)
*/
require_once 'connection.php';
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM tour_tour WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $tour_tour = $stat->fetch(PDO::FETCH_ASSOC);
    if ($tour_tour) {
        echo json_encode(['message' => 'Tour tour fetched successfully', 'data' => $tour_tour]);
    } else {
        echo json_encode(['error' => 'Tour tour not found']);
    }
} else {
    echo json_encode(['error' => 'Input is missing']);
}
?>'''
    },
    {
        'file_name': 'get_tour_user.php',
        'content': '''<?php
/*
    Usage: Used to get a tour user
    How to call: http://localhost/api/tour/get_tour_user.php?id=1
    Output:
    [{"error":"input is missing"}]
    [{"message":"Tour user fetched successfully", "data": {...}}]
    Input: id (required)
*/
require_once 'connection.php';
$input = $_REQUEST;
if (isset($input['id'])) {
    $sql = 'SELECT * FROM tour_user WHERE id = ?';
    $stat = $db->prepare($sql);
    $stat->bindParam(1, $input['id']);
    $stat->execute();
    $tour_user = $stat->fetch(PDO::FETCH_ASSOC);
    if ($tour_user) {
        echo json_encode(['message' => 'Tour user fetched successfully', 'data' => $tour_user]);
    } else {
        echo json_encode(['error' => 'Tour user not found']);
    }
} else {
    echo json_encode(['error' => 'Input is missing']);
}
?>'''
    }
    ]
create_files(file_data_list)