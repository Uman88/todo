<?php

session_start();

require_once 'connection.php';

$email = filter_var(strtolower(trim($_POST['email'])), FILTER_VALIDATE_EMAIL);
$password = filter_var(md5(trim($_POST['password'])), FILTER_SANITIZE_STRING);

$sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
    ];

    header('Location: /');
} else {
    $_SESSION['message'] = 'Неверный email или пароль';
    header('Location: /index.php?route=login');
}