<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>

    <?php include 'includes/css.php' ?>

</head>
<body>

<div class="container">
    <div class="form-center">
        <form action="/index.php?route=signin" method="post" enctype="multipart/form-data" class="form">
            <h2 class="title-form">Авторизация</h2>
            <div class="input-field">
                <i class="ri-mail-line"></i>
                <input type="email" name="email" placeholder="Введите email">
            </div>
            <div class="input-field">
                <i class="ri-lock-line"></i>
                <input type="password" name="password" placeholder="Введите пароль">
            </div>
            <input type="submit" value="Авторизоваться" class="btn-reg-login">
            <p>У вас нет аккаунта? <a href="/index.php?route=register" class="account-text">Зарегистрируйтесь</a></p>
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