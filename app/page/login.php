<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
    <?php
    include INCLUDES . '/css.php'; ?>

</head>
<body>

<div class="container">
    <div class="form-center">
        <form action="/index.php?route=signin" method="post" enctype="multipart/form-data" class="form">
            <h2 class="title-form">Авторизация</h2>
            <div class="input-field">
                <span class="material-symbols-outlined">mail</span>
                <input type="email" name="email" placeholder="Введите email">
            </div>
            <div class="input-field">
                <span class="material-symbols-outlined">lock</span>
                <input type="password" name="password" placeholder="Введите пароль">
            </div>
            <input type="submit" value="Авторизоваться" class="btn-reg-login">
            <p>У вас нет аккаунта? <a href="/index.php?route=register" class="account-text">Зарегистрируйтесь</a></p>
            <?php
            if (isset($_SESSION['message'])) : ?>
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