<?php
require_once '../app/core/init.php';

if (!empty($_SESSION['user'])) {
    header('Location: index.php?id=2');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <?php include INCLUDES . '/css.php'; ?>

</head>
<body>

<div class="container">
    <div class="form-center">
        <form action="/index.php?route=signup" method="post" class="form">
            <h2 class="title-form">Регистрация</h2>
            <div class="input-field">
                <span class="material-symbols-outlined">person</span>
                <input type="text" name="name" placeholder="Введите имя">
            </div>
            <div class="input-field">
                <span class="material-symbols-outlined">mail</span>
                <input type="text" name="email" placeholder="Введите email">
            </div>
            <div class="input-field">
                <span class="material-symbols-outlined">lock</span>
                <input type="password" name="password" placeholder="Введите пароль">
            </div>
            <div class="input-field">
                <span class="material-symbols-outlined">lock</span>
                <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
            </div>
            <input type="submit" value="Зарегистрироваться" class="btn-reg-login">
            <p>
                Если есть аккаунт? <a href="/index.php?route=login" class="account-text">Авторизируйтесь</a>
            </p>
            <?php if (isset($_SESSION['message'])) : ?>
            <p id="message" class="msg">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                endif; ?>
            </p>
        </form>
    </div>
</div>

<script>
    setTimeout(function () {
        document.getElementById('message').style.display = 'none';
    }, 3000);
</script>
</body>
</html>