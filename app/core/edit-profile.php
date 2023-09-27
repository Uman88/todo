<?php

require_once 'connection.php';

// Upload avatar
if (isset($_POST['download-avatar']) && !empty($_POST['download-avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $fileTMPPath = $_FILES['avatar']['tmp_name'];
    $fileName = $_FILES['avatar']['name'];
    $fileSize = $_FILES['avatar']['size'];
    $fileType = $_FILES['avatar']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $newFileName = md5(microtime() . $fileName) . '.' . $fileExtension;

    $id_user = $_SESSION['user']['id'];
    $allowedImageExtensions = ['jpg', 'png'];
    if (in_array($fileExtension, $allowedImageExtensions)) {
        $des_path = ROOT . IMAGES . '/' . $newFileName;

        if (move_uploaded_file($fileTMPPath, $des_path)) {
            $sql2 = "UPDATE `users` SET images='$newFileName' WHERE id='$id_user'";
            $conn->query($sql2);

            $_SESSION['message'] = 'Аватар успешно загружен!';
            header('Location: /index.php?route=profile');
            exit();
        } else {
            $_SESSION['message'] = 'Произошла ошибка, ваш аватар не загружен!';
            header('Location: /index.php?route=profile');
            exit();
        }
    }
}

// Unlink avatar by user
if (isset($_POST['delete-avatar'])) {
    $id_avatar = filter_var(trim($_POST['id-avatar']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name_avatar = filter_var(trim($_POST['name-avatar']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (unlink(ROOT . IMAGES . '/' . $name_avatar)) {
        $update = "UPDATE `users` SET images='' WHERE id='$id_avatar'";
        $conn->query($update);
        header('Location: /index.php?route=profile');
        exit();
    } else {
        $_SESSION['message'] = 'Произошла ошибка при удалении вашего аватара!';
        header('Location: /index.php?route=profile');
        exit();
    }
}

// Save changes in the field by user
if (isset($_POST['btn-save'])) {
    $name = filter_var(trim($_POST['username']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password_confirm = filter_var(trim($_POST['password_confirm']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = $_SESSION['user']['id'];

// Check length of name and password
    if (mb_strlen($name) < 3 || mb_strlen($name) > 50) {
        $_SESSION['message'] = 'Недопустимая длина имени';
        header('Location: /index.php?route=profile');
        exit();
    } elseif (mb_strlen($password) < 3 || mb_strlen($password) > 12) {
        $_SESSION['message'] = 'Недопустимая длина пароля (от 3 до 12 символов)';
        header('Location: /index.php?route=profile');
        exit();
    }

// Checking for the same password and password hashing
    if ($password === $password_confirm) {
        $password = md5($password);

        $sql = "UPDATE `users` SET name='$name', password='$password' WHERE id='$id'";
        $conn->query($sql);

        $_SESSION['message'] = 'Ваш профиль обновился';
        header('Location: /index.php?route=profile');
        exit();
    } else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: /index.php?route=profile');
        exit();
    }
}