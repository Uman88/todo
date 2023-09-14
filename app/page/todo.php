<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODO List</title>
    <?php include 'includes/css.php' ?>
</head>
<body>

<?php
if (isset($_SESSION['user'])) {
    include 'includes/header.php';
    include 'includes/sidebar.php';
    include 'includes/content.php';
}
?>

<?php include 'js.php'; ?>
</body>
</html>