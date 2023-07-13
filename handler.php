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
if (!empty($_POST['name-task'])) {
    $task = htmlspecialchars(trim($_POST['name-task']));
    mysqli_query($conn, "INSERT INTO `task` (`title`, `datetime`) VALUES ('$task', '$date')");

    header('Location: /');
}

// Rename task
if (isset($_GET['value']) && isset($_GET['id'])) {
    $title = htmlspecialchars($_GET['value'], ENT_QUOTES);
    $id = htmlspecialchars(trim($_GET['id']));

    mysqli_query($conn, "UPDATE `task` SET title='$title', datetime='$date' WHERE id='$id'");
}

// Delete task
if (isset($_GET['delid'])) {
    $delid = (int)$_GET['delid'];
    if (is_numeric($delid)) {
        mysqli_query($conn, "DELETE FROM `task` WHERE id='$delid'");
    }
}

// Sort tasks
if (isset($_GET['arrid'])) {
    $arrIds = explode(",", htmlspecialchars(trim($_GET['arrid'])));
    // Инкрементирую ключ $k, для того чтобы сортировка начиналось не с 0, а 1.
    // Это сделано для того, когда добавляется задача у нее по умолчанию сортировка с 0
    // Сама задача находится верху списка.
    foreach ($arrIds as $k => $v){
        $k++;
        mysqli_query($conn, "UPDATE `task` SET sortable='$k' WHERE id='$v'");
    }
}