<?php

require_once 'connection.php';

$task = filter_var(trim($_POST['task']), FILTER_SANITIZE_STRING);
$category = filter_var($_POST['select-category'], FILTER_SANITIZE_NUMBER_INT);
$priority = filter_var($_POST['select-priority'], FILTER_SANITIZE_NUMBER_INT);
$user_id = $_SESSION['user']['id'];
$date = date('m-d-Y');

mysqli_query($connect, "
INSERT INTO 
    `tasks` (`title`, `id_category`, `id_user`, `priority`) 
VALUES 
    ('$task', '$category', '$user_id', '$priority')");

header('Location: /');