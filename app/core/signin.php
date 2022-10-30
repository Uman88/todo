<?php

session_start();

require_once 'connection.php';

$email = filter_var(strtolower(trim($_POST['email'])), FILTER_VALIDATE_EMAIL);
$password = filter_var(md5(trim($_POST['password'])), FILTER_SANITIZE_STRING);

$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

if (mysqli_num_rows($check_user) > 0) {
    $user = mysqli_fetch_assoc($check_user);

    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
    ];

    header('Location: /index.php?route=todo');
} else {
    $_SESSION['message'] = 'Неверный email или пароль';
    header('Location: /index.php?route=login');
}