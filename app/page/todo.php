<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= APP_NAME; ?></title>
    <?php include INCLUDES . '/css.php' ?>
</head>
<body>

<?php

if (isset($_SESSION['user'])) {
    include INCLUDES . '/header.php';
    include INCLUDES . '/sidebar.php';
    include INCLUDES . '/content.php';
} else {
    include 'login.php';
}
?>

<?php include INCLUDES . '/js.php'; ?>
</body>
</html>