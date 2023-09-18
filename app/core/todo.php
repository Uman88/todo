<?php

require_once 'connection.php';

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
    $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
    $cat = filter_var(trim($_POST['category']), FILTER_VALIDATE_INT);
    $prio = filter_var(trim($_POST['priority']), FILTER_VALIDATE_INT);

    $insert = "INSERT INTO `task` (`title`, `category`, `priority`, `datetime`)VALUES('$title','$cat','$prio','$date')";
    $conn->query($insert);
}

// Rename task
if (isset($_POST['value']) && isset($_POST['id'])) {
    $title = filter_var(trim($_POST['value'], FILTER_SANITIZE_STRING));
    $id = filter_var(trim($_POST['id']), FILTER_VALIDATE_INT);

    $rename = "UPDATE `task` SET title='$title', datetime='$date' WHERE id='$id'";
    $conn->query($rename);
}

// Delete task
if (isset($_POST['deltask'])) {
    $delid = filter_var(trim($_POST['deltask']), FILTER_VALIDATE_INT);

    $delete = "DELETE FROM `task` WHERE id='$delid'";
    $conn->query($delete);
}

// Sort tasks
if (isset($_POST['arrid'])) {
    $arrIds = explode(",", filter_var(trim($_POST['arrid'])), FILTER_VALIDATE_INT);
    // Инкрементирую ключ $k, для того чтобы сортировка начиналось не с 0, а 1.
    // Это сделано для того, когда добавляется задача у нее по умолчанию сортировка с 0
    // Сама задача находится верху списка.
    foreach ($arrIds as $k => $v) {
        $k++;
        $sort = "UPDATE `task` SET sortable='$k' WHERE id='$v'";
        $conn->query($sort);
    }
}

// When click by checkbox also crossed out task
if (isset($_POST['crossedOut']) && isset($_POST['id'])) {
    $checkbox = filter_var(trim($_POST['crossedOut']), FILTER_VALIDATE_INT);
    $id = filter_var(trim($_POST['id']), FILTER_VALIDATE_INT);

    $crossedOut = "UPDATE `task` SET checkbox='$checkbox' WHERE id='$id'";
    $conn->query($crossedOut);
}

// When you uncheck the box, remove the crossed out tasks
if (isset($_POST['removeCrossedOut']) && isset($_POST['id'])) {
    $checkbox = filter_var(trim($_POST['removeCrossedOut']), FILTER_VALIDATE_INT);
    $id = filter_var(trim($_POST['id']), FILTER_VALIDATE_INT);

    $removeCrossedOut = "UPDATE `task` SET checkbox='$checkbox' WHERE id='$id'";
    $conn->query($removeCrossedOut);
}