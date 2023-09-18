<?php

session_start();

require_once 'connection.php';

$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$email = filter_var(strtolower(trim($_POST['email'])), FILTER_VALIDATE_EMAIL);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
$password_confirm = filter_var(trim($_POST['password_confirm']), FILTER_SANITIZE_STRING);

// Checking regular expressions for the correct address entered
if (!preg_match('~^[a-z0-9-_\.]+@[a-z0-9-\.]+\.\S{2,8}$~', $email)) {
    $_SESSION['message'] = 'Адрес указан не корректно';
    header('Location: /index.php?route=register');
    exit();
}

// Check length of name and password
if (mb_strlen($name) < 3 || mb_strlen($name) > 50) {
    $_SESSION['message'] = 'Недопустимая длина имени';
    header('Location: /index.php?route=register');
    exit();
} elseif (mb_strlen($password) < 3 || mb_strlen($password) > 12) {
    $_SESSION['message'] = 'Недопустимая длина пароля (от 3 до 12 символов)';
    header('Location: /index.php?route=register');
    exit();
}

// Checking for the existence of a registered email
$check_user = "SELECT * FROM `users` WHERE `email` = '$email'";
$result_check_user = $conn->query($check_user);
$user = $result_check_user->fetch_assoc();

if ($user['email'] === $email) {
    $_SESSION['message'] = 'Такой email уже существует';
    header('Location: /index.php?route=register');
    exit;
}

// Checking for the same password and password hashing
if ($password === $password_confirm) {
    $password = md5($password);

    $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')";
    $result = $conn->query($sql);

    $_SESSION['message'] = 'Регистрация прошла успешно';
    header('Location: /index.php?route=login');
} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: /index.php?route=register');
}


