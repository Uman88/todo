<?php

require_once 'connection.php';

$task = filter_var(trim($_POST['task']), FILTER_SANITIZE_STRING);
$date = date('m-d-Y');

$id = '1';

$user_id = $_SESSION['user']['id'];

$result = mysqli_query($connect, "INSERT INTO `tasks` (`title`, `id_category`, `id_user`) VALUES ('$task', '$id', '$user_id')");

header('Location: /index.php?route=todo');