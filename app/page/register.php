<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>

    <?php include 'includes/css.php' ?>

</head>
<body>

<div class="container">
    <div class="form-center">
        <form action="/index.php?route=signup" method="post" class="form">
            <h2 class="title-form">Регистрация</h2>
            <div class="input-field">
                <i class="ri-user-line"></i>
                <input type="text" name="name" placeholder="Введите имя">
            </div>
            <div class="input-field">
                <i class="ri-mail-line"></i>
                <input type="text" name="email" placeholder="Введите email">
            </div>
            <div class="input-field">
                <i class="ri-lock-line"></i>
                <input type="password" name="password" placeholder="Введите пароль">
            </div>
            <div class="input-field">
                <i class="ri-lock-line"></i>
                <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
            </div>
            <input type="submit" value="Зарегистрироваться" class="btn-reg-login">
            <p>
                Если есть аккаунт? <a href="/index.php?route=login" class="account-text">Авторизируйтесь</a>
            </p>
            <?php if (isset($_SESSION['message'])) : ?>
            <p class="msg">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                endif; ?>
            </p>
        </form>
    </div>
</div>

<?php include 'includes/js.php' ?>

</body>
</html>