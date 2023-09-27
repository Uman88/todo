<?php

require_once '../app/core/init.php';

if (empty($_SESSION['user'])) {
    header('Location: index.php?route=login');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include INCLUDES . '/css.php'; ?>
    <title>Профиль</title>
</head>
<body>
<?php
if (isset($_SESSION['user'])) {
    include INCLUDES . '/header.php';
    include INCLUDES . '/sidebar.php';
    include INCLUDES . '/profile.php';
} else {
    include 'login.php';
}
?>

<?php include INCLUDES . '/js.php'; ?>
</body>
</html>