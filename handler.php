<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$hostname = "localhost";
$username = "root";
$password = "";
$db = "todo";

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$days = [
    '0' => 'Вс',
    '1' => 'Пн',
    '2' => 'Вт',
    '3' => 'Ср',
    '4' => 'Чт',
    '5' => 'Пт',
    '6' => 'Сб',
];

$months = [
    '01' => 'Январь',
    '02' => 'Февраль',
    '03' => 'Март',
    '04' => 'Апрель',
    '05' => 'Май',
    '06' => 'Июнь',
    '07' => 'Июль',
    '08' => 'Август',
    '09' => 'Сентябрь',
    '10' => 'Октябрь',
    '11' => 'Ноябрь',
    '12' => 'Декабрь'
];

$date = date('Y-m-d H:i:s');

// Insert into db
if (isset($_POST['title']) && isset($_POST['category']) && isset($_POST['priority'])) {
    $title = htmlspecialchars(trim($_POST['title']));
    $cat = htmlspecialchars(trim($_POST['category']));
    $prio = htmlspecialchars(trim($_POST['priority']));

    mysqli_query(
        $conn,
        "INSERT INTO `task` (`title`, `category`, `priority`, `datetime`)VALUES('$title','$cat','$prio','$date')"
    );
}

// Rename task
if (isset($_POST['value']) && isset($_POST['id'])) {
    $title = htmlspecialchars(trim($_POST['value'], ENT_QUOTES));
    $id = htmlspecialchars(trim($_POST['id']));

    mysqli_query($conn, "UPDATE `task` SET title='$title', datetime='$date' WHERE id='$id'");
}

// Delete task
if (isset($_POST['deltask'])) {
    $delid = htmlspecialchars(trim($_POST['deltask']));
    mysqli_query($conn, "DELETE FROM `task` WHERE id='$delid'");
}

// Sort tasks
if (isset($_POST['arrid'])) {
    $arrIds = explode(",", htmlspecialchars(trim($_POST['arrid'])));
    // Инкрементирую ключ $k, для того чтобы сортировка начиналось не с 0, а 1.
    // Это сделано для того, когда добавляется задача у нее по умолчанию сортировка с 0
    // Сама задача находится верху списка.
    foreach ($arrIds as $k => $v) {
        $k++;
        mysqli_query($conn, "UPDATE `task` SET sortable='$k' WHERE id='$v'");
    }
}

// When click by checkbox also crossed out task
if (isset($_POST['crossedOut']) && isset($_POST['id'])) {
    $checkbox = htmlspecialchars(trim($_POST['crossedOut']));
    $id = htmlspecialchars(trim($_POST['id']));

    mysqli_query($conn, "UPDATE `task` SET checkbox='$checkbox' WHERE id='$id'");
}

// When you uncheck the box, remove the crossed out tasks
if (isset($_POST['removeCrossedOut']) && isset($_POST['id'])) {
    $checkbox = htmlspecialchars(trim($_POST['removeCrossedOut']));
    $id = htmlspecialchars(trim($_POST['id']));

    mysqli_query($conn, "UPDATE `task` SET checkbox='$checkbox' WHERE id='$id'");
}   